<?php
/**
 * @param $tasks array массив с задачами
 * @param $project
 * @return int
 * Считает количество невыполненных задач в проекте
 */
function  countProjects(array $tasks, $project): int
{
    $count = 0;
    foreach ($tasks as $value) {
        if ($value['project_id'] == $project['id']&&$value['complete']!=1) {
            $count++;
        }
    }
    return $count;
}

/**
 * @param $date
 * @return bool
 * @throws Exception
 * Проверяет сколько осталось времени до выполнения задачи, если меньше дня или задача просрочена, то подсвечивает
 */

function checkTime ($date) :bool {
    if ($date==null) {
        return false;
    }

    $date1 = new DateTime('now');
    $date2 = new DateTime($date);
    $difference = $date2->diff($date1);
    return $difference->days<=1||$difference->invert==0;
}

/**
 * @param $link
 * @param int $userId
 * @return array
 * Создает массив из проектов, выбранных по конкретному юзеру
 */

function getProjectsByUserId ($link,  int $userId) : array {
    $sql = "SELECT * FROM projects WHERE user_id = " . $userId . " ";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        die('Неверный запрос: ' . mysqli_error());
    }
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $array;
}

/**
 * @param $link
 * @param int $userId
 * @return array
 * Создает массив из задач, выбранных по конкретному юзеру
 */
function getTasksByUserId ($link, int $userId) : array {
    $sql = "SELECT * FROM tasks WHERE user_id = " . $userId . " ";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        die('Неверный запрос: ' . mysqli_error());
    }
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $array;
}

/**
 * @param $link
 * @param int $user_id
 * @param int $project
 * @return array
 */

function getTasksByProjectId ($link, int $user_id,  $project ) : array  {
 if ($project) {
     $id = intval($project);
     $sql = "SELECT * FROM tasks WHERE user_id = ". $user_id . " AND  project_id =" . $id . " ";
 }else{
     $sql = "SELECT * FROM tasks WHERE user_id = ". $user_id . " ";
 }
    $result = mysqli_query($link, $sql);
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $array;
}

function validateProject ($value, $projectsId) {
    if (!in_array($value, $projectsId)){
        return "Указан несуществующий проект!";
    }
    return null;
}

function validateLength($value, $min, $max) {
    if($value) {
       $len = strlen($value);
       if ($len < $min or $len > $max) {
           return "Значение должно быть от $min  до $max символов";
       }
    }
    return null;
}


function validateProjectName (array $projectsContent, $projectName)
{
    $projectName= mb_strtoupper($projectName);
        if (in_array($projectName, $projectsContent)) {
            return "Указан cуществующий проект!";
        }

    return null;
}

function addProject($link, array $post, int $userId){
    $projectAdd['project_name']= mb_strtoupper($post['project_name']);

    $sql = "INSERT INTO projects (user_id, content)
            VALUES (".$userId. ", ?)";

    $stmt = db_get_prepare_stmt($link, $sql, $projectAdd);
    $res = mysqli_stmt_execute($stmt);

    if (!$res) {
        die('Неверный запрос: ' . mysqli_error());
    }
}

function addTask($link, array $taskAdd, int $userId){
    $sql = "INSERT INTO tasks (user_id, content,  project_id, dt_end, url)
            VALUES (".$userId. ", ?, ?, ?, ? )";

    $stmt = db_get_prepare_stmt($link, $sql, $taskAdd);
    $res = mysqli_stmt_execute($stmt);

    if (!$res) {
        die('Неверный запрос: ' . mysqli_error());
    }
}

function getAllEmails ($link):array{
    $sql = "SELECT email FROM users";
    $result = mysqli_query($link, $sql);
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $array = array_column($array, 'email');
    return $array;

}

function validateEmail ($post, array $allEmails)
{
    $email = $post;
    if (in_array(strtolower($email), $allEmails)) {
        return "Указана cуществующая почта!";
    }

    return null;
}

function addUser ($link, array $userAdd){
    $sql = "INSERT INTO users (email, password,  name)
            VALUES ( ?, ?, ? )";
    $userAdd['password'] = password_hash($userAdd['password'], PASSWORD_DEFAULT);

    $stmt = db_get_prepare_stmt($link, $sql, $userAdd);
    $res = mysqli_stmt_execute($stmt);

    if (!$res) {
        die('Неверный запрос: ' . mysqli_error());
    }
}

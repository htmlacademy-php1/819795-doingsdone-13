<?php
/**
 * @param $tasks array массив с задачами
 * @param $project
 * @return int
 * Считает количество невыполненных задач в проекте
 */
function countProjects(array $tasks, $project): int
{
    $count = 0;
    foreach ($tasks as $value) {
        if ($value['project_id'] == $project['id'] && $value['complete'] != 1) {
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

function checkTime($date): bool
{
    if ($date == null) {
        return false;
    }

    $date1 = new DateTime('now');
    $date2 = new DateTime($date);
    $difference = $date2->diff($date1);
    return $difference->days < 1 || $difference->invert == 0;
}

/**
 * @param $link
 * @param int $userId
 * @return array
 * Создает массив из проектов, выбранных по конкретному юзеру
 */

function getProjectsByUserId($link, int $userId): array
{
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
function getTasksByUserId($link, int $userId): array
{
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

function getTasks($link, int $user_id, int $project, int $sort): array
{

    if ($sort == 1) {
        $sort = " AND DAY(dt_end) = DAY(NOW())";
    } else {
        if ($sort == 2) {
            $sort = " AND DAY(dt_end) = DAY(DATE_ADD(CURDATE(),INTERVAL 1 DAY))";
        } else {
            if ($sort == 3) {
                $sort = " AND DAY(dt_end) < DAY(NOW())";
            } else {
                $sort = "";
            }
        }
    }

    if ($project) {
        $id = $project;
        $sql = "SELECT * FROM tasks WHERE user_id = " . $user_id . " AND  project_id =" . $id . $sort;
    } else {
        $sql = "SELECT * FROM tasks WHERE user_id = " . $user_id . $sort;
    }
    $result = mysqli_query($link, $sql);
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $array;
}

function validateProject($value, $projectsId)
{
    if (!in_array($value, $projectsId)) {
        return "Указан несуществующий проект!";
    }
    return null;
}

function validateLength($value, $min, $max)
{
    if ($value) {
        $len = strlen($value);
        if ($len < $min or $len > $max) {
            return "Значение должно быть от $min  до $max символов";
        }
    }
    return null;
}


function validateProjectName(array $projectsContent, $projectName)
{
    $projectName = mb_strtoupper($projectName);
    if (in_array($projectName, $projectsContent)) {
        return "Указан cуществующий проект!";
    }

    return null;
}

function addProject($link, array $post, int $userId)
{
    $projectAdd['project_name'] = mb_strtoupper($post['project_name']);

    $sql = "INSERT INTO projects (user_id, content)
            VALUES (" . $userId . ", ?)";

    $stmt = db_get_prepare_stmt($link, $sql, $projectAdd);
    $res = mysqli_stmt_execute($stmt);

    if (!$res) {
        die('Неверный запрос: ' . mysqli_error());
    }
}

function addTask($link, array $taskAdd, int $userId)
{
    $sql = "INSERT INTO tasks (user_id, content,  project_id, dt_end, url)
            VALUES (" . $userId . ", ?, ?, ?, ? )";

    $stmt = db_get_prepare_stmt($link, $sql, $taskAdd);
    $res = mysqli_stmt_execute($stmt);

    if (!$res) {
        die('Неверный запрос: ' . mysqli_error());
    }
}

function getAllEmails($link): array
{
    $sql = "SELECT email FROM users";
    $result = mysqli_query($link, $sql);
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $array = array_column($array, 'email');
    return $array;

}

function validateEmail($post, array $allEmails)
{
    $email = $post;
    if (in_array(strtolower($email), $allEmails)) {
        return "Указана cуществующая почта!";
    }

    return null;
}

function addUser($link, array $userAdd)
{
    $sql = "INSERT INTO users (email, password,  name)
            VALUES ( ?, ?, ? )";
    $userAdd['password'] = password_hash($userAdd['password'], PASSWORD_DEFAULT);
    $userAdd['email'] = mb_strtolower($userAdd['email']);
    $stmt = db_get_prepare_stmt($link, $sql, $userAdd);
    $res = mysqli_stmt_execute($stmt);

    if (!$res) {
        die('Неверный запрос: ' . mysqli_error());
    }
}

function checkEmail(string $email, array $allEmails)
{
    if (in_array(strtolower($email), $allEmails)) {
        return null;
    }
    return "Указана неcуществующая почта!";


}


function getUserByEmail($link, string $email)
{
    $email = mysqli_real_escape_string($link, $email);
    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($link, $sql);

    if ($result == '') {
        die('Неверный запрос: ' . mysqli_error());
    }

    $array = mysqli_fetch_array($result, MYSQLI_ASSOC);

    return $array;
}

function checkSession()
{
    if (empty($_SESSION['userId'])) {
        header('Location: /logout.php');
        exit;
    }

}

function searchTasks($link, int $userId, $search): array
{
    $search = mysqli_real_escape_string($link, $search);
    $sql = "SELECT * FROM tasks WHERE user_id = " . $userId . " AND MATCH(content) AGAINST('" . $search . "')";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        die('Неверный запрос: ' . mysqli_error());
    }
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $array;
}

function setComplete($link, int $task, int $complete)
{
    $sql = "UPDATE tasks SET complete='$complete' WHERE id='$task'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        die('Неверный запрос: ' . mysqli_error());
    }
}




function checkAlarm($link): array
{
    $sql = "SELECT t.content, t.dt_end, u.email, u.name FROM tasks t
   INNER JOIN users u ON u.id = t.user_id WHERE DAY(dt_end) = DAY(NOW())";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        die('Неверный запрос: ' . mysqli_error());
    }
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $array;
}

function checkAuth()
{
    if (isset($_SESSION['userId'])) {
        header('Location: /logout.php');
        exit;
    }

}



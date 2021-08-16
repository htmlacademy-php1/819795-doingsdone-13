USE doingsdone;
INSERT INTO users
SET email = 'basay1980@gmail.com', password = '1980', name = 'Константин';
INSERT INTO users
SET email = 'basay1981@gmail.com', password = '1981', name = 'Вася';

INSERT INTO projects (content, user_id)
VALUES ('Входящие', '1'),
       ('Учеба', '1'),
       ('Работа', '1'),
       ('Домашние дела', '1'),
       ('Авто', '1');

SET time_zone='+00:00';

-- не работает запрос ниже...по таймстампу дает ошибку
INSERT INTO tasks (user_id, project_id, content, complete, dt_end, url )
VALUES ('1', '3', 'Собеседование в IT компании', 0, '03.08.2021',''),
       ('1', '3', 'Выполнить тестовое задание', 0, '25.12.2021',''),
       ('1', '2', 'Сделать задание первого раздела', 1, '02.07.2021',''),
       ('1', '1', 'Встреча с другом', 0, '22.09.2021',''),
       ('1', '4', 'Купить корм для кота', 0, '',''),
       ('1', '4', 'Заказать пиццу', 0, '','');

-- этот вариант работает
INSERT INTO tasks
SET user_id = '1', project_id = '3', content = 'Собеседование в IT компании' ,
     dt_end = '03.08.2021';
INSERT INTO tasks
SET user_id = '1', project_id = '3', content = 'Выполнить тестовое задание' ,
  dt_end = '25.12.2021';
INSERT INTO tasks
SET user_id = '1', project_id = '2', content = 'Сделать задание первого раздела' ,
  complete = 1, dt_end = '02.07.2021';
INSERT INTO tasks
SET user_id = '1', project_id = '1', content = 'Встреча с другом' ,
  dt_end = '22.09.2021';
INSERT INTO tasks
SET user_id = '1', project_id = '4', content = 'Купить корм для кота' ;
INSERT INTO tasks
SET user_id = '1', project_id = '4', content = 'Заказать пиццу' ;

-- Выбрать проекты, созданные Константином
SELECT content FROM projects WHERE user_id = '1';

-- получить список из всех задач для одного проекта;
SELECT * FROM tasks WHERE project_id= '3';

-- пометить задачу как выполненную
UPDATE tasks SET complete = 1 WHERE id = 3;

-- обновить название задачи по её идентификатору
UPDATE tasks SET content = 'Сделать задание первого раздела' WHERE id = 3;

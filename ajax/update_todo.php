<?php
    require_once("../bootstrap.php");

    if (!empty($_POST)) {
            $todo = new Todo();

            //set info
            $todo->setTitle($_POST['title']);
            $todo->setTime($_POST['time']);
            $todo->setTodoId($todoId);
            $rawdate = htmlentities($_POST['date']);
            $date = date('Y-m-d', strtotime($rawdate));
            $todo->setDate($date);

            // info about space to db and get id from space
        $todo->updateTodo($todoId);


        }
            else {
                
            }
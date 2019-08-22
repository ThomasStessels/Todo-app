<?php
    require_once("../bootstrap.php");

    $userId = $_SESSION['user'][0];
    $todoId = $_POST['todoId'];

    echo $todoId;
    
    $todo = new Todo();
    $todo->checkTodo($todoId);
    

  
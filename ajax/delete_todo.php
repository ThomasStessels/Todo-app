<?php
    require_once("../bootstrap.php");

    $userId = $_SESSION['user'][0];
    $todoId = $_POST['todoId'];

    $todo = new Todo();
    $todo->deleteTodo($todoId);
    
    header("Location: index.php");
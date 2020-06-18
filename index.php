<?php
require_once('bootstrap.php');
// User::checkLogin();
if (isset($_SESSION['user'])) {
    //logged in user
    //echo "😎";
} else {
    //no logged in user
    header('Location: login.php');
}
$myTodos = Todo::getTodos();
$CheckedTodos = Todo::getCheckedTodos();
$UncheckedTodos = Todo::getUncheckedTodos();
?><!doctype html>

<html lang="en">
<head>
    <?php include_once("includes/head.inc.php"); ?>

</head>

<body>
    <div id="canvas">

    <header>
        <?php include_once("includes/nav.inc.php"); ?>
    </header>

    <section id="main">

    <article class="todo">
    <h2>To do</h2>

    <ul class="itemlist todo">
        <?php foreach($UncheckedTodos as $t): ?>
            <li><a href="todo.php?todo_id=<?php echo $t['id'] ?>"><span class="icon"><i class=" fas fa-pen-square"></i></span><h3><?php echo $t['title'];?></h3> <p class="urgent">Due: <?php echo $t['date'] ?></p></a></li>
        <?php endforeach; ?>
    </ul>


    </article>

    <article class="done">
    <h2>Done</h2>

    <ul class="itemlist done">
        <?php foreach($CheckedTodos as $t): ?>
            <li><a href="todo.php?todo_id=<?php echo $t['id'] ?>"><span class="icon"><i class=" fas fa-pen-square"></i></span><h3><?php echo $t['title'];?></h3> <p class="urgent">Due: <?php echo $t['date'] ?></p></a></li>
        <?php endforeach; ?>
    </ul>
    
    </article>

    </section>


    </div>
</body>
</html>
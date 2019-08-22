<?php
    require_once("bootstrap.php");

    $userId = $_SESSION['user'][0];
    $listId = $_GET['list_id'];
    $MyLists = MyLists::getListInformation($listId);
    $todos = Todo::getTodosFromList($listId);
    
?><!doctype html>

<html lang="en">
<head>
    <?php include_once("includes/head.inc.php"); ?>

</head>

<body>
    <div id="canvas">

    <header>
    <?php include_once("includes/create.inc.php"); ?>
    </header>

    <section id="main">

    <article class="todo">
    <ul class="itemlist list">
        <?php foreach($todos as $l): ?>
            <li><a href="todo.php?todo_id=<?php echo $l['id'] ?>"><h3><?php echo $l['title'];?></h3></a></li>
        <?php endforeach; ?>
    </ul>
    </article>

    </section>


    </div>
</body>
</html>
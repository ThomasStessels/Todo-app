<?php
    require_once("bootstrap.php");

    if (!empty($_POST)) {
        $newList = new MyLists();

        // get user_id
        $userId = $_SESSION['user'][0];

        //set info
        $newList->setTitle($_POST['title']);

        // info about list to db and get id from list
       $listId = $newList->registerList();
    }
        else {
            
        }
    
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

    <article class="create">
    <h2>New list</h2>

    <form action="" method="post">
    <input type="text" id="title" name="title" placeholder="List Name" class="field" required>
    <input type="submit" value="Create" class="btn save">
    </form>
    </article>

    </section>


    </div>
</body>
</html>
<?php
    require_once("bootstrap.php");

    if (!empty($_POST)) {
        $todo = new Todo();

        // get user_id
        $userId = $_SESSION['user'][0];

        //set info
        $todo->setTitle($_POST['title']);
        $todo->setTime($_POST['time']);
        $todo->setListId($_POST['lists']);
        $rawdate = htmlentities($_POST['date']);
        $date = date('Y-m-d', strtotime($rawdate));
        $todo->setDate($date);

        // info about todo to db and get id from todo
       $todoId = $todo->registerTodo();

        //go to next page
        header("Location: index.php");
    }
        else {
            
        }
        $Mylists = MyLists::getLists();
    
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
    <h2>New To do</h2>

    <form action="" method="post">
    <input type="text" id="title" name="title" placeholder="Todo Name" class="field" required>
    <div class="small-container">
        <label class="due field" for="">Estimated Time</label>
        <input type="time" class="field" name="time" min="00:00" max="18:00" required>
    </div> 
    <div class="small-container">
        <label class="due field" for="">Due By</label>
        <input type="date" class="field date" name="date">
    </div> 
    <div class="small-container">
        <label class="due field" for="">Add to list</label>
        <select id="lists" name="lists">
            <?php foreach($Mylists as $l): ?>
                <option value="<?php echo $l['id'];?>"><?php echo $l['title'];?></option>
            <?php endforeach; ?>
    </select>
    </div>
    <input type="submit" value="Create" class="btn save">
    </form>

    </article>

    </section>


    </div>
</body>
</html>
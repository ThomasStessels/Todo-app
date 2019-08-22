<?php
    require_once("bootstrap.php");

    $userId = $_SESSION['user'][0];
    $todoId = $_GET['todo_id'];
    $todos = Todo::getTodoInfo($todoId);
    $todos = array_shift($todos);
    $c = $todos['done'];
    if ($c >= 1){
        $c = "checked";
    } else {
        $c = "unchecked";
    };
    //lists
    $myLists = MyLists::getListTitle($todos['list_id']);
    $myLists = array_shift($myLists);


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
    <h2>To do: <?php echo $todos['title']; ?></h2>

    <form action="">
    <input type="text" id="title" name="title" placeholder="<?php echo $todos['title']; ?>" class="field" >
    <div class="small-container">
        <label class="due field" for="">Estimated Time</label>
        <input type="time" class="field" name="time" value="<?php echo $todos['time']; ?>" min="00:00" max="18:00" >
    </div> 
    <div class="small-container">
        <label class="due field" for="">Due By</label>
        <input type="date" class="field date" value="<?php echo $todos['date']; ?>" name="date">
    </div>
    <div class="small-container">
        <label class="due field" for="">To do / done</label>
        <label class="switch field">
            <input type="checkbox" data-id="<?php echo $todoId; ?>" id="done" value="done" name="done" <?php echo $c ?>>
            <span class="slider round"></span>
        </label>  
    </div> 
    <div class="small-container">
        <label class="due field" for="">Added to list</label>
        <input type="text" id="list" name="list" placeholder="<?php echo $myLists['title']; ?>" class="field" >
    </div>
    <input type="submit" value="Update" class="btn save">
    </form>

    </article>

    </section>


    </div>
    <script type="text/javascript">
    $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            var todoId = $(this).data("id");
            if($(this).prop("checked") == true){
                $.ajax({
                    url: 'ajax/check_todo.php',
                    type: 'POST',
                    data: { todoId: todoId }
                });
            }
            else if($(this).prop("checked") == false){
                $.ajax({
                    url: 'ajax/uncheck_todo.php',
                    type: 'POST',
                    data: { todoId: todoId }
                });
            }
        });
    });
</script>
</body>
</html>
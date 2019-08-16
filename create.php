<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="large-container">
<header>
    <a href="#" class="close"> &#10006 </a>
    <h1>NEW TODO</h1>
    <a href="index.php" class="second">Save</a>
</header>
    <form action="">
    <span></span>
    <input type="text" id="todo" name="todo" placeholder="Todo Name" class="field">
    <span></span>
    <div class="small-container">
        <label class="due field" for="">Due Date</label>
        <label class="switch field">
            <input type="checkbox">
            <span class="slider round"></span>
        </label>  
    </div>  
    <div class="small-container">
        <label class="due field" for="">Due By</label>
    </div>
    <div class="small-container-date">
        <input type="date" name="date">
    </div>
    </form>
    </div>
</body>
</html>
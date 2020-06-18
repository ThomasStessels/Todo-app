<div class="head">
    <div class="head-left">
      <a href="create.php" class="btn">Create</a>
    </div>
    <div class="head-center">
    <h1>TODO APP</h1>
    </div>
    <div class="head-right">
      <div id="navToggle" class="slide-menu">
        <div class="menu-open"><i class="fas fa-bars"></i></div>
        <div class="menu-close"><i class="fas fa-times"></i></div>
      </div>
    </div>
 </div> 
   <div class="menu">
    <ul>
      <li><a href="./create.php">Create todo</a></li>
      <li><a href="./createList.php">Create list</a></li>
      <li><a href="./lists.php">Lists</a></li>
      <li class="menu__logout"><a href="./logout.php">Logout</a></li>
    </ul>
</div> 


<script>
$( document ).ready(function() {
    $( "#navToggle" ).click(function() {
      $(this).toggleClass('open');
      $( ".menu" ).toggleClass( "active");
    });
});</script>
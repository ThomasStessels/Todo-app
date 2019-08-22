<?php
include_once("bootstrap.php");
// get user and password from POST
if(!empty($_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];

	$user = new User();
	$user->setEmail($email);
	$user->setPassword($password);
	//check if user can login (use function)
    $data = $user->CanILogin();
    if($data != false){
        $_SESSION['user'] = $data;
        // if ok -> redirect to index.php
        header('Location: index.php');
    }
    else {
        $error = "Login failed";
    }
}
?>

<!doctype html>

<html lang="en">
<head>
    <?php include_once("includes/head.inc.php"); ?>

</head>

<body>
    <div id="canvas" class="loginscreen">

    <section id="main">

    <article class="create">

    <div class="large-container dissapear">
        <h1>ToDo App</h1>
        <div class="Login">
            <form action="" method="post">
                <?php if( isset($error) ): ?>
                    <div class="form__error">
                        <p>
                            Sorry, we can't log you in with that email and password. Can you try again?
                        </p>
                    </div>
                <?php endif; ?>
                <label class="input" for="email">Email</label>
                <input type="text" id="email" name="email" class="field">
                <label class="input" for="password">Password</label>
                <input type="password" id="password" name="password" class="field">
                <input type="submit" value="Login" class="btn" id="loginbtn">
            </form>
            <a href="register.php" class="noMember">Not a member yet?</a>
        </div>
    </div>


        </article>

    </section>


    </div>


    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>

</body>
</html>
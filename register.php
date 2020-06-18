<?php

    require_once("bootstrap.php");
    include_once("classes/security.class.php");
	
	if ( !empty($_POST)) {
		try
        {
            $security = new Security();
            $security->password = $_POST['password'];
            $security->passwordConfirmation = $_POST['repeatpassword'];

            if( $security->passwordsAreSecure() ){

                $user = new User();
                $user->setVoornaam($_POST['voornaam']);   
                $user->setFamilienaam($_POST['familienaam']);          
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->setPasswordConfirmation($_POST['repeatpassword']);

                if($user->isAccountAvailable($_POST['email'])){
                    $data = $user->register();
                    if($data != false) {
                        $_SESSION['user'] = $data;
                        header('location: index.php');
                    }else{
                        $error = true;
                    }
                }
			}
			else {
				$perror = "Your passwords are not secure or do not match.";
			}
        }
        catch(Exception $e) {
			$perror = $e->getMessage();
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

    <div class="large-container">
        <h1>ToDo App</h1>
        <div class="Login">
            <form action="" method="post">
                <h2>Create new account</h2>
                <?php if(isset($error)): ?>
                        <div class="form__error">
                            <p>
                                <?php echo "Something went wrong!"; ?>
                                
                            </p>
                        </div>
                <?php endif; ?>
                <?php if(isset($perror)): ?>
                        <div class="form__error">
                            <p>
                              <?php echo $perror; ?>
                            </p>
                        </div>
                <?php endif; ?>
                <label class="input" for="voornaam">Voornaam</label>
                <input type="text" name="voornaam" id="voornaam" class="field">
                
                <label class="input" for="familienaam">Familienaam</label>
                <input type="text" name="familienaam" id="familienaam" class="field">

                <label class="input" for="email">Email</label>
                <input type="text" id="email" name="email" class="field">
                <p class="availabilityCheck"></p>


                <label class="input" for="password">Password</label>
                <input type="password" id="password" name="password" class="field">

                <label class="input" for="repeatpassword">Repeat Password</label>
                <input type="password" id="repeatpassword" name="repeatpassword" class="field">

                <input type="submit" value="Register" class="btn">
            </form>
            <a class="btn cancel" href="./index.php">Cancel</a>
        </div>
    </div>


        </article>

    </section>


    </div>

    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script language="JavaScript" type="text/javascript" src="js/check_email.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/check_username.js"></script>
</body>
</html>
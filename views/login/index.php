<?php
session_start();
require_once 'libs/User.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
   $user_login->redirect(URL.'dashboard');
}

if(isset($_POST['btn-login']))
{
    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtupass']);

    if($user_login->login($email,$upass))
    {
        $user_login->redirect(URL. 'dashboard');
    }
}
?>
<?php require 'views/header.php'; ?>
<div class="container">
    <?php
    if(isset($_GET['inactive']))
    {
        ?>
        <div class='alert alert-error'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it.
        </div>
        <?php
    }
    ?>
    <form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))
        {
            ?>
            <div class='alert alert-success'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Wrong Details!</strong>
            </div>
            <?php
        }
        ?>
        <h2 class="form-signin-heading">Sign In.</h2>
        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Password" name="txtupass" required />
        <button class="btn btn-large btn-primary" type="submit" name="btn-login">Sign in</button>
        <a href="signup" style="float:right;" class="btn btn-large">Sign Up</a>
        <a href="fpass">Lost your Password ? </a>
    </form>

</div> <!-- /container -->

<?php require 'views/footer.php'; ?>

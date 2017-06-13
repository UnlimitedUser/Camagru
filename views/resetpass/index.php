<?php
require_once 'libs/User.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
    $user->redirect(URL. 'index');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
    $id = base64_decode($_GET['id']);
    $code = $_GET['code'];

    $stmt = $user->runQuery("SELECT * FROM camagru.users WHERE id=:uid AND tokenCode=:token");
    $stmt->execute(array(":uid"=>$id,":token"=>$code));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() == 1)
    {
        if(isset($_POST['btn-reset-pass']))
        {
            $pass = $_POST['pass'];
            $cpass = $_POST['confirm-pass'];

            if($cpass!==$pass)
            {
                $msg = "<div class='alert alert-block'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <strong>Sorry!</strong>  Password Doesn't match. 
      </div>";
            }
            else
            {
                $stmt = $user->runQuery("UPDATE camagru.users SET password=:upass WHERE id=:uid");
                $stmt->execute(array(":upass"=>md5($cpass),":uid"=>$rows['id']));

                $msg = "<div class='alert alert-success'>
      <button class='close' data-dismiss='alert'>&times;</button>
      Password Changed.
      </div>";
                header("refresh:2;index");
            }
        }
    }
    else
    {
        exit;
    }


}

?>
<?php require 'views/header.php'; ?>
<div class="container">
    <div class='alert alert-success'>
        <strong>Hello !</strong>  <?php echo $rows['username'] ?> you are here to reset your forgetton password.
    </div>
    <form class="form-signin" method="post">
        <h3 class="form-signin-heading">Password Reset.</h3><hr />
        <?php
        if(isset($msg))
        {
            echo $msg;
        }
        ?>
        <input type="password" class="input-block-level" placeholder="New Password" name="pass" required />
        <input type="password" class="input-block-level" placeholder="Confirm New Password" name="confirm-pass" required />
        <hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Reset Your Password</button>

    </form>

</div> <!-- /container -->
<?php require 'views/footer.php'; ?>
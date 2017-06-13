<?php
require_once 'libs/User.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
    $user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
    $id = base64_decode($_GET['id']);
    $code = $_GET['code'];

    $statusY = "Y";
    $statusN = "N";

    $stmt = $user->runQuery("SELECT id,userStatus FROM camagru.users WHERE id=:uID AND tokenCode=:code LIMIT 1");
    $stmt->execute(array(":uID"=>$id,":code"=>$code));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0)
    {
        if($row['userStatus']==$statusN)
        {
            $stmt = $user->runQuery("UPDATE camagru.users SET userStatus=:status WHERE id=:uID");
            $stmt->bindparam(":status",$statusY);
            $stmt->bindparam(":uID",$id);
            $stmt->execute();

            $msg = "
             <div class='alert alert-success'>
       <button class='close' data-dismiss='alert'>&times;</button>
       <strong>WoW !</strong>  Your Account is Now Activated : <a href='index.php'>Login here</a>
          </div>
          ";
        }
        else
        {
            $msg = "
             <div class='alert alert-error'>
       <button class='close' data-dismiss='alert'>&times;</button>
       <strong>sorry !</strong>  Your Account is allready Activated : <a href='index.php'>Login here</a>
          </div>
          ";
        }
    }
    else
    {
        $msg = "
         <div class='alert alert-error'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <strong>sorry !</strong>  No Account Found : <a href='signup.php'>Signup here</a>
      </div>
      ";
    }
}

?>
<?php if(isset($msg)) { echo $msg; } ?>

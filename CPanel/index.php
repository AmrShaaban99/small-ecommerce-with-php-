<?php 
session_start();
$nonavbar="";
$pageTitle="Login";
if(isset($_SESSION['Username'])){
    header('Location:dashboard.php');}
include 'init.php';
require_once '../lib/userlogin.php';
?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $Username = $_POST['user'];
    $hasspass = $_POST['pass'];
    $password = sha1($hasspass);
    if($Username == null){
        echo "please insert the value of name";
    }elseif(is_numeric($Username)){
        echo "the value of name must be letters";
    }elseif ($hasspass == null){
        echo "please insert the password";
    }else{
        $login = new login($Username, $password);
        if ($login->checkLogin($Username, $password)){
            $_SESSION['Username']=$Username;
            $_SESSION['UserId']=$login->checkLogin($Username, $password);
            header('Location:dashboard.php');
            exit();
        } else {
            echo"the user is not admin maneger";
        }
    }
}
?>
<form class="login" action=" <?php echo $_SERVER['PHP_SELF'];?> " method="post">
    <h4 class="text-center">Admin login</h4>
    <input class="form-control input-lg" type="text" name="user" placeholder="Username" autocomplete="off" />
    <input class="form-control input-lg" type="password" name="pass" placeholder="password" autocomplete="new-password" />
    <input class="btn btn-primary btn-block btn-lg" type="submit" value="Login"/>
</form>




<?php include 'template/footer.php';?>


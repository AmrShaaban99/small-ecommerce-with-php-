<?php
ob_start();
session_start();
if(isset($_SESSION['name'])){
    header('Location:index.php');
}
include 'lib/userlogin.php';
include 'init.php';
?>
<section class="module bg-dark-30" data-background="assets/images/section-4.jpg">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt mb-0">Login-Register</h1>
            </div>
        </div>
    </div>
</section>
<?php
            if(isset($_POST['Register'])){
                $username=$_POST['username'];   
                $password=$_POST['password'];
                $Repassword=$_POST['re-password'];
                $email=$_POST['email'];
                $fullname=$_POST['fullname'];  
                if ($username == null) {
                    redirectTOPage("the user name is empty");
               } elseif (is_numeric($username)) {
                   redirectTOPage("please enter name not a number");
               } elseif ($password == null) {
                   redirectTOPage("please enter the password");
               } elseif ($fullname == null) {
                   redirectTOPage(" please enter full name not a number");
               } elseif (is_numeric($fullname)) {
                   redirectTOPage("please enter name not a number");
               } elseif ($email == null) {
                   redirectTOPage("please enter email");

               }elseif ($Repassword !=$password) {
                   echo "<div class='alert alert-success'>the Re password is not correct </div>";
               } else {  
                    if(checkItem('Username','users', $username)){
                        $addmember=new member($username, $password, $email, $fullname);
                        if($addmember->Addmember('0')){
                            $_SESSION['name']=$username;
                            header('Location:index.php');
                            exit(); 
                        } else {
                            redirectTOPage("worng");
                        }
                    }else{
                        redirectTOPage("Sorry This User is not Exist");
                    }
                }
            }
          ?>
<?php
            if(isset($_POST['login'])){
                $user=$_POST['username'];   
                $hass=$_POST['password'];
                $pass = sha1($hass);
                if ($user == null) {
                    redirectTOPage("the user name is empty");
               } elseif (is_numeric($user)) {
                   redirectTOPage("please enter name not a number");
               } elseif ($pass == null) {
                   redirectTOPage("please enter the password");
               } else {  
                    $log = new login($user, $pass);
                    if ($log->checkLogin($user,$pass)){
                        $_SESSION['name']=$user;
                        $_SESSION['Id']=$log->checkLogin($user, $pass);
                        header('Location:index.php');
                        exit();
                    } else {
                        echo"the user is not admin manager";
                    }
                }
            }
          ?>
<section class="module">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-sm-offset-1 mb-sm-40">
                <h4 class="font-alt">Login</h4>
                <hr class="divider-w mb-10">
                <form class="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="form-group">
                        <input class="form-control" pattern=".{3,}" title="Username must 3 characters " id="username"
                            type="text" name="username" placeholder="Username" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" minlength="4" id="password" type="password" name="password"
                            placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-round btn-b" name="login">Login</button>
                    </div>
                    <div class="form-group"><a href="">Forgot Password?</a></div>
                </form>
            </div>

            <div class="col-sm-5">
                <h4 class="font-alt">Register</h4>
                <hr class="divider-w mb-10">
                <form class="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="form-group">
                        <input class="form-control" id="E-mail" type="email" name="email" placeholder="Email" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" pattern=".{3,}" title="Username must 3 characters " id="username"
                            type="text" name="username" placeholder="Username" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" minlength="4" id="password" type="password" name="password"
                            placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" minlength="4" id="re-password" type="password" name="re-password"
                            placeholder="Re-enter Password" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="fullname" placeholder="Full Name" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-round btn-b" name="Register">Register</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</section>
<div class="module-small bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">About Titan</h5>
                    <p>The languages only differ in their grammar, their pronunciation and their most common words.</p>
                    <p>Phone: +1 234 567 89 10</p>Fax: +1 234 567 89 10
                    <p>Email:<a href="#">somecompany@example.com</a></p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">Recent Comments</h5>
                    <ul class="icon-list">
                        <li>Maria on <a href="#">Designer Desk Essentials</a></li>
                        <li>John on <a href="#">Realistic Business Card Mockup</a></li>
                        <li>Andy on <a href="#">Eco bag Mockup</a></li>
                        <li>Jack on <a href="#">Bottle Mockup</a></li>
                        <li>Mark on <a href="#">Our trip to the Alps</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">Blog Categories</h5>
                    <ul class="icon-list">
                        <li><a href="#">Photography - 7</a></li>
                        <li><a href="#">Web Design - 3</a></li>
                        <li><a href="#">Illustration - 12</a></li>
                        <li><a href="#">Marketing - 1</a></li>
                        <li><a href="#">Wordpress - 16</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">Popular Posts</h5>
                    <ul class="widget-posts">
                        <li class="clearfix">
                            <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-1.jpg"
                                        alt="Post Thumbnail" /></a></div>
                            <div class="widget-posts-body">
                                <div class="widget-posts-title"><a href="#">Designer Desk Essentials</a></div>
                                <div class="widget-posts-meta">23 january</div>
                            </div>
                        </li>
                        <li class="clearfix">
                            <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-2.jpg"
                                        alt="Post Thumbnail" /></a></div>
                            <div class="widget-posts-body">
                                <div class="widget-posts-title"><a href="#">Realistic Business Card Mockup</a></div>
                                <div class="widget-posts-meta">15 February</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'template/footer.php';
ob_end_flush();
?>
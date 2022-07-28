<?php
ob_start();
session_start();
if(isset($_SESSION['Username'])){
    $pageTitle="Add members";
    include 'init.php';
    include '../lib/members.php';
    ?>
<div>
    <div class="Form-Of-Add">
        <h2>Add Member</h2>
        <?php
            if(isset($_POST['Addmember'])){
                $username=$_POST['username'];   
                $password=$_POST['password'];
                $email=$_POST['email'];
                $fullname=$_POST['fullname'];
                $avatarNam=$_FILES['avatar']['name'];
                $avatarName= rand('0','10000')."_".$avatarNam;
                $avatarSize=$_FILES['avatar']['size'];
                $avatarTmp=$_FILES['avatar']['tmp_name'];
                $avatarType=$_FILES['avatar']['type'];
                $avatarAllowedExtension=array("jpeg","jpg","png","gif");
                $avatarExtent= explode('.',$avatarName);
                $avatarExtention =strtolower(end($avatarExtent));
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

               } elseif (!in_array($avatarExtention, $avatarAllowedExtension)) {
                   redirectTOPage("This extention is not Allowed");
               }elseif ($avatarSize > '4194304') {
                   redirectTOPage("image cant be larger than 4 Mb");
               } else {  
                    if(checkItem('Username','users', $username)){
                        $addmember=new member($username, $password, $email, $fullname, $avatarName, $avatarTmp);
                        if($addmember->Addmember('1')){
                            echo '<div class="alert alert-success">correct</div>';
                        } else {
                            redirectTOPage("worng");
                        }
                    }else{
                        redirectTOPage("Sorry This User is not Exist");
                    }
                }
            }
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <h4>Username</h4>
        <input type="text"class="form-control" name="username" placeholder="Username" autocomplete="off" required="required" >
        <h4>Password</h4>
        <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required="required">
        <h4>Email</h4>
        <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required="required">
        <h4>Full Name</h4>
        <input type="text" class="form-control" name="fullname" placeholder="Full Name" autocomplete="off" required="required">
        <!--the start image of item field--> 
        <h4>image</h4>
        <div class="input-group">
            <label class="input-group-btn">
                <span class="btn btn-primary">
                    choose File <input type="file"name="avatar"  style="display: none;" multiple>
                </span>
            </label>
            <input type="text" class="form-control" readonly>
        </div>
        <!--the end Image field-->
        <div style="margin-top:20px; ">
            <input type="submit" name="Addmember" class="btn btn-primary  btn-group-lg " value="Add Member" />
            <a class="btn btn-primary" href="Editmember.php" >Edit member</a>
        </div>
        </form>
    </div>
</div>  

<?php  
    include 'template/footer.php';
}else {
    header('Location:index.php');
    exit();
}
ob_end_flush();
?>

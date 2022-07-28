<?php
ob_start();
session_start();
if (isset($_SESSION['Username'])) {
    $pageTitle = "Edit members";
    include '../lib/members.php';
    include 'init.php';
    ?> 
    <div class="Form-Of-Add">
        <h2><?php echo $pageTitle; ?></h2>
        <?php  
        if (isset($_GET["action"]) && isset( $_GET["UserId"])) {
            $action = $_GET["action"];
            $id = intval($_GET["UserId"]);
            switch ($action) {
                case 'delete':
                    if(!checkItem('userid', 'users',$id )){
                         if (member::deleteMemeberById($id)) {
                            redirectTOPagesucces("deleted Member successfully");
                        } else {
                            redirectTOPage('error deleted');
                        }
                    }else{
                        redirectTOPage('There is Sach Id');
                    }
                    break;

                case 'edit':
                    $member = member::retrieveMemeberById($id);
                    if($member){
                    echo'
                <form class="form-of-edit" action="' . $_SERVER['PHP_SELF'] . '" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                        <h4>Username</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text"class="form-control form-of-edit" name="username" value="' . $member['Username'] . '"  placeholder="Username" autocomplete="off" required="required" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Password</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-of-edit" name="password" value="' . $member['password'] . '"  placeholder="Password" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Email</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control form-of-edit" name="email" value="' . $member['Email'] . '"  placeholder="Email" autocomplete="off" required="required">
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Full Name</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-of-edit" name="fullname" value="' . $member['Fullname'] . '"  placeholder="Full  autocomplete="off" required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Image</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary">
                                            choose File
                                            <img src="../uploads/avatar/'.$member['Avatar'].'" style="width:50px; height:50px ">
                                            <input type="file" name="avatar"  style="display: none;"  multiple />
                                        </span>
                                    </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="' . $member['UserId'] . '"  />
                    <input type="submit" name="updateMember" class="btn btn-color-blue btn-group-lg " value="save" />
                </form>
                
             ';
                    }else{   
                        echo '<div class="alert alert-danger">there is sach id </div>';
                        
                    }
                    
                    break;
                case'Activate':   
                    if(member::updateStateOfUser($id,'RegStatus')){
                        redirectTOPagesucces("RegStatus Member successfully");
                    }else{
                        redirectTOPage('the user is not RegStatus change');
                    }
                    
                default :
                    echo '<div class="alert alert-danger">invalid action</div>';
            }
        }

        if (isset($_POST["updateMember"])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $id = $_POST['id'];
            $avatarNam=$_FILES['avatar']['name'];
            if($avatarNam!=Null){
                $avatarName= rand('0','10000')."_".$avatarNam;
                $avatarSize=$_FILES['avatar']['size'];
                $avatarTmp=$_FILES['avatar']['tmp_name'];
                $avatarType=$_FILES['avatar']['type'];
                $avatarAllowedExtension=array("jpeg","jpg","png","gif");
                $avatarExtent= explode('.',$avatarName);
                $avatarExtention =strtolower(end($avatarExtent));
                
            }else{
                $avatarName='.jpg';
                $avatarSize=NuLL;
                $avatarTmp=NULL;
                $avatarType=NULL;
                $avatarAllowedExtension=array("jpeg","jpg","png","gif");
                $avatarExtent= explode('.',$avatarName);
                $avatarExtention =strtolower(end($avatarExtent));
            }
            if ($username == null) {
                redirectTOPage("");
                echo '<div class="alert alert-danger">The user name is empty</div>';
            } elseif (is_numeric($username)) {
                echo '<div class="alert alert-danger">Please enter name not a number</div>';
            } elseif ($password == null) {
                echo '<div class="alert alert-danger">Please enter the password</div>';
            } elseif ($fullname == null) {
                echo '<div class="alert alert-danger">Please enter full name not a number</div>';
            } elseif (is_numeric($fullname)) {
                echo '<div class="alert alert-danger"> Please enter name not a number </div>';
            } elseif ($email == null) {
                echo '<div class="alert alert-danger"> Please enter email </div>';
            } else {
                if(checkItem('Username','users', $username)){
                    redirectTOPage("Sorry This User is not Exist");
                }else{
                    $updateMemeber = new member($username, $password, $email, $fullname,$avatarName, $avatarTmp, $id);
                    if ($updateMemeber->updatedatamember()) {
                        echo '<div class="alert alert-success">The update members is correct</div>';
                    } else {
                        echo '<div class="alert alert-danger">The update members is wronge</div>';
                    }
                }
            }
        }
        ?>
        <?php
        $Query='';
            if(isset($_GET["action"]) && $_GET["action"]=='pending'){
                $Query='1';
            }
            $members = member::selectAllMember($Query);
            if( !empty($members)){
                if (is_array($members)) {
            
            echo'<table class="table-data table-responsive" >
                <tr>   
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>Registered Date</th>
                    <th>Control</th>
                </tr>';
                    foreach ($members as $allMembers):
                        echo '<tr>
                                    <td class="table-left-border">' . $allMembers['UserId'] . '</td>
                                    <td>' . $allMembers['Username'] . '</td>
                                    <td>' . $allMembers['Email'] . '</td>
                                    <td>' . $allMembers['Fullname'] . '</td>
                                    <td>' . $allMembers['Date'] . '</td>    
                                    <td class="table-Right-border">
                                        <a class="btn edit-btn" href="?action=edit&UserId=' . $allMembers['UserId'] . '"><i class="fas fa-edit"></i> Edit</a>
                                        <a class="btn "style="color:rgb(211,41,41)" confirm" href="?action=delete&UserId=' . $allMembers['UserId'] . '"><i class="far fa-trash-alt"></i> Delete</a>';
                                    if($allMembers['RegStatus']==0){
                                        echo '<a class="btn" href="?action=Activate&UserId=' . $allMembers['UserId'] . '"><i class="fas fa-check"></i> Activate</a>';
                                    }
                                    echo '</td>
                                </tr>';
                    endforeach;
                    echo'</table>';
                    }else {
                        redirectHome("there is not exisit user");
                        }
                    } else {
                        echo '<div class="alert alert-info">There\'s No Record to show</div>';
                    }
                 ?>

            <a class="btn btn-primary " href="Addmember.php" ><i class="fas fa-plus"></i> &ensp; Add member</a>
            </div>
            <?php
            
        include 'template/footer.php';
    } else {
        header('Location:index.php');
        exit();
    }
    ob_end_flush();
    ?>

<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
?>
<div class="page">  
    <div class="leftpage col-md-2">
        <div class="header">
            <div><i class="fas fa-user fa-lg"></i></div>
            <div><a href="dashboard.php">Admin panel</a></div>
        </div>
        <div class="navbar">
            <ul class="list-unstyled">
                <a href="Editcategory.php" >
                    <div class="side-menu__icon">
                        <i class="fas fa-user fa-lg"></i>
                     </div>
                    <div class="side-menu-title"><?php echo lang('CATEGORIES'); ?></div>
                </a>
                <a href="EditItems.php" >
                    <div class="side-menu__icon">
                        <i class="fas fa-tag fa-lg"></i>
                     </div>
                    <div class="side-menu-title"><?php echo lang('ITEMS'); ?></div>
                </a>
                <a href="Editmember.php" class="active">
                    <div class="side-menu__icon">
                        <i class="fas fa-users fa-lg"></i>
                     </div>
                    <div class="side-menu-title"><?php echo lang('MEMBERS'); ?> </div>
                </a>
                <a href="ManageComment.php" class="active">
                    <div class="side-menu__icon">
                        <i class="fas fa-comments fa-lg"></i>
                     </div>
                    <div class="side-menu-title"><?php echo lang('COMMENTS'); ?> </div>
                </a>
                <a href="#" >
                    <div class="side-menu__icon">
                        <i class="fas fa-user fa-lg"></i>
                     </div>
                    <div class="side-menu-title"><?php echo lang('STATISTICS'); ?></div>
                </a>
                 <a href="#" >
                    <div class="side-menu__icon">
                        <i class="fas fa-user fa-lg"></i>
                     </div>
                    <div class="side-menu-title"><?php echo lang('LOGS'); ?></div>
                </a>
            </ul>
        </div>
    </div>        
    <div class="rightpage col-md-9">
        <div class="contant">
            <div class="topnavbar">
                <div class="col-md-3">
                    <h3 class="btn btn-primary btn-round visit-site"><a href="../index.php">visit Shop</a></h3>
                </div>  
                <div class="col-md-6 col-md-offset-3">
                    <form>
                        <div class="row">
                            <div class="navSearch col-md-6  col-md-offset-3">
                                <i class="fa fa-search icon-search fa-sm"></i>
                                <input type="text" class="inputSearch" placeholder="Search">
                            </div>
                            <div class="navprofile col-md-1 col-md-offset-2">
                                <div class="imgprofile">
                                    <img onclick="myFunction()" class="img-reponsive dropbtn "src="Capture.PNG" alt="image"/>
                                </div>
                                <div class="listofprofile">
                                    <div id="myDropdown" class="dropdown-content">
                                        <div class="icon-list-profile">
                                            <i class="fas fa-user fa-sm"></i>
                                        </div>
                                        <a href="Editmember.php?action=edit&UserId=<?php echo $_SESSION['UserId'];?>">Edit Profile</a>
                                        <div class="icon-list-profile">
                                            <i class="fas fa-user fa-sm"></i>
                                        </div>
                                        <a href="#about">Settings</a>
                                        <div class="icon-list-profile">
                                            <i class="fas fa-user fa-sm"></i>
                                        </div>
                                        <a href="Logout.php">Logout</a>						
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </form>
                </div>    
            </div>

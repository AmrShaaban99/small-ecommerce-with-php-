<?php
ob_start();
session_start();
if(isset($_SESSION['Username'])){
    $pageTitle="Dashboard";
    include 'init.php';
    ?>
    <div class="Dashboard">
        <h1><?php $pageTitle?></h1>
        <div class="statistics">
            <div class="top-contant ">
                <div class="col-xs-12">
                    <div class=" row ">
                        <div class="box col-xs-3" >
                            <div class="col-xs-2 icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="text-box col-xs-9 col-xs-offset-1 ">
                                <h4>Total Members</h4>
                                <p><a href="Editmember.php"><?php echo countItems('UserId','users');?></a></p> 
                            </div> 
                        </div>
                        <div class="box col-xs-3 " >
                            <div class="col-xs-2 icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="text-box col-xs-9 col-xs-offset-1">
                                <h4>pending Members</h4> 
                                <p><a href="Editmember.php?action=pending"><?php echo countItems('UserId','users','1');?></a></p>
                            </div> 
                        </div>
                        <div class="box col-xs-3" >
                            <div class="col-xs-2 icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div class=" text-box col-xs-9 col-xs-offset-1">
                                <h4>Total Items</h4> 
                                <p><a href="EditItems.php"><?php echo countItems('Item_ID','items');?></a></p>
                            </div> 
                        </div>
                        <div class="box col-xs-3 icon" >
                            <div class="col-xs-2 icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <div class="text-box col-xs-9 col-xs-offset-1">
                                <h4>Total Comment</h4> 
                                <p><a href="ManageComment.php"><?php echo countItems('C_ID','comments');?></a></p> 
                            </div> 
                        </div>
                    </div>
                </div>
            </div>    
            <div class="latest">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <?php $lastestUsers=5 ;?>
                                    <i class="fas fa-users"></i> Latest <?php echo $lastestUsers ?> Registerd Users
                                </div>
                                <div class="panel-body">
                                    <ul class="list-unstyled latest-users">
                                        <?php
                                        $thelatest= getLatest('*', 'users', 'UserID',5);
                                        if(!empty($thelatest)){
                                            foreach ( $thelatest as $user){
                                                echo '<li>'.$user['Username'].
                                                    '<a class="btn pull-right edit-btn" href="Editmember.php?action=edit&UserId=' . $user['UserId'] . '"><i class="fas fa-edit"></i> Edit</a>';
                                                        if ($user['RegStatus']==0){
                                                        echo'<a class="btn pull-right" href="Editmember.php?action=Activate&UserId=' . $user['UserId'] . '"><i class="fas fa-check"></i> Activate</a>';
                                                        }
                                                        echo'</li>';
                                            }
                                        }else{
                                             echo '<div class="alert alert-info">There\'s No Record to show</div>';
                                        }
                                        ?>
                                    </ul>    
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <?php $lastestItems=5 ;?>
                                    <i class="fas fa-tag"></i> Latest  <?php echo$lastestItems ;?> Items
                                </div>
                                <div class="panel-body">
                                    
                                     <ul class="list-unstyled latest-users">
                                        <?php
                                        $latest= getLatest('*', 'items', 'Item_ID',5);
                                        if(!empty($latest)){
                                            foreach ( $latest as $item){
                                                echo '<li>'.$item['Name'].
                                                    '<a class="btn pull-right edit-btn" href="EditItems.php?action=edit&Id=' . $item['Item_ID'] . '"><i class="fas fa-edit"></i> Edit</a>';
                                                if ($item['Approve']==0){
                                                echo'<a class="btn pull-right" href="EditItems.php?action=Approve&Id=' . $item['Item_ID'] . '"><i class="fas fa-check"></i> Activate</a>';
                                                }
                                                echo'</li>';
                                            }
                                        }else{
                                            echo '<div class="alert alert-info">There\'s No Record to show</div>';
                                        }    
                                        ?>
                                    </ul>    
                                </div>
                            </div>
                        </div>
                        </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <?php $lastestItems=5 ;?>
                                    <i class="fas fa-tag"></i> Latest  <?php echo$lastestItems ;?> Comments
                                </div>
                                <div class="panel-body">
                                    <?php
                                        
                                        $comment= getLatestwithjoin('comments.*,users.Username AS Member','comments','users','users.UserId','comments.user_id','comment_date',5);
                                        if(!empty($comment)){
                                            foreach ( $comment as $com){    
                                                echo '<div class="comment-box">';
                                                echo '<span class="member-n"><a href="Editmember.php?action=edit&UserId='.	$com['user_id'] .'">'.$com['Member'].'</a></span>';
                                                echo '<p class="member-c">'.$com['content'].'</p.>';
                                                echo '</div>';
                                            }
                                        }else{
                                            echo '<div class="alert alert-info">There\'s No Record to show</div>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
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

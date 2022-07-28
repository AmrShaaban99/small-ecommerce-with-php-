<?php
ob_start();
session_start();
if (isset($_SESSION['Username'])) {
    $pageTitle = "Manage Comments";
    include '../lib/members.php';
    include '../lib/comments.php';
    include '../lib/items.php';
    include 'init.php';
    ?> 
    <div class="Form-Of-Add">
        <h2><?php echo $pageTitle; ?></h2>
        <?php  
        if (isset($_GET["action"]) && isset( $_GET["Id"])) {
            $action = $_GET["action"];
            $id = intval($_GET["Id"]);
            switch ($action) {
                case 'delete':
                    if(!checkItem('C_ID', 'comments',$id )){
                         if (comments::deleteCommentById($id)) {
                            redirectTOPagesucces("deleted Item successfully");
                        } else {
                            redirectTOPage('error deleted',5);
                        }
                    }else{
                        redirectTOPage('There is Sach Id Item',5);
                    }
                    break;

                case 'edit':
                    $Com=comments::retrieveCommentById($id);
                    if($Com){
                    echo'
                <form class="form-of-edit" action="' . $_SERVER['PHP_SELF'] . '" method="post" >
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                        <h4>Name</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text"class="form-control form-of-edit" name="content" value="' . $Com['content'] . '"  placeholder="Name" autocomplete="off" required="required" >
                        </div>
                    </div>
                    
                    <input type="hidden" name="id" value="' . $Com['C_ID'] . '"  />
                    <input type="submit" name="updateComment" class="btn btn-color-blue btn-group-lg " value="save" />
                </form>
                
             ';
                    }else{   
                        echo '<div class="alert alert-danger">there is sach id </div>';
                        
                    }
                    
                    break;
                case'Approve':   
                    if(comments::updateApproveOfComment($id,'status')){
                        redirectTOPagesucces("Approve comment successfully");
                    }else{
                        redirectTOPage('NO Approve comment ');
                    }
                    
                default :
                    redirectTOPage("invalid action");
            }
        }

        if (isset($_POST["updateComment"])) {
            $id = $_POST['id'];
            $content= $_POST['content'];
            if ($content == null) {
                redirectTOPage("The content is empty");
            } else {
                $updateComment=new comments($content, $id);
                if ($updateComment->updatecomment()) {
                    redirectTOPagesucces('The update comment is correct');
                } else {
                    redirectTOPage("The update comment is wronge");
                }
            }
        }
        
        $comments= comments::selectAllComment();
            if(!empty($comments)){
            if (is_array($comments)) {
                
            echo'<table class="table-data table-responsive" >
                <tr>   
                    <th>Id</th>
                    <th>content</th>
                    <th>Item name</th>
                    <th>User Name</th>
                    <th>Added Date</th>
                    <th>Control</th>
                </tr>';
            foreach ($comments as $comment):
                    echo '<tr>
                                <td class="table-left-border">'.$comment['C_ID'].'</td>
                                <td>' .$comment['content']. '</td>
                                <td class="comment-size">' .$comment['item_name'] . '</td>   
                                <td>' .$comment['user_name'] . '</td>
                                <td>' .$comment['comment_date'] . '</td>    
                                <td class="table-Right-border">
                                    <a class="btn edit-btn" href="?action=edit&Id=' . $comment['C_ID'] . '"><i class="fas fa-edit"></i> Edit</a>
                                    <a class="btn "style="color:rgb(211,41,41)" confirm" href="?action=delete&Id=' . $comment['C_ID'] . '"><i class="far fa-trash-alt"></i> Delete</a>';
                                if($comment['status']==0){
                                    echo '<a class="btn" href="?action=Approve&Id=' . $comment['C_ID'] . '"><i class="fas fa-check"></i> Approve</a>';
                                }
                                echo'</td>
                            </tr>';
                                endforeach;
                    echo'</table>';
                
                }else {
                redirectHome("there is not exisit user");
                    }
                }else{
                    echo '<div class="alert alert-info">There\'s No Record to show</div>';
                }
                ?>
        <?php
        
        include 'template/footer.php';
    } else {
        header('Location:index.php');
        exit();
    }
    ob_end_flush();
    ?>

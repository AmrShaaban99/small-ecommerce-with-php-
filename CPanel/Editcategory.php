<?php
ob_start();
session_start();
if (isset($_SESSION['Username'])) {
    $pageTitle = "Manage Category";
    include '../lib/category.php';
    include 'init.php';
    ?> 
    <div class="Form-Of-Add">
        <h2><?php echo $pageTitle; ?></h2>
        <?php  
        if (isset($_GET["action"]) && isset( $_GET["CatId"])) {
            $action = $_GET["action"];
            $id = intval($_GET["CatId"]);
            switch ($action) {
                case 'delete':
                    if(!checkItem('ID', 'categories',$id )){
                         if (category::deleteCategoryById($id)) {
                            redirectTOPagesucces("deleted Category successfully");
                        } else {
                            redirectTOPage('error deleted');
                        }
                    }else{
                        redirectTOPage('There is Sach Id Category');
                    }
                    break;

                case 'edit':
                    
                    $Category = category::retrieveCategoryById($id);
                    if($Category){
                    echo'
                <form class="form-of-edit" action="' . $_SERVER['PHP_SELF'] . '" method="post" >
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                        <h4>Name</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text"class="form-control form-of-edit" name="name" value="' . $Category['Name'] . '"  placeholder="Name" autocomplete="off" required="required" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Description</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-of-edit" name="description" value="' . $Category['Description'] . '"  placeholder="Describe the category" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>parent?</h4>
                        </div>
                        <div class="col-md-6"> 
                        <select class="form-control" name="parent">';
                            $cat = category::selectAllCategory();
                            
                            foreach ($cat as $Categories){
                                if($Categories['ID']== $Category['ID'] ){
                                    $parent=getdatareturndata('Name', "categories","ID", $Categories['parent']);
                                      echo '<option value="'.$parent['ID'].'"selected="selected">'.$parent['Name'].'</option>';
                                }else{
                                    echo '<option value="'.$Categories['ID'].'">'.$Categories['Name'].'</option>';
                                }
                            } 
                            
                        echo '</select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Ordering</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-of-edit" name="ordering" value="' . $Category['Ordering']. '"  placeholder="Ordering" autocomplete="off">
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Visibility</h4>
                        </div>
                        <div class="col-md-6 margin-radio-category">
                            <label class="form-check-input" for="visible-yes">yes</label>
                            <input class="form-check-label" id="visible-yes" type="radio"  name="visibility" value="0" '.(($Category['Visibility']==0)?"checked":"").'>
                            <label class="form-check-input" for="visible-no">no</label>
                            <input class="form-check-label" id="visible-no" type="radio"  name="visibility" value="1" '.(($Category['Visibility']==1)?"checked":"").' >
                        </div>
                    </div>
                     <div class="row ">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Allow Commenting</h4>
                        </div>
                        <div class="col-md-6 margin-radio-category">
                            <label for="visible-yes">yes</label>
                            <input id="visible-yes" type="radio"  name="commenting" value="0" '.(($Category['Allow_Comment']==0)?"checked":"").'>
                            <label for="visible-no">no</label>
                            <input id="visible-no" type="radio"  name="commenting" value="1" '.(($Category['Allow_Comment']==1)?"checked":"").' >
                        </div>
                    </div> 
                    <div class="row ">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Allow Ads</h4>
                        </div>
                        <div class="col-md-6 margin-radio-category ">
                            <label for="visible-yes">yes</label>
                            <input id="visible-yes" type="radio"  name="ads" value="0" '.(($Category['Allow_Ads']==0)?"checked":"").'>
                            <label for="visible-no">no</label>
                            <input id="visible-no" type="radio"  name="ads" value="1" '.(($Category['Allow_Ads']==1)?"checked":"").' >
                        </div>
                    </div>   
                    <input type="hidden" name="id" value="' .  $Category['ID'] . '"  />
                    <input type="submit" name="updateCategory" class="btn btn-color-blue btn-group-lg " value="save" />
                </form> ';
                    }else{   
                        echo '<div class="alert alert-danger">there is sach id </div>';
                        
                    }
                    
                    break;                    
                default :
                    echo '<div class="alert alert-danger">invalid action</div>';
            }
        }

        if (isset($_POST["updateCategory"])) {
                $id=$_POST['id'];
                $name=$_POST['name'];   
                $description=$_POST['description'];
                $parent=$_POST['parent'];
                $ordering=$_POST['ordering'];
                $visibility=$_POST['visibility'];
                $commenting=$_POST['commenting'];
                $ads=$_POST['ads'];
            if ($name == null) {
                redirectTOPage("");
                echo '<div class="alert alert-danger">The user name is empty</div>';
            } elseif (is_numeric($name)) {
                echo '<div class="alert alert-danger">Please enter name not a number</div>';
            } else {
                $updateCategory = new category($name, $description,$parent,$ordering, $visibility, $commenting, $ads, $id);
                if ($updateCategory->updatedataCategory()) {
                    redirectTOPagesucces("The update members is correct",10);
                } else {
                    echo '<div class="alert alert-danger">The update members is wronge</div>';
                }
            }
        }
        ?>
        <?php
            $sort="ASC";
            $sort_array= array('ASC','DESC');
            if(isset($_GET['sort'])&& in_array($_GET['sort'], $sort_array)){
                $sort=$_GET['sort'];        
            }       
            $cats= category::selectAllCategory($sort);
        ?>
        <div class="categories">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Manage Categories
                    <div class="option pull-right">
                        ordering:
                        <a class="<?php if($sort =='ASC'){echo 'active';} ?>" href="?sort=ASC">ASC</a>
                        <a class="<?php if($sort =='DESC'){echo 'active';}?>" href="?sort=DESC">DESC</a>
                        View:
                        <span class="active" data-view="full">Full</span>
                        <span data-view="classic">Classic</span>
                    </div>
                </div>
                <div class="panel-body">
                    <?php
                            if(!empty($cats) ){
                                foreach ($cats as $cat){
                                    echo'<div class="cat">';
                                    echo '<div class="hidden-buttons">'.
                                    "<a href='?action=edit&CatId=" .$cat['ID'] . "'class='btn btn-xs edit-btn'><i class='fa fa-edit'></i>Edit</a>"
                                    ."<a href='?action=delete&CatId=" .$cat['ID'] . "' class='btn btn-xs delete-btn'><i class='fa fa-trash-alt'></i>Delete</a>";
                                    echo'</div>';
                                    echo '<h3>'.$cat['Name'].'</h3>';
                                    echo '<div class="full-view">';
                                        echo '<p>';if ( $cat['Description']==''){echo'the discription is empty'.'<br/>';}else{echo $cat['Description'].'<br/>';}; echo '</p>';
                                        if ($cat['Visibility']==1){echo '<span class="visibility">Hidden</span>';}
                                        if ($cat['Allow_Comment']==1){echo '<span class="commenting">comment disabled</span>';}
                                        if ($cat['Allow_Ads']==1){echo '<span class="Advertises">Ads Disabled</span>';}
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<hr>';
                                }
                            }else{
                                echo '<div class="alert alert-info">There\'s No Record to show</div>';
                            }
                    ?>
                </div>
            </div>
            <a class="btn btn-primary " href="Addcategory.php" ><i class="fas fa-plus"></i> &ensp; Add Category</a>
            </div>
        </div>
        <?php
        
            include 'template/footer.php';
    } else {
        header('Location:index.php');
        exit();
    }
    ob_end_flush();
    ?>



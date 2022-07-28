<?php
//The Add Category page 
ob_start();
session_start();
if(isset($_SESSION['Username'])){
    $pageTitle="Add Category";
    include 'init.php';
    include '../lib/category.php';
    ?>
<div>
    <div class="Form-Of-Add">
        <h2><?php echo$pageTitle ?></h2>
        <?php
            if(isset($_POST['Addcategory'])){
                
                $name=$_POST['name'];   
                $description=$_POST['description'];
                $parent=$_POST['parent'];
                $ordering=$_POST['ordering'];
                $visibility=$_POST['visibility'];
                $commenting=$_POST['commenting'];
                $ads=$_POST['ads'];
                if ($name == null) {
                    redirectTOPage("the user name is empty");
               } elseif (is_numeric($name)) {
                   redirectTOPage("please enter name not a number");
               }else {  
                    if(checkItem('Name','categories', $name)){
                        $addcategory= new category($name, $description,$parent,$ordering, $visibility, $commenting, $ads);
                        if($addcategory->AddCategory()){
                            echo '<div class="alert alert-success">correct</div>';
                        } else {
                            redirectTOPage("worng");
                        }
                    }else{
                        redirectTOPage("Sorry This User is not Exist",10);
                    }
                }
            }
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="Add-category">
                <!--the start Name of Category field-->  
                    <h4>Categoty name</h4>
                    <input type="text"class="form-control" name="name" placeholder="name" autocomplete="off" required="required" >
                <!--the end Name of Category field-->
                <!--the start Description field-->  
                    <h4>Description</h4>
                    <input type="text" class="form-control" name="description" placeholder="Describe the category" >
                <!--the end Description field-->  
                <!--the start Category field-->  
                    <h4>parent?</h4>
                    <select class="form-control" name="parent" required="required">
                        <option value="0">None</option>
                        <?php
                            $Categories= category::selectAllCategory('','1');
                            foreach ($Categories as $Category){
                                echo '<option value="'.$Category['ID'].'">'.$Category['Name'].'</option>';
                            } 
                        ?>
                    </select>
                <!--the end Category field-->
                <!--the start Ordering field-->  
                    <h4>Ordering</h4>
                    <input type="text" class="form-control" name="ordering" placeholder="Number To Arrange The Category" >
                <!--the end Ordering field-->  
                <!--the visibility  field-->  
                <div class="radio-box-category">
                    <span>Visibility</span>
                    <!--the visibility  yes--> 
                    <label class="form-check-input" for="visible-yes">yes</label>
                    <input class="form-check-label" id="visible-yes" type="radio"  name="visibility" value="0" checked>
                    <!--the visibility  no-->
                    <label class="form-check-input" for="visible-no">no</label>
                    <input class="form-check-label" id="visible-no" type="radio"  name="visibility" value="1" >
                </div>            
                <!--end the visibility  field--> 
                
                <!--the Allow comment  field-->  
                 <div class="radio-box-category">
                    <span>Allow Commenting</span>
                    <!--the Allow comment  yes--> 
                    <label for="visible-yes">yes</label>
                    <input id="visible-yes" type="radio"  name="commenting" value="0" checked>
                    <!--the Allow comment  no-->
                    <label for="visible-no">no</label>
                    <input id="visible-no" type="radio"  name="commenting" value="1" >
                 </div>
                <!--end the Allow comment  field--> 
                <!--start Ads  field-->  
                <div class="radio-box-category">
                    <span>Allow Ads</span>
                    <!--the Allow comment  yes--> 
                    <label for="visible-yes">yes</label>
                    <input id="visible-yes" type="radio"  name="ads" value="0" checked>
                    <!--the Allow comment  no-->
                    <label for="visible-no">no</label>
                    <input id="visible-no" type="radio"  name="ads" value="1" >
                </div>
                <!--the Allow comment  field--> 
                <div style="margin-top:20px; ">
                    <input type="submit" name="Addcategory" class="btn btn-primary  btn-group-lg " value="Add category" />
                    <a class="btn btn-primary" href="Editcategory.php" >Edit category</a>
                </div>
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

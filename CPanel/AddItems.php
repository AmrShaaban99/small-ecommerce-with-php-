<?php
//The Add Category page 
ob_start();
session_start();
if(isset($_SESSION['Username'])){
    $pageTitle="Add Item";
    require_once 'init.php';
    require_once '../lib/items.php';
    require_once '../lib/members.php';
    require_once '../lib/category.php';
    ?>
<div>
    <div class="Form-Of-Add">
        <h2><?php echo$pageTitle ?></h2>
        <?php
            if(isset($_POST['Additem'])){
                $name=$_POST['name'];   
                $imageNam=$_FILES['image']['name'];
                $imageName= rand('0','10000')."_".$imageNam;
                $imageSize=$_FILES['image']['size'];
                $imageTmp=$_FILES['image']['tmp_name'];
                $imageType=$_FILES['image']['type'];
                $imageAllowedExtension=array("jpeg","jpg","png","gif");
                $imageExtent= explode('.',$imageName);
                $imageExtention =strtolower(end($imageExtent));
                $description=$_POST['description'];
                $price=$_POST['price'];
                $country=$_POST['country'];
                $status=$_POST['status'];
                $color=$_POST['color'];
                $size=$_POST['size'];
                $composition=$_POST['composition'];
                $brand=$_POST['brand'];
                $member=$_POST['member'];
                $category=$_POST['category'];
                if ($name == null) {
                    redirectTOPage("the user name is empty");
               } elseif ($description == null) {
                   redirectTOPage("please enter the description");
               } elseif ($price == null) {
                   redirectTOPage("please enter the price of Item");
               } elseif ($country == null) {
                   redirectTOPage("please enter the country");
               } elseif ($status == null) {
                   redirectTOPage("please enter the status");
               } elseif ($member == null) {
                   redirectTOPage("please enter the member");
               } elseif (!in_array($imageExtention, $imageAllowedExtension)) {
                   redirectTOPage("This extention is not Allowed");
               }elseif ($imageSize > '4194304') {
                   redirectTOPage("image cant be larger than 4 Mb");
               }elseif ($category == null) {
                   redirectTOPage("please enter the category");
               }else {  
                    if(checkItem('Name','items', $name)){
                    $addItem=new items($name, $imageTmp, $imageName, $description, $price, $country, $status, $color, $size, $composition, $brand, $member, $category);
                        if($addItem->Additem()){
                            echo '<div class="alert alert-success">correct</div>';
                        } else {
                            redirectTOPage("worng");
                        }
                    }else{
                        redirectTOPage("Sorry This User is not Exist",2);
                    }
                }
            }
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div class="">
                <!--the start Name of item field-->  
                    <h4>Name</h4>
                    <input type="text"class="form-control" name="name" placeholder="name" autocomplete="off" required="required" >
                <!--the end Name of item field-->
                <!--the start image of item field--> 
                <h4>image</h4>
                <div class="input-group">
                    <label class="input-group-btn">
                        <span class="btn btn-primary">
                            choose File <input type="file"name="image"  style="display: none;" multiple>
                        </span>
                    </label>
                    <input type="text" class="form-control" readonly>
                </div>
                <!--the end Image field-->
                <!--the start Description field-->  
                    <h4>Description</h4>
                    <input type="text" class="form-control" name="description" placeholder="Describe of the Item"  required="required">
                <!--the end Description field-->  
                <!--the start Price field-->  
                    <h4>price</h4>
                    <input type="text" class="form-control" name="price" placeholder="price of the Item" >
                <!--the end price field-->
                <!--the start Country field-->  
                    <h4>Country</h4>
                    <input type="text" class="form-control" name="country" placeholder="Country of made" >
                <!--the end Country field-->
                <!--the start color field-->  
                    <h4>color</h4>
                    <input type="text" class="form-control" name="color" placeholder="color of item" >
                <!--the end color field-->
                <!--the start size field-->  
                    <h4>size</h4>
                    <input type="text" class="form-control" name="size" placeholder="size of item" >
                <!--the end size field-->
                <!--the start composition field-->  
                    <h4>composition</h4>
                    <input type="text" class="form-control" name="composition" placeholder="composition of item" >
                <!--the end composition field-->
                <!--the start Brand field-->  
                    <h4>Brand</h4>
                    <input type="text" class="form-control" name="brand" placeholder="brand of item" >
                <!--the end Brand field-->
                <!--the start Status field-->  
                    <h4>Status</h4>
                    <select class="form-control" name="status">
                        <option value="0">...</option>
                        <option value="1">New</option>
                        <option value="2">Like New</option>
                        <option value="3">Used</option>
                        <option value="4">Very Old</option>
                    </select>
                <!--the end Status field-->
                <!--the start member field-->  
                    <h4>Member</h4>
                    
                    <select class="form-control" name="member" required="required">
                        <option value="0">...</option>
                        <?php
                            $members=member::selectAllMember();
                            foreach ($members as $member){
                                echo '<option value="'.$member['UserId'].'">'.$member['Username'].'</option>';
                            } 
                        ?>
                    </select>
                <!--the end member field-->
                <!--the start Category field-->  
                    <h4>Category</h4>
                    <select class="form-control" name="category" required="required">
                        <option value="0">...</option>
                        <?php
                            $Categories= category::selectAllCategory();
                            foreach ($Categories as $Category){
                                echo '<option value="'.$Category['ID'].'">'.$Category['Name'].'</option>';
                            } 
                        ?>
                    </select>
                <!--the end Category field-->
                
                <div style="margin-top:20px; ">
                    <input type="submit" name="Additem" class="btn btn-primary  btn-group-lg " value="Add Item" />
                    <a class="btn btn-primary" href="EditItems.php" >Edit Item</a>
                </div>
            </div>
        </form>
    </div>
</div>  

<?php  
    require_once 'template/footer.php';
}else {
    header('Location:index.php');
    exit();
}
ob_end_flush();
?>

<?php
ob_start();
session_start();
if (isset($_SESSION['Username'])) {
    $pageTitle = "Manage Item";
    include '../lib/members.php';
    include '../lib/category.php';
    include '../lib/items.php';
    include 'init.php';
    ?> 
    <div class="Form-Of-Add" >
        <h2><?php echo $pageTitle; ?></h2>
        <?php  
        if (isset($_GET["action"]) && isset( $_GET["Id"])) {
            $action = $_GET["action"];
            $id = intval($_GET["Id"]);
            switch ($action) {
                case 'delete':
                    if(!checkItem('Item_ID', 'items',$id )){
                         if (items::deleteItemById($id)) {
                            redirectTOPagesucces("deleted Item successfully");
                        } else {
                            redirectTOPage('error deleted',5);
                        }
                    }else{
                        redirectTOPage('There is Sach Id Item',5);
                    }
                    break;

                case 'edit':
                    $item= items::retrieveItemById($id);
                    if($item){
                    echo'
                <form class="form-of-edit" action="' . $_SERVER['PHP_SELF'] . '" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                        <h4>Name</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text"class="form-control form-of-edit" name="name" value="' . $item['Name'] . '"  placeholder="Name" autocomplete="off" required="required" >
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
                                            <img src="../uploads/items/'.$item['Image'].'" style="width:50px; height:50px ">
                                            <input type="file" name="upload"  style="display: none;"  multiple />
                                        </span>
                                    </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Description</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-of-edit" name="description" value="' . $item['Description'] . '"  placeholder="Describe of the Item" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Price</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-of-edit" name="price" value="' . $item['Price'] . '"  placeholder="price of the Item" autocomplete="off" required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Country</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-of-edit" name="country" value="' . $item['Country_Made'] . '"  placeholder="Country of made" autocomplete="off" required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Colors</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-of-edit" name="color" value="' . $item['Colors'] . '"  placeholder="Country of made" autocomplete="off" required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Size</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-of-edit" name="size" value="' . $item['Size'] . '"  placeholder="Country of made" autocomplete="off" required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Composition</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-of-edit" name="composition" value="' . $item['Composition'] . '"  placeholder="Country of made" autocomplete="off" required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Brand</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-of-edit" name="brand" value="' . $item['Brand'] . '"  placeholder="Country of made" autocomplete="off" required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>Status</h4>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" name="status">
                                <option value="0">...</option>
                                <option value="1" '.(($item['Status']==1)?"selected='selected'":"").'>New</option>
                                <option value="2" '.(($item['Status']==2)?"selected='selected'":"").'>Like New</option>
                                <option value="3" '.(($item['Status']==3)?"selected='selected'":"").'>Used</option>
                                <option value="4" '.(($item['Status']==4)?"selected='selected'":"").'>Very Old</option>
                            </select>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>category</h4>
                        </div>
                        <div class="col-md-6"> 
                        <select class="form-control" name="category">';
                            $cat = category::selectAllCategory();
                            
                            foreach ($cat as $Categories){
                                if($Categories['ID']== $item['Cat_ID']){
                                      echo '<option value="'.$Categories['ID'].'"selected="selected">'.$Categories['Name'].'</option>';
                                }else{
                                    echo '<option value="'.$Categories['ID'].'">'.$Categories['Name'].'</option>';
                                }
                            } 
                            
                        echo '</select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <h4>member</h4>
                        </div>
                        <div class="col-md-6"> 
                        <select class="form-control" name="member" required="required">';
                        
                        $memb= member::selectAllMember();
                        foreach($memb as $members ){
                            if($members['UserId']== $item['Member_ID']){
                                  echo '<option value="'.$members['UserId'].'"selected="selected">'.$members['Username'].'</option>';
                            }else{
                                echo '<option value="'.$members['UserId'].'">'.$members['Username'].'</option>';
                            }
                        }
                            
                    echo '</select>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="' . $item['Item_ID'] . '"  />
                    <input type="submit" name="updateItem" class="btn btn-color-blue btn-group-lg " value="save" />
                </form>
                <div>
            </div>
                
             ';
                    }else{   
                        echo '<div class="alert alert-danger">there is sach id </div>';
                        
                    }
                    
                    break;
                case'Approve':   
                    if(items::updateApproveOfItem($id,'Approve')){
                        redirectTOPagesucces("Approve Item successfully");
                    }else{
                        redirectTOPage('NO Approve Item ');
                    }
                    
                default :
                    redirectTOPage("invalid action");
            }
        }

        if (isset($_POST["updateItem"])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $country = $_POST['country'];
            $imageNam=$_FILES['upload']['name'];
            if($imageNam!=Null){
            $imageName= rand('0','10000')."_".$imageNam;
            $imageSize=$_FILES['upload']['size'];
            $imageTmp=$_FILES['upload']['tmp_name'];
            $imageType=$_FILES['upload']['type'];
            $imageAllowedExtension=array("jpeg","jpg","png","gif");
            $imageExtent= explode('.',$imageName);
            $imageExtention =strtolower(end($imageExtent));
            }else{
            $imageName=".jpg" ;
            $imageSize=Null;
            $imageTmp=Null;
            $imageType=Null;
            $imageAllowedExtension=array("jpeg","jpg","png","gif");
            $imageExtent= explode('.',$imageName);
            $imageExtention =strtolower(end($imageExtent));
            }
            $color=$_POST['color'];
            $size=$_POST['size'];
            $composition=$_POST['composition'];
            $brand=$_POST['brand'];
            $status = $_POST['status'];
            $category = $_POST['category'];
            $member = $_POST['member'];      
            if ($name == null) {
                redirectTOPage("The name is empty");
            } elseif ($description == null) {
                redirectTOPage("The Description is empty");
            } elseif ($price == null) {
                redirectTOPage("The price is empty");
            } elseif ($status == null) {
                redirectTOPage("The Status is empty");
            } elseif ($category == null) {
                redirectTOPage("The Category is empty");
            } elseif ($member == null) {
                redirectTOPage("The Member is empty");
            }elseif (!in_array($imageExtention, $imageAllowedExtension)) {
                   redirectTOPage("This extention is not Allowed");
            }elseif ($imageSize > '4194304') {
                redirectTOPage("image cant be larger than 4 Mb");
            }elseif ($category == null) {
                redirectTOPage("please enter the category");
            } else {
             $updateItem=new items($name,$imageTmp, $imageName, $description, $price, $country, $status, $color, $size, $composition, $brand, $member, $category, $id);
             if ($updateItem->updateItem()) {
                 redirectTOPagesucces('The update Items is correct');
             } else {
                 redirectTOPage("The update Items is wronge");
             }
            }
        }
        $items= items::selectAllItems();
            if(!empty($items)){
            if (is_array($items)) {
        
        echo'<table class="table-data table-responsive" >
            <tr>   
                <th>Id</th>
                <th>image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Add Date</th>
                <th>colors</th>
                <th>size</th>
                <th>Composition</th>
                <th>Brand</th>
                <th>country</th>
                <th>Rating</th>
                <th>category</th>
                <th>Member</th>
                <th>Control</th>
            </tr>';
                foreach ($items as $item):
                    echo '<tr>
                                <td class="table-left-border">' . $item['Item_ID'] . '</td>';
                                 
                                if($item['Image']){
                                    echo'<td><img src="../uploads/items/' . $item['Image'] .'"alt="image"></td>';
                                }else{
                                    echo'<td>No image</td>';
                                }
                                echo'<td>'.$item['Name'].'</td>'
                                . '<td >' . $item['Description'] .'</td>
                                <td>' . $item['Price'] . '</td>
                                <td>' . $item['Add_Date'] . '</td> 
                                <td>' . $item['Colors'] . '</td> 
                                <td>' . $item['Size'] . '</td> 
                                <td>' . $item['Composition'] . '</td> 
                                <td>' . $item['Brand'] . '</td>
                                <td>' . $item['Country_Made'] . '</td>
                                <td>Rating</td>         
                                <td>' . $item['category_name'] . '</td> 
                                <td>' . $item['Member_name'] . '</td>     
                                <td class="table-Right-border">
                                    <a class="btn edit-btn" href="?action=edit&Id=' . $item['Item_ID'] . '"><i class="fas fa-edit"></i> Edit</a>
                                    <a class="btn "style="color:rgb(211,41,41)" confirm" href="?action=delete&Id=' . $item['Item_ID'] . '"><i class="far fa-trash-alt"></i> Delete</a>';
                                if($item['Approve']==0){
                                    echo '<a class="btn" href="?action=Approve&Id=' . $item['Item_ID'] . '"><i class="fas fa-check"></i> Approve</a>';
                                }
                                echo '</td>
                            </tr>';
                endforeach;
                echo '</table>';
                    }else {
                        redirectHome("there is not exisit user");
                    }
                }else{
                    echo '<div class="alert alert-info" style="margin:15px;">There\'s No Record to show</div>';
                }
                ?>

        <a class="btn btn-primary " href="AddItems.php" ><i class="fas fa-plus"></i> &ensp; Add Item</a>
        </div>
        <?php
        
        include 'template/footer.php';
    } else {
        header('Location:index.php');
        exit();
    }
    ob_end_flush();
    ?>

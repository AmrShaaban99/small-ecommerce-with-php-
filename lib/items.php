<?php
class items{
    private $id;
    private $imageTmp;
    private $imagename;
    private $name;
    private $Description;
    private $price;
    private $country;
    private $status;
    private $color;
    private $size;
    private $composition;
    private $brand;
    private $member;
    private $category;
    function __construct( $name,$imageTmp, $imagename,  $Description, $price, $country, $status, $color, $size, $composition, $brand, $member, $category,$id="") {
        $this->id = $id;
        $this->imageTmp = $imageTmp;
        $this->imagename = $imagename;
        $this->name = $name;
        $this->Description = $Description;
        $this->price = $price;
        $this->country = $country;
        $this->status = $status;
        $this->color = $color;
        $this->size = $size;
        $this->composition = $composition;
        $this->brand = $brand;
        $this->member = $member;
        $this->category = $category;
    }

        function Additem(){
        global $dbh;
        move_uploaded_file($this->imageTmp,"../uploads/items/".$this->imagename);
        $sql=$dbh->prepare("INSERT INTO items (Name         ,  Image   ,   Description      ,Price        ,Add_Date,   Country_Made,       Status  ,Colors,Size,Composition,Brand,Cat_ID,Member_ID)"
                                    . " VALUES('$this->name','$this->imagename','$this->Description','$this->price',now(),'$this->country','$this->status','$this->color','$this->size','$this->composition' ,'$this->brand','$this->category','$this->member' )");
        if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
        
    }   
    function updateItem(){
        global $dbh;
        if($this->imageTmp==NULL){
             $sql=$dbh->prepare("UPDATE items SET Name='$this->name',Description='$this->Description', Price='$this->price',Country_Made='$this->country',"
                . "Status='$this->status',Colors='$this->color',Size='$this->size',Composition='$this->composition',Brand='$this->brand',Cat_ID='$this->category',Member_ID='$this->member' WHERE Item_ID = '$this->id '"); 
            
        }else{
            move_uploaded_file($this->imageTmp,"../uploads/items/".$this->imagename);
            $sql=$dbh->prepare("UPDATE items SET Name='$this->name',Image='$this->imagename',Description='$this->Description', Price='$this->price',Country_Made='$this->country',"
                . "Status='$this->status',Colors='$this->color',Size='$this->size',Composition='$this->composition',Brand='$this->brand',Cat_ID='$this->category',Member_ID='$this->member' WHERE Item_ID = '$this->id '"); 
        }
        if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
    }
    public static function deleteItemById($id){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM items WHERE Item_ID='$id'");
        if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
    }
    public static function retrieveItemById($data){
        global $dbh;
        if(is_numeric($data)){
                $sql=$dbh->prepare("SELECT * FROM items WHERE Item_Id='$data'");
                $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        } else {
           $sql=$dbh->prepare("SELECT items.*,users.Username AS Member_name FROM items "
                . "INNER JOIN users ON users.UserID = items.Member_ID "
                . "WHERE users.Username='$data'");
           $sql->execute();
        $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
        } 
        return $fetch;    
    }
    public static function selectAllItems(){
        global $dbh;
        $sql=$dbh->prepare("SELECT items.*,categories.Name AS category_name ,users.Username AS Member_name FROM items  "
                . "INNER JOIN categories ON categories.ID = items.Cat_ID "
                . "INNER JOIN users ON users.UserID = items.Member_ID "
                . "ORDER BY Item_ID DESC");
        $sql->execute();
        $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;    
    }
    //get all items of the same category
    public static function selectAllItemsOfSameCategory($categoryId){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM items "
                ."WHERE Cat_ID='$categoryId'");
        $sql->execute();
        $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;    
    }
    // the function make one or more to be update 
    public static function updateApproveOfItem($id,$state=""){
        global $dbh;
        if($state=='Approve'){
            $state='Approve = 1';
        }
        $sql=$dbh->prepare("UPDATE items SET $state WHERE Item_ID='$id' ");
         if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
        
    }
}

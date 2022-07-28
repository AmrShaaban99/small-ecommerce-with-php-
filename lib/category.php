<?php
class category{
    private $id;
    private $name;
    private $description;
    private $parent;
    private $ordering;
    private $visibility;
    private $commenting;
    private $ads;
    
    function __construct($name, $description,$parent ,$ordering, $visibility, $commenting, $ads,$id="") {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->parent = $parent;
        $this->ordering = $ordering;
        $this->visibility = $visibility;
        $this->commenting = $commenting;
        $this->ads = $ads;
    }

    function AddCategory(){
        global $dbh;
        $sql=$dbh->prepare("INSERT INTO categories (Name, Description,parent ,Ordering,Visibility,Allow_Comment,Allow_Ads)"
                . " VALUES('$this->name','$this->description',$this->parent,'$this->ordering','$this->visibility','$this->commenting','$this->ads')");
        if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
        
    }   
    function updatedataCategory(){
        global $dbh;
        $sql=$dbh->prepare("UPDATE categories  SET Name='$this->name',Description='$this->description',parent='$this->parent' , Ordering='$this->ordering',Visibility ='$this->visibility',Allow_Comment='$this->commenting',Allow_Ads='$this->ads' WHERE ID = '$this->id'"); 
        if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
    }
    public static function deleteCategoryById($id){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM categories WHERE ID='$id'");
        if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
    }
    public static function retrieveCategoryById($id){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM categories WHERE ID='$id'");
        $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        return $fetch;    
    }
    public static function selectAllCategory($sort="",$parent=Null){
        global $dbh;
        if($sort==""){
            $sort="ASC";
        }
        if($parent!=Null){
             $sql=$dbh->prepare("SELECT * FROM categories where parent=0 ORDER BY Ordering $sort");
        }else{
        $sql=$dbh->prepare("SELECT * FROM categories ORDER BY Ordering $sort");
        }
        $sql->execute();
        $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;    
    }

}

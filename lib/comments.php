<?php
class comments{
    private $id;
    private $content;
    private $user_id;
    private $item_id;
    function __construct($content,$id="", $item_id="",$user_id="") {
        $this->content = $content;
        $this->id = $id;
        $this->user_id = $user_id;
        $this->item_id = $item_id;
    }
    function Addcomment(){
        global $dbh;
        $sql=$dbh->prepare("INSERT INTO comments(content,status,comment_date,item_id,user_id) VALUES('$this->content',0,now(),'$this->item_id','$this->user_id')");
        if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
        
    } 
    function updatecomment(){
        global $dbh;
        $sql=$dbh->prepare("UPDATE comments SET content='$this->content' WHERE C_ID='$this->id '"); 
        if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
    }
     
    public static function deleteCommentById($id){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM comments WHERE C_ID='$id'");
        if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
    }
    public static function retrieveCommentById($data){
        global $dbh;
        if(is_numeric($data)){
                $sql=$dbh->prepare("SELECT * FROM comments WHERE C_ID='$data'");
                $sql->execute();
                $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql=$dbh->prepare("SELECT comments.*,users.Username AS user_name FROM comments "
                    . "INNER JOIN users ON users.UserID = comments.user_id"
                    . " WHERE users.Username='$data'");
            $sql->execute();
            $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
            
        } 
        
        return $fetch;    
    }
    public static function selectAllComment(){
        global $dbh;
        $sql=$dbh->prepare("SELECT comments.*,items.Name AS item_name ,users.Username AS user_name FROM comments "
                . "INNER JOIN items ON items.Item_ID = comments.item_id "
                . "INNER JOIN users ON users.UserID = comments.user_id");
        $sql->execute();
        $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;    
    }
    // the function make one or more to be update 
    public static function updateApproveOfComment($id,$state=""){
        global $dbh;
        if($state=='status'){
            $state='status = 1';
        }
        $sql=$dbh->prepare("UPDATE comments SET $state WHERE C_ID='$id' ");
         if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
        
    }
}

<?php
class member{
    private $userid;
    private $username;
    private $password;
    private $email;
    private $fullname;
    private $avatarname;
    private $avatarTmp;
    function __construct($username, $password, $email, $fullname,$avatarname,$avatarTmp,$userid="") {
        $this->userid = $userid;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->fullname = $fullname;
        $this->avatarname= $avatarname;
        $this->avatarTmp = $avatarTmp;
    }

    function Addmember($RegStatus){
        global $dbh;
        move_uploaded_file($this->avatarTmp,"../uploads/avatar/".$this->avatarname);
        $encPassword = sha1($this->password);
        $sql=$dbh->prepare("INSERT INTO users (username, password, Email,Fullname,RegStatus,Date,Avatar) VALUES('$this->username','$encPassword','$this->email','$this->fullname','$RegStatus',now(),'$this->avatarname')");
        if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
        
    }   
    function updatedatamember(){
        global $dbh;
        $encPassword = sha1($this->password);
        if($this->avatarTmp==NULL){
            
            $sql=$dbh->prepare("UPDATE users SET Username='$this->username',password='$encPassword',"
                    . " Email='$this->email',Fullname='$this->fullname' WHERE UserId = '$this->userid'"); 
        }else{
            move_uploaded_file($this->avatarTmp,"../uploads/avatar/".$this->avatarname);
           $sql=$dbh->prepare("UPDATE users SET Username='$this->username',password='$encPassword',Avatar='$this->avatarname',"
                   . "Email='$this->email',Fullname='$this->fullname' WHERE UserId = '$this->userid'");  
        }
        
        if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
    }
    public static function deleteMemeberById($id){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM users WHERE UserId='$id'");
        if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
    }
    public static function retrieveMemeberById($data){
        global $dbh;
        if(is_numeric($data)){
            $sql=$dbh->prepare("SELECT * FROM users WHERE UserId='$data'");
        } else {
            $sql=$dbh->prepare("SELECT * FROM users WHERE Username='$data'");
        }
        $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        return $fetch;    
    }
    public static function selectAllMember($Query=""){
        global $dbh;
        if($Query==1){
            $Query= 'AND RegStatus = 0';
        }
        $sql=$dbh->prepare("SELECT *FROM users WHERE GroupID!=1 $Query  ORDER BY UserId DESC");
        $sql->execute();
        $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;    
    }
    // the function make one or more to be update 
    public static function updateStateOfUser($userid,$state=""){
        global $dbh;
        if($state=='RegStatus'){
            $state='RegStatus = 1';
        }
        $sql=$dbh->prepare("UPDATE users SET $state WHERE UserId='$userid' ");
         if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
        
    }
}

<?php
class login {
    
    private $username;
    private $password;
    function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }
    function checkLogin($username, $password){
        // get connection 
        global $dbh;
        // prepare query
        $sql=$dbh->prepare("SELECT  Username,Password,UserId FROM users WHERE username='$username'AND password='$password'");
        //execute sql query
         $sql->execute(array($username,$password));
          
        $logincheck =$sql->rowCount();
        $dataId=$sql->fetch();// get the data of the query
        if($logincheck >0){
            return $dataId['UserId'] ; // return the userId number
        } else {
            return FALSE;
        }      
    }
    
}
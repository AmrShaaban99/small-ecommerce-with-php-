<?php
//this function make the title of page
function getTitle(){
    global $pageTitle;
    if(isset($pageTitle)){ 
        echo $pageTitle;
    }else{
        echo 'Defulat';
    }
    
}
//this function accept 2 parameters 1)error Message 2)second before redirecting
function redirectTOPage($errorMsg,$seconds =5){
    echo "<div class='alert alert-danger'> $errorMsg </div>";
    echo "<div class='alert alert-info'> You Will Be Redirected to Homepage After $seconds seconds.</div>";
    //header('Location: '.$_SERVER['PHP_SELF']);
    header( "refresh:$seconds;url=".$_SERVER['PHP_SELF'] );
    exit();
    
}
//this function accept 2 parameters 1)error Message 2)second before redirecting
function redirectToOtherPage($errorMsg,$seconds =5){
    echo "<div class='alert alert-danger'> $errorMsg </div>";
    echo "<div class='alert alert-info'> You Will Be Redirected to Homepage After $seconds seconds.</div>";
    //header('Location: '.$_SERVER['PHP_SELF']);
    header( "refresh:$seconds;url=index.php");
    exit();
    
}
//this function accept 2 parameters 1)seccess Message 2)second before redirecting
function redirectTOPagesucces($errorMsg,$seconds =5){
    echo "<div class='alert alert-success'> $errorMsg </div>";
    echo "<div class='alert alert-info'> You Will Be Redirected to Homepage After $seconds seconds.</div>";
    header( "refresh:$seconds;url=".$_SERVER['PHP_SELF'] );
    exit();
}
//the function to check item in database or not 
//select= the Item In database [Example:user,item,category]
//$from = the table to select form [Example:users , items, category]
//$value = the value of select [Example:Osama , Box, Electronics]
function checkItem($select,$form,$value){
    global $dbh;
    $sql =$dbh->prepare("SELECT $select FROM $form WHERE $select= ?");
    $sql->execute(array($value));
    $count=$sql->rowCount();
    if($count==1){
        return false;
    }else {
        return true;
    }        
}
/*
 * Count Numberof Items function v1.0
 * function To count Numberof Items Rows
 * $item = The Item to count 
 * $table = the Table to choose from
 * $condition= to make the conditon of anu item count
  */
function countItems($item,$table,$condition=""){
    global $dbh;
    if($condition==1){
        $condition='WHERE RegStatus = 0';
    }
    $sql =$dbh->prepare("SELECT COUNT($item) FROM $table $condition");
    $sql->execute();
    return $sql->fetchColumn();
}
/*
 *Get Lastest Records Fuction v1.0 
 * function To Get Lastest Items From Database[user,Items,commnent]
 * $select = field to select 
 * $table = The table to Choose From
 * $limit= Number of Records to Get 
 */
function getLatest($select, $table, $order,$limit=5,$Active=Null){
    global $dbh;
    if($Active !=Null){ 
        $sql =$dbh->prepare("SELECT $select FROM $table Where Approve=1 ORDER BY $order DESC LIMIT $limit  ");
    $sql->execute();
    }else{
    $sql =$dbh->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit  ");
    $sql->execute();
    }
    $data=$sql->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}
/*
 * with join
 * Get Lastest Records Fuction v1.0 
 * function To Get Lastest Items From Database[user,Items,commnent]
 * $select = field to select 
 * $table = The table to Choose From
 * $limit= Number of Records to Get 
 * $tableJoin= the table you want to join
 * $columnjoin = the column you want to equal to column of the other table
 * $columnfromthistable= the  column of other table
 */
function getLatestwithjoin($select, $table,$tableJoin,$columnjoin,$columnfromthistable, $order,$limit=5){
    global $dbh;
    $sql =$dbh->prepare("SELECT $select FROM $table "
            . " INNER JOIN $tableJoin  ON $columnjoin = $columnfromthistable "
            . " ORDER BY $order DESC LIMIT $limit ");
    $sql->execute();
    $data=$sql->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}
//this fuction made to get name and return id of the user
function getdatareturndata($select,$table,$datacondition,$dataWant){
    global $dbh;
    $sql =$dbh->prepare("SELECT $select FROM $table WHERE $datacondition='$dataWant'");
    $sql->execute();
    $data=$sql->fetch(PDO::FETCH_ASSOC);
    return $data;
}
function getcommentbyItemId($ItemId){
    global $dbh;
    $sql =$dbh->prepare("SELECT * FROM comments WHERE item_id ='$ItemId' AND status=1");
    $sql->execute();
    $data=$sql->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}
?>

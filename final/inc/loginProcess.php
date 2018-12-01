<?php

    session_start();

    include "dbConnection.php";
    
    $conn=getDatabaseConnection();
    $username=$_POST['username'];
    $password=sha1($_POST['password']);
    
    $sql= "SELECT userName, roleName  
           FROM users u
             JOIN user_roles ur ON
               u.userId = ur.userId
             JOIN roles r ON
               ur.roleId = r.roleId
           WHERE userName = :username AND password = :password";
           
    $np=array();
    $np[":username"]=$username;
    $np[":password"]=$password;
    
    $stmt=$conn->prepare($sql);
    $stmt->execute($np);
    $record=$stmt->fetch(PDO::FETCH_ASSOC);

    if(empty($record)){
        $_SESSION['incorrect']=true;
    }else{
        $_SESSION['incorrect']=false;
        $_SESSION['user']=$record['userName'];
        $_SESSION['role']=$record['roleName'];
    }
?>
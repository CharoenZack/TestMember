<?php
    ini_set("display errors", 0);
    error_reporting(~0);
    
    session_start();
    $serverName = "localhost\SQLEXPRESS";
    $username = "cs";
    $password ="123456";
    $database = "mydatabase";
    
    $connectionInfo = array(
        "Database" =>$database, 
        "UID" => $username, "PWD" => $password, 
        'MultipleActiveResultSets'=>true
        ,"CharacterSet" =>'UTF-8');
    $objCon = sqlsrv_connect($serverName, $connectionInfo);
    if ($objCon === false) {
        echo 'check login';
        die(print_r(sqlsrv_errors(), false));
    }
    
    $strSQL = "SELECT * FROM member WHERE Username=? and Password=?";
    $parameters =[$_POST["txtUsername"], $_POST["txtPassword"]];
    $objQuery = sqlsrv_query($objCon, $strSQL, $parameters);
    $objResult = sqlsrv_fetch_array($objQuery, SQLSRV_FETCH_ASSOC);
    if (!$objResult) {
            echo "Username and Password Incorrect!!!";
        }
        else
        {
        $_SESSION["UserID"] = $objResult["UserID"];    
        $_SESSION["Status"] = $objResult["Status"];
        
        session_write_close();
        if ($objResult["Status"] == "ADMIN") {
            header("location:admiinPage.php");
        }else{
            header("location:userPage.php");
        }
    }
    sqlsrv_close($objCon);
?>
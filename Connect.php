<?php
$serverName = "localhost\SQLEXPRESS";
$userName = "CS";
$userPassword = "cs980";
$dbName = "dbphptest";

$connectionInfo = array( "Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true);

$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn)
{
    echo "Database Connected";
}else
{
    die(print_r(sqlsrv_errors(), True));
}

sqlsrv_close($conn);
?>
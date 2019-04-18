<?php
    ini_set("display errors", 0);
    error_reporting(~0);
    
    session_start();
    if ($_SESSION['UserID'] == "") {
        echo "Please Login!";
        exit();
    }
    if ($_SESSION['Status'] != "USER") {
        echo "This page for User Only!";
        exit();
    }
    $serverName = "localhost\SQLEXPRESS";
    $username = "cs";
    $password ="123456";
    $database = "mydatabase";
    $connectionInfo = array(
        "Database" =>$database, 
        "UID"=>$username, 
        "PWD"=> $password, 
        "MultipleActiveResultSets"=>true, 
        "CharacterSet" =>'UTF-8');
    
    $objCon = sqlsrv_connect($serverName, $connectionInfo);
    if ( $objCon === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    $strSQL ="SELECT * FROM member WHERE UserID ='".$_SESSION['UserID']."'";
    $objQuery = sqlsrv_query($objCon, $strSQL, $parameters);
    $objResult = sqlsrv_fetch_array($objQuery, SQLSRV_FETCH_ASSOC);
?>

<html>
<head>
<title>Member CS</title>
</head>
<body>
	Welcome to User Page<br>
	
	<table border="1" style="width: 300px">
		<tbody>
			<tr>
				<td width="87">&nbsp;Username</td>
				<td width="197"><?php echo $objResult['Username'];?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;Name</td>
				<td><?php echo $objResult['Name'];?></td>
			</tr>
		</tbody>
	
	</table>
</body>
</html>
<?php 
    sqlsrv_close($objCon);
?>





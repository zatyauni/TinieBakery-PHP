<?php

	//get values pass from form in fana login.php file
	$ID = $_POST['user'];
	$password = $_POST['pass'];

	//to prevent mysqli injection
	$ID = stripcslashes($ID);
	$password = stripcslashes($password);
	$ID = mysql_real_escape_string($ID);
	$password = mysql_real_escape_string($password);

	//connect to server and select database
	mysql_connect("localhost", "root", "");
	mysql_select_db("tinie");

	// query the database for user
	$result = mysql_query("select * from login where ID = '$ID' and password = '$password'")
		or die("Failed to query database ".mysql_error());
	$row = mysql_fetch_array($result);

	if($ID=="" || $password=="")
			{
				print("<script language='JavaScript' type='text/JavaScript'>
				window.history.back();
				</script>");
			}

			if ($password== "123" && $ID=="staff")
			{
						print("<script language='JavaScript' type='text/JavaScript'>
						window.location.href='a-sHome.html';
						</script>");			

			}else{
				print("<script language='JavaScript' type='text/JavaScript'>
						window.location.href='a-cHome.html';
						</script>");
			}


?>
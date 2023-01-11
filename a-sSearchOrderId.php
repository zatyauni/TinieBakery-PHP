<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Cari</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
	
<style>
body {
  background-color: #f8b0c4;
}
		img {
  
  border-radius: 4px;
  padding: 5px;
  width: 150px;
	}
	
</style>
	<form align="right" name="form1" method="post" action="index.html">
  <label class="logoutLblPos">
	  <button class="btn">Log out</button>
  </label>
</form>
	
	<body>
	  <center><img src="logo.png"></center>
    <div class="container">
      <!-- The contents of the page will go here. -->
    </div>
		
		
</body>
	
	<style>
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: black;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #E5397F;
}
		
</style>
</head>

<body>

<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";                                                                                                              
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
	
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.navbar {
  overflow: hidden;
  background-color: black;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: #E5397F;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: black;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #E5397F;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>

<body>

<div class="navbar">
  <a href= "a-sOrderList.php">ORDER LIST</a>
  <a href="a-sCompleteOrder.html">COMPLETE ORDER</a>
   <a href="a-sCustomerList.html">CUSTOMER</a>
   <a href="a-sAtasInventory.html">INVENTORY</a>
</div>
</body>
<br>
	<center><h1 style="color:#E5397F;">COMPLETED ORDER </h1></center>
	<br>
	

<body>

<?php

$DB_HOST = "localhost"; 
    $DB_DBNAME = "tinie"; 
    $DB_USER = "root"; 
    $DB_PWD = ""; 
	
	// 1. Create a database connection
$connection = mysqli_connect($DB_HOST,$DB_USER,$DB_PWD,$DB_DBNAME);
if (!$connection) {
    die("Database connection failed");
}

// 2. Select a database to use 
$db_select = mysqli_select_db($connection, $DB_DBNAME);
if (!$db_select) {
    die("Database selection failed: " . mysqli_error($connection));
}
	

	{
				 $sql = "SELECT * FROM completed ORDER BY orderID";
                // execute query
                $result = mysqli_query($connection, $sql);
                // retrieves a row data and returns it as an associative array
                $row=mysqli_fetch_array($result);
               // display direct from array
			   echo "<table width=500 border=1 align='center'>";
			   echo "<tr align='center'>";
			   echo "<td bgcolor='#E5397F'><font face=georgia>ORDER ID</font></td> ";
			   echo "</tr>";
			   
			   echo "<tr>";
			   echo "<td>$row[orderID] <br></td>";
			   while ($get_info = mysqli_fetch_row($result)){ 
			   print "<tr>\n";
				   
			   foreach ($get_info as $field) 
			   print "\t<td><font face=georgia/>$field</font></td>\n";
			   print "</tr>\n";}
				
			   print "</table>\n";
				
	} 
	
      
	mysqli_close($connection);
	  ?>

</body>
</html>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Purchase</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<style>
body {
    background-color: #F8b0C4;
}
* {
    box-sizing: border-box;
}
	   .logoutLblPos{
   right:10px;
   top:5px;
}
/* Style the navigation menu */
nav {
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    background: #E5397F;
    padding: 20px;
}
/* Style the list inside the menu */
nav ul {
    list-style-type: none;
    padding: 40;
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
    background-color:#E5397F;
}
.dropdown:hover .dropdown-content {
    display: block;
}
.button {
    border: none;
    color: white;
    padding: 12px 18px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 2px 2px;
    cursor: pointer;
}
body {
    font-family: Arial, Helvetica, sans-serif;
}
/* Style the header */
header {
    background-color: #F8B0C4;
    padding: 0px;
    text-align: center;
    font-size: 10px;
    color: white;
}
article {
    float: right;
    padding: 10px;
    width: 50%;
    background-color: none;/*height: 300px; /* only for demonstration, should be removed */
}
/* Clear floats after the columns */
section::after {
    content: "";
    display: table;
    clear: both;
    position : absolute;
}
/* Style the footer */
footer {
    background-color: #E5397F;
    padding: 0px;
    text-align: none;
    color: white;
}
/*form to user*/
input[type=text], select {
    width: 40%;
    padding: 10px 10px;
    margin: 4px 0;
    display: inline-block;
    border: 1px solid black;
    border-radius: 4px;
    box-sizing: border-box;
}
/*form to user*/
input[type=number], select {
    width: 15%;
    padding: 10px 10px;
    margin: 4px 0;
    display: inline-block;
    border: 1px solid black;
    border-radius: 4px;
    box-sizing: border-box;
}
		main{
	margin-top:0;
	padding: 2rem 1.5rem;
	background: #F8B0C4;
	min-height: calc(100vh - 500px);
}

/* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
@media (max-width: 600px) {
nav, article {
    width: auto;
    height: auto;
}
}
</style> 
	<form align="right" name="form1" method="post" action="index.html">
  <label class="logoutLblPos">
  <a href="register.html"><input name="submit2" type="submit" id="submit2" value="Logout"></a>
  </label>
</form>
	
</head>
<body>
<header> <img src="logo.png" alt="logo" style="width:150px" padding="3x"> </header>
<div class="navbar">
  <a href= "a-cHome.html">HOME</a>
  <a href="a-cList.php">PRODUCT</a>
   <a href="cart.php">CART</a>
   <a href="a-cCariPurchase.html">MY PURCHASE</a>
</div> 
	<br><br>
<main>
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

$submit = $_POST["submit"];

if($submit=="Submit")
{
    if(isset($_POST["name"]))
    {        // create the query
               $name = $_POST["name"];
		
              echo "<form align='center' bgcolor='ff47a3'><font face=georgia >All your purchase in Tinie Bakery as below</font></form> ";
		
				 $sql = "SELECT orderID, productID, productName, quantity, name, date,  totPrice FROM purchase WHERE name LIKE '%$name%' ";
                // execute query
               $result = mysqli_query($connection, $sql);
		
			 
		         // retrieves a row data and returns it as an associative array
                $row=mysqli_fetch_array($result);
               // display direct from array
			   echo "<table width=600 border=1 align='center'>";
			   echo "<tr align='center'>";
			   echo "<td bgcolor='ff47a3'><font face=georgia>Order ID</font></td> ";
			   echo "<td bgcolor='ff47a3'><font face=georgia>Product ID</font></td> ";
			   echo "<td bgcolor='ff47a3'><font face=georgia>Product Name</font></td> ";
			   echo "<td bgcolor='ff47a3'><font face=georgia>Quantity</font> </td>";
		 	   echo "<td bgcolor='ff47a3'><font face=georgia>Customer Name</font> </td>";
		       echo "<td bgcolor='ff47a3'><font face=georgia>Date</font> </td>";
			   echo "<td bgcolor='ff47a3'><font face=georgia>Total Price (RM)</font></td> ";
			   echo "</tr>";
			   
			   echo "<tr>";
			   echo "<td>$row[orderID] <br></td>";
		       echo "<td>$row[productID] <br></td>";
               echo "<td>$row[productName] <br></td>";
        	   echo "<td>$row[quantity]<br></td>";
			   echo "<td>$row[name]<br></td>";
			   echo "<td>$row[date]<br></td>";
               echo "<td>$row[totPrice] <br></td>";
			   while ($get_info = mysqli_fetch_row($result)){ 
			   print "<tr>\n";
			   foreach ($get_info as $field) 
			   print "\t<td><font face=georgia/>$field</font></td>\n";
			   print "</tr>\n";}
				
			   print "</table>\n";
				
	} 
	
      } 
	mysqli_close($connection);
	  ?>
	
	</main>	 
<footer>
<center>
  <h5>About Us</h5>
<div class="custom_block">We know quality when we taste it, and we believe you do too. Best Cakes for all with the best price since 2012 !</div>
<p class="infoline"><i class="fa fa-location-arrow"></i>No. 93, Jalan Meru Perdana 1, Taman Meru Perdana, 31200 Chemor, Perak Darul Ridzuan.</p>
<p class="infoline"><i class="fa fa-mobile"></i> Phone: 016 637 7824</p>
<p class="infoline"></p>

<center>
<div class="footer-copyright">Powered By <a href="#">eShop Malaysia</a>Tinie Bakery © Copyright - All rights reserved. 2012 - 2021</div>
</center>
</footer>

</body>
</html>
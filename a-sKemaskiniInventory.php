<html>
<head>
<title>Update</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<style>
	body {
    background-color: #F8b0C4;
}
	img {
  
  border-radius: 4px;
  padding: 5px;
  width: 150px;
	}
	
	/*style the header*/
	header {background-color: #F8B0C4;
			padding: 5px;
			text-align: center;
			font-size: 10px;
			color: white;}
	
/*style for dropdown*/
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: black;
}

li {
  float:left;
}

li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn{
  background-color: #E5397F;
}

	.card-body .btn{
		background-color: #E5397F;
	}

li.dropdown {
  display: inline-block;
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
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #E5397F;}

.dropdown:hover .dropdown-content {
  display: block;
	
	</style>

	<form align="right" name="form1" method="post" action="index.html">
  <label class="logoutLblPos">
	  <button class="btn">Log out</button>
  </label>
</form>
	
<body>
	
	<header>
	<img src="logo.png" alt="Tinie Bakery Logo" >
</header>
	
<ul>
	<li><a href="a-sOrderList.php">ORDER</a></li>
  	<li><a href="a-sCompleteOrder.html">COMPLETE ORDER</a></li>
  	<li><a href="a-sCustomerList.html">CUSTOMER</a></li>
  	<li><a href="a-sAtasInventory.html">INVENTORY</a></li>
</ul>
	
	<table width="882" border="1" align="center"><br>
  <tr> <br>
    <td width="178" height="40"><div align="center"><font color="#000000" face="Georgia, Times New Roman, Times, serif"><strong><a href="a-sFormProduct.html" target="mainFrame">ADD 
        STOCK</a></strong></font></div></td>
    <td width="246"><div align="center"><font color="#000000" face="Georgia, Times New Roman, Times, serif"><strong><a href="a-sCarianInventory.html" target="mainFrame">SEARCH PRODUCT</a></strong></font></div></td>
    <td width="236"><div align="center"><font color="#000000" face= "Georgia, Times New Roman, serif"><strong><a href="a-sKemaskiniInventory.html" target="mainFrame">UPDATE STOCK</a></strong></font></div></td>
    <td width="194"><div align="center"><font color="#000000" face="Georgia, Times New Roman, Times, serif"><strong><a href="a-sHapusInventory.html" target="mainFrame">DELETE  
       STOCK</a></strong></font></div></td>
  </tr>
</table>
	
<form method="post" action="a-sKemaskiniInventory.php">
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
    if(isset($_POST["cari"]))
    {        // create the query
               $productID =$_POST ["cari"];
                 //$sql = "SELECT FROM pelajar WHERE Matrik LIKE %$Matrik%";
				 $sql = "SELECT * FROM stock WHERE productID ='$productID' ";
                // execute query
               $result = mysqli_query($connection, $sql);
		
		         // retrieves a row data and returns it as an associative array
                $row=mysqli_fetch_array($result);
               // display direct from array
				echo "<br>";
			    echo "<center>Product ID  : $row[productID] </center><br>";
       			echo "<center>Product Name : $row[productName] </center><br>";
				echo "<center>Product Price    : <input type='text' name='productPrice' value='$row[productPrice]' size='40'> </center><br>";
		        echo "<center>Product Stock  : <input type='text' name='productStock' value='$row[productStock]' size='40'></center> <br>";
        		echo "<center><input type='hidden' name='productID' value='$row[productID]'></center>";
				echo "<center><input type='hidden' name='productName' value='$row[productName]'></center>";
        		echo "<center><input type ='submit' name='submit' value='Update'></center>";	
	} 
	
      } 
	
if($submit=="Update")
{	$productID = $_POST["productID"];
		$productName = $_POST["productName"];
		$productPrice = $_POST["productPrice"];
 		$productStock = $_POST["productStock"];
		
    	$sql= "UPDATE stock SET productPrice='$productPrice', productStock='$productStock' WHERE productID= '$productID'";
		
    	$result = mysqli_query($connection,$sql);
    	echo "<center><hr><h2>Record Updated</h2></center><br>";
		echo "<table border='1' align='center' width=400>";
		echo "<tr><font face=georgia>";
		echo "<td bgcolor='ff47a3'><font face=georgia>ID</font></td>";
		echo "<td bgcolor='ff47a3'><font face=georgia>Name </font> </td> "; 
		echo "<td bgcolor='ff47a3'><font face=georgia>Price</font></td>";
 		echo "<td bgcolor='ff47a3'><font face=georgia>Stock</font></td>";
		echo "</tr>";
		 
		echo "<tr>";
    	echo "<td><font face=georgia>$productID</font></td>";
		echo "<td><font face=georgia>$productName </font></td>"; 
		echo "<td><font face=georgia>$productPrice</font></td>";
 		echo "<td><font face=georgia>$productStock </font></td>";
		echo "</tr></font>";
		echo "</table>";  
}   
	mysqli_close($connection);
?>
</form>
 </body>
</html>
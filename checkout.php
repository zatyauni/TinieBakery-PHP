<?php
	require 'config.php';

	$grand_total = 0;
	$allItems = '';
	$items = [];
	$beli = '';

	$sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
	  $grand_total += $row['total_price'];
	  $items[] = $row['ItemQty'];
	}
	$allItems = implode(', ', $items);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Checkout</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

<style>
	body{
		background-color: #F8B0C4;
	}	
	
	.logoutLblPos{
   right:10px;
   top:5px;
}

header {
    background-color: #F8B0C4;
    padding: 0px;
    text-align: center;
    font-size: 10px;
    color: white;
}
	
.navbar a:hover, .dropdown:hover .dropbtn {
    background-color: #E5397F;
}
	
	.navbar a {
    float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
	
	.navbar {
    overflow: hidden;
    background-color: black;
}
	
	nav ul {
    list-style-type: none;
    padding: 40;
}
	
	nav {
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    background: #E5397F;
    padding: 20px;
}
	
	footer {
    background-color: #E5397F;
    padding: 0px;
    text-align: none;
    color: white;
}
</style>
</head>

	<form align="right" name="form1" method="post" action="index.html">
  <label class="logoutLblPos">
  <a href="register.html"><input name="submit2" type="submit" id="submit2" value="Logout"></a>
  </label>
	</form>
	
<body>
  <header> <img src="logo.png" alt="logo" style="width:150px" padding="3x"> </header>
	<!--Menu hitam-->
	<nav class="navbar navbar-expand-md" style="background-color:black">
		
	 <a href= "a-cHome.html">HOME</a>
	 <a href="a-cList.php">PRODUCT</a>
	 <a href="cart.php">CART</a>
   <a href="a-cCariPurchase.html">MY PURCHASE</a>
  </nav>
<br>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4 class="text-center text-info p-2">Complete your order!</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
			<h6 class="lead"><b>Product(s) ID : </b>WP13</h6>
          <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
          <h5><b>Total Amount Payable (RM): </b><?= number_format($grand_total,2) ?>/-</h5>
		
        </div>
        <form action="" method="post" id="placeOrder">
          <input type="hidden" name="products" value="<?= $allItems; ?>">
          <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
          </div>
		  <div class="form-group">
			<input type="date" id="birthday" name="birthday" class="form-control" placeholder="Choose Date" required>
		  </div>
          <div class="form-group">
            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone Number" required>
          </div>
          <div class="form-group">
            <textarea name="message" class="form-control" rows="3" cols="10" placeholder="Enter Order Messages..."></textarea>
          </div>
		  
          <div class="form-group">
            <input type="submit" name="place" value="Place Order" class="btn btn-danger btn-block" style="background-color:#E5397F ">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Sending Form data to the server
    $("#placeOrder").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: $('form').serialize() + "&action=order",
        success: function(response) {
          $("#order").html(response);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
	<br><br>
	<footer>
<center>
  <h5>About Us</h5>
<div class="custom_block">We know quality when we taste it, and we believe you do too. Best Cakes for all with the best price since 2012 !</div>
<p class="infoline"><i class="fa fa-location-arrow"></i>No. 93, Jalan Meru Perdana 1, Taman Meru Perdana, 31200 Chemor, Perak Darul Ridzuan.</p>
<p class="infoline"><i class="fa fa-mobile"></i> Phone: 016 637 7824</p>
<p class="infoline"></p>

<div class="footer-copyright">Powered By <a href="#">eShop Malaysia</a>Tinie Bakery ©️ Copyright - All rights reserved. 2012 - 2021</div>
</center>
</footer>
</body>

</html>

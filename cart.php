<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cart</title>
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
	
	<!--trolley-->
  <nav class="navbar navbar-expand-md" style="background-color:#F8B0C4 ">

       <ul class="navbar-nav ml-auto">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
      </ul>
  </nav>
	

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div style="display:<?php if (isset($_SESSION['showAlert'])) {
  echo $_SESSION['showAlert'];
} else {
  echo 'none';
} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
} unset($_SESSION['showAlert']); ?></strong>
        </div>
        <div class="table-responsive mt-2">
          <table class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <td colspan="7">
                  <h4 class="text-center text-info m-0" style="color: black">Products in your cart!</h4>
                </td>
              </tr>
              <tr>
                <th>Image</th>
				  <th>Product ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>
                  <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
                require 'config.php';
                $stmt = $conn->prepare('SELECT * FROM cart');
                $stmt->execute();
                $result = $stmt->get_result();
                $grand_total = 0;
                while ($row = $result->fetch_assoc()):
              ?>
              <tr>
                <td><img src="<?= $row['product_image'] ?>" width="50"></td>
				<td><?= $row['product_code'] ?></td>
                <td><?= $row['product_name'] ?></td>
                <td>
                  RM</i>&nbsp;&nbsp;<?= number_format($row['product_price'],2); ?>
                </td>
                <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                <td>
                  <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
                </td>
                <td>RM</i>&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?></td>
                <td>
                  <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>
              <?php $grand_total += $row['total_price']; ?>
              <?php endwhile; ?>
              <tr>
                <td colspan="3">
                  <a href="a-cList.php" class="btn btn-success" style="background-color: black"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                    Shopping</a>
                </td>
                <td colspan="2"><b>Grand Total</b></td>
                <td><b>RM</i>&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                <td>
                  <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>" style="background-color: #E5397F"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Change the item quantity
    $(".itemQty").on('change', function() {
      var $el = $(this).closest('tr');

      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);
      $.ajax({
        url: 'action.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pid: pid,
          pprice: pprice
        },
        success: function(response) {
          console.log(response);
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Product List</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
	
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
.navbar a:hover, .dropdown:hover .dropbtn {
    background-color: #E5397F;
}

/* Style the header */
header {
    background-color: #F8B0C4;
    padding: 0px;
    text-align: center;
    font-size: 10px;
    color: white;
}

/* Style the footer */
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
	
  <!-- trolley -->
  <nav class="navbar navbar-expand-md" style="background-color:#F8B0C4 ">

      <ul class="navbar-nav ml-auto">
          <a href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
      </ul>
  </nav>

  <!-- Displaying Products Start -->
  <div class="container">
    <div id="message"></div>
    <div class="row mt-2 pb-3">
      <?php
  			include 'config.php';
  			$stmt = $conn->prepare('SELECT * FROM product_list');
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):
  		?>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
        <div class="card-deck">
          <div class="card p-2 border-secondary mb-2">
            <img src="<?= $row['product_image'] ?>" class="card-img-top" height="250">
            <div class="card-body p-1">
				<h5 class="card-title text-center text-info"><?= $row['product_code'] ?></h5>
              <h4 class="card-title text-center text-info"><?= $row['product_name'] ?></h4>
              <h5 class="card-text text-center text-danger">RM</i>&nbsp;&nbsp;<?= number_format($row['product_price'],2) ?>/-</h5>

            </div>
            <div class="card-footer p-1">
              <form action="" class="form-submit">
                <div class="row p-2">
                  <div class="col-md-6 py-1 pl-4">
                    <b>Quantity : </b>
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control pqty" value="<?= $row['product_qty'] ?>">
                  </div>
                </div>
                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
                <button class="btn btn-info btn-block addItemBtn" style="background-color:#E5397F "><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                  cart</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
  <!-- Displaying Products End -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();
      var pcode = $form.find(".pcode").val();

      var pqty = $form.find(".pqty").val();

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          pimage: pimage,
          pcode: pcode
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
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

</html

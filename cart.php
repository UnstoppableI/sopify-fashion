<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "sopify_web");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["product"]))
	{
		$item_array_id = array_column($_SESSION["product"], "PRODUCT_ID");
		if(!in_array($_GET["item-id"], $item_array_id))
		{
			$count = count($_SESSION["product"]);
			$item_array = array(
				'PRODUCT_ID'=>$_GET["PRODUCT_ID"],
				'PRO_NAME'=>$_POST["PRO_NAME"],
				'PRICE'=>	$_POST["PRICE"],
				'QUANTITY'=>$_POST["QUANTITY"]
			);
			$_SESSION["product"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'PRODUCT_ID'			=>	$_GET["PRODUCT_ID"],
			'PRO_NAME'			=>	$_POST["PRO_NAME"],
			'PRICE'		=>	$_POST["PRICE"],
			'QUANTITY'		=>	$_POST["QUANTITY"]
		);
		$_SESSION["product"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["product"] as $keys => $values)
		{
			if($values["PRODUCT_ID"] == $_GET["PRODUCT_ID"])
			{
				unset($_SESSION["sopify_web"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="cart.php"</script>';
			}
		}
	}
}

?>

		<script src="cart.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">

			<?php
				$query = "SELECT * FROM product ORDER BY PRODUCT_ID ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-4">
				<form method="post" action="cart.php?action=add&id=<?php echo $row["PRODUCT_ID"]; ?>">
					<div style="border:3px solid #5cb85c; background-color:whitesmoke; border-radius:5px; padding:16px;" align="center">
						<img src="images/cloth1.jpg <?php echo $row["image"]; ?>" class="img-responsive" /><br />

						<h4 class="text-info"><?php echo $row["PRO_NAME"]; ?></h4>

						<h4 class="text-danger">$ <?php echo $row["PRICE"]; ?></h4>

						<input type="text" name="quantity" value="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["PRO_NAME"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["PRICE"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
                        <th width="40%">PRODUCT_ID</th>
						<th width="40%">PRO_NAME</th>
						<th width="10%">QUANTITY</th>
						<th width="20%">PRICE</th>
						<th width="15%">TOTAL</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["product"]))
					{
						$total = 0;
						foreach($_SESSION["product"] as $keys => $values)
						{
					?>
					<tr>
                        <td><?php echo $values["PRODUCT_ID"]; ?></td>
						<td><?php echo $values["PRO_NAME"]; ?></td>
						<td><?php echo $values["QUANTITY"]; ?></td>
						<td>$ <?php echo $values["PRICE"]; ?></td>
						<td>$ <?php echo number_format($values["QUANTITY"] * $values["PRICE"], 2);?></td>
						<td><a href="cart.php?action=delete&id=<?php echo $values["PRODUCT_ID"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["QUANTITY"] * $values["PRICE"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
			</div><button><a href="checkout.html">Proceed to Checkout</a></button>
		</div>
        
	</div>
	<br />
	</body>
</html>
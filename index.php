<?php
include 'db_config.php';
session_start();
if(isset($_POST["add_to_cart"])){
	if(isset($_SESSION["shoping_cart"]))
	{
		$item_array_id=array_column($_SESSION["shoping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count=count($_SESSION["shoping_cart"]);
			$item_array = array(
			'item_id' => $_GET["id"] ,
			'item_name' => $_POST["hidden_name"] ,
			'item_price' => $_POST["hidden_price"] ,
			'item_quantity' => $_POST["quantity"]
			);
		$_SESSION["shoping_cart"][$count]=$item_array;
		}
		else
		{
			echo '<script>alert("Item already added")</script>';
			echo '<script>window.location="shop.php"</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id' => $_GET["id"] ,
			'item_name' => $_POST["hidden_name"] ,
			'item_price' => $_POST["hidden_price"] ,
			'item_quantity' => $_POST["quantity"]
			);
		$_SESSION["shoping_cart"][0]=$item_array;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Online Shoping Cart</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>
	</head>
	<body>
		<br />
		<div class="container" style="width: 70px;">
			<h3 align="center">Shoping Cart</h3><br />
			<?php
			$query="SELECT * FROM products ORDER BY id ASC";
			$result = mysqli_query($connect, $query);
			if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
						{
							?>
							<div class="col-md-4">
								<form method="post" action="shop.php?action=add&id=<?php echo $row["id"]; ?>">
									<div style="border: 1px solid #333; background-color: #f1f1f1; border-radius:  margin: -1px 19px 3px -1px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding:10px;" align="center">
										<img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />
										<h4 class="text-info"><?php echo $row["p_name"]; ?></h4>
										<h4 class="text-danger">Tk. <?php echo $row["price"]; ?></h4>
										<input type="text" name="quantity" class="form-control" value="1" />
										<input type="hidden" name="hidden_name" value="<?php echo $row["p_name"]; ?>" />
										<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
										<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
									</div>
								</form>
							</div>
							<?php

						}
				}
			?>
			<div style="clear: both"></div>
			< /br>
			<h3>Order Details</h3>
			<

		</div>
	</body>
</html>
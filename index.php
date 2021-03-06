<?php
/**
 * index.php The home HTML page of the Food Truck web application.  Displays a menu and allows a customer to load a shopping cart with which to order items.
 *
 * @package Food_Truck.
 * @Peter Caliandro
 * @Clare Mason
 */

	session_start();  //   session_start()  must be called before any HTML has been output.  If HTML has been output by the time session_start has been called, a new variable called $_SESSION will be created, only to be lost when the web page is refreshed, as this variable $_SESSION will not be connected with the real, superglobal variable $_SESSION.
	
	require_once "Item.php";
	require_once "Choice.php";
	require_once "Menu.php";
	require_once "Cart.php";
	
	require_once "functions.php";
// $_SESSION = array();
// $_POST = array();
// session_destroy();	
// exit;
// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

$total = 0;

	$menu = loadMenuItems();
	if (isset($_SESSION['Cart'])) {
		$cart = unserialize($_SESSION['Cart']);  //  Set the Cart back to what it was the last time a Choice was added to it.
	} else {
		$cart = new Cart();
	}
	if ($_POST) {
		$total = 0;
		foreach ($_POST as $key => $value) {  //  Now set the user input for each HTML input tag back to the value that it had before the Post request.
			$keys = explode(INPUT_DELIMITER, $key);
			if (strpos($keys[0], ITEM_PREFIX) === 0) {  //  It's an Add Item request
				$item = $menu->getItem($key);
				$choice = (new Choice($item));
				$cart->Add($choice);
			} elseif (strpos($keys[0], REMOVE_PREFIX) === 0) {  //  It's a Remove Choice request
				$cart->Remove($keys[1]);
			} elseif ($keys[1] === QUANTITY_SUFFIX) {  //  It's a Choice Quantity
				$cart->getChoice($keys[0])->setQuantity($value);  //  Set its value back to what it had been before the Post request.
			} elseif (strpos($keys[1], OPTION_PREFIX) === 0) {  //  It's a Choice Option
				$cart->getChoice($keys[0])->setOption($value, true);
			}

			if(substr( $keys[0], 0, 6 ) === "Choice"){
			$total = $total + ($cart->getChoice($keys[0])->Item->Price * $cart->getChoice($keys[0])->getQuantity());
			
			foreach ($cart->getChoice($keys[0])->Options as $key => $value){
				if( $value == 1){
					$total = $total + .25;
				}
		
			}
		}
	}
}
// echo '<pre>';
// var_dump($cart);
// echo '</pre>';
	

  if (isset($_POST['submitter'])) {
		$_SESSION['total'] = $total;
		header("Location: submit.php?");
		exit;
		}

	$_SESSION['Cart'] = serialize($cart);
	
	
	
?>
<!doctype html>
 
<html lang="en">
	
	<head>
		<meta charset="UTF-8">
		<title>Food Truck  -  Menu</title>
		<link href="styles.css" type="text/css" rel="stylesheet" />		
	</head>

	<body>
		
		<div class="wrapper">
        <header>Food Truck</header>
			<form id="menu_cart" method="post" action="">
				<table id="menu">
<?=$menu->getHTML()?>
				</table>
				
				<hr />

				<table id="cart">

<?=$cart->getHTML()?>
				</table>
							<input type="submit" method="post" value ="Submit Order" name="submitter">

			</form>

		</div>
		
		<footer>
		</footer>
	</body>
	
</html>
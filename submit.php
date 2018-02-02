<?php
/**
 * submit.php The order confirmation HTML page of the Food Truck web application.
 *
 * @package Food_Truck.
 * @Clare Mason
 */


session_start();
if(isset($_SESSION['total'])){

    $total = $_SESSION['total'];
    $tax = number_format((float)$total * .065, 2, '.', '');    
    $total = number_format((float)$total + $tax, 2, '.', '');


}

else{
    echo "You didn't order anything :(";
}

?>

<html lang="en">
	
	<head>
		<meta charset="UTF-8">
		<title>Food Truck  -  Menu</title>
		<link href="styles.css" type="text/css" rel="stylesheet" />		
	</head>

	<body>
		<header>
		</header>
		
		<main>

		<div class="wrapper">
			<h3> Thank You for your Order!</h3>
<br>
    Tax:$<?=$tax?>
<br>
Total:$ <?=$total?>
<br>
</div>
		</main>
		<footer>
		</footer>
	</body>
	
</html>
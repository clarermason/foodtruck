<?php
session_start();
if(isset($_SESSION['total'])){

$total = $_SESSION['total'];
    echo "<h3>Thank you for your order!</h3>";
    echo "Tax:$";
    $tax = number_format((float)$total * .065, 2, '.', '');
    echo $tax;
    echo "<br>";
    echo "Your total is:$";
    echo number_format((float)$total + $tax, 2, '.', '');


}

else{
    echo "You didn't order anything :(";
}

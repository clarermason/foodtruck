<?php
class Item{


public $Name ='';
public $Description ='';
public $Price ='';


public function __construct($Name, $Description, $Price){


  $this->Name = $Name;
  $this->Description = $Description;
  $this->Price = $Price;

}// end of constructor

}//end class
$myItem = new Item ('Taco', 'Our Tacos are awesome!', 4.95);

$items[]=$myItem;

$items[]= new Item ('Burrito', 'Our Burritos are awesome!', 4.95);
$items[]= new Item ('Nachos', 'Our Nachos are awesome!', 4.95);

/*echo '<pre>';
var_dump($items);
echo '</pre>';

*/
echo '<form action="" method ="post">';


for ($x = 0; $x <= 2; $x++) {
echo '<h2>' ;
echo $items[$x]->Name;
echo '</h2>';
echo'<input name="';
echo $items[$x]->Name ;
echo '" type="number" value="0">';
}

echo '<input type="submit"></form>';

foreach($_POST as $num){
  echo  $num;
}

if (!empty($_POST)){
echo'<h2> Your Order</h2>';
$total = 0;
$tax =0;
for ($x = 0; $x <= 2; $x++) {

echo $_POST[$items[$x]->Name];
echo " ";
echo $items[$x]->Name;
echo " :$";
echo  number_format((float)$items[$x]->Price * $_POST[$items[$x]->Name], 2, '.', '');
echo '<br>';
$total = number_format((float) $total + $items[$x]->Price * $_POST[$items[$x]->Name], 2, '.', '');
      }
      echo "<h4> Tax:$";
      $tax = number_format((float)$total * .065, 2, '.', '');
      echo $tax;
      echo "<h3> Your total is:$";
      echo number_format((float)$total + $tax, 2, '.', '');

}
else{

echo "<h2>Please order something</h2>";
}

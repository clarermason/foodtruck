<?php
/**
 * functions.php Stores global constants for use in the classes as well as in the main procedure.  Also contains the procedure that will load the Menu with Items.
 *
 * @package Food_Truck.
 * @Peter Caliandro
 */

	define("EXTRAS_DELIMITER", ", ");
	define("OPTIONS_DELIMITER", "<br />");
	define("EXTRAS_PRICE", 0.25);
	define("ITEM_PREFIX", "Item");
	define("CHOICE_PREFIX", "Choice");
	define("QUANTITY_SUFFIX", "Quantity");
	define("OPTION_PREFIX", "Option");
	define("INPUT_DELIMITER", "|");
	define("REMOVE_PREFIX", "Remove");
	
	define("SESSION_CART", "Cart");

	

/**
 * loadMenuItems:  The procedure that will load the Menu with Items.  The source text from which Items are built is hard-coded here.  A future iteration of this function could retrieve this text from a CSV file or a MySQL database.
 *
 * @return Menu A Menu object pre-loaded with an array of Item objects.
 */
	function loadMenuItems()
	{
		$myMenu = new Menu;
		
		$myItem = new Item(16, "Taco", "Our tacos are awesome!", 4.95);
		$myItem->addExtra("Tomatoes");
		$myItem->addExtra("Cheese");
		$myItem->addExtra("Refried beans");
		$myMenu->Add($myItem);

		$myItem = new Item(2, "Sundae", "Our sundaes are awesome!", 3.95);
		$myItem->addExtra("Chocolate syrup");
		$myItem->addExtra("Nuts");
		$myMenu->Add($myItem);

		$myItem = new Item(3, "Salad", "Our salads are awesome!", 5.95);
		$myItem->addExtra("Chicken");
		$myItem->addExtra("Croutons");
		$myMenu->Add($myItem);

		$myItem = new Item(4, "Pizza", "Our pizza awesome!", 4.95);
		$myItem->addExtra("Anchovies");
		$myItem->addExtra("Extra cheese");
		$myItem->addExtra("Pineapple");
		$myMenu->Add($myItem);

		return $myMenu;
	}

<?php
/**
 * Menu.php stores the code for the Menu class.
 *
 * @package Food_Truck.
 * @Peter Caliandro
 */


/**
 * A Menu object represents the collection of Items that are listed on the menu of a restaurant.
 */
	class Menu
	{
		private $Items = array();  //  This is the core property of a Menu object.  It is an associative array of Item objects.
		private $index = 0;
		private $menuHeading = array("", "Dish", "Description", "Price", "Extras (" . EXTRAS_PRICE * 100 . "¢ each)", "");
 

/**
 * Add:  Adds a new Item to the $Items associative array, effectively adding an item to the menu.
 *
 * The ItemKey property of the Item being added is applied as the key to identify this Item in the Menu's $Items associative array.
 *
 * @param Item @Item The Item object to be added to the Menu.
 */
		public function Add($Item)
		{
			$key = ITEM_PREFIX . ++$this->index;  //  This will be stored both as a property of the $Item object and as the key of the associative array $Items.
			$Item->ItemKey = $key;  //  Set the ItemKey property of $Item.
			$this->Items[$key] = $Item;  //  Add $Item to the associative array that is $Items.
		}

/**
 * getItem:  Getter method for an Item in the $Items array.
 *
 * @param string @key The key that identifies which Item to get.
 */
		public function getItem($key)
		{
			return $this->Items[$key];
		}
		
/**
 * getHTML:  Returns an HTML string to display the entire Menu on a web page.
 *
 * @return string An HTML string to display the entire Menu on a web page, including both plain text and HTML tags.
 */
		public function getHTML()
		{
			$menuHTML = $this->getHeaderRowHTML();
			foreach ($this->Items as $key => $value) {
				$menuHTML .= $value->getHTML();
			}
			return $menuHTML;
		}

		private function getHeaderRowHTML()
		{
			$headerHTML =
<<<_HEREDOC
					<tr>

_HEREDOC;
			foreach ($this->menuHeading as $heading) {
				$headerHTML .=
<<<_HEREDOC
						<th scope="col">$heading</th>

_HEREDOC;
			}
			$headerHTML .=
<<<_HEREDOC
					</tr>

_HEREDOC;
			return $headerHTML;
		}
		
	}

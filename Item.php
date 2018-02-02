<?php
/**
 * Item.php stores the code for the Item class.
 *
 * @package Food_Truck.
 * @Peter Caliandro
 */


/**
 * An Item object represents an item on the menu of a restaurant.
 */
	class Item
	{
		private $ID			= 0;
		public $ItemKey     = "";  //  Corresponds to the primary key of the record in the table.  By the way, since an autonumbered primary key will be at least 1, if this property remains 0, it indicates an error.
		public $ItemName    = "";  //  Always give a zero-equivalent default value.
		public $Description = "";
		public $Price       = 0.0;
		public $Extras      = array();  //  Corresponds to the many side of a one-to-many relationship.
		
/**
 * Populates several of the properties of a new Item.
 *
 * @param string $ID The number of an item on the menu.  This is especially useful for enabling customers to order hard-to-pronounce items.
 * @param string $Name The name of an item on the menu.  For instance, "Pizza".
 * @param string $Description A description of an item on the menu.  For instance, "Fresh dough, delicious sauce, 100% real Romano and mozzarella cheese.".
 * @param float $Price The price of an item on the menu.  For instance, 5.95.
 */
		public function __construct($ID, $Name, $Description, $Price)
		{
			$this->ID		   = (int) $ID;
			$this->ItemName        = $Name;
			$this->Description = $Description;
			$this->Price       = (float) $Price;
		}  //  end constructor
		
/**
 * addExtra:  Adds a new extra to the $Extras indexed array.
 *
 * @param string @extra The name of the extra to be added to the Item.  For example, for a Pizza Item, an extra could be "Pepperoni".
 */
		public function addExtra($extra)
		{
			$this->Extras[] = $extra;
		}  //  end addExtra

/**
 * getHTML:  Returns an HTML string to display this menu item on a web page.
 *
 * @return string An HTML string to display this menu item on a web page, including both plain text and HTML tags.
 */
		public function getHTML()
		{
			$extrasHTML = $this->getExtrasHTML();
			return
<<<_HEREDOC
					<tr>
						<td>$this->ID</td>
						<td>$this->ItemName</td>
						<td>$this->Description</td>
						<td>$$this->Price</td>
						<td>$extrasHTML</td>
						<td><input type="submit" form="menu_cart" value="Add $this->ItemName to Cart" name="$this->ItemKey" /></td>
					</tr>

_HEREDOC;
		}

/**
 * getExtrasHTML:  Returns an HTML string to display the list of an item's extras on a web page.
 *
 * This method is private and is used only to make the getHTML function's code easier to follow.
 *
 * @return string An HTML string to display the list of an item's extras on a web page.
 */
		private function getExtrasHTML()
		{
			$extrasHTML = '';
			foreach ($this->Extras as $extra)
			{
				$extrasHTML .= $extra . EXTRAS_DELIMITER;
			}
			return substr($extrasHTML, 0, mb_strlen($extrasHTML) - mb_strlen(EXTRAS_DELIMITER));
		}

	}

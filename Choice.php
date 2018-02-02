<?php
/**
 * Choice.php stores the code for the Choice class.
 *
 * @package Food_Truck.
 * @Peter Caliandro
 */


/**
 * A Choice object represents an Item that has been chosen for order from the menu of a restaurant.
 */
	class Choice
	{
		public $ChoiceKey = "";
		public $Item;
		private $Quantity = 1;
		public $Options  = array();
		
/**
 * Creates a new Choice from an existing Item.
 *
 * @param Item $Item An Item object from the menu.
 */
		public function __construct($Item)
		{
			$this->Item = $Item;
			foreach ($Item->Extras as $extra) {
				$this->Options[$extra] = false;
			}
		}

/**
 * Setter method for the $Quantity property.
 *
 * @param int $quantity The number of items of type Item that are being ordered.
 */
		public function setQuantity($quantity)
		{
			$this->Quantity = (int) $quantity;
		}

/**
 * Getter method for the $Quantity property.
 *
 * @return int The number of items of type Item that are being ordered.
 */
		public function getQuantity()
		{
			return $this->Quantity;
		}

/**
 * Setter method for the $Options property.
 *
 * @param string $option The key that identifies the option being set.
 * @param int $value 1 means order this Choice or these Choices with this option.  0 means don't include this option.
 */
		public function setOption($option, $value)
		{
			$this->Options[$option] = $value;
		}

/**
 * Getter method for the $Options property.
 *
 * @param string $option The key that identifies the option in question.
 * @return int $value 1 means that this Choice or these Choices are being ordered with this option.  0 means this option is not being included.
 */
		public function getOption($option)
		{
			return $this->Options[$option];
		}

/**
 * getHTML:  Returns an HTML string to display this shopping cart choice on a web page.
 *
 * @return string An HTML string to display this shopping cart choice on a web page, including both plain text and HTML tags.
 */
		public function getHTML()
		{
			$quantityInputName = $this->ChoiceKey . INPUT_DELIMITER . QUANTITY_SUFFIX;
			$remove = REMOVE_PREFIX . INPUT_DELIMITER . $this->ChoiceKey;
			$itemName = $this->Item->ItemName;
			$price = $this->Item->Price;
			$options = $this->getOptionsHTML();
			return
<<<_HEREDOC
					<tr>
						<td>$itemName</td>
						<td><input type="number" form="menu_cart" min="1" value="$this->Quantity" name="$quantityInputName" /></td>
						<td>$$price</td>
						<td>
$options
						</td>
						<td><!-- Subtotal goes here --></td>
						<td><input type="submit" form="menu_cart" value="Remove $itemName from Cart" name="$remove" /></td>
					</tr>

_HEREDOC;
		}

/**
 * getOptionsHTML:  Returns an HTML string to display the list of a choice's options on a web page.
 *
 * This method is private and is used only to make the getHTML function's code easier to follow.
 *
 * @return string An HTML string to display the list of a choice's options on a web page.
 */
		private function getOptionsHTML()
		{
			$index = 0;
			$optionsDelimiter = OPTIONS_DELIMITER;  //  Absurd to have to do this, but heredoc won't interpret a constant.
			$optionsHTML = '';
			foreach ($this->Options as $key => $value)
			{
				$optionName = $this->ChoiceKey . INPUT_DELIMITER . OPTION_PREFIX . ++$index;
				$optionChecked  =  $value === true ? 'checked' : '';
				$optionsHTML .= 
<<<_HEREDOC
							<input type="checkbox" form="menu_cart" name="$optionName" value="$key" $optionChecked/>$key$optionsDelimiter

_HEREDOC;
			}
			return substr($optionsHTML, 0, strrpos($optionsHTML, OPTIONS_DELIMITER));  //  Remove the last options delimiter.
		}
	
	}

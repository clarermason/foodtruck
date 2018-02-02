<?php
/**
 * Cart.php stores the code for the Cart class.
 *
 * @package Food_Truck.
 * @Peter Caliandro
 */


/**
 * A Cart object represents the collection of Choices that have been added to a customer's shopping cart for ordering items from a restaurant.
 */
	class Cart
	{
		private $Choices = array();
		private $index = 0;
		private $cartHeading = array("Dish", "Quantity", "Unit Price", "Extras (" . EXTRAS_PRICE * 100 . "¢ each)", "Subtotal", "");

/**
 * Add:  Adds a new Choice to the $Choice associative array, effectively adding a chosen item to the shopping cart.
 *
 * The ChoiceKey property of the Choice being added is applied as the key to identify this Choice in the Cart's $Choices associative array.
 *
 * @param Choice @Choice The Choice object to be added to the Cart.
 */
		public function Add($Choice)
		{
			$key = CHOICE_PREFIX . ++$this->index;  //  This will be stored both as a property of the $Choice object and as the key of the associative array $Choices.
			$Choice->ChoiceKey = $key;  //  Set the ChoiceKey property of $Choice.
			$this->Choices[$key] = $Choice;  //  Add $Choice to the associative array that is $Choices.
		}

/**
 * Remove:  Removes a Choice from the $Choices array, effectively removing it from the shopping cart.
 *
 * @param string @key The key that identifies which Choice to remove.
 */
		public function Remove($key)
		{
			unset($this->Choices[$key]);
		}
		
/**
 * getItem:  Getter method for a Choice in the $Choices array.
 *
 * @param string @key The key that identifies which Choice to get.
 */
		public function getChoice($key)
		{
			return $this->Choices[$key];
		}

/**
 * getHTML:  Returns an HTML string to display the entire Cart on a web page.
 *
 * @return string An HTML string to display the entire Cart on a web page, including both plain text and HTML tags.
 */
		public function getHTML()
		{
			$menuHTML = $this->getHeaderRowHTML();
			foreach ($this->Choices as $key => $value) {
				$menuHTML .= $value->getHTML();
			}
			return $menuHTML;
		}

/**
 * getHeaderRowHTML:  Returns an HTML string to display the header row of the Cart on a web page.
 *
 * @return string An HTML string to display the header row of the Cart on a web page.
 */
		private function getHeaderRowHTML()
		{
			$headerHTML =
<<<_HEREDOC
					<tr>

_HEREDOC;
			foreach ($this->cartHeading as $heading) {
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
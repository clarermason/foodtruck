<?php
 //  Choice.php
	class Choice
	{
		public $ChoiceKey = "";
		public $Item;
		private $Quantity = 1;
		public $Options  = array();
		
		public function __construct($Item)
		{
			$this->Item = $Item;
			foreach ($Item->Extras as $extra) {
				$this->Options[$extra] = false;
			}
		}

		public function setQuantity($quantity)
		{
			$this->Quantity = (int) $quantity;
		}

		public function getQuantity()
		{
			return $this->Quantity;
		}

		public function setOption($option, $value)
		{
			$this->Options[$option] = $value;
		}

		public function getOption($option)
		{
			return $this->Options[$option];
		}

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

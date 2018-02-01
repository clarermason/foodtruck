<?php
//  Cart.php
	class Cart
	{
		private $Choices = array();
		private $index = 0;
		private $cartHeading = array("Dish", "Quantity", "Unit Price", "Extras (" . EXTRAS_PRICE * 100 . "¢ each)", "Subtotal", "");

		public function Add($Choice)
		{
			$key = CHOICE_PREFIX . ++$this->index;  //  This will be stored both as a property of the $Choice object and as the key of the associative array $Choices.
			$Choice->ChoiceKey = $key;  //  Set the ChoiceKey property of $Choice.
			$this->Choices[$key] = $Choice;  //  Add $Choice to the associative array that is $Choices.
		}

		public function Remove($key)
		{
			unset($this->Choices[$key]);
		}
		
		public function getChoice($key)
		{
			return $this->Choices[$key];
		}

		public function getHTML()
		{
			$menuHTML = $this->getHeaderRowHTML();
			foreach ($this->Choices as $key => $value) {
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
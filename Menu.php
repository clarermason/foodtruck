<?php
//  Menu.php
	class Menu
	{
		private $Items = array();  //  This is the core property of a Menu object.  It is an associative array of Item objects.
		private $index = 0;
		private $menuHeading = array("", "Dish", "Description", "Price", "Extras (" . EXTRAS_PRICE * 100 . "¢ each)", "");
 

		public function Add($Item)
		{
			$key = ITEM_PREFIX . ++$this->index;  //  This will be stored both as a property of the $Item object and as the key of the associative array $Items.
			$Item->ItemKey = $key;  //  Set the ItemKey property of $Item.
			$this->Items[$key] = $Item;  //  Add $Item to the associative array that is $Items.
		}

		public function getItem($key)
		{
			return $this->Items[$key];
		}
		
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

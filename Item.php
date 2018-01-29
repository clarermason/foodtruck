<?php
//  Item.php
	class Item
	{
		private $ID			= 0;
		public $ItemKey     = "";  //  Corresponds to the primary key of the record in the table.  By the way, since an autonumbered primary key will be at least 1, if this property remains 0, it indicates an error.
		public $ItemName    = "";  //  Always give a zero-equivalent default value.
		public $Description = "";
		public $Price       = 0.0;
		public $Extras      = array();  //  Corresponds to the many side of a one-to-many relationship.
		
		public function __construct($ID, $Name, $Description, $Price)
		{
			$this->ID		   = (int) $ID;
			$this->ItemName        = $Name;
			$this->Description = $Description;
			$this->Price       = (float) $Price;
		}  //  end constructor
		
		public function addExtra($extra)
		{
			$this->Extras[] = $extra;
		}  //  end addExtra

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

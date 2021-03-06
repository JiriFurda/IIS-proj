<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;
use App\Medicine;
use App\Branch;

class CartItem
{
	public $medicine;
	public $quantity;

	public function __construct($medicine, $quantity)
	{
		$this->medicine = $medicine;
		$this->quantity = $quantity;	
	}

	public function getPrice()
	{
		return $this->medicine->price * $this->quantity;
	}

	public function verifyStock($branch = null)
	{
	    if(is_null($branch))
	        $branch = Branch::current();

		if($branch->getQuantityInStock($this->medicine) >= $this->quantity)
			return true;
		return false;
	}
}

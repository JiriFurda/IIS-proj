<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;
use App\Medicine;

class CartItem
{
	public $medicine;
	public $quantity;

	public function __construct($medicine, $quantity)
	{
		$this->medicine = $medicine;
		$this->quantity = $quantity;	
	}
}
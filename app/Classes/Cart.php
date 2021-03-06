<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;
use App\Medicine;

abstract class Cart
{
    public static function add(Medicine $medicine, $count = 1)
    {
        $cart = session('cart', array());

        if(array_key_exists($medicine->id, $cart))
            $cart[$medicine->id] += $count;
        else
            $cart[$medicine->id] = $count;

        session()->put('cart', $cart);
    }

    public static function count()
    {
        if(!session()->has('cart'))
            return 0;

        return array_sum(session('cart'));
    }

    public static function sum()
    {
        $sum = 0;
        foreach(self::items() as $cartItem)
        {
            $sum += $cartItem->medicine->price * $cartItem->quantity;
        }

        return $sum;
    }

    public static function items()
    {
        if(!session()->has('cart') || empty(session('cart')))
            return null;

        $cart = session('cart');
        $medicines = Medicine::find(array_keys($cart));

        
        $items = array();
        
        foreach($medicines as $medicine)
        {
            array_push($items, new CartItem($medicine, $cart[$medicine->id]));
        }



        return $items;
    }

    public static function isEmpty()
    {
        return ( !session()->has('cart') || empty(session('cart')) );
    }

    public static function update($medicineId, $count = 1)
    {
        $cart = session('cart', array());

        $cart[$medicineId] = $count;

        session()->put('cart', $cart);
    }

    public static function remove(Medicine $medicine)
    {
        $cart = session('cart', array());

        if(array_key_exists($medicine->id, $cart))
            unset($cart[$medicine->id]);
        else
            abrot(500, "Cart::remove(): Id léku nenalazeno v košíku.");

        session()->put('cart', $cart);
    }

    public static function hasPrescriptedMedicine()
    {
        foreach(self::items() as $cartItem)
        {
            if($cartItem->medicine->prescription)
                return true;
        }

        return false;
    }

    public static function verifyStock()
    {
        foreach(self::items() as $cartItem)
        {
            if(!$cartItem->verifyStock())
                return false;
        }
        return true;
    }

    public static function erase()
    {
        session()->forget('cart');
    }
}

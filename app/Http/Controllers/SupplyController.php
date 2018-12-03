<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;
use App\Branch;

use App\Rules\KeyIsID;
use App\Rules\KeyUnique;

class SupplyController extends Controller
{
    public function create()
    {
        $medicines = Medicine::all();

        return view('supply.create', compact('medicines'));
    }

    public function store()
    {
        $rules = [
            'supply' => ['array', new KeyIsID(Medicine::class), new KeyUnique()],
            'supply.*' => 'nullable|integer|min:0',
        ];
        $this->validate(request(), $rules);

        $branch = Branch::current();

        $branch->addSupply(request()->input('supply'));


        session()->flash('alert-success', 'Dodávka léků byla úspěšně zaevidována.');
        return redirect()->route('branches.show', $branch);
    }
}

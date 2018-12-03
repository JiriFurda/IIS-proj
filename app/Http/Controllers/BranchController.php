<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;

class BranchController extends Controller
{
    public function index()
    {
    	$branches = Branch::all();

    	return view('branches.index', compact('branches'));
    }

    public function show(Branch $branch)
    {
    	return view('branches.show', compact('branch'));
    }

    public function switch(Branch $branch)
    {
        auth()->user()->branch()->associate($branch)->save();

        session()->flash('alert-success', 'Aktuální pobočka byla změněna.');
        return redirect()->back();
    }
}

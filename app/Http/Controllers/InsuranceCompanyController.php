<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\InsuranceCompany;

class InsuranceComapnyController extends Controller
{
    public function index()
    {
        $insuranceCompanies = InsuranceCompany::all();
    	return view('insurance_companies.index', compact('insuranceCompanies'));
    }

    public function show(InsuranceCompany $insuranceCompany)
    {
        $from = request('from', Carbon::now()->subMonth());
        $to = request('to', Carbon::now());

        $sales = $insuranceCompany->sales()->whereBetween('created_at', [$from, $to])->get();
        /*PageView::select('id', 'title', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            //return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });*/
    	return view('insurance_companies.show', compact('insuranceCompany', 'from', 'to', 'sales'));
    }
}

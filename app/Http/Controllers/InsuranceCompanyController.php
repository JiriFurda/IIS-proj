<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\InsuranceCompany;
use App\Medicine;
use App\Rules\KeyIsID;
use App\Rules\KeyUnique;
use Validator;

class InsuranceComapnyController extends Controller
{
    public function index()
    {
        $insuranceCompanies = InsuranceCompany::all();
    	return view('insurance_companies.index', compact('insuranceCompanies'));
    }

    public function sales(InsuranceCompany $insuranceCompany)
    {
        $validator = Validator::make(request()->all(), [
            'from' => 'nullable|date',
            'to' => 'nullable|date',
        ]);
        if ($validator->fails())
        {
            $parameters[] = $insuranceCompany;
            if(!$validator->errors()->has('from'))
                $parameters['from'] = request('from');
            if(!$validator->errors()->has('to'))
                $parameters['to'] = request('to');
            return redirect()->route('insurance_companies.sales', $parameters)->withErrors($validator); // Not exactly the smartest solution
        }

        $from = Carbon::parse(request('from', Carbon::now()->subMonth()));
        $to = Carbon::parse(request('to', Carbon::now()));

        $sales = $insuranceCompany->sales()->whereBetween('created_at', [$from->startOfDay(), $to->endOfDay()])->get();
        /*PageView::select('id', 'title', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            //return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });*/
        $from = $from->format('d.m.Y');
        $to = $to->format('d.m.Y');
    	return view('insurance_companies.sales', compact('insuranceCompany', 'from', 'to', 'sales'));
    }

    public function contributionsEdit(InsuranceCompany $insuranceCompany)
    {
        $medicines = Medicine::with(['insuranceCompanies' => function($q) use ($insuranceCompany) {
            $q->where('id', $insuranceCompany->id);
        }])->get();

        return view('insurance_companies.contributions', compact('insuranceCompany', 'medicines'));
    }

    public function contributionsUpdate(InsuranceCompany $insuranceCompany)
    {
        $rules = [
            'contribution' => ['array', new KeyIsID(Medicine::class), new KeyUnique()],
            'contribution.*' => 'nullable|numeric|min:0|regex:/^\d+(\.[\d]{1,2})?$/',
            ];

        foreach(Medicine::all() as $medicine)
        {
            $rules['contribution.'.$medicine->id] = 'nullable|max:'.$medicine->price;
        }
        $this->validate(request(), $rules);

        foreach(request()->input('contribution') as $medicineId => $contribution)
        {
            if(!$contribution)
                continue;
            
            $syncData[$medicineId] = ['amount' => $contribution];
        }

        $insuranceCompany->medicines()->sync($syncData);

        session()->flash('alert-success', 'Hrazení lékárny bylo aktualizováno.');
        return redirect()->back();
    }
}

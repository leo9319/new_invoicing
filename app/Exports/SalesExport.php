<?php

namespace App\Exports;

use App\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;

class SalesExport implements \Maatwebsite\Excel\Concerns\FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
	{
		$data['sales'] = Sale::all();
    	return view('report', $data);
	}
}

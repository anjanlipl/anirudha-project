<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoicesExport implements FromView
{


	public function __construct(int $year)
    {
        $this->year = $year;
    }


    public function view(): View
    {
        return view('add_achieve', [
            'data' => Invoice::all()
        ]);
    }

}
<?php

namespace App\Exports;

use App\Customer;
use App\Model;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerperMonthExport implements FromView
{
	public $firstdate;
	public $lastdate;

	public function __construct(string $firstdate,string $lastdate) {
		$this->firstdate = $firstdate;
		$this->lastdate = $lastdate;
	}

    public function view(): View
    {
    	$customer = Customer::whereRaw("DATE(created_at) >= ?", [$this->firstdate])->whereRaw("DATE(created_at) <= ?", [$this->lastdate])->with("product")->with("user")->get();
        return view("template_excel.customer", [
        	"customers" => $customer
        ]);
    }
}

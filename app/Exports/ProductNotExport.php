<?php

namespace App\Exports;

use App\Product;
use App\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductNotExport implements FromView
{	
	public $firstdate;
	public $lastdate;

	public function __construct(string $firstdate,string $lastdate) {
		$this->firstdate = $firstdate;
		$this->lastdate = $lastdate;
	}

    public function view(): View
    {
        $customer = Customer::whereHas("product", function($q) {
        	$q->where("dateofentry", ">=", $this->firstdate)->where("dateofissue", "<=", $this->lastdate);
        })->get();
        // $customer[0]->product[0]->pivot->dateofissue
        $now = date("Y-m-d");
        return view("template_excel.customernotreturn", [
        	"customers" => $customer,
        	"now" => $now
        ]);

    }
}

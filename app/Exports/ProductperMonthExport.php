<?php

namespace App\Exports;

use App\Product;
use Illuminate\Http\Request;
use App\Exports\ProductperMonthExport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class ProductperMonthExport implements FromView
{
	public $firstdate;
	public $lastdate;

	public function __construct(string $firstdate,string $lastdate) {
		$this->firstdate = $firstdate;
		$this->lastdate = $lastdate;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $product = Product::whereRaw("DATE(created_at) >= ?", [$this->firstdate])->whereRaw("DATE(created_at) <= ?", [$this->lastdate])->get();
        return view('template_excel.product', [
            "products" => $product
        ]);
    }
}

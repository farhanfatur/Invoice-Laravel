<?php

namespace App\Http\Controllers;

use App\Exports\ProductperMonthExport;
use App\Exports\CustomerperMonthExport;
use App\Exports\ProductNotExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class ReportController extends Controller
{
    public function ProductperMonth(Request $request) {
    	if($request->reportmenu == "product") {
    		return Excel::download(new ProductperMonthExport($request->firstdate, $request->lastdate), "Product-Month.xlsx");
    	}else if($request->reportmenu == "customer") {
    		return Excel::download(new CustomerperMonthExport($request->firstdate, $request->lastdate), "Customer-Month.xlsx");
    	}else if($request->reportmenu == "customernotreturn") {
    		return Excel::download(new ProductNotExport($request->firstdate, $request->lastdate), "Product-Not-Return.xlsx");
    	}
    }
}
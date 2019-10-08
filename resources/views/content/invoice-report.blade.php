@extends("layouts.appadmin")

@push("javascripts")
<script src="{{ asset('/js/require-admin-report.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}" type="text/javascript"></script>
@endpush

@section('content')
<div class="container">
	<div class="row justify-content-center">
	<div class="col-md-12">
	    <div class="card">
	        <div class="card-header">
	            Report
	        </div>
	        <div class="card-body">
	        	<form method="POST" action="api/productreport">
	        	<div class="row">
	        		<div class="col-md-12">
	        			<select class="form-control" id="reportmenu" name="reportmenu">
	        				<option>-- Choose Option --</option>
	        				<option value="customer">Export Customer</option>
	        				<option value="product">Export Product</option>
	        				<option value="customernotreturn">Customer who don't return product</option>
	        			</select>
	        		</div>
	        	</div>
	        	<div class="row">
	        		@csrf
	        		<div class="col-md-4">
	        			<label>First Date</label>
	        			<input type="date" id="firstdate" name="firstdate" class="form-control">
	        		</div>
	        		<div class="col-md-4">
	        			<label>Last Date</label>
	        			<input type="date" id="lastdate" name="lastdate" class="form-control">
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-4">
	        			<br>
	        			<button class="btn btn-success" id="exportToExcel" type="submit">Export to Excel</button>
	        		</div>
	        	</div>
	        	</form>
	        </div>
	       </div>
	    </div>
	</div>
</div>
@endsection
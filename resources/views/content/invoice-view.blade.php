@extends("layouts.appadmin")

@push("javascripts")
<script type="text/javascript" src="/js/require-admin-invoice.js"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}" type="text/javascript"></script>
@endpush

@section("content")
<div class="container">
	<div class="row justify-content-center">
	<div class="col-md-12">
	    <div class="card">
	        <div class="card-header">
	            Invoice
	        </div>
	        <div class="card-body">
	        	<div class="jumbotron">
	        		<div class="row">
	        			<div class="col-md-6">
	        				<label>ID Customer</label>
	        				<select class="form-control" id="idcustomer" readonly></select>
	        			</div>	
	        		</div>
	        		<div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" id="name" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Age</label>
                            <input type="number" name="age" class="form-control" id="age" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Phone</label>
                            <input type="number" name="phone" class="form-control" id="phone" readonly>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Identity Card</label>
                            <input type="number" name="idcard" class="form-control" id="idcard" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" id="address" readonly>
                        </div>
                    </div>
                    <br>
                    <h2>Product</h2>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Product</label>
                            <select class="form-control" name="product" id="product" readonly>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Description</label>
                            <textarea class="form-control" readonl id="description" readonly></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" id="price" readonly>
                        </div>
                        <div class="col-md-3">
                            <label>Stock</label>
                            <input type="number" name="stock" class="form-control" id="stock" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Item started at</label>
                            <input type="date" name="dateentry" class="form-control" id="dateentry" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Item returned at</label>
                            <input type="date" name="dateissue" class="form-control" id="dateissue" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                                <button class="btn btn-danger" id="unlockAdminInvoice">Unlock</button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" id="saveAdminInvoice">Save</button>
                        </div>
                    </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Product</th>
                            <th>Date of Entry</th>
                            <th>Date of Issue</th>
                            <th>Day Invoice</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="gridInvoice"></tbody>
                    </table>
	        	</div>
	        </div>
	       </div>
	    </div>
	</div>
</div>

<!-- ##################################################################################### -->
<!--                                          Return Invoice                               -->
<!-- ##################################################################################### -->

<div class="modal fade" id="modalInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <label>Product</label>
                <select class="form-control" id="idProduct" onchange="productCost(this.value)"></select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>Date of Entry</label>
                <input type="date" id="dateofentry" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label>Date of Issue</label>
                <input type="date" id="dateofissue" class="form-control" readonly>
            </div>
        </div>
        <input type="hidden" id="customer_id">
        <div class="row">
            <div class="col-md-4">
                <label>Cost: <span id="totalCost"></span></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>Fine: <span id="totalFine"></span></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label>Payment</label>
                <input type="number" id="payment" class="form-control">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="doPayment">Do Pay</button>
      </div>
    </div>
  </div>
</div>

<!-- ##################################################################################### -->
<!--                                          Detail Invoice                               -->
<!-- ##################################################################################### -->

<div class="modal fade " id="modalDetailInvoice" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Invoice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2>Customer</h2>
        <hr>
         <div class="row">
            <div class="col-md-12">
                <label>ID Customer</label>
                <input type="text" name="id" id="idcustomerdetail" class="form-control" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label>Name</label>
                <input type="text" name="name" class="form-control" id="namedetail" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>Age</label>
                <input type="number" name="age" class="form-control" id="agedetail" readonly>
            </div>
            <div class="col-md-8">
                <label>Phone</label>
                <input type="number" name="phone" class="form-control" id="phonedetail" readonly>
            </div>  
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>Identity Card</label>
                <input type="number" name="idcard" class="form-control" id="idcarddetail" readonly>
            </div>
            <div class="col-md-8">
                <label>Address</label>
                <input type="text" name="address" class="form-control" id="addressdetail" readonly>
            </div>
        </div>
        <h2>Product</h2>
        <hr>
        <div class="row">
            <div class="col-md-12">
               <table class="table table-hover">
                   <thead>
                       <tr>
                           <th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Date of Entry</th><th>Date of Issue</th><th>Total Price</th><th>Status</th>
                       </tr>
                   </thead>
                   <tbody id="gridDetailInvoice">
                       
                   </tbody>
               </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
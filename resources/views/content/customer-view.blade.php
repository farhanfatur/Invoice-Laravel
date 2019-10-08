@extends('layouts.app')

@push("javascript")
<script src="{{ asset('/js/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/require-customer-invoice.js') }}" type="text/javascript"></script>

@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->has('id'))
            <input type="hidden" id="id" value="{{ session()->get('id') }}" readonly="">
            @endif
            <div class="card">
                <div class="card-header bg-success">Dashboard</div>
                <div class="card-body">
                    <div id="customerData">
                    <h2>Customer</h2>
                    <hr>
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
                            <select class="form-control" name="product" id="product">
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
                            <input type="date" name="dateissue" class="form-control" id="dateissue">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            <button class="btn btn-primary" id="saveInvoiceCustomer">Save</button> 
                        </div>
                    </div>
                    </div>
                </div>
               </div>
            </div>
        </div>
    </div>
@endsection
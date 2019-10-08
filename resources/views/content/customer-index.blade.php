@extends('layouts.appadmin')

@push("javascripts")
<script src="{{ asset('/js/require-admin-customer.js') }}" type="text/javascript"></script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Customer
                </div>
                <div class="card-body">
                	<div class="jumbotron">
                        <div class="row">
                            <input type="hidden" id="id">
                            <div class="col-md-5">
                                <label>Name</label>
                                <input type="text" id="name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>Address</label>
                                <input type="text" id="address" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <label>Age</label>
                                <input type="Number" id="age" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label>Identity Card</label>
                                <input type="number" id="idcard" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <label>E-mail</label>
                                <input type="email" id="email" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label>Phone</label>
                                <input type="number" id="phone" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <label>Password</label>
                                <input type="password" id="password" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <label>Confirm Password</label>
                                <input type="password" id="confirmpassword" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">
                                <button class="btn btn-danger" id="unlockAdminCustomer">Unlock</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" id="saveAdminCustomer">Save</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-warning" id="updateAdminCustomer">Update</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Identity Card</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="gridCustomer"></tbody>
                    </table>
                </div>
               </div>
            </div>
        </div>
    </div>
@endsection
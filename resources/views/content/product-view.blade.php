@extends('layouts.appadmin')

@push("javascripts")
<script src="{{ asset('/js/require-admin-product.js') }}" type="text/javascript"></script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   Product
                </div>
                <div class="card-body">
                    <div class="jumbotron">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <input type="hidden" id="id">
                                    @csrf
                                    <div class="col-md-6">
                                        <label>Name</label>
                                        <input type="text" id="title" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Price</label>
                                        <input type="number" id="price" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Stock</label>
                                        <input type="number" id="stock" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Description</label>
                                <textarea id="desc" cols="6" rows="6" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <button class="btn btn-danger" id="unlockAdminProduct">Unlock</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" id="saveAdminProduct">Save</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-warning" id="udpateAdminProduct">update</button>
                            </div>
                        </div>
                    </div>
                	<table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="gridProduct"></tbody>
                    </table>
                </div>
               </div>
            </div>
        </div>
    </div>
@endsection

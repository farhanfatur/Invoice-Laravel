@extends('layouts.appadmin')
@push("javascripts")
<script type="text/javascript" src='{{ asset("/js/chart.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/require-admin-chart.js") }}'></script>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>
                <div class="card-body">
                	<div class="row">
                     <div class="col-md-6">
                         <h2>Item Loan Today</h2>
                         <hr>
                         <canvas id="amountDay" width="400" height="400"></canvas>
                     </div>
                     <div class="col-md-6">
                         <h2>Product Amount</h2>
                         <hr>
                         <canvas id="amountProduct" width="400" height="400"></canvas>
                     </div>   
                    </div>
                </div>
               </div>
            </div>
        </div>
    </div>
@endsection
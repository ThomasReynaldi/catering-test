@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order Details</div>

                <div class="card-body">
                    <p>Invoice Number: {{ $order->invoice_number }}</p>
                    <p>Customer ID: {{ $order->customer_id }}</p>
                    <p>Merchant ID: {{ $order->merchant_id }}</p>
                    <p>Menu ID: {{ $order->menu_id }}</p>
                    <p>Quantity: {{ $order->quantity }}</p>
                    <p>Total Amount: {{ $order->total_amount }}</p>
                    <p>Delivery Date: {{ $order->delivery_date }}</p>
                    <p>Status: {{ $order->status }}</p>
                    <p>Invoice Date: {{ $order->invoice_date }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

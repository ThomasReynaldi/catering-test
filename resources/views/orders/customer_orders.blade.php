<!-- resources/views/orders/customer_orders.blade.php -->
@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Orders</div>

                <div class="card-body">
                    @if ($orders->isEmpty())
                        <p>No orders found.</p>
                    @else
                        <ul>
                            @foreach ($orders as $order)
                                <li>
                                    <a href="{{ route('orders.show', $order->id) }}">
                                        Invoice: {{ $order->invoice_number }} - Total: {{ $order->total_amount }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

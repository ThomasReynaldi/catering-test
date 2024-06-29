<!-- resources/views/catering/order_form.blade.php -->
@extends('layouts.app')

@section('title', 'Order Form')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order Menu: {{ $menu->name }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="menu">Menu: {{ $menu->name }}</label>
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="delivery_date">Delivery Date:</label>
                            <input type="date" name="delivery_date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

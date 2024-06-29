@extends('layouts.app')

@section('title', 'Edit Order')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Order</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('orders.update', $order->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="total_amount">Total Amount</label>
                            <input type="number" name="total_amount" value="{{ $order->total_amount }}" class="form-control" required>
                        </div>
                        <!-- Add other fields to edit as needed -->

                        <button type="submit" class="btn btn-primary">Update Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

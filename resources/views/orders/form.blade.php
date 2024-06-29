@extends('layouts.app')

@section('title', 'Pesan Menu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pesan Menu - {{ $menu->name }}</div>

                <div class="card-body">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <div class="form-group">
                            <label for="quantity">Jumlah Porsi</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="delivery_date">Tanggal Pengiriman</label>
                            <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

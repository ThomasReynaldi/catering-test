<!-- resources/views/catering/index.blade.php -->
@extends('layouts.app')

@section('title', 'Catering Menus')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Catering Menus</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Menu Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Merchant Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($menus as $menu)
                        <tr>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->description }}</td>
                            <td>{{ $menu->price }}</td>
                            <td>{{ $menu->merchant->address }}</td>
                            <td>
                                <a href="{{ route('orders.form', $menu) }}" class="btn btn-success">Pesan</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Menus')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Menus
                    <a href="{{ route('menus.create') }}" class="btn btn-success float-right">Add Menu</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Photo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->description }}</td>
                                    <td>{{ $menu->price }}</td>
                                    <td>
                                        @if ($menu->photo)
                                            <img src="{{ Storage::url($menu->photo) }}" alt="{{ $menu->name }}" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                        @else
                                            No photo available
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('menus.edit', $menu) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('menus.destroy', $menu) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this menu?')">Delete</button>
                                        </form>
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

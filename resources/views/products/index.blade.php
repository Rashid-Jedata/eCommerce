@extends('layouts.app')


@section('nav_section')
    <div class="jumbotron">
        <h1 class="display-4">My Products</h1>
        <p class="lead">My All Products In All The Various Categories</p>
        <hr class="my-4">
        <p>To Add New Products Click Below</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="{{ route('products.create') }}" role="button">Add</a>
        </p>
    </div>
@endsection


@section('content')
    <hr class="my-4">

    <div class="container">
        <div class="row">

            @foreach ($products as $product)
                <div class="col-sm-12 col-md-6 col-lg-4">

                    <div class="card">
                        <span
                            style="position: absolute;left: -1px;color: aliceblue;background: blueviolet;display: inline-block;padding: 0 14px;margin-top: 10px;">
                            {{ $product->price }}$
                        </span>
                        <img class="card-img-top" src="{{ URL::asset($product->mainImage) }}" style="height: 18rem;" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">
                            </p>
                            <a href="{{ route('products.show', $product->slug) }}" class="btn rounded btn-success">Show</a>
                            <a href="{{ route('products.edit', $product->slug) }}" class="btn rounded btn-info">Edit</a>
                            <a href="{{ route('products.softDelete', $product->id) }}"
                                class="btn rounded btn-danger">Delete</a>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
@endsection

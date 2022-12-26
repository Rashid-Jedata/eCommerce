@php
    $categories = App\Models\Category::all();
@endphp
@section('collapse', 'collapse')

@extends('layouts.app')



@section('content')
    <div class="container">



        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('products.update', ['id' => $product->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" value="{{ $product->name }}" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" value="{{ $product->price }}" name="price" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>

                <select name="category_id" class="custom-select">
                    @foreach ($categories as $category)
                        <option {{ $category->id === $product->category_id ? 'selected' : '' }} value="{{ $category->id }}">
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Details</label>
                <textarea name="details" name="details" class="form-control">{{ $product->name }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Images</label>
                <div class="custom-file">
                    <input type="file" multiple class="custom-file-input" name="images[]" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                    <small id="emailHelp" class="form-text text-muted">Leave It Empty If you don't Wanna Change It</small>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>


        <div class="mt-4 jumbotron jumbotron-fluid">
            <div class="container">
                <h6 class="text-center display-6">Previous Images</h6>



                {{-- ///////////////////////////////////////////////////////////// --}}

                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="{{ URL::asset($product->mainImage) }}" alt="Image">
                        </div>
                        @foreach ($product->images as $image)
                            <div class="carousel-item" style="height: 410px;">
                                <img class="img-fluid" src="{{ URL::asset($image->url) }}" alt="Image">
                            </div>
                        @endforeach

                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>



                {{-- ///////////////////////////////////////////////////////////// --}}
            </div>
        </div>
    </div>
@endsection

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

        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>

                <select name="category_id" class="custom-select">
                    <option selected>----SELECT----</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Details</label>
                <textarea name="details" name="details" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Images</label>
                <div class="custom-file">
                    <input type="file" multiple class="custom-file-input" name="images[]" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
@endsection

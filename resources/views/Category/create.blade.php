@extends('layouts.app')
@section('collapse', 'collapse')
@section('title','Create-Category-Amekran Shop')

@section('content')
    <div class="container">

        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('categories.store') }}"  enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <div class="custom-file">
                        <input type="file" multiple class="custom-file-input" name="category_mainImage" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <label for="category">Name :</label>
                <input type="text" name="name" class="form-control" id="category" placeholder="Enter Category Name">
                <small class="form-text text-muted">It will Be Shown To everyOne And They'll be able to class products Based
                    On It immediately</small>

            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>

    </div>
@endsection

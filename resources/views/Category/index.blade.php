@extends('layouts.app')
@section('collapse','collapse')
@section('title','Category-Amekran Shop')
@section('content')
    <div class="container">

        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Categories Settings</h1>
                <p class="lead">
                    <a class="btn btn-outline-info mt-3" href="{{ route('categories.create') }}">Add A Category</a>
                </p>
            </div>
        </div>


        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Last Updated At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $i = 0;
                @endphp

                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="row">
                                <div class="col col-lg-2"> <a class="btn btn-info rounded"
                                        href="{{ route('categories.edit', $category->id) }}">Edit</a></div>
                                <div class="col">
                                    <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger rounded">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection

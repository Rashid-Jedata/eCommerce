@extends('layouts.app')
@section('title','Home-Amekran Shop')
@section('collapse', 'collapse')
{{-- @section('nav_section')
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 410px;">
                <img class="img-fluid" src="img/carousel-1.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                        <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="height: 410px;">
                <img class="img-fluid" src="img/carousel-2.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                        <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                    </div>
                </div>
            </div>
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
@endsection --}}

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row">

            <!-- Shop Product Start -->
            <div>
                <div class="row pb-3">
                    <div class="col-10 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form method="GET" action="{{ route('shop.index') }}">
                                @csrf
                                <div style="margin-left: 60%;" class="input-group">
                                    <input name="search" type="text" class="form-control" placeholder="Search by name">
                                    <input type="submit" class="btn btn-outline-info" value='Search'>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Sort by
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="{{ route('shop.index') }}?sortBy=latest">Latest</a>
                                    <a class="dropdown-item"
                                        href="{{ route('shop.index') }}?sortBy=popularity">Popularity</a>
                                    <a class="dropdown-item" href="{{ route('shop.index') }}?sortBy=rating">Best Rating</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- -------------------Products Here------------------- --}}


                    <div class="container">
                        <div class="row">

                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                                    <div class="card product-item border-0 mb-4">
                                        <div
                                            class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                            <img class="img-fluid w-100" src="{{ URL::asset($product->mainImage) }}"
                                                alt="">
                                        </div>
                                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                            <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                                            <div class="d-flex justify-content-center">
                                                <h6>{{ $product->price }}$</h6>
                                                {{-- <h6 class="text-muted ml-2"><del>$123.00</del></h6> --}}
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between bg-light border">

                                            @if (isset($favourite))
                                                <form method="POST"
                                                    action="{{ route('favourite.destroy', $product->slug) }}">
                                                    @csrf
                                                    @method('POST')
                                                    <button class="btn btn-sm text-dark p-0">Unfavourite</button>
                                                </form>
                                            @else
                                                <form method="POST"
                                                    action="{{ route('favourite.store', $product->slug) }}">
                                                    @csrf
                                                    @method('POST')
                                                    <button class="btn btn-sm text-dark p-0"><i
                                                            class="fas fa-heart text-primary text-primary mr-1"></i></button>
                                                </form>
                                            @endif


                                            <a href="{{ route('products.show', ['slug' => $product->slug]) }}"
                                                class="btn btn-sm text-dark p-0"><i
                                                    class="fas fa-eye text-primary mr-1"></i>View
                                                Detail</a>
                                            <a href="{{ route('checkout.create', ['slug' => $product->slug]) }}"
                                                class="btn btn-sm text-dark p-0"><i
                                                    class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>



                    {{-- -------------------Products End------------------- --}}


                    {{-- <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div> --}}
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

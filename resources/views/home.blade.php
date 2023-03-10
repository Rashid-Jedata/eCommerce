@extends('layouts.app')

@section('nav_section')
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @for ($i = 0; $i < count($trandyProducts) && $i < 4; $i++)
                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}" style="height: 410px;">
                    <img class="img-fluid" src="{{ URL::asset($trandyProducts[$i]->mainImage) }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            {{-- <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4> --}}
                            <h3 class="display-4 text-white font-weight-semi-bold mb-4">{{ $trandyProducts[$i]->name }}</h3>
                            <a href="{{ route('products.show', $trandyProducts[$i]->slug) }}"
                                class="btn btn-light py-2 px-3">Shop Now</a>
                        </div>
                    </div>
                </div>
            @endfor
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
@endsection

@section('content')
    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            @foreach ($categories as $category)
                @php
                    if (count($category->products) == 0) {
                        continue;
                    }
                    
                    $categoryMainImage = $category->category_mainImage;
                @endphp
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        <p class="text-right">{{ count($category->products) }}</p>
                        <a href="{{ route('shop.index') }}?category={{ $category->name }}"
                            class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="{{ URL::asset($categoryMainImage) }}" alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0">{{ $category->name }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Categories End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($trandyProducts as $product)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{ URL::asset($product->mainImage) }}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>${{ $product->price }}</h6>

                                {{-- <h6 class="text-muted ml-2"><del>$123.00</del></h6> --}}
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <form method="POST" action="{{ route('favourite.store', $product->slug) }}">
                                @csrf
                                @method('POST')
                                <button class="btn btn-sm text-dark p-0"><i
                                        class="fas fa-heart text-primary text-primary mr-1"></i></button>
                            </form>
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="{{ route('checkout.create', $product->slug) }}" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>

                        </div>

                    </div>
                </div>
            @endforeach


        </div>
    </div>
    <!-- Products End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Just Arrived</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($justArrived as $product)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{ URL::asset($product->mainImage) }}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>${{ $product->price }}</h6>
                                {{-- <h6 class="text-muted ml-2"><del>$123.00</del></h6> --}}
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <form method="POST" action="{{ route('favourite.store', $product->slug) }}">
                                @csrf
                                @method('POST')
                                <button class="btn btn-sm text-dark p-0"><i
                                        class="fas fa-heart text-primary text-primary mr-1"></i></button>
                            </form>
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="{{ route('checkout.create', $product->slug) }}" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->
@endsection

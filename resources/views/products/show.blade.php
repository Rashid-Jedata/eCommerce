@extends('layouts.app')

@section('nav_section')
    <!-- Page Header Start -->
    <div class="mt-4 container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">{{ $product->name }}</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop Detail</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
@endsection

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">


            @isset($message)
                <div class="alert alert-danger">{{ $message }}</div>
            @endisset

            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif


        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ URL::asset($product->mainImage) }}" alt="Image">
                        </div>
                        @foreach ($product->images as $image)
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="{{ URL::asset($image->url) }}" alt="Image">
                            </div>
                        @endforeach


                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $product->name }}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">

                        @php
                            function createRating($fullStart, $halfStar = false)
                            {
                                for ($i = 0; $i < $fullStart; $i++) {
                                    echo '<small class="fas fa-star"></small>';
                                }
                                if ($halfStar) {
                                    echo '<small class="fas fa-star-half-alt"></small>';
                                }
                            }

                        @endphp


                        @switch($product->rating)
                            @case(1)
                                {{ createRating(3) }}
                            @break

                            @case(1.5)
                                {{ createRating(1, true) }}
                            @break

                            @case(2)
                                {{ createRating(2) }}
                            @break

                            @case(2.5)
                                {{ createRating(2, true) }}
                            @break

                            @case(3)
                                {{ createRating(3) }}
                            @break

                            @case(3.5)
                                {{ createRating(3, true) }}
                            @break

                            @case(4)
                                {{ createRating(4) }}
                            @break

                            @case(4.5)
                                {{ createRating(4, true) }}
                            @break

                            @case(5)
                                {{ createRating(5) }}
                            @break

                            @default
                                No Rating
                            @break
                        @endswitch

                    </div>
                    <small class="pt-1">({{ $reviewsCount }} Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">${{ $product->price }}</h3>
                <p class="mb-4">{{ $product->details }}</p>

                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button
                                onclick="
                           document.getElementById('formInputQuantity').value =
                           document.getElementById('quantity').value"
                                class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" id="quantity" class="form-control bg-secondary text-center" value="1">
                        <div class="input-group-btn">
                            <button
                                onclick="
                           document.getElementById('formInputQuantity').value =
                           document.getElementById('quantity').value"
                                class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    @if ($product->user_id != Auth::id())
                    <form method="GET" action="{{ route('checkout.create', ['slug' => $product->slug]) }}">
                        <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                        <input id="formInputQuantity" value="1" type="hidden" name="quantity">
                    </form>
                    @endif

                </div>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    {{-- <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a> --}}
                    {{-- <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a> --}}
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-3">Reviews
                        ({{ $reviewsCount }})</a>
                </div>
                <div class="tab-content">
                    {{-- <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt
                            duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur
                            invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet
                            rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam
                            consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam,
                            ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr
                            sanctus eirmod takimata dolor ea invidunt.</p>
                        <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor
                            consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita
                            diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed
                            et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
                    </div> --}}
                    {{-- <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Additional Information</h4>
                        <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt
                            duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur
                            invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet
                            rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam
                            consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam,
                            ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr
                            sanctus eirmod takimata dolor ea invidunt.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                    <div class="tab-pane fade show active" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">{{ $reviewsCount }} review for "{{ $product->name }}"</h4>


                                @foreach ($product->reviews as $review)
                                    <div class="media mb-4">
                                        <img src="https://i.pinimg.com/originals/6b/aa/98/6baa98cc1c3f4d76e989701746e322dd.png"
                                            alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>{{ $review->user->name }}<small> -
                                                    <i>{{ $review->created_at->diffForHumans() }}</i></small></h6>
                                            <div class="text-primary mb-2">
                                                @switch($review->personalRating)
                                                    @case(1)
                                                        {{ createRating(1) }}
                                                    @break

                                                    @case(1.5)
                                                        {{ createRating(1, true) }}
                                                    @break

                                                    @case(2)
                                                        {{ createRating(2) }}
                                                    @break

                                                    @case(2.5)
                                                        {{ createRating(2, true) }}
                                                    @break

                                                    @case(3)
                                                        {{ createRating(3) }}
                                                    @break

                                                    @case(3.5)
                                                        {{ createRating(3, true) }}
                                                    @break

                                                    @case(4)
                                                        {{ createRating(4) }}
                                                    @break

                                                    @case(4.5)
                                                        {{ createRating(4, true) }}
                                                    @break

                                                    @case(5)
                                                        {{ createRating(5) }}
                                                    @break
                                                @endswitch

                                            </div>
                                            <p>{{ $review->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <form method="POST" class="col-md-6"
                                action="{{ route('review.store', ['id' => $product->id]) }}">
                                @csrf
                                @method('POST')
                                <div>
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary">
                                            <input type="number" min="0" max="5" class="form-control"
                                                name="personalRating" id="name">
                                        </div>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea name="comment" id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
@endsection

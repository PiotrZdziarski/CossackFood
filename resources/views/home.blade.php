@extends('app')
@section('title') CossackFood @endsection
@section('content')
    <!-- CLAIM -->

    <claim></claim>

    <pizzas_menu api_link="@php echo getenv('APP_URL') @endphp"></pizzas_menu>

    <featured-dishes dishes_prop="{{$dishes}}" api_link="@php echo getenv('APP_URL') @endphp"></featured-dishes>

    <div class="container">
        <div class="featuredDishesTitle">
            <div class="featuredTitle">
                Gallery
            </div>
            <div class="borderDiv"></div>

        </div>

        <div class="galleryDishes">
            <div class="galleryDish" data-aos="fade-up" data-aos-delay="100"  data-aos-duration="600" data-aos-once="true"
                 style="background-image: url('/images/pizza.jpg')"></div>
            <div class="galleryDish">
                <div class="doubleDish" data-aos="fade-up" data-aos-delay="50"  data-aos-duration="600" data-aos-once="true"
                      style="background-image: url('/images/restaurant.jpg')"></div>
                <div class="doubleDish" data-aos="fade-up" data-aos-delay="150" data-aos-offset="-80"  data-aos-duration="600" data-aos-once="true"
                      style="background-image: url('/images/restaurant2.jpg')"></div>
            </div>
            <div class="galleryDish">
                <div class="doubleDish" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600" data-aos-once="true"
                      style="background-image: url('/images/restaurant3.jpg')"></div>
                <div class="doubleDish" data-aos="fade-up" data-aos-delay="200" data-aos-offset="-80"  data-aos-duration="600" data-aos-once="true"
                      style="background-image: url('/images/restaurant4.jpg')"></div>
            </div>
        </div>
    </div>



@endsection
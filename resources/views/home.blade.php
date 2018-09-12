@extends('app')
@section('title') CossackFood @endsection
@section('content')
    <!-- CLAIM -->
    <div class="claim">
        <div class="claimTitle">CossackFood</div>
        <div class="claimSubTitle">Fictional Restaurant Website</div>
    </div>

    <pizzas_menu api_link="@php echo getenv('APP_URL') @endphp"></pizzas_menu>

    <featured-dishes api_link="@php echo getenv('APP_URL') @endphp"></featured-dishes>

    <div class="container">
        <div class="featuredDishesTitle">
            <div class="featuredTitle">
                Gallery
            </div>
            <div class="borderDiv"></div>

        </div>

        <div class="galleryDishes">
            <div class="galleryDish" data-aos="fade-in" data-aos-duration="600" data-aos-once="true"
                 style="background-image: url('/images/pizza.jpg')"></div>
            <div class="galleryDish">
                <div class="doubleDish" data-aos="fade-in" data-aos-duration="600" data-aos-once="true"
                      style="background-image: url('/images/restaurant.jpg')"></div>
                <div class="doubleDish" data-aos="fade-in" data-aos-duration="600" data-aos-once="true"
                      style="background-image: url('/images/restaurant2.jpg')"></div>
            </div>
            <div class="galleryDish">
                <div class="doubleDish" data-aos="fade-in" data-aos-duration="600" data-aos-once="true"
                      style="background-image: url('/images/restaurant3.jpg')"></div>
                <div class="doubleDish" data-aos="fade-in" data-aos-duration="600" data-aos-once="true"
                      style="background-image: url('/images/restaurant4.jpg')"></div>
            </div>
        </div>
    </div>
@endsection
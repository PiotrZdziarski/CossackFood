@extends('app')
@section('content')
    <!-- CLAIM -->
    <div class="claim">
        <div class="claimTitle">CossackFood</div>
        <div class="claimSubTitle">Fictional Restaurant Website</div>
    </div>
    <div style="width: 100%; border-top: 5px solid #f34949">
        <div class="container">
            <div class="menuTag">
                Pizza
            </div>

            <div class="menuList">
                <div class="menuItem">
                    <div class="menuFood">
                        Completto Feliciana
                        <div class="subText">Cheese, Tomato, Myshrooms, Beef</div>
                    </div>
                    <div class="menuBorder"></div>
                    <div class="menuPrice">27$</div>
                </div>

                <div class="menuItem">
                    <div class="menuFood">
                        Completto Feliciana
                        <div class="subText">Cheese, Tomato, Myshrooms, Beef</div>
                    </div>
                    <div class="menuBorder"></div>
                    <div class="menuPrice">27$</div>
                </div>

                <div class="menuItem">
                    <div class="menuFood">
                        Completto Feliciana
                        <div class="subText">Cheese, Tomato, Myshrooms, Beef</div>
                    </div>
                    <div class="menuBorder"></div>
                    <div class="menuPrice">27$</div>
                </div>

                <div class="menuItem">
                    <div class="menuFood">
                        Completto Feliciana
                        <div class="subText">Cheese, Tomato, Myshrooms, Beef</div>
                    </div>
                    <div class="menuBorder"></div>
                    <div class="menuPrice">27$</div>
                </div>

                <div class="menuItem">
                    <div class="menuFood">
                        Completto Feliciana
                        <div class="subText">Cheese, Tomato, Myshrooms, Beef</div>
                    </div>
                    <div class="menuBorder"></div>
                    <div class="menuPrice">27$</div>
                </div>

                <div class="menuItem">
                    <div class="menuFood">
                        Completto Feliciana
                        <div class="subText">Cheese, Tomato, Myshrooms, Beef</div>
                    </div>
                    <div class="menuBorder"></div>
                    <div class="menuPrice">27$</div>
                </div>

                <div class="menuItem">
                    <div class="menuFood">
                        Completto Feliciana
                        <div class="subText">Cheese, Tomato, Myshrooms, Beef</div>
                    </div>
                    <div class="menuBorder"></div>
                    <div class="menuPrice">27$</div>
                </div>

                <div class="menuItem">
                    <div class="menuFood">
                        Completto Feliciana
                        <div class="subText">Cheese, Tomato, Myshrooms, Beef</div>
                    </div>
                    <div class="menuBorder"></div>
                    <div class="menuPrice">27$</div>
                </div>
            </div>

            <button class="showMore">
                Show More
            </button>
        </div>
    </div>

    <featured-dishes></featured-dishes>


    <div class="container">
        <div class="featuredDishesTitle">
            <div class="featuredTitle">
                Gallery
            </div>
            <div class="borderDiv"></div>

        </div>

        <div class="galleryDishes">
            <div class="galleryDish" style="background-image: url('/images/pizza.jpg')"></div>
            <div class="galleryDish">
                <div class="doubleDish" style="background-image: url('/images/restaurant.jpg')"></div>
                <div class="doubleDish" style="background-image: url('/images/restaurant2.jpg')"></div>
            </div>
            <div class="galleryDish">
                <div class="doubleDish" style="background-image: url('/images/restaurant3.jpg')"></div>
                <div class="doubleDish" style="background-image: url('/images/restaurant4.jpg')"></div>
            </div>
        </div>
    </div>
@endsection
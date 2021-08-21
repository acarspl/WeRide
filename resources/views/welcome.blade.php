@extends('layouts.app')

<!-- Styles -->
<link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">
@section('content')
    {{--BANNER--}}
    <div  style="position:relative" class="text-center">
        <img class="my-0" id="titleImage" src="{{asset('images/bikers/biker_talking_desert.jpg')}}" alt="Bikers riding with each other">
        <div id="overlayText" class=" bg-green text-white px-5 py-5 rounded-corners rhombus-left">
            <h1 class="rhombus-left-content">{{__('Enjoy your rides with others!')}}<br>{{__('Join a group ride in your area')}}</h1>
            <a href="{{route('register')}}" class="rhombus-left-content btn  btn-lg mt-3 btn-green-light" style="font-size: 30px; font-family: 'Bebas Neue', cursive;">Sign up for free</a>
        </div>
    </div>
    <h1 class="text-green text-center mt-4" style="font-size: 80px; font-family: 'Bebas Neue', cursive;">One place - multiple sports</h1>
    {{--TYPES OF CYCLING--}}
    <div class="row justify-content-center mt-2">
        <div class="col-12 col-md-10 col-lg-8">
            <div id="typesOfBikesCarousel" class="carousel slide" data-ride="carousel" >
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{asset('images/types_of_bikes/road_cycling.jpg')}}" alt="Road Cycling">
                        <div class="carousel-caption">
                            <h1 class="font-weight-bold">Road Cycling</h1>
                            <h3>Experience less air resistance in a group</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('images/types_of_bikes/gravel_ride.jpg')}}" alt="Gravel Riding">
                        <div class="carousel-caption">
                            <h1 class="font-weight-bold">Gravel Riding</h1>
                            <h3>Explore unpaved roads and trails with friends</h3>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <img class="d-block w-100" src="{{asset('images/types_of_bikes/casual_ride_in_park.jpg')}}" alt="Bike Touring">
                        <div class="carousel-caption">
                            <h1 class="font-weight-bold">Bike Touring</h1>
                            <h3>Explore cities and nature with others</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('images/types_of_bikes/mtb.jpg')}}" alt="Mountain Biking">
                        <div class="carousel-caption">
                            <h1 class="font-weight-bold">Mountain Biking (MTB)</h1>
                            <h3>Discover amazing places you never knew existed</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('images/types_of_bikes/enduro.jpg')}}" alt="Enduro Biking">
                        <div class="carousel-caption">
                            <h1 class="font-weight-bold">Enduro Biking</h1>
                            <h3>Be faster, improve your technique</h3>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#typesOfBikesCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#typesOfBikesCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    {{--LOCAL RACES / GROUP RIDES--}}
    <div class="row justify-content-center text-center mx-0 mt-5">
        <h2 class="py-3 col-6 col-lg-5 col-xl-4 m-0 bg-green text-white" style="border-top-left-radius:15px">Local Races</h2>
        <h2 class="py-3 col-6 col-lg-5 col-xl-4 m-0 bg-green text-white" style="border-top-right-radius:15px">Group Rides</h2>
    </div>
    <div class="row justify-content-center mx-0">
        <div class="col-6 col-lg-5 col-xl-4 p-0 imageMoreInfoOnHover" style="position:relative; border-bottom-left-radius:15px;">
            <img src="{{asset('images/bikers/road_race.jpg')}}"  style="width: 100%;border-bottom-left-radius:15px;" alt="Road race">
            <a class="btn btn-outline-light btn-lg overlayTextCenterFaded" href="#" >Find out more</a>
        </div>
        <div class="col-6 col-lg-5 col-xl-4 p-0 imageMoreInfoOnHover" style="position:relative; border-bottom-right-radius:15px">
            <img src="{{asset('images/bikers/city_bikers.jpg')}}" style=" width: 100%; border-bottom-right-radius:15px" alt="Group Ride">
            <a class="btn btn-outline-light btn-lg overlayTextCenterFaded" href="#" >Find out more</a>
        </div>
    </div>
    <h1 class="text-green text-center mt-5" style="font-size: 60px; font-family: 'Bebas Neue', cursive;">Reviews</h1>
    {{--OPINIONS--}}
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-11 col-lg-10 col-xl-8">
            <div id="opinionsCarousel" class="carousel slide" data-ride="carousel" >
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-4 card px-0 ">
                                <img class="card-img-top rounded-circle mx-auto mt-2" style="width: 22%" src="{{asset('images/people/p1.jpg')}}" alt="Photo">
                                <div class="card-body bg-green-light mt-2 text-white">
                                    <p class="text-left mx-3 mb-0" style="font-size: 130%;font-family: 'Kalam', cursive;">It is cool to meet new people who love cycling.</p>
                                    <div class="text-right"><small>Jenny, USA</small></div>
                                </div>
                            </div>
                            <div class="col-4 card px-0 ">
                                <img class="card-img-top rounded-circle mx-auto mt-2" style="width: 22%" src="{{asset('images/people/p2.jpg')}}" alt="Photo">
                                <div class="card-body bg-green-light mt-2 text-white">
                                    <p class="text-left mx-3 mb-0" style="font-size: 130%;font-family: 'Kalam', cursive;">The best list of MTB marathons on the Internet.</p>
                                    <div class="text-right"><small>Anton, Slovenia</small></div>
                                </div>
                            </div>
                            <div class="col-4 card px-0 ">
                                <img class="card-img-top rounded-circle mx-auto mt-2" style="width: 22%" src="{{asset('images/people/p3.jpg')}}" alt="Photo">
                                <div class="card-body bg-green-light mt-2 text-white">
                                    <p class="text-left mx-3 mb-0" style="font-size: 130%;font-family: 'Kalam', cursive;">The people I met showed me lots of new roads in the neighbourhood</p>
                                    <div class="text-right"><small>Anders, Norway</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-4 card px-0 ">
                                <img class="card-img-top rounded-circle mx-auto mt-2" style="width: 22%" src="{{asset('images/people/p4.jpg')}}" alt="Photo">
                                <div class="card-body bg-green-light mt-2 text-white">
                                    <p class="text-left mx-3 mb-0" style="font-size: 130%;font-family: 'Kalam', cursive; ">I'd be lost without {{ config('app.name', 'Laravel') }} It's the perfect place to meet cyclists!</p>
                                    <div class="text-right"><small>Markus, Germany</small></div>
                                </div>
                            </div>
                            <div class="col-4 card px-0 ">
                                <img class="card-img-top rounded-circle mx-auto mt-2" style="width: 22%" src="{{asset('images/people/p5.jpg')}}" alt="Photo">
                                <div class="card-body bg-green-light mt-2 text-white">
                                    <p class="text-left mx-3 mb-0" style="font-size: 130%;font-family: 'Kalam', cursive; ">Thanks to my new cycling buddies I can save a lot of energy! </p>
                                    <div class="text-right"><small>Dae-Hyun, South Korea</small></div>
                                </div>
                            </div>
                            <div class="col-4 card px-0 ">
                                <img class="card-img-top rounded-circle mx-auto mt-2" style="width: 22%" src="{{asset('images/people/p6.jpg')}}" alt="Photo">
                                <div class="card-body bg-green-light mt-2 text-white">
                                    <p class="text-left mx-3 mb-0" style="font-size: 130%;font-family: 'Kalam', cursive; ">I like it more and more each day. It makes my life a lot easier.</p>
                                    <div class="text-right"><small>Yagil, Israel</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="row">
                            <div class="col-4 card px-0 ">
                                <img class="card-img-top rounded-circle mx-auto mt-2" style="width: 22%" src="{{asset('images/people/p7.jpg')}}" alt="Photo">
                                <div class="card-body bg-green-light mt-2 text-white">
                                    <p class="text-left mx-3 mb-0" style="font-size: 130%;font-family: 'Kalam', cursive; ">It really saves me time and effort to schedule group rides</p>
                                    <div class="text-right"><small>Mila, Netherlands</small></div>
                                </div>
                            </div>
                            <div class="col-4 card px-0 ">
                                <img class="card-img-top rounded-circle mx-auto mt-2" style="width: 22%" src="{{asset('images/people/p8.jpg')}}" alt="Photo">
                                <div class="card-body bg-green-light mt-2 text-white">
                                    <p class="text-left mx-3 mb-0" style="font-size: 130%;font-family: 'Kalam', cursive; ">The website has completely surpassed my expectations. </p>
                                    <div class="text-right"><small>Mary, USA</small></div>
                                </div>
                            </div>
                            <div class="col-4 card px-0 ">
                                <img class="card-img-top rounded-circle mx-auto mt-2" style="width: 22%" src="{{asset('images/people/p9.jpg')}}" alt="Photo">
                                <div class="card-body bg-green-light mt-2 text-white">
                                    <p class="text-left mx-3 mb-0" style="font-size: 130%;font-family: 'Kalam', cursive; ">{{ config('app.name', 'Laravel') }} is great.</p>
                                    <div class="text-right"><small>David, South Africa</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- FOOTER --}}
    <footer class="page-footer font-small bg-green mt-5 p-3">
        <div class="col-lg-8 mx-auto pt-1">
            <div class="row justify-content-between pt-2">
                <div class="col-6  col-md-5 col-lg-4 text-center my-auto">
                    <ul style="list-style-type: none" class="my-auto text-white font-weight-bold">
                        <li>Contact: <a class="link-as-text mx-2" href = "#">mail@mail</a></li>
                        <li>Facebook:  <a class="link-as-text mx-2" href = "#" target="_blank"><img src="{{asset('images/icons/social_media/facebook.png')}} " style="height:25px" alt="Facebook"></a></li>
                    </ul>
                </div>
                <div class="col-6  col-md-5 col-lg-4 text-center my-auto">
                    <ul class="my-auto font-weight-bold" style="list-style-type: none">
                        <li><a href="#" class="link-as-text">Privacy Policy</a></li>
                        <li><a href="#" class="link-as-text">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/carouselController.js') }}" ></script>
@endsection

@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            <li data-target="#carousel-example-generic" data-slide-to="4"></li>
        </ol>

        <div class="container">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="pictures/view/view6.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item">
                    <img src="pictures/view/view7.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item">
                    <img src="pictures/view/view8.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item">
                    <img src="pictures/view/view9.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item">
                    <img src="pictures/view/view10.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                ...
            </div>
        </div>
@endsection
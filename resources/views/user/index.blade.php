@extends('layouts.user')

@section('head')
<meta name="keywords" content="kato cranes, kato truck cranes, kato rough terrain cranes, kato mobile cranes, kato-hicom, ihi crawler cranes, sumitomo asphalt paver, liebherr earthmoving, truck mounted pm cranes, boom lift and scissor lift skyjack, tower cranes potain" />

<meta name="og:title" content="Home - Multicrane Perkasa" />
<meta name="og:description" content="Multicrane Perkasa provides after sales service in the field of construction equipment, lifting equipment, working area platform and heavy equipment" />
<meta name="og:image" content="{{ url('images/user/icons/fav.png') }}" />

<meta name="twitter:title" content="Home - Multicrane Perkasa" />
<meta name="twitter:description" content="Multicrane Perkasa provides after sales service in the field of construction equipment, lifting equipment, working area platform and heavy equipment" />
<meta name="twitter:image" content="{{ url('images/user/icons/fav.png') }}" />

<title>Home - Multicrane Perkasa</title>
<meta name="description" content="Multicrane Perkasa provides after sales service in the field of construction equipment, lifting equipment, working area platform and heavy equipment" />
@endsection

@section('content')
<div id="home-slider" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    @foreach ($sliders as $slider)
    <li data-target="#home-slider" data-slide-to="{{ $loop->iteration-1 }}" @if ($loop->first) class="active" @endif></li>
    @endforeach
  </ol>
  <div class="carousel-inner">
    @foreach ($sliders as $slider)
    <div class="carousel-item @if ($loop->first) active @endif">
      <img class="d-block img-fluid" src="{{ $slider->image_url }}" alt="{{ $slider->title }}">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="title text-uppercase">
        {{ $slider->title }}
        </h2>
        <a href="{{ $slider->button_url }}" class="btn btn-warning text-uppercase">
        {{ $slider->button_label }}
        </a>
      </div>
    </div>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#home-slider" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#home-slider" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div id="home-about" class="row align-items-center m-3">
  <div class="col-sm-12 col-md-6">
    <img class="img-fluid" src="{{ $home->image_url ?? '' }}" alt="Product Image Sample">
  </div>
  <div class="col-sm-12 col-md-6">
    <div class="content">
      <div>
        <h1 class="text-uppercase">Multicrane Perkasa</h1>
        <h2>{{ $home->title ?? '' }}</h2>
      </div>
      <p>{!! $home->description ?? '' !!}</p>
      <a class="text-uppercase" href="{{ $home->url ?? '' }}">Learn More</a>
    </div>
  </div>
</div>

<div id="home-brand" class="row text-center m-3 bg-warning">
    @foreach ($productsNav as $brand)
    <div class="col-6 col-lg-2">
      <a href="" class="d-block">
        <img class="img-fluid" src="{{ $brand->image_url }}" alt="{{ $brand->name }} Logo">
      </a>
    </div>
    @endforeach
</div>

<div id="equipment-slider" class="carousel m-3 p-3 slide bg-info" data-ride="carousel">
  <ol class="carousel-indicators">
    @foreach ($equipments as $brand => $models) 
    <li data-target="#equipment-slider" data-slide-to="{{ $loop->iteration-1 }}" @if ($loop->first) class="active" @endif></li>
    @endforeach
  </ol>
  <div class="carousel-inner">
    @foreach ($equipments as $brand => $models)
    <div class="carousel-item @if ($loop->first) active @endif">
      <div class="card-group text-center">  
        <div class="container">
          <div class="row">
        @foreach ($models as $equipment)
        @php
          $model = $equipment->model;
        @endphp
        <div class="col-4">
          <div class="card">
            <a class="align-self-center" href="">
            <img class="card-img-top" width="208px" height="208px" src="{{ $model->display_image_url }}" alt="{{ $model->name . ' ' . $model->category_name }}">
            </a>
            <div class="card-body text-center">
                <a class="text-default" href="">
                <p class="card-title">
                    {{ $model->name }}
                </p>
                <p class="card-text">
                    {{ $model->category_name }}
                </p>
                <p class="card-text">
                    {{ $brand }}
                </p>
                </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="mt-5">
  <a class="carousel-control-prev" href="#equipment-slider" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#equipment-slider" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>
</div>

<footer class="pb-30">
  <hr>
  <div class="container">  
    <p class="copyright">
      © 2020 Multicrane Perkasa. All rights reserved.
    </p>
  </div>
</footer>
@endsection
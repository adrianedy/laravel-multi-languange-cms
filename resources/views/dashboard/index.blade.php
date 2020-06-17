@extends('layouts.dashboard')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
  </ol>
</nav>

<div class="card m-3">
  <div class="card-header">
    <div class="row">
      <div class="col-sm-6">
        <h4>Home Slider</h4>
      </div>
      <div class="col-sm-6 text-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-home-slider"
        data-backdrop="static"><i class="fa fa-plus" aria-hidden="true"></i> Add Home Slider</button>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="box-body">
      @if (session('home-slider'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="icon fa fa-check"></i> {{ session('home-slider') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width: 150px;">Image</th>
              <th style="width: 550px;">Title</th>
              <th>Button</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sliders as $slider)
            <tr>
              <td>
                <span class="display-xs-block"><img class="img-fluid" 
                  src="{{ $slider->image_url ?? 
                    'http://via.placeholder.com/' . implode('x', config('multicraneperkasa.img-size.banner')) }}" 
                  alt="{{$slider->image}}">
                </span>
              </td>
              <td>
                <span class="display-xs-block"><strong>{{ $slider->title }}</strong></span>
              </td>
              <td>
                <a href="{{ $slider->button_url }}" target="_blank"><button class="btn btn-info">{{ $slider->button_label }}</button></a>
              </td>
              <td>
                <span class="display-xs-inline-block" data-toggle="tooltip" title="Edit">
                  <button type="button" class="btn btn-primary edit-btn" data-get="{{ route('dashboard.home-slider.edit', $slider->id) }}" 
                  data-patch="{{ route('dashboard.home-slider.update', $slider->id) }}" data-target="#modal-edit-home-slider">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </button>
                </span>
                <span class="display-xs-inline-block" data-toggle="tooltip" title="Delete">
                  <button type="button" class="btn btn-danger delete-confirm-btn" data-action="{{ route('dashboard.home-slider.destroy', $slider->id) }}" data-toggle="modal">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </button>
                </span>
                <form method="POST" style="display:inline">
                  @csrf
                  <span class="display-xs-inline-block" data-toggle="tooltip" title="Up">
                    <button type="submit" class="btn btn-direction"
                    formaction="{{ route('dashboard.home-slider.sort', [$slider->id, 'up']) }}"
                    @if ($loop->first) disabled @endif>
                      <i class="fa fa-arrow-up" aria-hidden="true"></i>
                    </button>
                  </span>
                  <span class="display-xs-inline-block" data-toggle="tooltip" title="Down">
                    <button type="submit" class="btn btn-direction"
                    formaction="{{ route('dashboard.home-slider.sort', [$slider->id, 'down']) }}"
                    @if ($loop->last) disabled @endif>
                      <i class="fa fa-arrow-down" aria-hidden="true"></i>
                    </button>
                  </span>
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="card m-3" id="first-section">
  <div class="card-header">
    <div class="row">
      <div class="col-sm-6">
        <h4>First Section</h4>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="box-body">
      @if (session('first-section'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="icon fa fa-check"></i> {{ session('first-section') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @if ($errors->first_section->any())
        @foreach ($errors->first_section->all() as $error)
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="icon fa fa-check"></i> {{ session('first-section') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endforeach
      @endif
      <form method="post" enctype="multipart/form-data" action="{{ route('dashboard.home.update') }}">
      @csrf
        <div class="row">
          <div class="col-sm-6">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-slider-en-tab" data-toggle="tab" href="#first-sectionr-en" role="tab" aria-controls="home-slider-en" aria-selected="true"><img src="{{ asset('images/flag_gb.png') }}"> English</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="home-slider-id-tab" data-toggle="tab" href="#first-section-id" role="tab" aria-controls="home-slider-id" aria-selected="true"><img src="{{ asset('images/flag_id.jpg') }}"> Indonesia</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="first-section-en" role="tabpanel" aria-labelledby="first-section-en-tab">
                <div class="p-2">
                  <div class="form-group">
                    <label class="required">Title</label>
                    <input type="text" name="en[title]" value="{{ $errors->first_section->any() ? old('en.title') : $home->{'title:en'} ?? '' }}" class="form-control" autofocus required>
                  </div>
                  <div class="form-group">
                    <label class="required">Description</label>
                    <textarea id="first-section-description-en" class="ck-editor" name="en[description]" rows="100">{!! $errors->first_section->any() ? old('en.description') : $home->{'description:en'} ?? '' !!}</textarea>
                  </div>
                  <div class="form-group">
                    <label class="required">Learn More URL</label>
                    <input type="text" name="en[url]" value="{{ $errors->first_section->any() ? old('en.url') : $home->{'url:en'} ?? '' }}" class="form-control" autofocus required>
                  </div>
                </div>  
              </div>
              <div class="tab-pane fade" id="first-section-id" role="tabpanel" aria-labelledby="first-section-id-tab">
                <div class="p-2">
                  <div class="form-group">
                    <label class="required">Title</label>
                    <input type="text" class="form-control" name="id[title]" 
                      value="{{ $errors->first_section->any() ? old('id.title') : $home->{'title:id'} ?? '' }}" autofocus required>
                  </div>
                  <div class="form-group">
                    <label class="required">Content</label>
                    <textarea id="first-section-description-id" class="ck-editor" name="id[description]" rows="5">{!! $errors->first_section->any() ? old('id.description') : $home->{'description:id'} ?? '' !!}</textarea>
                  </div>
                  <div class="form-group">
                    <label class="required">Learn More URL</label>
                    <input type="text" name="id[url]" value="{{ $errors->first_section->any() ? old('id.url') : $home->{'url:id'} ?? '' }}" class="form-control" autofocus required>
                  </div>
                </div> 
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group img-upload-row">
              <label class="required">Image</label>
                <img class="img-fluid margin-bot-10 img-cropper" 
                  src="{{ file_exists($home ? $home->getImagePath() : null) ? $home->image_url : 
                  'http://via.placeholder.com/' . implode('x', config('multicraneperkasa.img-size.home-section')) }}" alt="">
                <span class="input-group-btn">
                  <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input img-upload-crop" style="cursor: pointer" 
                    id="first-section-image" aria-describedby="first-section-image" data-image-size="[{{ implode(',', config('multicraneperkasa.img-size.home-section')) }}]">
                    <label class="custom-file-label" for="first-section-image">Choose file</label>
                  </div>
                </span>
                <input type="hidden" class="coordinate-x" name="image_crop[x]"/>
                <input type="hidden" class="coordinate-y" name="image_crop[y]"/>
                <input type="hidden" class="img-width" name="image_crop[width]"/>
                <input type="hidden" class="img-height" name="image_crop[height]"/>
              </div>
            </div> 
          </div>
          
          <div class="text-right">
            <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes</button>
          </div>
        </div>   
      </form>
    </div>
  </div>
</div>

<div class="card m-3" id="equipment-section">
  <div class="card-header">
    <div class="row">
      <div class="col-sm-6">
        <h4>Equipment Section</h4>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="box-body">
      @if (session('equipment-section'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="icon fa fa-check"></i> {{ session('equipment-section') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @if ($errors->equipment_section->any())
        @foreach ($errors->equipment_section->all() as $error)
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="icon fa fa-check"></i> {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endforeach
      @endif
      <form method="post" action="{{ route('dashboard.equipment.store') }}">
        @csrf
        <div class="form-group">
          <label>Select Brand</label>
          <select id="brand-selector" name="brand" class="form-control searchable custom-select">
            <option disabled selected value>Select Brand</option>
            @foreach ($products as $brand)
            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Select Model</label>
          <select id="model-selector" name="model" class="form-control searchable custom-select">
            <option disabled selected value>Select Model</option>
            @foreach ($products as $brand)
              @foreach ($brand->models as $model)
              <option class="model-option {{ str_replace(' ', '-', $brand->name) . '-option' }} hide" value="{{ $model->id }}">{{ $model->name }}</option>
              @endforeach
            @endforeach
          </select>
        </div>
        <div class="text-right mb-3">
          <button class="btn btn-primary" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Add Model</button>
        </div>
      </form>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width: 150px;">Image</th>
              <th>Brand</th>
              <th style="width: 700px;">Model</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($equipments as $brand => $models)
              @foreach ($models as $equipment)
              @php
                $model = $equipment->model;
              @endphp
              <tr>
                <td>
                  <span class="display-xs-block"><img class="img-fluid" src="{{ $model->display_image_url ?? 'http://via.placeholder.com/' . implode('x', config('multicraneperkasa.img-size.model-display')) }}" alt=""></span>
                </td>
                <td>
                  <span class="display-xs-block"><strong>{{ $brand }}</strong></span>
                </td>
                <td>
                  <span class="display-xs-block"><strong>{{ $model->name }}</strong></span>
                </td>
                <td>
                  <span class="display-xs-inline-block" data-toggle="tooltip" title="Delete">
                    <button type="button" class="btn btn-danger delete-confirm-btn" data-action="{{ route('dashboard.equipment.destroy', $equipment->id) }}" data-toggle="modal">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                  </span>
                  <form method="POST" style="display:inline">
                    @csrf
                    <span class="display-xs-inline-block" data-toggle="tooltip" title="Up">
                      <button type="submit" class="btn btn-direction"
                      formaction="{{ route('dashboard.equipment.sort', [$brand, $equipment->id, 'up']) }}"
                      @if ($loop->first) disabled @endif>
                        <i class="fa fa-arrow-up" aria-hidden="true"></i>
                      </button>
                    </span>
                    <span class="display-xs-inline-block" data-toggle="tooltip" title="Down">
                      <button type="submit" class="btn btn-direction"
                      formaction="{{ route('dashboard.equipment.sort', [$brand, $equipment->id, 'down']) }}"
                      @if ($loop->last) disabled @endif>
                        <i class="fa fa-arrow-down" aria-hidden="true"></i>
                      </button>
                    </span>
                  </form>
                </td>
              </tr>
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@include('dashboard.modals.add-home-slider')
@include('dashboard.modals.edit-home-slider')
@include('dashboard.modals.delete')
@endsection

@section('script')
<script src="{{ asset('js/ck-editor-script.js') }}"></script>
<script src="{{ asset('js/modal-script.js') }}"></script>
<script src="{{ asset('js/cropping-script.js') }}"></script>
<script>
$(document).ready(function () {
  $.fn.select2.defaults.set("theme", "bootstrap");
  $('.searchable').each(function() {
    $(this).select2({
      width: null,
      templateResult: resultState,
      containerCssClass: ':all:'
    })
  })

  function resultState(data, container){
    if(data.element) {
        $(container).addClass($(data.element).attr("class"));
    }
    
    return data.text
  }

  $('#brand-selector').change(function(){
    $('.model-option').addClass('d-none');
    $(`.${$(this).val().replace(' ', '-')}-option`).removeClass('d-none');
    $('#model-selector').select2('destroy');
    $('#model-selector').select2({
      width: null,
      templateResult: resultState,
      containerCssClass: ':all:'
    });
  })
});
</script>
@endsection
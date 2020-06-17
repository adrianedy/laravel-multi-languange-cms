<div class="modal fade" id="modal-add-home-slider" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Image Slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="ajax-form" enctype="multipart/form-data" method="post" action="{{ route('dashboard.home-slider.store') }}">
        <div class="modal-body">
          @csrf
          <div class="error-block list-group"></div>
          <div class="form-group">
            <label class="required">Image</label>
            <div class="img-upload-row">
              <div>
                <img class="img-fluid img-cropper margin-bot-10" src="http://via.placeholder.com/{{ implode('x', config('multicraneperkasa.img-size.banner')) }}">
              </div>
              <div>
                <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input img-upload-crop" style="cursor: pointer" 
                      id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" data-image-size="[{{ implode(',', config('multicraneperkasa.img-size.banner')) }}]">
                      <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
                <input type="hidden" class="coordinate-x" name="image_crop[x]"/>
                <input type="hidden" class="coordinate-y" name="image_crop[y]"/>
                <input type="hidden" class="img-width" name="image_crop[width]"/>
                <input type="hidden" class="img-height" name="image_crop[height]"/>
              </div>
            </div>
          </div>
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-slider-en-tab" data-toggle="tab" href="#add-home-slider-en" role="tab" aria-controls="home-slider-en" aria-selected="true"><img src="{{ asset('images/flag_gb.png') }}"> English</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="home-slider-id-tab" data-toggle="tab" href="#add-home-slider-id" role="tab" aria-controls="home-slider-id" aria-selected="true"><img src="{{ asset('images/flag_id.jpg') }}"> Indonesia</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="add-home-slider-en" role="tabpanel" aria-labelledby="add-home-slider-en-tab">
              <div class="p-2">
                <div class="form-group">
                  <label class="required">Title</label>
                  <input type="text" name="en[title]" class="form-control" autofocus required>
                </div>
                <div class="form-group">
                  <label class="required">Button Label</label>
                  <input type="text" name="en[button_label]" class="form-control" autofocus required>
                </div>
                <div class="form-group">
                  <label class="required">Button Url</label>
                  <input type="text" name="en[button_url]" class="form-control" autofocus required>
                </div>
              </div>  
            </div>
            <div class="tab-pane fade" id="add-home-slider-id" role="tabpanel" aria-labelledby="add-home-slider-id-tab">
              <div class="p-2">
                <div class="form-group">
                  <label class="required">Title</label>
                  <input type="text" name="id[title]" class="form-control" autofocus required>
                </div>
                <div class="form-group">
                  <label class="required">Button Label</label>
                  <input type="text" name="id[button_label]" class="form-control" autofocus required>
                </div>
                <div class="form-group">
                  <label class="required">Button Url</label>
                  <input type="text" name="id[button_url]" class="form-control" autofocus required>
                </div>
              </div> 
            </div>
          </div>
          <hr>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success btn-save"><span class="label-save"><i class="fa fa-save"></i> Save</span><div class="loader d-none"></div></button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
$('.img-upload-crop').on('change', function(){
    if (this.files && this.files[0]) {
        let reader  = new FileReader()
        let cropper = $(this).parents('.img-upload-row').find('.img-cropper')
        cropper.cropper('destroy')

        if ($(this).data('image-size')) {
            let width  = $(this).data('image-size')[0]
            let height = $(this).data('image-size')[1]
    
            reader.onload = function (e) {
               var image = cropper.attr('src', e.target.result)
               setCropper(image, width, height)
            }
        } else {
            reader.onload = function (e) {
                cropper.attr('src', e.target.result)
            }
        }

        reader.readAsDataURL(this.files[0])
    }
})

function setCropper (cropper, width, height) {
    cropper.cropper({
        viewMode: 0,
        guides: false,
        center: false,
        aspectRatio: width/height,
        crop: function(event) {
          cropper.parents('.img-upload-row').find('.coordinate-x').val(event.detail.x);
          cropper.parents('.img-upload-row').find('.coordinate-y').val(event.detail.y);
          cropper.parents('.img-upload-row').find('.img-width').val(event.detail.width);
          cropper.parents('.img-upload-row').find('.img-height').val(event.detail.height);
        }
    });
}
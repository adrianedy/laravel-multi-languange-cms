$('.ajax-form').submit(function (e) {
  e.preventDefault()
  var form = $(this)

  $.ajax({
    dataType: "json",
    url: form.attr('action'),
    method: form.attr('method'),
    data: new FormData(this),
    headers: {
      'Accept': 'application/json',
    },
    beforeSend: function() {
      form.find('.btn-save').prop('disabled', true)
    },
    complete: function(data) {
      form.find('.btn-save').prop('disabled', false)
    },
    contentType: false,
    cache: false,
    processData: false,
    success: function(result){
      Swal.fire(
        'Success!',
        result.data.message,
        'success'
      )
    },
    error: function(err){
      console.log(err);
      let msg = "<ul>"
      $.each(err.responseJSON.errors, function (i, error) {
        msg + "<li>" + error[0] + "<li/>"
      });
      msg + "</ul>"

      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong!',
        footer: msg
      })
    }
  })
})
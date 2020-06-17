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
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function() {
      form.find('.btn-save').prop('disabled', true)
      form.find('.label-save').hide()
      form.find('.loader').removeClass('d-none')
    },
    complete: function(data) {
      form.find('.btn-save').prop('disabled', false)
      form.find('.label-save').show()
      form.find('.loader').addClass('d-none')
    },
    success: function(result){
      alert(result.data.message)
      if (result.data.location) window.location.hash = result.data.location
      location.reload(true)
    },
    error: function(err){
      console.log(err)
      if (err.status == 422) {
        let el = form.find('.error-block')
        el.find('.alert-danger').remove()
        $.each(err.responseJSON.errors, function (i, error) {
          let errorBlock = `<div class="alert alert-danger alert-dismissible fade show" role="alert">`
                          + error[0]
                          + `<button type="button" class="close" data-dismiss="alert" aria-label="Close">`
                          + `<span aria-hidden="true">&times;</span>`
                          + `</button>`
                          + `</div>`
          el.append(errorBlock)
          $('.modal').animate({ scrollTop: 0 }, 'fast')
        })
      }
    }
  })
})

$('.delete-confirm-btn').click(function () {
  $('#delete-confirm-form').get(0).setAttribute('action', $(this).data('action'));
  $('#delete-confirmation').modal('show');
});

$('.edit-btn').click(function () {
  let modal = $(this).data('target')
  
  $.ajax({
    dataType: "json",
    url: $(this).data('get'),
    method: 'get',
    headers: {
        'Accept': 'application/json',
    },
    contentType: false,
    cache: false,
    processData: false,
    success: function(result){
      $(modal + '-form').find('.error-block').find('.alert-danger').remove()

      $.each(result.data, function (name, data) {
        let field = $(modal).find('[name="' + name + '"]')

        if (field.hasClass('datepicker')) {
          field.datepicker().data({date: data}).datepicker('update').children('input').val(data)
          return
        }

        if (field.has('.map').length) {
          $(`#${field.attr('id')}`).find('.map').locationpicker('location', {
            latitude: data[0],
            longitude: data[1]
          })
          $(`#${field.attr('id')}`).find('[name="latitude"]').val(data[0])
          $(`#${field.attr('id')}`).find('[name="longitude"]').val(data[1])
          return
        }
        
        if (field.prop('nodeName') == 'INPUT') {
          field.val(data)
        } else if (field.prop('nodeName') == 'TEXTAREA') {
          editors[field.attr('id')].setData(data)
        } else if (field.prop('nodeName') == 'IMG') {
          if (data) {
            field.attr('src', data)
          }
        }        
      })
      
      $(modal).modal('show')
    },
    error: function(err){
      console.log(err)
    }
  })

  $(modal + '-form').get(0).setAttribute('action', $(this).data('patch'))
})
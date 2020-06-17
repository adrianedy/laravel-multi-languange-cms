const editors = {}

$('.ck-editor').each(function () {
  ClassicEditor.create( document.querySelector( '#' + $(this).attr('id') ), {
    removePlugins: [ 'Table', 'MediaEmbed', 'ImageUpload' ]
  }).then(editor => {
    editors[$(this).attr('id')] = editor
  }).catch( error => {
    console.error( error )
  } )
})
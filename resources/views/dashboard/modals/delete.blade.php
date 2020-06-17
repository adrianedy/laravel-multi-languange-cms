<!--MODAL DELETE-->
<div class="modal fade" id="delete-confirmation" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <form id="delete-confirm-form" method="POST">
          @method('DELETE')
          @csrf
          <div class="my-20">
            <h4 class="title-main mt-0 mb-10">Delete?</h4>
            <p>Are you sure want to delete this item?</p>
          </div>
          <button class="btn btn-danger mr-5"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
          <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--MODAL DELETE END-->
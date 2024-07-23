<div data-id="{{$id}}">
	<a href="{{$view_url}}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye" aria-hidden="true"></i></a>
	<a href="{{$delete_url}}" onclick="return confirm('Are you sure you want to delete this record?');" data-url="{{$delete_url}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
</div>


<!-- Modal -->
<div class="modal fade common_modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Business Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="form_card merchant_form">
        <div class="row">
            <div class="col-md-12">
                <form id="businessCategory-form" method="POST" action="{{route('admin.businessCategory.store')}}" enctype="multipart/form-data">
					@csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label>Name</label>
                            <input class="form-control" name="name" type="text" value="">
                            <strong class="text-danger is-invalid" id="name"></strong>
                        </div>

                        <div class="col-md-12">
                            <label>Dwolla Key</label>
                            <input class="form-control" name="dwolla_key" type="text" value="">
                            <strong class="text-danger is-invalid" id="dwolla_key"></strong>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
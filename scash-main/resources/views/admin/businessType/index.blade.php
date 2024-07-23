@extends('layout/main')

@section('title', 'Business Type List')

@section('content')

<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Business Type List</h1>
  </div>

  <!-- Content Row -->
  <div class="card shadow mb-4">
    <div class="card-header user_list py-3">
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row border-bottom mb-4 align-items-center">
            <div class="col-md-9">
              <h4 class="my-4 text-black-600">Business Type List</h4>
            </div>
            <div class="col-md-3 text-right">
              <!-- <a href="{{route('admin.businessType.create')}}" class="add_btn">+ Add New</a> -->
              <a href="{{route('admin.businessType.create')}}" class="add_btn" data-toggle="modal" data-target="#exampleModalCenter">+ Add New</a>
                    <!-- Business Type Modal -->
                    <div class="modal fade common_modal bussiness_type" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Business Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form_card merchant_form">
                              <div class="row">
                                  <div class="col-md-12">
                                      <!-- <h3>Business Type</h3> -->
                                      <form id="businessType-form" method="POST" action="{{route('admin.businessType.store')}}" enctype="multipart/form-data">
                                @csrf
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <label>Name</label>
                                                  <input class="form-control" name="name" type="text" value="">
                                                  <strong class="text-danger is-invalid" id="name"></strong>
                                              </div>
                                              <div class="col-md-12">
                                                  <label>Tax ID</label>
                                                  <select name="type" class="form-control">
                                                      <option value="">Select</option>
                                                      <option value="1">SSN</option>
                                                      <option value="2">EIN</option>
                                                  </select>
                                                  <strong class="text-danger is-invalid" id="type"></strong>
                                              </div>

                                              <div class="col-md-12">
                                                  <label>Dwolla Key</label>
                                                  <select name="dwolla_key" class="form-control">
                                                      <option value="">Select</option>
                                                      <option value="corporation">Corporation</option>
                                                      <option value="llc">Llc</option>
                                                      <option value="partnership">Partnership</option>
                                                      <option value="soleProprietorship">Sole Proprietorship</option>
                                                  </select>
                                                  <strong class="text-danger is-invalid" id="type"></strong>
                                              </div>

                                          </div>

                                        
                                      </form>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                      </div>
                      </div>
                    </div>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-bordered dataTable-table" id="businessType-table" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  <th class="text-uppercase text-sm font-weight-bolder ps-2">
                    NAME</th>
                  <th class="text-sm">Type</th>
                  <th class="text-sm">Dwolla Key</th>
                  <th class="text-sm">ACTION</th>
                  </tr>
                </thead>

                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('style')

<link href="{{ asset('/asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


@endpush

@push('js')

<script src="{{ asset('/asset/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/asset/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('/asset/js/demo/datatables-demo.js') }}"></script>

<script src="{{ asset('assets') }}/js/admin/business-type.js"></script>
<script>
	var businessType_datatable_url = "{{ route('admin.businessType.table') }}";
	var businessType_status_change_url = "{{ route('admin.businessType.status.change') }}";

</script>
@endpush

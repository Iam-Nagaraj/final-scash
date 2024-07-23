@extends('layout/main')

@section('title', 'Promotional Notification List')

@section('content')

<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Promotional Notification List</h1>
  </div>

  <!-- Content Row -->
  <div class="card shadow mb-4">
    <div class="card-header user_list py-3">
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row border-bottom mb-4 align-items-center">
            <div class="col-md-9">
              <h4 class="my-4 text-black-600">Promotional Notification List</h4>
            </div>
            <div class="col-md-3 text-right">
              <!-- <a href="{{route('admin.promotionalNotification.create')}}" class="add_btn">+ Add New</a> -->
              <a href="{{route('admin.promotionalNotification.create')}}" class="add_btn" data-toggle="modal" data-target="#exampleModalCenter">+ Add New</a>
              <!-- Modal -->
              <div class="modal fade common_modal notification_modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Promotional Notification</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form_card merchant_form">
                          <div class="row">
                              <div class="col-md-12">
                                  <!-- <h3>Promotional Notification</h3> -->
                                  <form id="promotionalNotification-form" method="POST" action="{{route('admin.promotionalNotification.store')}}" enctype="multipart/form-data">
                                      @csrf
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group input-group-outline" id="imageInput">
                                                  <label for="subject" class="form-label">Subject</label>
                                                  <input class="form-control @error('subject') is-invalid @enderror" name="subject" type="text" value="">
                                                  <strong class="text-danger is-invalid" id="subject"></strong>
                                              </div>
                                          </div>
                                          
                                          <div class="col-md-6">
                                              <div class="form-group input-group-outline" id="imageInput">
                                                  <label for="date" class="form-label">Date</label>
                                                  <input class="form-control @error('date') is-invalid @enderror" name="date" type="date" value="">
                                                  <strong class="text-danger is-invalid" id="date"></strong>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="form-group input-group-outline" id="imageInput">
                                                  <label for="text" class="form-label">Text</label>
                                                  <input class="form-control @error('text') is-invalid @enderror" name="text" type="text" value="">
                                                  <strong class="text-danger is-invalid" id="text"></strong>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="form-group input-group-outline" id="imageInput">
                                                  <label for="date" class="form-label">Time</label>
                                                  <input class="form-control @error('time') is-invalid @enderror" name="time" type="time" value="">
                                                  <strong class="text-danger is-invalid" id="time"></strong>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="form-group input-group-outline" id="imageInput">
                                                  <label for="state_id" class="form-label">Send To</label>
                                                  <select name="send_to" class="form-control" id="">
                                                      <option value="">Choose Users</option>
                                                      <option value="1">Merchants</option>
                                                      <option value="2">Users</option>
                                                      <option value="3">Merchant With Users</option>
                                                      <option value="4">All</option>
                                                  </select>
                                                  <strong class="text-danger is-invalid" id="send_to"></strong>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="form-group input-group-outline" id="imageInput">
                                                  <label for="zip_code" class="form-label">Zip Code</label>
                                                  <select class="form-control select2" name="zip_code[]" id="business_zip_code" multiple="multiple"></select>
                                              </div>
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
              <table class="table table-bordered dataTable-table" id="promotionalNotification-table" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-sm font-weight-bolder ps-2">
                      Subject</th>
                      <th class="text-uppercase text-sm font-weight-bolder ps-2">
                      Date</th>
                      <th class="text-uppercase text-sm font-weight-bolder ps-2">
                      Time</th>
                      <th class="text-uppercase text-sm font-weight-bolder ps-2">
                      Status</th>                    
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

<script src="{{ asset('assets') }}/js/admin/promotionalNotification.js"></script>
<script>
	var promotionalNotification_datatable_url = "{{ route('admin.promotionalNotification.table') }}";
	var promotionalNotification_status_change_url = "{{ route('admin.promotionalNotification.status.change') }}";

</script>
@endpush

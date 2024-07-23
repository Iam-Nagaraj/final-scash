@extends('layout/main')

@section('title', 'Banner')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Banner</h1>
        <!-- <a
                href="#"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                ><i class="fas fa-download fa-sm text-white-50"></i> Generate
                Report</a
              > -->
    </div>

    <!-- Content Row -->
    <div class="form_card merchant_form card shadow mb-4 p-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Banner</h3>
                <div class="row">
                    <div class="col">
                        <a href="{{$detail->banner_image}}" target="_blank"><img class="form_card" src="{{$detail->banner_image}}"></a>
                    </div>
                </div>
                <form id="banner-form" method="POST" action="{{route('admin.banner.update')}}" enctype="multipart/form-data">
					@csrf
                    <input value="{{$detail->id}}" name="id" type="hidden" >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group input-group-outline mt-3" id="imageInput">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" name="name" type="text" value="{{$detail->name}}" >
                                <strong class="text-danger is-invalid" id="name"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input-group-outline mt-3" id="imageInput">
                                <label for="latitude" class="form-label">Banner</label>
                                <input class="form-control" name="banner_image" type="file" value="">
                                <strong class="text-danger is-invalid" id="banner_image"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input-group-outline mt-3" id="imageInput">
                                <label for="longitude" class="form-label">Start Date</label>
                                <input class="form-control" name="start_date" type="date" value="{{$detail->start_date}}">
                                <strong class="text-danger is-invalid" id="start_date"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input-group-outline mt-3" id="imageInput">
                                <label for="longitude" class="form-label">End date</label>
                                <input class="form-control" name="end_date" type="date" value="{{$detail->end_date}}">
                                <strong class="text-danger is-invalid" id="end_date"></strong>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group input-group-outline mt-3" id="imageInput">
                                <label for="longitude" class="form-label">Url</label>
                                <input class="form-control" name="url" type="text" value="{{$detail->url}}">
                                <strong class="text-danger is-invalid" id="url"></strong>

                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group input-group-outline mt-3" id="imageInput">
                                <label for="state_id" class="form-label">Type</label>
                                <select name="type" class="form-control" id="banner_type" onChange="chooseMerchant()">
                                    <option value="1" {{$detail->type == 1 ? 'selected' : ''}} >Referral</option>
                                    <option value="2" {{$detail->type == 2 ? 'selected' : ''}} >Merchant</option>
                                    <option value="3" {{$detail->type == 3 ? 'selected' : ''}} >Scanner</option>
                                </select>
                                <strong class="text-danger is-invalid" id="type"></strong>
                            </div>
                        </div>
                        <div class="col-md-6" id="select_merchant">
                            <div class="form-group input-group-outline mt-3" id="imageInput">
                                <label for="state_id" class="form-label">Merchant</label>
                                <select name="user_id" class="form-control" >
                                    <option value="">Select Merchant</option>
                                    @foreach($merchantModel as $k => $single)
                                    <option value="{{$k}}" {{$detail->user_id == $k ? 'selected' : ''}} >{{$single}}</option>
                                    @endforeach
                                </select>
                                <strong class="text-danger is-invalid" id="user_id"></strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit">Save Changes</button>
                        </div>

                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('style')
<style>
    .form_card img {
    width: 130px;
    padding: 0.375rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #6e707e;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #d1d3e2;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    border-radius: 0.35rem;
}
</style>
@endpush

@push('js')
<script src="{{ asset('assets') }}/js/admin/banner.js"></script>
<script>
	var banner_datatable_url = "{{ route('admin.banner.table') }}";
	var banner_status_change_url = "{{ route('admin.banner.status.change') }}";
    
    function chooseMerchant(){
        console.log('sdfsd');
        var banner_type = $('#banner_type').val();
        if(banner_type == 2){
            $('#select_merchant').show();
        } else {
            $('#select_merchant').hide();
        }
    }
    
    chooseMerchant();
</script>

@endpush
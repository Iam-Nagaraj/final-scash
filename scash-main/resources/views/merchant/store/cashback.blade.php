@extends('layout/main')

@section('title', 'Store Cashback Create')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Store Cashback Create</h1>
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
                <h3>{{$detail->name}} Store</h3>
                <form  method="POST" id="cashback-form" action="{{route('merchant.store.cashback.rule.save')}}" >
					@csrf
                    <input type="hidden" name="id" value="{{$detail->uuid}}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group input-group-outline mt-3">
                                <label for="standard_cashback_percentage" class="form-label">Admin Standard Cash <br>Back Percentage </label>
                                <input class="form-control" readonly step="any"value="{{$default}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group input-group-outline mt-3">
                                <label for="standard_cashback_percentage" class="form-label">Merchant Standard Cash Back Percentage</label>
                                @if($cashbackRuleModel)
                                <input class="form-control" name="standard_cashback_percentage" type="number"  min="0"  step="any"value="{{ old('standard_cashback_percentage', $cashbackRuleModel->standard_cashback_percentage ?? '') }}">
                                @else
                                <input class="form-control" name="standard_cashback_percentage" type="number"  min="0"  step="any"value="{{ old('standard_cashback_percentage', $default ?? '') }}">
                                @endif
                                @error('standard_cashback_percentage')
                                <strong class="text-danger is-invalid">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-3">
                            <div class="form-group input-group-outline mt-3">
                                <label for="ts_total_amount" class="form-label"> Increase Transaction<br> Total Spent</label>
                                <input class="form-control" name="ts_total_amount" type="number" value="{{ old('ts_total_amount', $cashbackRuleModel->ts_total_amount ?? '') }}" >
                                @error('ts_total_amount')
                                <strong class="text-danger is-invalid">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group input-group-outline mt-3">
                                <label for="ts_extra_percentage" class="form-label"> Increase Transaction<br> Extra Percentage</label>
                                <input class="form-control" name="ts_extra_percentage" type="number" step="any"  value="{{ old('ts_extra_percentage', $cashbackRuleModel->ts_extra_percentage ?? '') }}">
                                @error('ts_extra_percentage')
                                <strong class="text-danger is-invalid">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group input-group-outline mt-3">
                                <label for="ts_status" class="form-label"> Increase Transaction <br>Status</label>
                                <input type="checkbox" @if (isset($cashbackRuleModel) && $cashbackRuleModel->ts_status == 1) checked @endif
                                                {{ old('ts_status') ? 'checked' : '' }} data-toggle="toggle" name="ts_status" data-onstyle="success">
                              
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-3">
                            <div class="form-group input-group-outline mt-3">
                                <label for="rp_total_amount" class="form-label"> Repeat Purchase <br>Total Spent</label>
                                <input class="form-control" name="rp_total_amount" type="number" value="{{ old('rp_total_amount', $cashbackRuleModel->rp_total_amount ?? '') }}" >
                                @error('rp_total_amount')
                                <strong class="text-danger is-invalid">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group input-group-outline mt-3">
                                <label for="rp_extra_percentage" class="form-label"> Repeat Purchase <br>Extra Percentage</label>
                                <input class="form-control" name="rp_extra_percentage" type="number" step="any"  value="{{ old('rp_extra_percentage', $cashbackRuleModel->rp_extra_percentage ?? '') }}">
                                @error('rp_extra_percentage')
                                <strong class="text-danger is-invalid">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group input-group-outline mt-3">
                                <label for="rp_status" class="form-label"> Repeat Purchase<br> Status</label>
                                <input type="checkbox"  @if (isset($cashbackRuleModel) && $cashbackRuleModel->rp_status == 1) checked @endif
                                                {{ old('rp_status') ? 'checked' : '' }} data-toggle="toggle" name="rp_status" data-onstyle="success">
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
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush

@push('js')
<script src="{{ asset('assets') }}/js/merchant/cashback.js"></script>
<script>
	var cashback_datatable_url = "{{ route('merchant.store.table') }}";
	var cashback_status_change_url = "{{ route('merchant.store.status.change') }}";

</script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


@endpush
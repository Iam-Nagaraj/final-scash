<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantStoreRequest;
use App\Models\BusinessCategory;
use App\Models\BusinessDetail;
use App\Models\BusinessSubCategory;
use App\Models\Cashback;
use App\Models\CashbackRule;
use App\Models\DwollaCustomer;
use App\Models\MerchantStore;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserMedia;
use App\Models\Wallet;
use App\Traits\UploadFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
	use UploadFile;

	protected MerchantStore $merchantStoreService;
	public function __construct(MerchantStore $merchantStoreService)
	{
		$this->merchantStoreService = $merchantStoreService;
	}

	public function index(Request $request)
	{
		try {
			
			return $this->sendResponse([], 'Merchant Store fetched successfully.');
		} catch (Exception $ex) {
			return $this->sendError([], $ex->getMessage());
		}
	}

	public function list()
	{
		try {
			return view('merchant.store.index');
		} catch (Exception $ex) {
			return $this->sendError([], $ex->getMessage());
		}
	}

	public function view(Request $request)
	{
		$detail = MerchantStore::where('uuid', $request->id)->first();
		$userModel = User::where('id', $detail->user_id)->first();
		return view('merchant.store.view')->with(['detail' => $detail, 'userModel' => $userModel]);
	}

	public function transaction(Request $request)
	{
		$id = $request->id;
		$storeModel = MerchantStore::where('uuid', $id)->first();
		$userModel = User::where('id', $storeModel->user_id)->first();
		return view('merchant.store.transaction', compact('id','storeModel','userModel'));
	}

	public function create()
	{
		try {
			return view('merchant.store.create');
		} catch (Exception $ex) {
			return $this->sendError([], $ex->getMessage());
		}
	}

	public function store(MerchantStoreRequest $request)
	{
		try {
			$current_id = Auth::user()->id;
			
			DB::beginTransaction();
			
			$userModel = $this->user($request);
			$this->userAddress($userModel, $request);
			$wallet = $this->wallet($userModel);
			$this->dwollaCustomer($userModel);
			$this->businessDetail($userModel, $request);
			$this->cashbackRule($userModel);
			// $this->uploadProfileImage($userModel, $request);

			$MerchantStore = MerchantStore::updateOrCreate(
				[
					'merchant_id' => $current_id,
					'name' => $request->name
				],
				[
					'merchant_id' => $current_id,
					'wallet_id' => $wallet->id,
					'user_id' => $userModel->id,
					'branch_id' => $request->branch_id,
					'name' => $request->name,
					'email' => $request->email,
					'city' => $request->city,
					'state' => $request->state,
					'phone' => $request->phone,
					'address' => $request->address,
					'latitude' => $request->latitude,
					'longitude' => $request->longitude,
					'uuid' => $uuid = Str::uuid()->toString()
				]
			);

			DB::commit();

			return $this->sendResponse([], 'Merchant store save successfully.');
		} catch (Exception $ex) {
			DB::rollBack();
			return $this->sendError([], $ex->getMessage());
		}
	}

	public function update(MerchantStoreRequest $request)
	{
		try {
			$current_id = Auth::user()->id;
			$storeModel = MerchantStore::where('uuid', $request->id)->first();
			if(empty($storeModel)){
				return $this->sendError([], 'Data Not Found', 404);
			}
			$userModel = User::where('id', $storeModel->user_id)->first();
			
			DB::beginTransaction();

			// $this->uploadProfileImage($userModel, $request);
			
			$MerchantStore = MerchantStore::updateOrCreate(
				[
					'uuid' => $request->id,
				],
				[
					'branch_id' => $request->branch_id,
					'name' => $request->name,
					'phone' => $request->phone,
					'email' => $request->email,
					'city' => $request->city,
					'state' => $request->state,
					'address' => $request->address,
					'latitude' => $request->latitude,
					'longitude' => $request->longitude,
				]
			);
			$userModelUpdate = User::updateOrCreate(
				[
					'id' => $storeModel->user_id,
				],
				[
					'name' => $request->name,
					'first_name' => $request->name,
					'phone_number' => $request->phone,
					'email' => $request->email
				]
			);
			$userAddressModel = UserAddress::updateOrCreate(
				[
					'user_id' => $storeModel->user_id,
				],
				[
					'city' => $request->city,
					'state' => $request->state,
					'address' => $request->address,
					'latitude' => $request->latitude,
					'longitude' => $request->longitude,
				]
			);

			DB::commit();

			return $this->sendResponse([], 'Merchant store save successfully.');
		} catch (Exception $ex) {
			DB::rollBack();
			return $this->sendError([], $ex->getMessage());
		}
	}

	protected function uploadProfileImage($userModel, $request){
		if($request->hasFile('picture')){
			$logo = $request->picture;
			$uploadImage = $this->imageUpload($logo);
			
			$userMedia = UserMedia::updateOrCreate(
				['user_id' => $userModel->id, 'type' => UserMedia::TYPE_IMAGE],
				[
					'user_id' => $userModel->id,
					'file' => $uploadImage['url'],
					'type' => UserMedia::TYPE_IMAGE
				]
			);
		}
		return true;
	}

	protected function cashbackRule($userModel)
	{
		$MerchantCashbackRule = CashbackRule::where('user_id', Auth::user()->id)->first();
		if(empty($MerchantCashbackRule)){
			$business_category= BusinessSubCategory::select('id')
			->where('id', Auth::user()->BusinessDetail->business_category)->first();
			$cashback_business_type    = Cashback::where('business_category_id',$business_category->id ?? '')->first();
			$cashback_percentage = $cashback_business_type->percentage ?? 0;	
			$CashbackRuleModel = new CashbackRule();
			$CashbackRuleModel->user_id = $userModel->id;
			$CashbackRuleModel->standard_cashback_percentage = 0;
			$CashbackRuleModel->ts_total_amount = 0;
			$CashbackRuleModel->rp_total_amount = 0;
			$CashbackRuleModel->save();

			return $CashbackRuleModel;			
		}

		$CashbackRuleModel = new CashbackRule();
		$CashbackRuleModel->user_id = $userModel->id;
		$CashbackRuleModel->standard_cashback_percentage = $MerchantCashbackRule->standard_cashback_percentage;
		$CashbackRuleModel->ts_total_amount = $MerchantCashbackRule->ts_total_amount;
		$CashbackRuleModel->ts_extra_percentage = $MerchantCashbackRule->ts_extra_percentage;
		$CashbackRuleModel->ts_status = $MerchantCashbackRule->ts_status;
		$CashbackRuleModel->rp_total_amount = $MerchantCashbackRule->rp_total_amount;
		$CashbackRuleModel->rp_extra_percentage = $MerchantCashbackRule->rp_extra_percentage;
		$CashbackRuleModel->rp_status = $MerchantCashbackRule->rp_status;
		$CashbackRuleModel->save();

		return $CashbackRuleModel;
	}

	protected function businessDetail($userModel, $request)
	{
		$merchantBusinessDetail = BusinessDetail::where('user_id', Auth::user()->id)->first();
		$BusinessDetailModel = new BusinessDetail();
		$BusinessDetailModel->user_id = $userModel->id;
		$BusinessDetailModel->tax_type = $merchantBusinessDetail->tax_type;
		$BusinessDetailModel->registration_type = $merchantBusinessDetail->registration_type;
		$BusinessDetailModel->business_name = $request->name;
		$BusinessDetailModel->business_category = $merchantBusinessDetail->business_category;
		$BusinessDetailModel->business_street_address = $request->address;
		$BusinessDetailModel->business_city = $request->city;
		$BusinessDetailModel->business_state = $request->state;
		$BusinessDetailModel->business_phone_number = $request->phone;
		$BusinessDetailModel->email = $request->email;
		$BusinessDetailModel->save();

		return $BusinessDetailModel;
	}

	protected function dwollaCustomer($userModel)
	{
		$merchantCustomer = DwollaCustomer::where('user_id', Auth::user()->id)->first();
		$customerModel = new DwollaCustomer();
		$customerModel->user_id = $userModel->id;
		$customerModel->customer_id = $merchantCustomer->customer_id;
		$customerModel->save();

		return $customerModel;
	}

	protected function wallet($userModel)
	{
		$merchantWallet = Wallet::where('user_id', Auth::user()->id)->first();
		$walletModel = new Wallet();
		$walletModel->user_id = $userModel->id;
		$walletModel->wallet_id = $merchantWallet->wallet_id;
		$walletModel->save();

		return $walletModel;
	}

	protected function userAddress($userModel, $request)
	{
		$UserAddressModel = new UserAddress();
		$UserAddressModel->user_id = $userModel->id;
		$UserAddressModel->address = $request->address;
		$UserAddressModel->city = $request->city;
		$UserAddressModel->state = $request->state;
		$UserAddressModel->longitude = $request->longitude;
		$UserAddressModel->latitude = $request->latitude;
		$UserAddressModel->country = $request->country;
		$UserAddressModel->save();

		return $UserAddressModel;
	}

	protected function user($request)
	{
		$uuid = Str::uuid()->toString();
		$userModel = new User();
		$userModel->name = $request->name;
		$userModel->first_name = $request->name;
		$userModel->email = $request->email;
		$userModel->role_id = 5;
		$userModel->country_code = $request->country_code;
		$userModel->phone_number = $request->phone;
		$userModel->uuid = $uuid;
		$userModel->save();

		return $userModel;
	}

	public function table(Request $request)
	{

		$cashbacks = $this->merchantStoreService->where('merchant_id', Auth::user()->id);
		if ($request->has('search') && !empty($request->get('search'))) {
			$searchValue = '%' . $request->get('search')['value'] . '%';
		}
		$cashbacks = $cashbacks->latest('id');
		return DataTables::of($cashbacks)->addColumn('action', function ($row) {
			return view('merchant.store.table-action')->with(
				[
					'id' => $row->id, 
					'view_url' => route('merchant.store.view', ['id' => $row->uuid]),
					'transaction_url' => route('merchant.store.transaction', ['id' => $row->uuid]),
					'cashback_url' => route('merchant.store.cashback', ['id' => $row->uuid]),
					'delete_url' => route('merchant.store.delete', ['id' => $row->uuid])
				]
			);
		})
			->rawColumns(['action'])->make(true);
	}

	public function transactionTable($id)
	{
		$storeModel = MerchantStore::where('uuid', $id)->first();
		$transactions = Transaction::where('wallet_type', Transaction::TYPE_WALLET_TO_WALLET)
		->where('to_user_id', $storeModel->user_id)->with(['receiver','sender'])->latest();

		return Datatables::of($transactions)->addColumn('action', function ($row) {
			return view('merchant.dashboard.table-action')->with(
				[
					'id' => $row->id, 
				]
			);
		})
			->rawColumns(['action'])->make(true);
	}

	public function cashback($id)
	{
		try {
			$detail = MerchantStore::where('uuid', $id)->first();
			$userModel = User::where('id', $detail->user_id)->first();
			$cashbackRuleModel = CashbackRule::where('user_id', $detail->user_id)->first();
			
			$default = 1.00;
			$user_business_details = $userModel->BusinessDetail;
			if(isset($user_business_details)){
				$business_category = BusinessSubCategory::select('id')->where('id',$user_business_details->business_category)->first();
				$business_type    = Cashback::where('business_category_id',$business_category->id ?? '')->first();
				$default  = isset($business_type) ? $business_type->percentage : 0.00;
			}

			return view('merchant.store.cashback', compact('detail', 'userModel', 'cashbackRuleModel', 'default'));
		} catch (Exception $ex) {
			return abort(500);
		}
	}

	public function cashbackSave(Request $request){
		
		try {
			$detail = MerchantStore::where('uuid', $request->id)->first();
			if(empty($detail)){
				return $this->sendError([], 'Data Not Found');
			}

			CashbackRule::updateOrCreate(
				[
					'user_id' => $detail->user_id,
				],
				[
					'user_id' => $detail->user_id,
					'standard_cashback_percentage' => $request->standard_cashback_percentage,
					'ts_total_amount' => $request->ts_total_amount,
					'ts_extra_percentage' => $request->ts_extra_percentage,
					'ts_status' => ($request->ts_status == 'on') ? 1 : 0,
					'rp_total_amount' => $request->rp_total_amount,
					'rp_extra_percentage' => $request->rp_extra_percentage,
					'rp_status' => ($request->rp_status) ? 1 : 0,
				]
			);
			return $this->sendResponse(true, [], 'Cashback successfully saved.');

		} catch (Exception $ex) {
			return $this->sendError([], $ex->getMessage());
		}
	}

}

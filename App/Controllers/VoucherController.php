<?php
namespace App\Controllers;
use App\Controllers\Controller;
use Codefii\View\View;
use Codefii\Hash\Hash;
use Codefii\Validation\Validation;
use Codefii\Http\Request;
use App\Models\Offer;
use App\Models\Recipient;
use App\Models\Voucher_Code;
class VoucherController extends Controller{
	public $error, $response=array(),$result;
	public function index(){
		/**
		*This part of the code only runs whenever the purchase button is clicked
		*There's also a validation test that checks if an item and voucher code is empty or not
		**/
		if(isset($_GET['id']) && isset($_GET['item']) && isset($_GET['email'])){
			if(!empty($_GET['id']) && !empty($_GET['item'])){
				$myVoucher = new Voucher_Code();
				$data = $myVoucher->findBy(['v_id'=>$_GET['id']]);
				$offer_and_voucher = $myVoucher->select()->belongsTo('offer','offer_name','name')->leftJoin()->all();
				$v_id = $myVoucher->findBy(['id'=>$_GET['id']]);
				if($data->trial_times==1){
					//if the item trial times or used times is 1, then it should notify the user
					//that the item has already been purchased
					echo "<script>alert('this item has already been purchased!');
					window.location='/';</script>";
				}else{
					//this lists all the items in voucher_code and offer and check where voucher code
					//is equal to the sent voucher code before processing the request
					foreach($offer_and_voucher as $new_offer_and_voucher){
						if($new_offer_and_voucher->v_id==$_GET['id'] && $new_offer_and_voucher->recipient_email==$_GET['email']){
							$discount = $new_offer_and_voucher->discount;
						$myVoucher->update(['id'=>$data->id,'date_of_usage'=>date("Y-m-d"),'trial_times'=>'1']);
								if($myVoucher){
									echo"<script>alert('item puchased with a discount of $discount%');
									window.location='/';</script>";
								}
						}
					}
				}
			}
		}
	
		//this part of the code runs when a new offer is created, a validation is runned to check
		//whether the fields are empty or filled before processing the request
		if(Request::exists()){
			$validation = new Validation();
			$validation->validate($_POST,array(
				'recipient_name'=>array(
					'required'=>true
				),
				'recipient_email'=>array(
					'required'=>true
				),
				'offer_name'=>array(
					'required'=>true
				),
				'discount'=>array(
					'required'=>true
				)
			));
			//in the absent of no error, process request
			if($validation->passes()){
				$voucher_code = strtoupper(Hash::salt(8));
				$myVoucher = new Voucher_Code();
				$recipient = new Recipient();
				$offer = new Offer();
				$data = $myVoucher->findBy(['recipient_email'=>Request::get('recipient_email')]);
				if($data){
				$this->response['failed'] ="A coupon has already been assigned to this email";	
				}else{
					$end = date("Y-m-d",strtotime(date("Y-m-d",strtotime(date("Y-m-d")))."+2 days"));
				$recipient->create([Request::get('recipient_name'),Request::get('recipient_email')]);
				$offer->create([Request::get('offer_name'),Request::get('discount')]);
				$myVoucher->create([$voucher_code,Request::get('offer_name'),Request::get('recipient_email'),'',0,$end]);
				if($myVoucher){
					$this->response['success'] = 'Voucher generated successfully!';
					if($recipient){
					$this->response['success'] = 'Recipient created successfully!';
						if($offer){
							$this->response['success'] = 'Offer created successfully!';
						}else{
							$this->response['failed'] ='Error, could not create special offer!';
						}
					}else{
					$this->response['failed'] ='Error, could not create recipient!';
					}
				}else{
					$this->response['failed'] ='Error, could not generate coucher code!';
				}

				}
				

			}else{
				//if error occurs during validation, capture the errors
				$this->error = $validation->errors();
			}
		}
		$voucher_code = new Voucher_Code();
		$data = $voucher_code->find()->belongsTo('recipient','recipient_email','email')->leftJoin()->all();
		View::render('voucher_pages/home',['errors' =>$this->error,'response'=>$this->response,'data'=>$data]);
	}

}
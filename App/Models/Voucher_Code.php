<?php
namespace App\Models;
use Codefii\Entity\Orm\Fiirm;
class Voucher_Code extends Fiirm {
	public $table ='voucher_code';
	public $pk = 'id';
	public $columns =['v_id','offer_name','recipient_email','trial_times','date_of_usage','expiry_date'];
}
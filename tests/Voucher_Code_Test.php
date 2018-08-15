<?php
namespace Test;
class Voucher_Code_Test extends \PHPUnit_Framework_TestCase {
	public function test_getData(){
		$voucher = new \App\Models\Voucher_Code;
		 $data = $voucher->findAll();
		 var_dump($data);
	}
}
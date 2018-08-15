<?php
namespace App\Models;
use Codefii\Entity\Orm\Fiirm;
use Codefii\Entity\auth\FiiAuth;
class Recipient extends FiiAuth{
	public $table ='recipient';
	public $columns =['name','email'];
}
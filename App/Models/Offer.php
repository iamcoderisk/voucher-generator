<?php
namespace App\Models;
use Codefii\Entity\Orm\Fiirm;
class Offer extends Fiirm {
	public $tables ='offer';
	public $columns = ['name','discount'];
}
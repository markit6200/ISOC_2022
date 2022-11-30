<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\GeneralModel;

class DataPersonalWaitrecruitModel extends Model
{
    protected $table      = 'DataPersonalWaitrecruit';
	protected $primaryKey = 'pid';
    protected $allowedFields = ['pid','cardID','codePrefix','firstName','lastName','originPosition','dateInsert','gender'];
 
   
}
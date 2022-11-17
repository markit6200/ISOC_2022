<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\GeneralModel;

class DataPersonalForcesModel extends Model
{
    protected $table      = 'DataPersonalForces';
	protected $primaryKey = 'fid';
    protected $allowedFields = ['fid','pid','cardID','hrTypeID','codePrefix','firstName','lastName','positionCivilianID','orgID','positionID','positionGroupID','positionCivilianGroupID','isocPosition','status','profileType'];
}

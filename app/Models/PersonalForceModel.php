<?php namespace App\Models;

use CodeIgniter\Model;

class PersonalForceModel extends Model
{
    protected $table      = 'DataPersonalForces';
	protected $primaryKey = 'fid';
    protected $allowedFields = ['fid','pid','cardID','hrTypeID','codePrefix','firstName','lastName','orgID','positionID','positionGroupID','positionCivilianID','positionCivilianGroupID','status','profileType'];
    protected $createdField  = 'createDate';
	protected $updatedField  = 'updateTime';
}

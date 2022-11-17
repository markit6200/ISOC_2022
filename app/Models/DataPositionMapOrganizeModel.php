<?php namespace App\Models;

use CodeIgniter\Model;

class DataPositionMapOrganizeModel extends Model
{
	// protected $DBGroup = ('usermanager');
    protected $table      = 'DataPositionMapOrganize';
	protected $primaryKey = 'positionMapID';
    protected $allowedFields = ['positionMapID','positionID','positionGroupID','positionCivilianID','positionCivilianGroupID','positionType','rankID','rankIDTo','org_id','positionNumber','ordering','activeStatus','createDate','updateTime','profileID'];
    

}

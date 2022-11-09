<?php namespace App\Models;

use CodeIgniter\Model;

class OrganizeProfileModel extends Model
{
    protected $DBGroup = ('usermanager');
    protected $table      = 'organize_profile';
	protected $primaryKey = 'org_profile_id';
    protected $allowedFields = ['org_profile_id','org_profile_year','org_profile_status','datecreate','dateupdate',
    'user_owner','org_profile_name','org_date_announce','profileType'];
    protected $updatedField  = 'dateupdate';
    protected $createdField  = 'datecreate';
}

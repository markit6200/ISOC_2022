<?php namespace App\Models;

use CodeIgniter\Model;

class PersonalForceModel extends Model
{
    protected $table      = 'DataPersonalForces';
	protected $primaryKey = 'fid';
    protected $allowedFields = ['fid','pid','cardID','firstName','lastName','orgID','isocPosition','status'];
    protected $createdField  = 'createDate';
	protected $updatedField  = 'updateTime';
}

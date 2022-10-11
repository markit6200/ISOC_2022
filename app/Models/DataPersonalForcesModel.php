<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\GeneralModel;

class DataPersonalForcesModel extends Model
{
    protected $table      = 'DataPersonalForces';
	protected $primaryKey = 'fid';
    protected $allowedFields = ['fid','cardID','codePrefix','firstName','lastName','positionCivilianID'];
}

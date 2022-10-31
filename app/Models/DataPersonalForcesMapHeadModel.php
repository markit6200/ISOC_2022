<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\GeneralModel;

class DataPersonalForcesMapHeadModel extends Model
{
    protected $table      = 'DataPersonalForcesMapHead';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id','orderTypeID','orgID','directiveBegin','statusDirective','createDate','updateTime','userID'];
    
    public function __construct() {
		parent::__construct();
        
		$this->generalModel = new GeneralModel();
	}
}

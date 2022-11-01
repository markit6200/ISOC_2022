<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\GeneralModel;

class DataPersonalForcesMapModel extends Model
{
    protected $table      = 'DataPersonalForcesMap';
	protected $primaryKey = 'mId';
    protected $allowedFields = ['mId','fId','hID','typeForce','statusPackingRate','dateBegin','dateEnd','hIDRetire','dateRetire','createDate','updateTime','positionMapID'];
    
    public function __construct() {
		parent::__construct();
        
		$this->generalModel = new GeneralModel();
	}
}

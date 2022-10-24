<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\GeneralModel;

class DataPersonalForcesMapModel extends Model
{
    protected $table      = 'DataPersonalForcesMap';
	protected $primaryKey = 'mId';
    // protected $allowedFields = ['mId','fId','typeForce','statusPackingRate','datePackingRate','dateOffPackingRate','createDate','updateTime','positionMapID'];
    protected $allowedFields = ['mId','fId','typeForce','statusPackingRate','directiveBegin','dateBegin','dateEnd','directiveRetire','dateRetire','createDate','updateTime','positionMapID'];
    
    public function __construct() {
		parent::__construct();
        
		$this->generalModel = new GeneralModel();
	}
}

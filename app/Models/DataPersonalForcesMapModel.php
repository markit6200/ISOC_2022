<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\GeneralModel;

class DataPersonalForcesMapModel extends Model
{
    protected $table      = 'DataPersonalForcesMap';
	protected $primaryKey = 'mId';
    protected $allowedFields = ['mId','fId','typeForce','statusPackingRate','datePackingRate','dateOffPackingRate','createDate','updateTime','positionMapID'];
    
    public function __construct() {
		parent::__construct();
        
		$this->generalModel = new GeneralModel();
	}

    public function getData($params = array()){
        $builder = $this->db->table('DataPersonalForces AS t1');
        $builder->select('t1.*,t2.mId');
        $builder->join("DataPersonalForcesMap AS t2","t1.fId = t2.fId","left");
        $builder->where('t2.mId IS NULL');
        $builder->orderBy("t1.fid ASC");
        $builder->limit('10');
        $result = $builder->get()->getResult();

        $codePrefixShort = $this->generalModel->getcodePrefixShort();
        $positionCivilian = $this->generalModel->getPositionCivilianList();
        
        if(count($result)>0){
			foreach( $result as $key => $value ){
                $data[$key] = $value;
                $data[$key]->codePrefixTxt = !empty($value->codePrefix)?$codePrefixShort[$value->codePrefix]:'-';
                $data[$key]->personalPosition = !empty($value->positionCivilianID)?$positionCivilian[$value->positionCivilianID]:'';
            }
        }
        return $data;
    }
}

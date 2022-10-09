<?php namespace App\Models;

use CodeIgniter\Model;

class DataPersonalForcesMapModel extends Model
{
    protected $table      = 'DataPersonalForcesMap';
	protected $primaryKey = 'mId';
    protected $allowedFields = ['mId','fId','typeForce','statusPackingRate','datePackingRate','dateOffPackingRate','createDate','updateTime','positionID'];
    

    public function getData($params = array()){
        $builder = $this->db->table('DataPersonalForces AS t1');
        $builder->select('t1.*,t2.mId');
        $builder->join("DataPersonalForcesMap AS t2","t1.fId = t2.fId","left");
        $builder->where('t2.mId IS NULL');
        $builder->limit('10');
        return $builder->get()->getResult();
    }
}

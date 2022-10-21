<?php namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect('master'); 
    }
    private $personalType = ['1'=>'พตท','2'=>'พ'];

    public function getPrefix()
    {
        $builder = $this->db->table('DSLPrefix');
        $builder->select('codePrefix as id, titlePrefix');
        $builder->where('active','1');
        $builder->orderBy('codePrefix','ASC');
        $data = array();
        foreach ($builder->get()->getResult() as $key => $value) {
            $data[$value->id] = $value->titlePrefix;
        }
        return $data;
    }

    public function getHRType()
    {
        $builder = $this->db->table('STDHumanResourceType');
        $builder->select('hrTypeID as id, hrShortName as hr_type_name');
        $builder->where('activeStatus','1');
        $builder->orderBy('hrTypeID','ASC');
        $data = array();
        foreach ($builder->get()->getResult() as $key => $value) {
            $data[$value->id] = $value->hr_type_name;
        }
        return $data;
    }
    

    public function getPersonalType()
    {
        $builder = $this->db->table('STDPersonalType');
        $builder->select('personalTypeID as id, personalTypeName as position_name');
        $builder->where('activeStatus','1');
        $builder->orderBy('ordering','ASC');
        $data = array();
        foreach ($builder->get()->getResult() as $key => $value) {
            $data[$value->id] = $value->position_name;
        }
        return $data;
    }

    public function getPosition()
    {
        $builder = $this->db->table('STDPosition');
        $builder->select('positionID as id, positionName as position_name');
        $builder->where('activeStatus','1');
        return $builder->get()->getResult();
    }

    public function getPositionList()
    {
        $builder = $this->db->table('STDPosition');
        $builder->select('positionID as id, positionName as position_name');
        $builder->where('activeStatus','1');
        $data = array();
        foreach ($builder->get()->getResult() as $key => $value) {
            $data[$value->id] = $value->position_name;
        }

        return $data;
    }

    public function getPositionGroup()
    {
        $builder = $this->db->table('STDPositionGroup');
        $builder->where('activeStatus','1');
        $builder->select('positionGroupID as id, positionGroupName as position_group_name');
        return $builder->get()->getResult();
    }

    public function getPositionGroupList()
    {
        $builder = $this->db->table('STDPositionGroup');
        $builder->where('activeStatus','1');
        $builder->select('positionGroupID as id, positionGroupName as position_group_name');
        $data = array();

        foreach ($builder->get()->getResult() as $key => $value) {
            $data[$value->id] = $value->position_group_name;
        }

        return $data;
    }

    public function getPositionCivilian()
    {
        $builder = $this->db->table('STDPositionCivilian');
        $builder->select('positionCivilianID as id, positionCivilianName as position_civilian_name');
        $builder->where('activeStatus','1');
        return $builder->get()->getResult();
    }

    public function getPositionCivilianList()
    {
        $builder = $this->db->table('STDPositionCivilian');
        $builder->select('positionCivilianID as id, positionCivilianName as position_civilian_name');
        $builder->where('activeStatus','1');
        $data = array();

        foreach ($builder->get()->getResult() as $key => $value) {
            $data[$value->id] = $value->position_civilian_name;
        }

        return $data;
    }

    public function getPositionCivilianGroup()
    {
        $builder = $this->db->table('STDPositionCivilianGroup');
        $builder->select('positionCivilianGroupID as id, positionCivilianGroupName as position_civilian_group_name');
        return $builder->get()->getResult();
    }

    public function getPositionCivilianGroupList()
    {
        $builder = $this->db->table('STDPositionCivilianGroup');
        $builder->select('positionCivilianGroupID as id, positionCivilianGroupName as position_civilian_group_name');
        $data = array();

        foreach ($builder->get()->getResult() as $key => $value) {
            $data[$value->id] = $value->position_civilian_group_name;
        }

        return $data;
    }

    public function getPositionRank()
    {
        $builder = $this->db->table('STDPositionRank');
        $builder->select('rankID as id, rankName as rank_name');
        $builder->where('ativeStatus','1');
        $builder->orderBy('ordering','ASC');
        return $builder->get()->getResult();
    }

    public function getPositionRankList()
    {
        $builder = $this->db->table('STDPositionRank');
        $builder->select('rankID as id, randShortName as rank_name');
        $builder->where('ativeStatus','1');
        $builder->orderBy('ordering','ASC');
        $data = array();

        foreach ($builder->get()->getResult() as $key => $value) {
            $data[$value->id] = $value->rank_name;
        }

        return $data;
    }

    public function getPositionRankTo($id)
    {
        $builder = $this->db->table('STDPositionRank');
        $builder->select('rankID as id, rankName as rank_name, ordering');
        $builder->where('rankID',$id);
        $builder->where('ativeStatus',1);
        $result = $builder->get()->getResultArray();
        if(isset($result[0]['ordering'])){
            $rank = $this->db->table('STDPositionRank');
            $rank->select('rankID as id, rankName as rank_name');
            $rank->where('ordering <=',$result[0]['ordering']);
            $rank->where('ativeStatus',1);
            $rank->orderBy('ordering','DESC');
            return $rank->get()->getResult();
        }
        return ;

		
    }

    public function getPositionRankShortList()
    {
        $builder = $this->db->table('STDPositionRank');
        $builder->select('rankID as id, randShortName as rank_name');
        $builder->where('ativeStatus','1');
        $builder->orderBy('ordering','ASC');
        $data = array();

        foreach ($builder->get()->getResult() as $key => $value) {
            $data[$value->id] = $value->rank_name;
        }

        return $data;
    }

    public function getcodePrefixShort()
    {
        $builder = $this->db->table('DSLPrefix');
        $builder->select('codePrefix, shortPrefix');
        $builder->where('active','1');
        $builder->orderBy('codePrefix','ASC');
        $data = array();

        foreach ($builder->get()->getResult() as $key => $value) {
            $data[$value->codePrefix] = $value->shortPrefix;
        }

        return $data;
    }

}

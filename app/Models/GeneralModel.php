<?php namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect('master'); 
    }

    public function getPosition()
    {
        $builder = $this->db->table('STDPosition');
        $builder->select('positionID as id, positionName as position_name');
        $builder->where('activeStatus','1');
        return $builder->get()->getResult();
    }

    public function getPositionGroup()
    {
        $builder = $this->db->table('STDPositionGroup');
        $builder->select('positionGroupID as id, positionGroupName as position_group_name');
        return $builder->get()->getResult();
    }

    public function getPositionCivilian()
    {
        $builder = $this->db->table('STDPositionCivilian');
        $builder->select('positionCivilianID as id, positionCivilianName as position_civilian_name');
        $builder->where('activeStatus','1');
        return $builder->get()->getResult();
    }

    public function getPositionCivilianGroup()
    {
        $builder = $this->db->table('STDPositionCivilianGroup');
        $builder->select('positionCivilianGroupID as id, positionCivilianGroupName as position_civilian_group_name');
        return $builder->get()->getResult();
    }

    public function getPositionRank()
    {
        $builder = $this->db->table('STDPositionRank');
        $builder->select('rankID as id, rankName as rank_name');
        $builder->where('ativeStatus','1');
        $builder->orderBy('ordering','ASC');
        return $builder->get()->getResult();
    }

}

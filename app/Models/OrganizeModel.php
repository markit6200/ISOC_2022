<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\GeneralModel;

class OrganizeModel extends Model
{
	protected $DBGroup = ('usermanager');
    protected $table      = 'organize_to_profile';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
	
		
		// $this->load->model('GeneralModel');
		$this->generalModel = new GeneralModel();
		$this->num = 0;
	}

	// private function getPosition()
	// {
	// 	$position = $this->generalModel->getPosition();
	// 	echo "<pre>";
	// 	print_r($position);
	// 	die();
	// 	$positionArray = array();
	// 	foreach ($position as $key => $value) {
	// 		$positionArray[$value->id] = $value->position_name;
	// 	}
	// 	return $positionArray;
	// }

	public function getOrganizeDetail($org_id)
	{
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize');
		$builder->where('org_id',$org_id);
		$result = $builder->get()->getResult();
		$html = '';
		$position = $this->generalModel->getPositionList();
		$positionGroup = $this->generalModel->getPositionGroupList();
		$positionCivilian = $this->generalModel->getPositionCivilianList();
		$positionCivilianGroup = $this->generalModel->getPositionCivilianGroupList();
		$rank = $this->generalModel->getPositionRankList();
		
		
		if(count($result)>0){
			foreach( $result as $key => $value ){
				$this->num++;
				$positionTxt = $position[$value->positionID];
				$positionGroupTxt = !empty($value->positionGroupID)?$positionGroup[$value->positionGroupID]:'-';
				$positionCivilianTxt = !empty($value->positionCivilianID)?$positionCivilian[$value->positionCivilianID]:'-- --';
				$positionCivilianGroupTxt = !empty($value->positionCivilianGroupID)?$positionCivilianGroup[$value->positionCivilianGroupID]:'-';
				$rankTxt = !empty($value->rankID)?$rank[$value->rankID]:'-';
				$positionNumberTxt = $value->positionNumber;
				$html .= '	<tr class="collapseExample'.$value->org_id.' show"> ';
				$html .= '	<td class="text-center" style="width:6rem;">'.$this->num.'</td>';
				$html .= '	<td scope="row"> '.$positionTxt.'</td>';
				$html .= '	<td>'.$positionGroupTxt.'</td>';
				$html .= '	<td><button class="btn btn-primary btn-rounded">'.$positionCivilianTxt.'</button></td>';
				$html .= '	<td>'.$positionCivilianGroupTxt.'</td>';
				$html .= '	<td>';
				$html .= '		<div class="dhx_demo-active">'.$rankTxt.'</div>';
				$html .= '	</td>';

				$html .= '	<td>'.$positionNumberTxt.'</td>';
				$html .= '	<td style="width: 13rem;text-align:center;">';

				$html .= '		<div class="col-auto pe-md-0 ">';
				$html .= '			<div class="form-group mb-0">';


				$html .= '				<a href="'.base_url('StructureByAssistRate/form/'.$value->org_id.'/'.$value->positionMapID).'" class="btn  btn-warning">';
				$html .= '					<i class="mdi mdi-pencil"></i>&nbsp;แก้ไข';
				$html .= '				</a>';
				$html .= '				<button data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn  btn-danger">&nbsp;';


				$html .= '					<i class="mdi mdi-close-circle-outline"></i>&nbsp;ลบ';
				$html .= '				</button>';

				$html .= '			</div>';

				$html .= '		</div>';
				$html .= '	</td>';
				$html .= '</tr>';
			}
		}
		return $html;
	}

    public function loopTreeListSub($org_id,$org_profile_id,$html,$root){
        
		$this->select('*');
		$this->where('org_profile_id',$org_profile_id);
		$this->where('org_parent',$org_id);
		$this->orderBy('order_no','ASC');
		$root+=1;
		$data = $this->get()->getResult();
			if(count($data)>0){
				foreach( $data as $key => $value ){
					
					$name = $value->org_name;
					$detail = $this->getOrganizeDetail($value->org_id);
					$hasParent = $this->hasParent($value->org_id,$org_profile_id);
					$icon = ($detail != '')?'<i class="fas fa-angle-down"></i>':'';
					$cls = 'collapseExample'.$value->org_id;
					$html .= '<tr>';
					$html .= '	<td colspan="9" >';
					$html .= '		<div class="ms-0 d-inline">';
					$html .= '<a class="btn btn-default" data-bs-toggle="collapse"
					href=".'.$cls.'" aria-expanded="false" aria-controls="'.$cls.'">
					'.str_repeat('&nbsp;&nbsp;',$root).$icon.'&nbsp;&nbsp;'.$name.'
				</a>';
					// $html .= ' 			<span>'.$name.'</span>';
					$html .= '			<div class="float-end">';
					$html .= "				<a class=\"btn btn-default\" href=\"".base_url('StructureByAssistRate/form/'.$value->org_id)."\">";
					$html .= "					<i class=\"mdi mdi-plus-circle-outline\"></i>&nbsp;เพิ่มตำแหน่ง";
					$html .= '				</a>';
					$html .= '			</div>';
					$html .= '		</div>';
					$html .= '	</td>';
					$html .= '</tr>';
					$html .=  $detail;
					$html .= $this->loopTreeListSub($value->org_id,$org_profile_id,'',$root);
				}
		}
		return $html;
	}

	public function hasParent($org_id,$org_profile_id)
	{
		$this->selectCount('org_id');
		$this->where('org_profile_id',$org_profile_id);
		$this->where('org_parent',$org_id);
		if ($this->countAllResults() > 0) {
			return true;
		  } else {
			return false;
		  } 
	}

	public function getTreeList($org_profile_id,$org_id,$html)
	{
		$this->select('*');
		$this->where('org_profile_id',$org_profile_id);
		$this->where('org_parent',$org_id);
		// $this->from('tree');
		$this->orderBy('order_no','ASC');
		$data = $this->get()->getResult();

		foreach( $data as $key => $value ){
			$name = $value->org_name;
			$html .= '<tr>';
			$html .= '	<td colspan="9" >';
			$html .= '		<div class="ms-0 d-inline">';
			$html .= ' 			<span>'.$name.'</span>';
			$html .= '			<div class="float-end">';
			$html .= "				<a class=\"btn btn-default\" href=\"".base_url('StructureByAssistRate/form/'.$value->org_id)."\">";
			$html .= "					<i class=\"mdi mdi-plus-circle-outline\"></i>&nbsp;เพิ่มตำแหน่ง";
			$html .= '				</a>';
			$html .= '			</div>';
			$html .= '		</div>';
			$html .= '	</td>';
			$html .= '</tr>';
			$html .= $this->loopTreeListSub($value->org_id,$org_profile_id,'',1);
		}

		return $html;
	}

}

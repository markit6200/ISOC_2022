<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\GeneralModel;

class OrganizeModel extends Model
{
	protected $DBGroup = ('usermanager');
    protected $table      = 'organize_to_profile';
	protected $primaryKey = 'org_id';
	protected $allowedFields = ['org_profile_id','org_id','org_profile_year','org_name','org_short_name','org_parent','org_type','order_no','profileType'];

	public function __construct() {
		parent::__construct();
	
		
		// $this->load->model('GeneralModel');
		$this->generalModel = new GeneralModel();
		$this->num = 0;
	}

	public function getOrg($id)
	{
		$this->select('*');
		$this->where('org_id',$id);
		$data = $this->get()->getRow();

		return $data;
	}

	public function getOrganizeDetail($org_id,$type)
	{
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize');
		$builder->where('org_id',$org_id);
		$result = $builder->get()->getResult();
		$html = '';
		$position = $this->generalModel->getPositionList();
		$personalType = $this->generalModel->getPersonalType();
		$positionGroup = $this->generalModel->getPositionGroupList();
		$positionCivilian = $this->generalModel->getPositionCivilianList();
		$positionCivilianGroup = $this->generalModel->getPositionCivilianGroupList();
		$rank = $this->generalModel->getPositionRankList();
		
		if(count($result)>0){
			foreach( $result as $key => $value ){
				$this->num++;
				$positionTxt = $position[$value->positionID];
				$personalTypeTxt = $personalType[$value->positionType];
				$positionGroupTxt = !empty($value->positionGroupID)?$positionGroup[$value->positionGroupID]:'-';
				$positionCivilianTxt = !empty($value->positionCivilianID)?$positionCivilian[$value->positionCivilianID]:'-- --';
				$positionCivilianGroupTxt = !empty($value->positionCivilianGroupID)?$positionCivilianGroup[$value->positionCivilianGroupID]:'-';
				$rankTxt = !empty($value->rankID)?$rank[$value->rankID]:'-';
				$rankTxt .= !empty($value->rankIDTo)?' - '.$rank[$value->rankIDTo]:'';
				$positionNumberTxt = $value->positionNumber;
				$link = $type == 1 ? base_url('StructureByAssistRate/form/'.$value->org_id.'/'.$value->positionMapID) : base_url('StructureByAssistRatePRMN/form/'.$value->org_id.'/'.$value->positionMapID);
				$html .= '	<tr class="collapseExample'.$value->org_id.' show"> ';
				$html .= '	<td class="text-center" style="width:6rem;">'.$this->num.'</td>';
				$html .= '	<td scope="row"> '.$positionTxt.'</td>';
				$html .= '	<td>'.$personalTypeTxt.'</td>';
				$html .= '	<td>'.$positionGroupTxt.'</td>';
				$html .= '	<td><span class="btn btn-primary btn-rounded">'.$positionCivilianTxt.'</span></td>';
				$html .= '	<td>'.$positionCivilianGroupTxt.'</td>';
				$html .= '	<td>';
				$html .= '		<div class="dhx_demo-active"><span class="btn btn-outline-success btn-rounded">'.$rankTxt.'</span></div>';
				$html .= '	</td>';

				$html .= '	<td>'.$positionNumberTxt.'</td>';
				$html .= '	<td style="width: 13rem;text-align:center;">';

				$html .= '		<div class="col-auto pe-md-0 ">';
				$html .= '			<div class="form-group mb-0">';


				$html .= '				<a href="'.$link.'" class="btn  btn-warning">';
				$html .= '					<i class="mdi mdi-pencil"></i>&nbsp;แก้ไข';
				$html .= '				</a>';
				$html .= '				<button onclick="confirmDelete(\''.$value->positionMapID.'\')" class="btn  btn-danger">&nbsp;';


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

    public function loopTreeListSub($org_id,$org_profile_id,$html,$root,$type){
        
		$this->select('*');
		$this->where('org_profile_id',$org_profile_id);
		$this->where('org_parent',$org_id);
		$this->where('profileType',$type);
		$this->orderBy('order_no','ASC');
		$root+=1;
		$data = $this->get()->getResult();
			if(count($data)>0){
				foreach( $data as $key => $value ){
					
					$name = $value->org_name;
					$detail = $this->getOrganizeDetail($value->org_id,$type);
					$hasParent = $this->hasParent($value->org_id,$org_profile_id);
					$icon = ($detail != '')?'<i class="fas fa-angle-down"></i>':'';
					$link = $type == 1 ? base_url('StructureByAssistRate/form/'.$value->org_id) : base_url('StructureByAssistRatePRMN/form/'.$value->org_id);
					$cls = 'collapseExample'.$value->org_id;
					$html .= '<tr>';
					$html .= '	<td colspan="10" class="hl-l-bar-'.$root.'">';
					$html .= '		<div class="ms-0 d-inline">';
					$html .= '<a class="btn btn-default" data-bs-toggle="collapse" href=".'.$cls.'" aria-expanded="false" aria-controls="'.$cls.'">'.str_repeat('&nbsp;&nbsp;',$root).$icon.'&nbsp;&nbsp;'.$name.'</a>';
					$html .= '			<div class="float-end">';
					$html .= "				<a class=\"btn btn-default\" href=\"".$link."\">";
					$html .= "					<i class=\"mdi mdi-plus-circle-outline\"></i>&nbsp;เพิ่มตำแหน่ง";
					$html .= '				</a>';
					$html .= '			</div>';
					$html .= '		</div>';
					$html .= '	</td>';
					$html .= '</tr>';
					$html .=  $detail;
					$html .= $this->loopTreeListSub($value->org_id,$org_profile_id,'',$root,$type);
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

	public function getTreeList($org_profile_id,$org_id,$html,$type=1)
	{
		$this->select('*');
		$this->where('org_profile_id',$org_profile_id);
		$this->where('org_parent',$org_id);
		$this->where('profileType',$type);
		// $this->from('tree');
		$this->orderBy('order_no','ASC');
		$data = $this->get()->getResult();

		foreach( $data as $key => $value ){
			$name = $value->org_name;
			$link = $type == 1 ? base_url('StructureByAssistRate/form/'.$value->org_id) : base_url('StructureByAssistRatePRMN/form/'.$value->org_id);
			$html .= '<tr>';
			$html .= '	<td colspan="10" class="hl-l-bar-1">';
			$html .= '		<div class="ms-0 d-inline">';
			$html .= ' 			<span>'.$name.'</span>';
			$html .= '			<div class="float-end">';
			$html .= "				<a class=\"btn btn-default\" href=\"".$link."\">";
			$html .= "					<i class=\"mdi mdi-plus-circle-outline\"></i>&nbsp;เพิ่มตำแหน่ง";
			$html .= '				</a>';
			$html .= '			</div>';
			$html .= '		</div>';
			$html .= '	</td>';
			$html .= '</tr>';
			$html .= $this->loopTreeListSub($value->org_id,$org_profile_id,'',1,$type);
		}

		return $html;
	}

	public function getOrgListSub($org_id,$org_profile_id,$html,$root,$type){
        
		$this->select('*');
		$this->where('org_profile_id',$org_profile_id);
		$this->where('org_parent',$org_id);
		$this->where('profileType',$type);
		$this->orderBy('order_no','ASC');
		$root+=1;
		$data = $this->get()->getResult();
			if(count($data)>0){
				foreach( $data as $key => $value ){
					
					$name = $value->org_name;
					$linkAdd =base_url('OrganizeProfile/structureForm/'.$org_profile_id.'/'.$value->org_id.'');
					$linkEdit =base_url('OrganizeProfile/structureForm/'.$org_profile_id.'/'.$value->org_parent.'/'.$value->org_id.'');
					$cls = 'collapseExample'.$value->org_id;
					$html .= '<tr>';
					$html .= '	<td colspan="10" class="hl-l-bar-'.$root.'">';
					$html .= '		<div class="ms-0 d-inline">';
					$html .= '<a class="btn btn-default" data-bs-toggle="collapse" href=".'.$cls.'" aria-expanded="false" aria-controls="'.$cls.'">'.str_repeat('&nbsp;&nbsp;',$root).'&nbsp;&nbsp;'.$name.'</a>';
					$html .= '			<div class="float-end">';
					$html .= '				<a class="btn btn-default" href="'.$linkAdd.'">';
					$html .= '					<i class="mdi mdi-plus-circle-outline"></i>&nbsp;เพิ่มหน่วยงาน';
					$html .= '				</a>';
					$html .= '				<a class="btn btn-default" href="'.$linkEdit.'">';
					$html .= '					<i class="mdi mdi-plus-circle-outline"></i>&nbsp;แก้ไข';
					$html .= '				</a>';
					$html .= '			</div>';
					$html .= '		</div>';
					$html .= '	</td>';
					$html .= '</tr>';
					$html .= $this->getOrgListSub($value->org_id,$org_profile_id,'',$root,$type);
				}
		}
		return $html;
	}

	public function getOrgList($org_profile_id,$org_id,$html,$type=1)
	{
		$this->select('*');
		$this->where('org_profile_id',$org_profile_id);
		$this->where('org_parent',$org_id);
		$this->where('profileType',$type);
		$this->orderBy('order_no','ASC');
		$data = $this->get()->getResult();

		foreach( $data as $key => $value ){
			$name = $value->org_name;
			$linkAdd =base_url('OrganizeProfile/structureForm/'.$org_profile_id.'/'.$value->org_id.'');
			$linkEdit =base_url('OrganizeProfile/structureForm/'.$org_profile_id.'/'.$value->org_parent.'/'.$value->org_id.'');
			$html .= '<tr>';
			$html .= '	<td colspan="10" class="hl-l-bar-1">';
			$html .= '		<div class="ms-0 d-inline">';
			$html .= ' 			<span>'.$name.'</span>';
			$html .= '			<div class="float-end">';
			$html .= '				<a class="btn btn-default" href="'.$linkAdd.'">';
			$html .= '					<i class="mdi mdi-plus-circle-outline"></i>&nbsp;เพิ่มหน่วยงาน';
			$html .= '				</a>';
			$html .= '				<a class="btn btn-default" href="'.$linkEdit.'">';
			$html .= '					<i class="mdi mdi-plus-circle-outline"></i>&nbsp;แก้ไข';
			$html .= '				</a>';
			$html .= '			</div>';
			$html .= '		</div>';
			$html .= '	</td>';
			$html .= '</tr>';
			$html .= $this->getOrgListSub($value->org_id,$org_profile_id,'',1,$type);
		}

		return $html;
	}

}

<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\GeneralModel;

class OrganizeForcesModel extends Model
{
	protected $DBGroup = ('usermanager');
    protected $table      = 'organize_to_profile';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
	
		
		$this->generalModel = new GeneralModel();
		$this->num = 0;
	}

	public function getOrganizeDetail($org_id)
	{
		$typeForce = @$_GET['typeForce'];

		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '{$typeForce}'","left");
		// $builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.statusPackingRate != '2' AND t2.typeForce = '{$typeForce}'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		$builder->where('t1.org_id',$org_id);
		$builder->orderBy("t1.org_id ASC,t1.positionMapID ASC");
		$result = $builder->get()->getResult();
		$html = '';
		$position = $this->generalModel->getPositionList();
		$positionGroup = $this->generalModel->getPositionGroupList();
		$positionCivilian = $this->generalModel->getPositionCivilianList();
		$positionCivilianGroup = $this->generalModel->getPositionCivilianGroupList();
		$rank = $this->generalModel->getPositionRankList();
		$rankShort = $this->generalModel->getPositionRankShortList();
		$codePrefixShort = $this->generalModel->getcodePrefixShort();
		
		if(count($result)>0){
			foreach( $result as $key => $value ){
				$this->num++;
				$positionTxt = $position[$value->positionID];
				$positionGroupTxt = !empty($value->positionGroupID)?$positionGroup[$value->positionGroupID]:'-';
				$positionCivilianTxt = !empty($value->positionCivilianID)?$positionCivilian[$value->positionCivilianID]:'-- --';
				$positionCivilianGroupTxt = !empty($value->positionCivilianGroupID)?$positionCivilianGroup[$value->positionCivilianGroupID]:'-';
				$rankTxt = !empty($value->rankID)?$rankShort[$value->rankID]:'-';
				$positionNumberTxt = $value->positionNumber;
				$fullName = $value->firstName.' '.$value->lastName;
				$personalPositionCivilianTxt = !empty($value->personalPositionCivilianID)?$positionCivilian[$value->personalPositionCivilianID]:'';

				$css_bg = ($value->statusPackingRate == '1')?"background: yellow;":(($value->statusPackingRate == '2')?"background: #f46a6a;":(($value->statusPackingRate == '3')?"background: #ffffff;":""));
				$html .= '	<tr class="collapseExample'.$value->org_id.' show" style="vertical-align: middle;'.$css_bg.'"> ';
				$html .= '	<td class="text-center" style="width:6rem;">'.$this->num.'</td>';
				$html .= '	<td scope="row"> '.$positionTxt.'</td>'; //ชื่อตำแหน่งใน กอ.รมน./>ชื่อตำแหน่งในการบริหาร
				$html .= '	<td><div class="dhx_demo-active">'.$rankTxt.'</div></td>'; //ชั้นยศ
				$html .= '	<td>'.$positionNumberTxt.'</td>'; //ตำแหน่งเลขที่

				if($value->mId != ''){
					$codePrefixTxt = !empty($value->codePrefix)?$codePrefixShort[$value->codePrefix]:'-';
					$html .= '	<td>'.$codePrefixTxt.'</td>';//ยศ
					$html .= '	<td>';
					$html .= $fullName;
					$html .= '	</td>';//ชื่อ-สกุล
					$html .= '	<td>'.$personalPositionCivilianTxt.'</td>';//ตำแหน่งและสังกัดปกติ
				}else{
					$html .= '	<td></td>';//ยศ
					$html .= '	<td>';
					$html .= '		<div class="dhx_demo-danger">-- ว่าง --</div>';
					$html .= '	</td>';//ชื่อ-สกุล
					$html .= '	<td></td>';//ตำแหน่งและสังกัดปกติ
				}
				$html .= '	<td style="width: 13rem;text-align:center;">';

				if($value->mId != ''){
					if($value->statusPackingRate == '3'){
						$html .= '			<div class="col-auto pe-md-0">';
						$html .= '				<div class="form-group mb-0">';
						$html .= '					<button class="btn  btn-danger w-xs btn_distribute" data-bs-toggle="modal" data-bs-target="#distributeModal" onclick="checkDistribute(\''.$value->mId.'\',\''.$rankTxt.'\',\''.$fullName.'\',\''.$personalPositionCivilianTxt.'\',\''.$typeForce.'\')">';
						$html .= '						<i class="mdi mdi-close-circle-outline"></i>&nbsp;พ้น';
						$html .= '					</button>';
						$html .= '				</div>';
						$html .= '			</div>';
					}
				}else{
					$html .= '			<div class="col-auto pe-md-0">';
					$html .= '				<div class="form-group mb-0">';
					$html .= '					<button class="btn  btn-primary w-md btn_search" data-bs-toggle="modal" data-bs-target="#searchModal" onclick="checkSearch('.$value->positionMapID.','.$typeForce.')">';
					$html .= '						<i class="mdi mdi-plus-circle-outline"></i>&nbsp;บรรจุอัตรา';
					$html .= '					</button>';
					$html .= '				</div>';
					$html .= '			</div>';
				}
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
					$html .= '	<td colspan="8" class="line_bar-'.$root.'">';
					$html .= '		<div class="ms-0 d-inline custom-code bar-'.$root.'">';
					$html .= '<a class="btn btn-default" data-bs-toggle="collapse"
									href=".'.$cls.'" aria-expanded="false" aria-controls="'.$cls.'">
									'.str_repeat('&nbsp;&nbsp;',$root).$icon.'&nbsp;&nbsp;'.$name.'
								</a>';

					$html .= '			<div class="float-end">';
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
			$html .= '	<td colspan="8" class="line_bar">';
			$html .= '		<div class="ms-0 d-inline custom-code bar-1">';
			$html .= ' 			<span>'.$name.'</span>';
			$html .= '			<div class="float-end">';
			$html .= '			</div>';
			$html .= '		</div>';
			$html .= '	</td>';
			$html .= '</tr>';
			$html .= $this->loopTreeListSub($value->org_id,$org_profile_id,'',1);
		}

		return $html;
	}

}

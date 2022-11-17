<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\GeneralModel;
use App\Models\DataPersonalForcesModel;
use App\Models\DataPositionMapOrganizeModel;
use App\Models\DataPersonalForcesMapModel;
use App\Libraries\CompareText;

class OrganizeModel extends Model
{
	protected $DBGroup = ('usermanager');
    protected $table      = 'organize_to_profile';
	protected $primaryKey = 'org_id';
	protected $allowedFields = ['org_profile_id','org_id','org_profile_year','org_name','org_short_name','org_parent','org_type','order_no','profileType'];

	private $nullOrgID = 133;//รออัพเดตข้อมูลหน่วยงาน

	public function __construct() {
		parent::__construct();
	
		
		// $this->load->model('GeneralModel');
		$this->generalModel = new GeneralModel();
		$this->dataPersonalForcesModel = new DataPersonalForcesModel();
		$this->dataPositionMapOrganizeModel = new DataPositionMapOrganizeModel();
		$this->dataPersonalForcesMapModel = new DataPersonalForcesMapModel();
		$this->dataPersonal = 'DataPersonal';
		$this->dataPersonalForce = 'DataPersonalForces';
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
				$positionTxt = !empty($position[$value->positionID]) ? $position[$value->positionID] : '';
				$personalTypeTxt = !empty($personalType[$value->positionType]) ? $personalType[$value->positionType] : '';
				$positionGroupTxt = !empty($value->positionGroupID) && isset($positionGroup[$value->positionGroupID])?$positionGroup[$value->positionGroupID]:'-';
				$positionCivilianTxt = !empty($value->positionCivilianID)?$positionCivilian[$value->positionCivilianID]:'-- --';
				$positionCivilianGroupTxt = !empty($value->positionCivilianGroupID)?$positionCivilianGroup[$value->positionCivilianGroupID]:'-';
				$rankTxt = !empty($value->rankID) && !empty($rank[$value->rankID])?$rank[$value->rankID]:'-';
				$rankTxt .= !empty($value->rankIDTo) && !empty($rank[$value->rankIDTo])?'-'.$rank[$value->rankIDTo]:'';
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

	public function getTempImport($id)
	{
		$db = db_connect();
		$builder = $db->table('TmpImportExcel');
		$builder->where('uploadId',$id);
		$result = $builder->get()->getResult();
		return $result;
	}

	public function importToDB($id,$profileId)
	{
		$db = db_connect();
		$builder = $db->table('TmpImportExcel');
		$builder->where('uploadId',$id);
		$result = $builder->get()->getResultArray();
		// echo "<pre>";
		// print_r($result);
		// die();
		$db->transBegin();
		$tempPositionMapId = array();
			foreach($result as $key => $value){
				$prefix_original = addslashes(trim($value['prename']));//ตัด html tag ออก
				$transfrom_prefix = $this->translateOcrPrefix($prefix_original);//แปลงคำนำหน้าให้เป็น code
				if ($transfrom_prefix == '') {//หากหาคำนำหน้าไม่เจอ กำหนดเป็น ไม่ระบุ
					$prefix_nohave = 'ไม่ระบุ';
					$search_prefix = $this->transfromText2Code($prefix_nohave, 'DSLPrefix', 'shortPrefix', 'titlePrefix', 'codePrefix', '','master');
					$transfrom_prefix = $search_prefix;
				}
				$fname = addslashes(trim($value['firstname']));
				$lastname = addslashes(trim($value['lastname']));
				$allOrg = addslashes(trim($value['orgId1']) . '|'
				. trim($value['orgId2']) . '|'
				. trim($value['orgId3']) . '|'
				. trim($value['orgId4']) . '|'
				. trim($value['orgId5']) . '|'
				. trim($value['orgId6']) . '|'
				. trim($value['orgId7']) . '|'
				. trim($value['orgId8']) . '|'
				. trim($value['orgId9']) . '|'
				. trim($value['orgId10']) . '|'
				. trim($value['orgId11']) . '|'
				. trim($value['orgId12'])
				);
				$allOrg = str_replace(array('
		'), '', $allOrg);// replace newline
				$allIsocPosition = addslashes(trim($value['position']));
					$allIsocPosition = str_replace(array('
			'), '', $allIsocPosition);// replace newline

				$positionID = $this->transfromText2Code($value['positionName'], 'STDPosition', '', 'positionName','positionID', '', 'master');
				$positionGroupID = $this->transfromText2Code($value['positionGroup'], 'STDPositionGroup', '', 'positionGroupName', 'positionGroupID', '', 'master');
				$positionCivilianID = $this->transfromText2Code($value['positionCivilian'], 'STDPositionCivilian', '', 'positionCivilianName', 'positionCivilianID', '', 'master');
				$positionCivilianGroupID = $this->transfromText2Code($value['level'], 'STDPositionCivilianGroup', '', 'positionCivilianGroupName', 'positionCivilianGroupID', '', 'master');
				$positionType = $this->transfromText2Code($value['positionType'], 'STDPersonalType', 'personalTypeShortName', 'personalTypeName', 'personalTypeID', '', 'master');
				$rank = explode("-",$value['rank']);
				if (!empty($rank)) {
					if ($rank[0] != '') {
						$rankID = $this->transfromText2Code($rank[0], 'STDPositionRank', 'randShortName', 'rankName', 'rankID', '', 'master');
					} else {
						$rankID = '';
					}
					
					if (isset($rank[1]) && $rank[1] != '') {
						$rankIDTo = $this->transfromText2Code($rank[1], 'STDPositionRank', 'randShortName', 'rankName', 'rankID', '', 'master');
					} else {
						$rankIDTo = '';
					}
				} else {
					$rankID = '';
					$rankIDTo = '';
				}
				$org_id = $this->findOrgByText(explode('|', $allOrg));
				if ($key == 0) {
					// $builder = $db->table('DataPositionMapOrganize');
					// $builder->where('org_id',$org_id);
					// $builder->where('profileID',$profileId);
					// $tmpMapPosition = $builder->select()->get()->getCustomRowObject(0,'positionMapID');
					// echo "<pre>";
					// print_r($tmpMapPosition);
					// die();
					// Delete date
					$builder = $db->table('DataPositionMapOrganize');
					$builder->where('org_id',$org_id);
					$builder->where('profileID',$profileId);
					$builder->delete();
				}
				$data['positionID'] = $positionID ;
				$data['positionGroupID'] = $positionGroupID ;
				$data['positionCivilianID'] = $positionCivilianID ;
				$data['positionCivilianGroupID'] = $positionCivilianGroupID ;
				$data['positionType'] = $positionType ;
				$data['rankID'] = $rankID ;
				$data['rankIDTo'] = $rankIDTo ;
				$data['org_id'] = $org_id ;
				$data['positionNumber'] = $value['positionNo'];
				$data['ordering'] = '0';
				$data['activeStatus'] = '1';
				$data['profileType'] = $value['profileType'];
				$data['profileID'] = $profileId;
				$this->dataPositionMapOrganizeModel->insert($data);
				$positionMapID = $this->dataPositionMapOrganizeModel->insertID();

				// 
				$pid = $this->matchDataPersonal(trim($value['cardId']), trim($fname), trim($lastname));
				
				if ($pid != '') {//========== กรณีที่พบข้อมูลใน personal
					$sql_update = 'UPDATE ' . $this->dataPersonal . ' SET
								belongTo = \'' . addslashes(trim($value['orgId1'])) . '\',
								cardID = IF(cardID IS NULL OR cardID = \'\', \'' . trim($value['cardId']) . '\', cardID)
								WHERE pid = \'' . $pid . '\'';
					$db->query($sql_update);
					// $this->dataPersonalForcesModel->save($personalData);
				} else {//========== เพิ่มข้อมูลใหม่ใน data_personal กรณีที่ไม่พบข้อมูลใน personal
					
					$builderPerson = $db->table($this->dataPersonal);
					$personDdata = [
						'cardID' => trim($value['cardId']),
						'hrTypeID' => $positionType,
						'codePrefix' => $transfrom_prefix,
						'firstName' => $fname,
						'lastName' => $lastname,
						'originPosition' => $allOrg,
						'orgID' => $org_id,
						'isocPosition' => $allIsocPosition,
						'belongTo' => addslashes(trim($value['orgId1'])),
						'createDate' => 'NOW()',
						'updateTime' => 'NOW()',
						'refID' => '',
						'profileType' => $value['profileType']
					];
					$builderPerson->insert($personDdata);
					$pid =  $db->insertID();
					
				}

				$fid = $this->matchDataPersonalForce(trim($value['cardId']), trim($fname), trim($lastname));

				if ($fid != '') {//========== กรณีที่พบข้อมูลใน personal
					$sql_update = 'UPDATE ' . $this->dataPersonalForce . ' SET
								cardID = IF(cardID IS NULL OR cardID = \'\', \'' . trim($value['cardId']) . '\', cardID)
								WHERE fid = \'' . $fid . '\'';
					$db->query($sql_update);
				} else {//========== เพิ่มข้อมูลใหม่ใน data_personal กรณีที่ไม่พบข้อมูลใน personal
					
					$personalDataForce = array();
					$personalDataForce['pid'] = $pid;
					$personalDataForce['cardID'] = trim($value['cardId']);
					$personalDataForce['hrTypeID'] = $positionType;
					$personalDataForce['codePrefix'] = '';
					$personalDataForce['firstName'] = $fname;
					$personalDataForce['lastName'] = $lastname;
					$personalDataForce['orgID'] = $org_id;
					$personalDataForce['positionID'] = $positionID;
					$personalDataForce['positionGroupID'] = $positionGroupID;
					$personalDataForce['positionCivilianID'] = $positionCivilianID;
					$personalDataForce['positionCivilianGroupID'] = $positionCivilianGroupID;
					$personalDataForce['isocPosition'] = $allIsocPosition;
					$personalDataForce['status'] = '0';
					$personalDataForce['profileType'] = $value['profileType'];
					$this->dataPersonalForcesModel->insert($personalDataForce);
					$fid = $this->dataPersonalForcesModel->insertID();
				}
				if ($key == 0) {
					# deleteForceMap
				}
				// 
				$personalMap['fId'] = $fid;
				$personalMap['typeForce'] = $positionType;
				$personalMap['positionMapID'] = $positionMapID;
				$personalMap['statusPackingRate'] = '1';
				$personalMap['dateBegin'] = '';
				$personalMap['dateEnd'] = '';
				$personalMap['createDate'] = 'NOW()';
				$personalMap['updateTime'] = 'NOW()';
				$this->dataPersonalForcesMapModel->save($personalMap);
			}
		if ($db->transStatus() === false) {
			$db->transRollback();
			return false;
		} else {
			$db->transCommit();
			return true;
		}
	}


	private function findOrgByText($IsocPosition = array(), $debug = 0)
    {
        $output_org_id = $this->nullOrgID;

		if (!empty($IsocPosition)) {
            $arrIsocPosition = array();
            foreach ($IsocPosition as $isocp) {
                if ($isocp != '') $arrIsocPosition[] = $isocp;
            }
            ksort($arrIsocPosition);

            foreach ($arrIsocPosition as $index => $isocp) {
                $search_orgID = $this->transfromText2Code(
                    addslashes(trim($isocp)),
                    'organize_to_profile',
                    'org_short_name',
                    'org_name',
                    'org_id',
                    '',
					'usermanager',
                    $debug
                );
                if ($search_orgID != '' && $search_orgID > 1) {
                    $output_org_id = $search_orgID;
                    break;
                }
            }
        }
        return $output_org_id;
    }

	private function transfromText2Code(
        $str = '',//ข้อความที่จะแปลง
        $table_compare = '', //ตารางที่จะไปเปรียบเทียบ
        $field_shortname = '', //ฟิลล์ที่ไปเปรียบเทียบแบบสั้น
        $field_fullname = '', //ฟิลล์ที่ไปเปรียบเทียบแบบเต็ม
        $field_code = '', //ฟิลล์ code ที่จะนำค่าไปใช้
        $replacement = '', //กำหนดค่าหากต้องการเอาข้อความบางส่วนออกก่อนเปรียบเทียบ
		$dbname = '', //ฐานข้อมูลที่จะไปเปรียบเทียบ
        $debug = 0 //debug level
    )
    {
        $output = '';
        if ($str != '') {
            $search_list = $this->getListSearch($str, $table_compare, $field_shortname, $field_code, $dbname);//นำค่าที่ต้องการไปหาในฐานข้อมูล
            $search_short = CompareText::compareText($str, $search_list, $debug);//หาเปอร์เซ็นความเหมือน
            if ($search_short == null && $field_fullname != '') {
                $search_list_full = $this->getListSearch($str, $table_compare, $field_fullname, $field_code, $dbname);
                $search_short = CompareText::compareText($str, $search_list_full, $debug);
                if ($search_short != null) {
                    $output = $search_short;
                }
            } else {
                $output = $search_short;
            }
            if ($replacement != '' && count($search_list) > 0) {
                $search_list_replacement = array();
                $str_replacement = str_replace($replacement, '', $str);
                foreach ($search_list as $key => $val) {
                    $search_list_replacement[$key] = str_replace($replacement, '', $val);
                }
                $search_short = CompareText::compareText($str_replacement, $search_list_replacement, $debug);
                if ($search_short != null) {
                    $output = $search_short;
                }
            } else {
                $output = $search_short;
            }
        }
        return $output;
    }

	private function translateOcrPrefix($str = ''){
        $output = '';
        if($str != ''){
            $search_list = $this->getListSearch($str, 'DSLPrefix', 'shortPrefix', 'codePrefix','master');
            $search_short = CompareText::compareText($str, $search_list);
            if($search_short == null){
                $search_list = $this->getListSearch($str, 'DSLPrefix', 'titlePrefix', 'codePrefix','master');
                $search_short = CompareText::compareText($str, $search_list);
                if($search_short != null){
                    $output = $search_short;
                }
            }else{
                $output = $search_short;
            }
        }
        return $output;
    }

	private function getListSearch($txt_input = '', $table = '', $field_search = '', $field_output = '', $dbname = '')
    {
        $output = array();
        if ($txt_input != '' && $table != '' && $field_search != '' && $field_output != '') {
			$db = db_connect($dbname);
            $sql = "SELECT $field_output , $field_search  FROM  $table  WHERE $field_search LIKE '".iconv_substr($txt_input, 0, 1, 'UTF-8')."%' ORDER BY " . $field_output;
			$builder = $db->query($sql);
            $arr_search = $builder->getResultArray();
            if (!empty($arr_search)) {
                foreach ($arr_search as $v) {
                    $output[$v[$field_output]] = $v[$field_search];
                }
            }
        }
        return $output;
    }

	private function matchDataPersonal($idcard = '', $firstName = '', $lastName = '')
    {
        $db = db_connect();
        $sql = "SELECT pid FROM " . $this->dataPersonal . " WHERE cardID = '{$idcard}' OR (firstName = '{$firstName}' and lastName = '{$lastName}')";
        $result = $db->query($sql);
        $row = $result->getRowArray();
        return isset($row['pid'])?$row['pid']:'' ;
    }

	private function matchDataPersonalForce($idcard = '', $firstName = '', $lastName = '')
    {
        $db = db_connect();
        $sql = "SELECT pid FROM " . $this->dataPersonalForce . " WHERE cardID = '{$idcard}' OR (firstName = '{$firstName}' and lastName = '{$lastName}')";
        $result = $db->query($sql);
        $row = $result->getRowArray();
        return isset($row['pid'])?$row['pid']:'' ;
    }
}

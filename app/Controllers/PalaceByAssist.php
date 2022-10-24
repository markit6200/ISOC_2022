<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\OrganizeForcesModel;
use App\Models\GeneralModel;
use App\Models\DataPersonalForcesMapModel;
use App\Models\DataPersonalForcesModel;

class PalaceByAssist extends BaseController
{
	protected $perPage = 20;

	public function __construct()
    {
		$this->DataPersonalForcesMapModel = new DataPersonalForcesMapModel();
		$this->personalForcesModel = new DataPersonalForcesModel();
		$this->generalModel = new GeneralModel();
    }

	public function index()
	{
		$org = new OrganizeForcesModel();
		$tree = $org->getTreeList(1,0,'');

		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'ระบบทำเนียบกำลังพลตามอัตราช่วยราชการ กอ.รมน.']),
			'page_title' => view('partials/page-title', ['title' => 'ระบบทำเนียบกำลังพลตามอัตราช่วยราชการ กอ.รมน.']),
			
		];
		if($_GET['typeForce'] == 1){
			$data['title'] = 'ระบบทำเนียบกำลังพลตามอัตราช่วยราชการ กอ.รมน.';
		}else{
			$data['title'] = 'ระบบทำเนียบกำลังพลตามอัตรา  สง.ปรมน.ทบ., สน.ปรมน.จว.';
		}
		$data['datas'] = '';
		$data['table_content'] = $tree;
		// $data['personal'] = $dataPersonal;

		// $personalData = $this->personalForcesModel->select("*");
		// if ($txtSearch = $this->request->getGet('search')){
		// 	$where = "cardID LIKE '%{$txtSearch}%' OR firstName LIKE '%{$txtSearch}%' OR lastName LIKE '%{$txtSearch}%'";
		// 	$personalData->where($where);
		// }
		// $personal = $personalData->paginate($this->perPage, 'bootstrap');

		// $codePrefixShort = $this->generalModel->getcodePrefixShort();
        // $positionCivilian = $this->generalModel->getPositionCivilianList();
		// if(!empty($personal)){
		// 	foreach($personal AS $key=>$value){
		// 		$arr_personal[$key] = $value;
		// 		$arr_personal[$key]['codePrefixTxt'] = !empty($value['codePrefix'])?$codePrefixShort[$value['codePrefix']]:'-';
        //         $arr_personal[$key]['personalPosition'] = !empty($value['positionCivilianID'])?$positionCivilian[$value['positionCivilianID']]:'';
		// 	}
		// }	

		// $data['personal'] = $arr_personal;
		// // echo '<pre>'; print_r($data['personal']); echo '</pre>'; exit;
		// $data['pager'] = $this->personalForcesModel->pager;
		// $data['currentPage'] =$this->personalForcesModel->pager->getCurrentPage('bootstrap'); // The current page number
        // $data['totalPages']  = $this->personalForcesModel->pager->getPageCount('bootstrap');   // The total page count
		// $data['perPage'] = $this->perPage;
		$data['typeForce'] = $_GET['typeForce'];

		return view('palaceByAs/index', $data);
	}

	public function view()
	{
		exit;
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
		];
		return view('palaceByAs/view', $data);
	}

	public function form()
	{
		exit;
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
		];
		return view('palaceByAs/form', $data);
	}

	public function savePalace()
    {
        $params = [
			'fId' => $_POST['fId'],
			'typeForce' => $_POST['typeForce'], //ประเภทกำลังพล 1=กอ.รมน.,2=สง.ปรมน.ทบ., สน.ปรมน.จว.
			'statusPackingRate' => '3', //สถานะ 3=รอออกคำสั่ง
			'positionMapID' => $_POST['positionMapID'],
			'createDate' => date("Y-m-d H:i:s")
        ];

        if ($this->DataPersonalForcesMapModel->save($params)) {
			$result = 'success';
        } else {
			$result = 'error';
        }
		return $result;
    }

	public function updateDistribute()
    {
        $params = [
			'mId' => $_POST['mId'],
			'statusPackingRate' => '2', //สถานะ 2=พ้น
			'directiveRetire' => date("Y-m-d H:i:s"), //คำสั่งพ้น
			'dateRetire' => date("Y-m-d H:i:s"), //วันที่พ้น
			// 'dateOffPackingRate' => date("Y-m-d H:i:s"), //วันที่พ้นบรรจุอัตรา
        ];

        if ($this->DataPersonalForcesMapModel->save($params)) {
			$result = 'success';
        } else {
			$result = 'error';
        }
		return $result;
    }

	public function searchPersonal()
	{

		$personalData = $this->personalForcesModel->select("*");
		// $where = "fid NOT IN (SELECT fid FROM DataPersonalForcesMap WHERE statusPackingRate = '1' GROUP BY fid) AND profileType = 1 ";
		$where = "fid NOT IN (SELECT fid FROM DataPersonalForcesMap WHERE statusPackingRate != '2' GROUP BY fid) AND profileType = 1 ";
		if ($txtSearch = $this->request->getPost('search')){
			$where .= " AND (cardID LIKE '%{$txtSearch}%' OR firstName LIKE '%{$txtSearch}%' OR lastName LIKE '%{$txtSearch}%')";
		}
		$personalData->where($where);
		
		$personal = $personalData->paginate($this->perPage, 'bootstrap');

		$codePrefixShort = $this->generalModel->getcodePrefixShort();
        $positionCivilian = $this->generalModel->getPositionCivilianList();
		if(!empty($personal)){
			foreach($personal AS $key=>$value){
				$arr_personal[$key] = $value;
				$arr_personal[$key]['codePrefixTxt'] = !empty($value['codePrefix'])?@$codePrefixShort[@$value['codePrefix']]:'-';
				$arr_personal[$key]['personalPosition'] = !empty($value['positionCivilianID'])?$positionCivilian[$value['positionCivilianID']]:'';
			}
		}

		$html = '';
		$runno = 0;
		if(!empty($arr_personal)){
			foreach($arr_personal AS $value){
				$runno++;
				$fId = $value['fid'];
				
			$html .= '<tr>
						<td class="text-center" rowspan="">'.$runno.'</td>
						<td class="text-center" rowspan="">'.$value['cardID'].' </td>
						<td class="text-left" rowspan="">'.$value['codePrefixTxt'].$value['firstName'].' '.$value['lastName'].'</td>
						<td class="text-center">'.$value['personalPosition'].'</td>
						<td class="text-center">
							<div class="col-auto pe-md-0">
								<div class="form-group mb-0">
									<button class="btn btn-primary" onclick="addPalace('.$fId.')">
										<x-orchid-icon path="fa.plus" />&nbsp;เพิ่ม
									</button>
								</div>
							</div>
						</td>
					</tr>';
			}
		}

		return $html;
	}

	public function saveRequestDirective()
    {
		// echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
		if(!empty($_POST['checkBoxReqName'])){
			foreach($_POST['checkBoxReqName'] AS $key){
				$params = [
					'mId' => $key,
					'statusPackingRate' => $_POST['statusPackingRate'], //สถานะ
					'directiveBegin' => $_POST['directiveBegin'], //คำสั่งปฏิบัติ
					'dateBegin' => @$this->ConvertToSQLDate($_POST['dateBegin']), //วันที่ปฏิบัติ
					'dateEnd' => @$this->ConvertToSQLDate($_POST['dateEnd']) //วันที่สิ้นสุด
				];
				$this->DataPersonalForcesMapModel->save($params);
			}
		}
		
		return redirect()->to('PalaceByAssist?typeForce=1');
    }

	function ConvertToSQLDate($date,$type='en') {
		if(!empty($date)) {
			if(strpos($date, "/")!==false) {
				$x = explode("/", $date);
				if($type=='th'){
					$x[2] = ($x[2] - 543);
				}else{
					$x[2] = ($x[2]);
				}
				$x[1] = sprintf("%02d", (int)$x[1]);
				$return = "{$x[2]}-{$x[1]}-{$x[0]}";
				
			} elseif(strpos($date, "-")!==false) {
				$x = explode("-", $date);
				$x[0] = ($x[0] - 543);
				$x[1] = sprintf("%02d", (int)$x[1]);
				$return = "{$x[0]}-{$x[1]}-{$x[2]}";
			} else $return = "0000-00-00";
		} else $return = "";
		return $return;
	}

	function mydate2date($date, $time = false, $lang = "th") {
		if ($date != '') {
			if ($lang == "th") {
				$tmp = explode(" ", $date);
				if ($tmp[0] != "" && $tmp[0] != "0000-00-00") {
					$d = explode("-", $tmp[0]);
					$str = $d[2] . "/" . $d[1] . "/" . ($d[0] > 2500 ? $d[0] : $d[0] + 543);
					if ($time) {
						$t = strtotime($date);
						$str .= " " . date("H:i", $t);
					}
				}
			} else {
				$str = empty($date) || $date == "0000-00-00 00:00:00" || $date == "0000-00-00" ? "" : date("d/m/Y" . ($time ? " H:i" : ""), strtotime($date));
			}

			return $str;
		} else {
			return '';
		}
	}

	public function dataPersonalForces()
	{
		$arrReqD = $this->request->getPost('ReqD');
		$org_id = $this->request->getPost('org_id');
		
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '1'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		$builder->where("t2.mId IN (".implode(',',array_filter($arrReqD)).") ");
		$builder->orderBy("t1.org_id ASC,t1.positionMapID ASC");
		$result = $builder->get()->getResult();
		//AND t1.org_id = '{$org_id }'
		// echo $db->getLastQuery(); exit;

		$position = $this->generalModel->getPositionList();
		$positionGroup = $this->generalModel->getPositionGroupList();
		$positionCivilian = $this->generalModel->getPositionCivilianList();
		$positionCivilianGroup = $this->generalModel->getPositionCivilianGroupList();
		$rank = $this->generalModel->getPositionRankList();
		$rankShort = $this->generalModel->getPositionRankShortList();
		$codePrefixShort = $this->generalModel->getcodePrefixShort();

		$html = '';
		$runno = 0;
		if(!empty($result)){
			foreach($result AS $value){
				$runno++;
				
				$positionTxt = $position[$value->positionID];
				$rankTxt = !empty($value->rankID)?$rankShort[$value->rankID]:'-';
				$positionNumberTxt = $value->positionNumber;
				$fullName = $value->firstName.' '.$value->lastName;
				$personalPositionCivilianTxt = !empty($value->personalPositionCivilianID)?$positionCivilian[$value->personalPositionCivilianID]:'';
				$codePrefixTxt = !empty($value->codePrefix)?$codePrefixShort[$value->codePrefix]:'-';
				$html .= '<tr id="R'.$value->mId.'">
							<td class="text-center" rowspan="">'.$runno.'</td>
							<td class="text-center" rowspan="">'.$positionTxt.' </td>
							<td class="text-left" rowspan="">'.$rankTxt.'</td>
							<td class="text-center">'.$positionNumberTxt.'</td>
							<td class="text-center">'.$codePrefixTxt.'</td>
							<td class="text-center">'.$fullName.'</td>
							<td class="text-center">'.$personalPositionCivilianTxt.'</td>
							<td class="text-center">
								<div class="col-auto pe-md-0">
									<div class="form-group mb-0">
										<button class="btn btn-danger" onclick="delRow('.$value->mId.')">
											<x-orchid-icon path="fa.plus" />&nbsp;ลบ
										</button>
									</div>
								</div>
							</td>
						</tr>';
			}
		}

		return $html;
	}

	//เช็คสถานะ 4=ร้องขอออกคำสั่ง
	public function chkRequestDirective()
	{
		$org_id = $this->request->getPost('org_id');
		
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '1'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		$builder->where("t1.org_id = '{$org_id}' AND t2.statusPackingRate = '4'");
		$builder->orderBy("t1.org_id ASC,t1.positionMapID ASC");
		$result = $builder->get()->getResult();
		// echo $db->getLastQuery();

		if(!empty($result)){
			$result = 'success';
        }else {
			$result = 'error';
        }
		return $result;
	}


	public function dataForcesReq()
	{
		$org_id = $this->request->getPost('org_id');

		$arr_data = array();
		
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate,t2.directiveBegin,t2.dateBegin,t2.dateEnd,t2.directiveRetire,t2.dateRetire');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '1'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		$builder->where("t1.org_id = '{$org_id}' AND t2.statusPackingRate = '4'");
		$builder->orderBy("t1.org_id ASC,t1.positionMapID ASC");
		$result = $builder->get()->getResult();
		// echo $db->getLastQuery();
 
		$position = $this->generalModel->getPositionList();
		$positionGroup = $this->generalModel->getPositionGroupList();
		$positionCivilian = $this->generalModel->getPositionCivilianList();
		$positionCivilianGroup = $this->generalModel->getPositionCivilianGroupList();
		$rank = $this->generalModel->getPositionRankList();
		$rankShort = $this->generalModel->getPositionRankShortList();
		$codePrefixShort = $this->generalModel->getcodePrefixShort();

		$html = '';
		$input = '';
		$runno = 0;
		if(!empty($result)){
			foreach($result AS $value){
				$runno++;

				$arr_data['directiveBegin'] = $value->directiveBegin;
				$arr_data['dateBegin'] = $this->mydate2date($value->dateBegin,0,'en');
				$arr_data['dateEnd'] = $this->mydate2date($value->dateEnd,0,'en');
				
				$positionTxt = $position[$value->positionID];
				$rankTxt = !empty($value->rankID)?$rankShort[$value->rankID]:'-';
				$positionNumberTxt = $value->positionNumber;
				$fullName = $value->firstName.' '.$value->lastName;
				$personalPositionCivilianTxt = !empty($value->personalPositionCivilianID)?$positionCivilian[$value->personalPositionCivilianID]:'';
				$codePrefixTxt = !empty($value->codePrefix)?$codePrefixShort[$value->codePrefix]:'-';
				$html .= '<tr id="R'.$value->mId.'">
							<td class="text-center" rowspan="">'.$runno.'</td>
							<td class="text-center" rowspan="">'.$positionTxt.' </td>
							<td class="text-left" rowspan="">'.$rankTxt.'</td>
							<td class="text-center">'.$positionNumberTxt.'</td>
							<td class="text-center">'.$codePrefixTxt.'</td>
							<td class="text-center">'.$fullName.'</td>
							<td class="text-center">'.$personalPositionCivilianTxt.'</td>
							<td class="text-center">
								<div class="col-auto pe-md-0">
									<div class="form-group mb-0">
										<button class="btn btn-danger" onclick="delRow('.$value->mId.')">
											<x-orchid-icon path="fa.plus" />&nbsp;ลบ
										</button>
									</div>
								</div>
							</td>
						</tr>';
				
				$input .= '<input type="hidden" name="checkBoxReqName[]" value="'.$value->mId.'" class="ReqD" />';
			}
		}
		$arr_data['html'] = $html;
		$arr_data['input'] = $input;
		echo json_encode($arr_data);
	}


	public function dataPersonalRetire()
	{
		$mId = $this->request->getPost('mId');
		
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '1'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		$builder->where("t2.mId = '{$mId}'");
		$builder->orderBy("t1.org_id ASC,t1.positionMapID ASC");
		$result = $builder->get()->getResult();
		// echo $db->getLastQuery();

		$position = $this->generalModel->getPositionList();
		$positionGroup = $this->generalModel->getPositionGroupList();
		$positionCivilian = $this->generalModel->getPositionCivilianList();
		$positionCivilianGroup = $this->generalModel->getPositionCivilianGroupList();
		$rank = $this->generalModel->getPositionRankList();
		$rankShort = $this->generalModel->getPositionRankShortList();
		$codePrefixShort = $this->generalModel->getcodePrefixShort();

		$html = '';
		$runno = 0;
		if(!empty($result)){
			foreach($result AS $value){
				$runno++;
				
				$positionTxt = $position[$value->positionID];
				$rankTxt = !empty($value->rankID)?$rankShort[$value->rankID]:'-';
				$positionNumberTxt = $value->positionNumber;
				$fullName = $value->firstName.' '.$value->lastName;
				$personalPositionCivilianTxt = !empty($value->personalPositionCivilianID)?$positionCivilian[$value->personalPositionCivilianID]:'';
				$codePrefixTxt = !empty($value->codePrefix)?$codePrefixShort[$value->codePrefix]:'-';
				$html .= '<tr>
							<td class="text-center" rowspan="">'.$runno.'</td>
							<td class="text-center" rowspan="">'.$positionTxt.' </td>
							<td class="text-left" rowspan="">'.$rankTxt.'</td>
							<td class="text-center">'.$positionNumberTxt.'</td>
							<td class="text-center">'.$codePrefixTxt.'</td>
							<td class="text-center">'.$fullName.'</td>
							<td class="text-center">'.$personalPositionCivilianTxt.'</td>
						</tr>';
			}
		}

		return $html;
	}

	public function saveRequestRetire()
    {
		// echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
		if(!empty($_POST['mId'])){
				$params = [
					'mId' => $_POST['mId'],
					'statusPackingRate' => $_POST['statusPackingRate'], //สถานะ
					'directiveRetire' => $_POST['directiveRetire'], //คำสั่งพ้น
					'dateRetire' => @$this->ConvertToSQLDate($_POST['dateRetire']), //วันที่พ้น
				];
				$this->DataPersonalForcesMapModel->save($params);
		}
		
		return redirect()->to('PalaceByAssist?typeForce=1');
    }
}

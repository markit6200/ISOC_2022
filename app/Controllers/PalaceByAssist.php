<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\OrganizeForcesModel;
use App\Models\GeneralModel;
use App\Models\DataPersonalForcesMapModel;
use App\Models\DataPersonalForcesModel;
use App\Models\DataPersonalForcesMapHeadModel;
use App\Libraries\ExportExcel;
use App\Libraries\DateFunction;

class PalaceByAssist extends BaseController
{
	protected $perPage = 20;

	public function __construct()
    {
		$this->DataPersonalForcesMapModel = new DataPersonalForcesMapModel();
		$this->personalForcesModel = new DataPersonalForcesModel();
		$this->generalModel = new GeneralModel();
		$this->DataPersonalForcesMapHeadModel = new DataPersonalForcesMapHeadModel();
		$this->DateFunction = new DateFunction();
    }

	public function index()
	{
		$org = new OrganizeForcesModel();
		$tree = $org->getTreeList(1,0,'');

		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'ระบบทำเนียบกำลังพลตามอัตราช่วยราชการ กอ.รมน.']),
			'page_title' => view('partials/page-title', ['title' => 'ระบบทำเนียบกำลังพลตามอัตราช่วยราชการ กอ.รมน.','pagetitle' => '']),
			
		];
		
		$data['title'] = 'ระบบทำเนียบกำลังพลตามอัตราช่วยราชการ กอ.รมน.';
		$data['datas'] = '';
		$data['table_content'] = $tree;
		
		$data['typeForce'] = $_GET['typeForce'];

		$orderType = $this->generalModel->getOrderType();
		$data['orderType'] = $orderType;

		return view('palaceByAs/index', $data);
	}

	public function view()
	{
		exit;
	}

	public function form()
	{
		exit;
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
			//บันทึกตารางหลัก
			$paramsHead = [
				'id' => @$_POST['hID'],
				'statusDirective' => $_POST['statusDirective'], //สถานะ
				'directiveNo' => $_POST['directiveBegin'],
				'orderTypeID' => $_POST['orderTypeID'],
				'orgID' => @$_POST['rOrgId'],
				'directiveType' => '1',
			];

			// echo '<pre>'; print_r($paramsHead); echo '</pre>';
			if($this->DataPersonalForcesMapHeadModel->save($paramsHead)){
				if(@$_POST['hID'] == ''){
					$hID = $this->DataPersonalForcesMapHeadModel->insertID();
				}else{
					$hID = @$_POST['hID'];
				}
				
				foreach($_POST['checkBoxReqName'] AS $key=>$val){
						$params = [
							'mId' => $val,
							'statusPackingRate' => $_POST['statusPackingRate'], //สถานะ
							'hID' => @$hID, 
							'dateBegin' => @$this->DateFunction->ConvertToSQLDate($_POST['dateBegin'][$key]), //วันที่ปฏิบัติ
							'dateEnd' => @$this->DateFunction->ConvertToSQLDate($_POST['dateEnd'][$key]) //วันที่สิ้นสุด
						];
						$this->DataPersonalForcesMapModel->save($params);
						// echo '<pre>'; print_r($params); echo '</pre>';
				}
			}
		}
		// exit;
		if(@$_POST['showSend'] == 1){
			return redirect()->to('ReportPalaceByAssist');
		}else{
			return redirect()->to('PalaceByAssist?typeForce=1');
		}
    }

	public function dataPersonalForces()
	{
		$arrReqD = $this->request->getPost('ReqD');
		$org_id = $this->request->getPost('org_id');
		
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate,t2.hID');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '1'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		$builder->where("t2.mId IN (".implode(',',array_filter($arrReqD)).") ");
		$builder->orderBy("t1.org_id ASC,t1.positionMapID ASC");
		$result = $builder->get()->getResult();
		// echo $db->getLastQuery(); exit;

		$position = $this->generalModel->getPositionList();
		$positionGroup = $this->generalModel->getPositionGroupList();
		$positionCivilian = $this->generalModel->getPositionCivilianList();
		$positionCivilianGroup = $this->generalModel->getPositionCivilianGroupList();
		$rank = $this->generalModel->getPositionRankList();
		$rankShort = $this->generalModel->getPositionRankShortList();
		$codePrefixShort = $this->generalModel->getcodePrefixShort();
		$orderType = $this->generalModel->getOrderType();

		$html = '';
		$runno = 0;
		if(!empty($result)){
			foreach($result AS $value){
				if($org_id != $value->org_id){
					return 'error';
					exit;
				}
				$runno++;
				
				$positionTxt = $position[$value->positionID];
				$rankTxt = !empty($value->rankID)?$rankShort[$value->rankID]:'-';
				$positionNumberTxt = $value->positionNumber;
				$fullName = $value->firstName.' '.$value->lastName;
				$personalPositionCivilianTxt = !empty($value->personalPositionCivilianID)?$positionCivilian[$value->personalPositionCivilianID]:'';
				$codePrefixTxt = !empty($value->codePrefix)?$codePrefixShort[$value->codePrefix]:'-';
				$html .= '<tr id="R'.$value->mId.'">
							<td class="text-center" rowspan="">'.$runno.'<input type="hidden" name="checkBoxReqName[]" value="'.$value->mId.'" class="ReqD" /></td>
							<td class="text-center" rowspan="">'.$positionTxt.' </td>
							<td class="text-left" rowspan="">'.$rankTxt.'</td>
							<td class="text-center">'.$positionNumberTxt.'</td>
							<td class="text-center">'.$codePrefixTxt.'</td>
							<td class="text-center">'.$fullName.'</td>
							<td class="text-center">'.$personalPositionCivilianTxt.'</td>
							<td class="text-center">
								<div class="input-group" id="datepicker2">
									<input type="text" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true" id="dateBegin" name="dateBegin[]">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
							</td>
							<td class="text-center">
								<div class="input-group" id="datepicker2">
									<input type="text" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true" id="dateEnd" name="dateEnd[]">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
							</td>
							<td class="text-center">
								<div class="col-auto pe-md-0">
									<div class="form-group mb-0">
										<button class="btn btn-danger bt_del" onclick="delRow('.$value->mId.','.$value->hID.')">
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
		$org = new OrganizeForcesModel();
		$org_id = $this->request->getPost('org_id');

		$arr_data = array();
		
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate,t2.hID,t4.directiveNo AS directiveBegin,t2.dateBegin,t2.dateEnd,t4.orderTypeID,t4.statusDirective');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '1'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		$builder->join("DataPersonalForcesMapHead AS t4","t2.hID = t4.id AND t4.directiveType = 1","left");
		// $builder->join("DataPersonalForcesMapHead AS t5","t2.hIDRetire = t5.id AND t5.directiveType = 2","left");
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
		$orderType = $this->generalModel->getOrderType();

		$html = '';
		$input = '';
		$runno = 0;
		$dateBegin = '';
		$dateEnd = '';
		if(!empty($result)){
			foreach($result AS $value){
				$runno++;

				$arr_data['directiveBegin'] = $value->directiveBegin;
				$arr_data['hID'] = $value->hID;
				$arr_data['orderTypeID'] = $value->orderTypeID;
				$arr_data['org_id'] = $value->org_id;
				$dateBegin = $this->DateFunction->mydate2date($value->dateBegin,0,'en');
				$dateEnd = $this->DateFunction->mydate2date($value->dateEnd,0,'en');

				$arr_data['statusDirective'] = $value->statusDirective;

				$org_full_name = $org->org_full_name($value->org_id,1);
				$arr_data['textOrgName'] = 'สังกัด'.$org_full_name;
				
				$positionTxt = $position[$value->positionID];
				$rankTxt = !empty($value->rankID)?$rankShort[$value->rankID]:'-';
				$positionNumberTxt = $value->positionNumber;
				$fullName = $value->firstName.' '.$value->lastName;
				$personalPositionCivilianTxt = !empty($value->personalPositionCivilianID)?$positionCivilian[$value->personalPositionCivilianID]:'';
				$codePrefixTxt = !empty($value->codePrefix)?$codePrefixShort[$value->codePrefix]:'-';
				$html .= '<tr id="R'.$value->mId.'">
							<td class="text-center" rowspan="">'.$runno.'<input type="hidden" name="checkBoxReqName[]" value="'.$value->mId.'" class="ReqD" /></td>
							<td class="text-center" rowspan="">'.$positionTxt.' </td>
							<td class="text-left" rowspan="">'.$rankTxt.'</td>
							<td class="text-center">'.$positionNumberTxt.'</td>
							<td class="text-center">'.$codePrefixTxt.'</td>
							<td class="text-center">'.$fullName.'</td>
							<td class="text-center">'.$personalPositionCivilianTxt.'</td>
							<td class="text-center">
								<div class="input-group" id="datepicker2">
									<input type="text" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true" id="dateBegin" name="dateBegin[]" value="'.$dateBegin.'">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
							</td>
							<td class="text-center">
								<div class="input-group" id="datepicker2">
									<input type="text" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true" id="dateEnd" name="dateEnd[]" value="'.$dateEnd.'">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
							</td>
							<td class="text-center">
								<div class="col-auto pe-md-0">
									<div class="form-group mb-0">
										<button type="button" class="btn btn-danger bt_del" onclick="delRow('.$value->mId.','.$value->hID.')">ลบ</button>
									</div>
								</div>
							</td>
						</tr>';
				
			}
		}
		$arr_data['html'] = $html;
		$arr_data['input'] = $input;
		echo json_encode($arr_data);
	}

	public function dataPersonalRetire()
	{
		$arrReqD = $this->request->getPost('ReqD');
		$org_id = $this->request->getPost('org_id');
		
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate,t2.hIDRetire');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '1'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		$builder->where("t2.mId IN (".implode(',',array_filter($arrReqD)).") ");
		$builder->orderBy("t1.org_id ASC,t1.positionMapID ASC");
		$result = $builder->get()->getResult();
		// echo $db->getLastQuery(); exit;

		$position = $this->generalModel->getPositionList();
		$positionGroup = $this->generalModel->getPositionGroupList();
		$positionCivilian = $this->generalModel->getPositionCivilianList();
		$positionCivilianGroup = $this->generalModel->getPositionCivilianGroupList();
		$rank = $this->generalModel->getPositionRankList();
		$rankShort = $this->generalModel->getPositionRankShortList();
		$codePrefixShort = $this->generalModel->getcodePrefixShort();
		$orderType = $this->generalModel->getOrderType();

		$html = '';
		$runno = 0;
		if(!empty($result)){
			foreach($result AS $value){
				if($org_id != $value->org_id){
					return 'error';
					exit;
				}
				$runno++;
				
				$positionTxt = $position[$value->positionID];
				$rankTxt = !empty($value->rankID)?$rankShort[$value->rankID]:'-';
				$positionNumberTxt = $value->positionNumber;
				$fullName = $value->firstName.' '.$value->lastName;
				$personalPositionCivilianTxt = !empty($value->personalPositionCivilianID)?$positionCivilian[$value->personalPositionCivilianID]:'';
				$codePrefixTxt = !empty($value->codePrefix)?$codePrefixShort[$value->codePrefix]:'-';
				$html .= '<tr id="R'.$value->mId.'">
							<td class="text-center" rowspan="">'.$runno.'<input type="hidden" name="checkBoxReqName[]" value="'.$value->mId.'" class="ReqD" /></td>
							<td class="text-center" rowspan="">'.$positionTxt.' </td>
							<td class="text-left" rowspan="">'.$rankTxt.'</td>
							<td class="text-center">'.$positionNumberTxt.'</td>
							<td class="text-center">'.$codePrefixTxt.'</td>
							<td class="text-center">'.$fullName.'</td>
							<td class="text-center">'.$personalPositionCivilianTxt.'</td>
							<td class="text-center">
								<div class="input-group" id="dateRetire2">
									<input type="text" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container="#dateRetire2" data-provide="datepicker" data-date-autoclose="true" id="dateRetire" name="dateRetire[]">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
							</td>
							<td class="text-center">
								<div class="col-auto pe-md-0">
									<div class="form-group mb-0">
										<button class="btn btn-danger bt_del" onclick="delRowRetire('.$value->mId.','.$value->hIDRetire.')">
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

	public function saveRequestRetire()
    {
		// echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
		if(!empty($_POST['checkBoxReqName'])){
			foreach($_POST['checkBoxReqName'] AS $key=>$val){
				//บันทึกตารางหลัก
				$paramsHead = [
					'id' => @$_POST['hIDRetire'],
					'statusDirective' => $_POST['statusDirective'], //สถานะ
					'directiveNo' => $_POST['directiveRetire'],
					'orderTypeID' => $_POST['orderTypeID'],
					'orgID' => @$_POST['rOrgId'],
					'directiveType' => '2',
				];
				// echo '<pre>'; print_r($paramsHead); echo '</pre>';
				if($this->DataPersonalForcesMapHeadModel->save($paramsHead)){
					if(@$_POST['hIDRetire'] == ''){
						$hIDRetire = $this->DataPersonalForcesMapHeadModel->insertID();
					}else{
						$hIDRetire = @$_POST['hIDRetire'];
					}

					$params = [
						'mId' => $val,
						'statusPackingRate' => $_POST['statusPackingRate'], //สถานะ
						'hIDRetire' => @$hIDRetire, 
						'dateRetire' => @$this->DateFunction->ConvertToSQLDate($_POST['dateRetire'][$key]), //วันที่พ้น
					];
					$this->DataPersonalForcesMapModel->save($params);
					// echo '<pre>'; print_r($params); echo '</pre>';
				}
			}
		}
		// exit;
		return redirect()->to('PalaceByAssist?typeForce=1');
    }

	public function saveDelRequest()
    {
		// echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
		if(!empty($_POST['mId'])){
			$params = [
				'mId' => $_POST['mId'],
				'statusPackingRate' => '3', //สถานะ รอออกคำสั่ง
				'dateBegin' => NULL,
				'dateEnd' => NULL,
				'hID' => NULL,
			];

			if ($this->DataPersonalForcesMapModel->save($params)) {

				//เช็คว่าถ้าไม่มีตารางหลักแล้วให้ลบข้อมูลตารางหลักออก
				$db = db_connect();
				$builder = $db->table('DataPersonalForcesMap AS t1');
				$builder->select('count(t1.hID) AS c_num');
				$builder->where("t1.hID = '{$_POST['hID']}'");
				$result = $builder->get()->getResult();
				if($result[0]->c_num == 0){
					$this->DataPersonalForcesMapHeadModel->delete($_POST['hID']);
				}
				
				$result = 'success';
			} else {
				$result = 'error';
			}
			
		}else{
			$result = 'error';
		}
		echo $result;
    }

	//เช็คสถานะ 6=ร้องขอออกคำสั่งพ้น
	public function chkRequestRetire()
	{
		$org_id = $this->request->getPost('org_id');
		
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '1'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		$builder->where("t1.org_id = '{$org_id}' AND t2.statusPackingRate = '6'");
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

	public function dataForcesReqRetire()
	{
		$org = new OrganizeForcesModel();
		$org_id = $this->request->getPost('org_id');
		
		$arr_data = array();

		$org_full_name = $org->org_full_name($org_id,1);
		$arr_data['textOrgName'] = 'สังกัด'.$org_full_name;
		
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate,t2.hIDRetire,t5.directiveNo AS directiveRetire,t2.dateRetire,t5.orderTypeID,t4.statusDirective');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '1'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		// $builder->join("DataPersonalForcesMapHead AS t4","t2.hID = t4.id AND t4.directiveType = 1","left");
		$builder->join("DataPersonalForcesMapHead AS t5","t2.hIDRetire = t5.id AND t5.directiveType = 2","left");
		$builder->where("t1.org_id = '{$org_id}' AND t2.statusPackingRate = '6'");
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
		$orderType = $this->generalModel->getOrderType();

		$html = '';
		$input = '';
		$runno = 0;
		$dateBegin = '';
		$dateEnd = '';
		if(!empty($result)){
			foreach($result AS $value){
				$runno++;

				$arr_data['directiveRetire'] = $value->directiveRetire;
				$arr_data['hIDRetire'] = $value->hIDRetire;
				$arr_data['orderTypeID'] = $value->orderTypeID;
				$arr_data['org_id'] = $value->org_id;
				$dateRetire = $this->DateFunction->mydate2date($value->dateRetire,0,'en');
				$arr_data['statusDirective'] = $value->statusDirective;
				
				$positionTxt = $position[$value->positionID];
				$rankTxt = !empty($value->rankID)?$rankShort[$value->rankID]:'-';
				$positionNumberTxt = $value->positionNumber;
				$fullName = $value->firstName.' '.$value->lastName;
				$personalPositionCivilianTxt = !empty($value->personalPositionCivilianID)?$positionCivilian[$value->personalPositionCivilianID]:'';
				$codePrefixTxt = !empty($value->codePrefix)?$codePrefixShort[$value->codePrefix]:'-';
				$html .= '<tr id="R'.$value->mId.'">
							<td class="text-center" rowspan="">'.$runno.'<input type="hidden" name="checkBoxReqName[]" value="'.$value->mId.'" class="ReqD" /></td>
							<td class="text-center" rowspan="">'.$positionTxt.' </td>
							<td class="text-left" rowspan="">'.$rankTxt.'</td>
							<td class="text-center">'.$positionNumberTxt.'</td>
							<td class="text-center">'.$codePrefixTxt.'</td>
							<td class="text-center">'.$fullName.'</td>
							<td class="text-center">'.$personalPositionCivilianTxt.'</td>
							<td class="text-center">
								<div class="input-group" id="datepicker2">
									<input type="text" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true" id="dateRetire" name="dateRetire[]" value="'.$dateRetire.'">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
							</td>
							<td class="text-center">
								<div class="col-auto pe-md-0">
									<div class="form-group mb-0">
										<button type="button" class="btn btn-danger bt_del" onclick="delRowRetire('.$value->mId.','.$value->hIDRetire.')">ลบ</button>
									</div>
								</div>
							</td>
						</tr>';
				
			}
		}
		$arr_data['html'] = $html;
		$arr_data['input'] = $input;
		echo json_encode($arr_data);
	}

	public function saveDelRequestRetire()
    {
		// echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
		if(!empty($_POST['mId'])){
			$params = [
				'mId' => $_POST['mId'],
				'statusPackingRate' => '1', //สถานะ บรรจุ
				'dateRetire' => NULL,
				'hIDRetire' => NULL,
			];

			if ($this->DataPersonalForcesMapModel->save($params)) {

				//เช็คว่าถ้าไม่มีตารางหลักแล้วให้ลบข้อมูลตารางหลักออก
				$db = db_connect();
				$builder = $db->table('DataPersonalForcesMap AS t1');
				$builder->select('count(t1.hIDRetire) AS c_num');
				$builder->where("t1.hIDRetire = '{$_POST['hIDRetire']}'");
				$result = $builder->get()->getResult();
				if($result[0]->c_num == 0){
					$this->DataPersonalForcesMapHeadModel->delete($_POST['hIDRetire']);
				}
				
				$result = 'success';
			} else {
				$result = 'error';
			}
			
		}else{
			$result = 'error';
		}
		echo $result;
    }

	// EXCEL
	public function exportExcel()
	{
		$exportexcel = new ExportExcel();
		$data = array();
		$file_name = 'บัญชีรายชื่อกำลังพล';
		$data['file_name'] = $file_name;

		$data['DataReq'] = $this->getDataReq($_GET['hID']);
		$data['datePrint'] = $this->DateFunction->changeThainum($this->DateFunction->ConvertToThaiDate(date('Y-m-d')));//วันที่พิมพ์

		$dataHead = $this->DataPersonalForcesMapHeadModel->find($_GET['hID']);
		$orderType = $this->generalModel->getOrderType();

		$org = new OrganizeForcesModel();
		$org_full_name = $org->org_full_name($dataHead['orgID'],1);

		$data['orgName'] = $org_full_name;//สังกัด หน่วยงานย่อยไปหาหน่วยงานหลัก
		$data['orderType'] = ($dataHead['orderTypeID'] != '')?$orderType[$dataHead['orderTypeID']]:'';//ประเภทคำสั่ง
		
		// จัดให้อยู่ในรูปแบบ html
		$html = view('palaceByAs/export', $data,);
		// echo $html;die();
		$result =  $exportexcel->export($data, $file_name, $html, 'L');
	}

	public function getDataReq($hID)
	{
		$arr_data = array();
		
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.hrNumber,t3.originPosition,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate,t2.hID,t4.directiveNo AS directiveBegin,t2.dateBegin,t2.dateEnd,t4.orderTypeID,t4.statusDirective');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '1'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		$builder->join("DataPersonalForcesMapHead AS t4","t2.hID = t4.id AND t4.directiveType = 1","left");
		$builder->where("t2.hID = '{$hID}'");
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
		$orderType = $this->generalModel->getOrderType();

		$html = '';
		$input = '';
		$runno = 0;
		$dateBegin = '';
		$dateEnd = '';
		$key = 0;
		if(!empty($result)){
			foreach($result AS $value){
				$runno++;
				
				$positionTxt = $position[$value->positionID];
				$rankTxt = !empty($value->rankID)?$rankShort[$value->rankID]:'-';
				$positionNumberTxt = $value->positionNumber;
				$fullName = $value->firstName.' '.$value->lastName;
				$personalPositionCivilianTxt = !empty($value->personalPositionCivilianID)?$positionCivilian[$value->personalPositionCivilianID]:'';
				$codePrefixTxt = !empty($value->codePrefix)?$codePrefixShort[$value->codePrefix]:'-';

				$arr_data[$key]['runno'] = $this->DateFunction->changeThainum($runno);
				$arr_data[$key]['positionTxt'] = $positionTxt;
				$arr_data[$key]['rankTxt'] = $rankTxt;
				$arr_data[$key]['positionNumberTxt'] = $positionNumberTxt;
				$arr_data[$key]['codePrefixTxt'] = $codePrefixTxt;
				$arr_data[$key]['fullName'] = $fullName;
				$arr_data[$key]['dateBegin'] = $this->DateFunction->changeThainum($this->DateFunction->ConvertToThaiDate($value->dateBegin));
				$arr_data[$key]['dateEnd'] = $this->DateFunction->changeThainum($this->DateFunction->ConvertToThaiDate($value->dateEnd));
				$arr_data[$key]['originPosition'] = @str_replace('|',' ',@$value->originPosition);
				$arr_data[$key]['isocPosition'] = @str_replace('|',' ',@$value->isocPosition);
				$arr_data[$key]['hrNumber'] = $this->DateFunction->changeThainum(@$value->hrNumber);
				$key++;
			}
		}
		return $arr_data;
	}

	public function getOrgFullName()
	{
		$org = new OrganizeForcesModel();
		$org_id = $this->request->getPost('org_id');
		
		$arr_data = array();

		$org_full_name = $org->org_full_name($org_id,1);
		$arr_data['textOrgName'] = 'สังกัด'.$org_full_name;

		echo json_encode($arr_data);
	}

	public function getOrgFullNameArr($org_id)
	{
		$org = new OrganizeForcesModel();
		
		$arr_data = array();

		$org_name = $org->org_full_name($org_id,1,'|');
		// echo '<pre>'; print_r($org_name); echo '</pre>';
		$arr_data = explode("|",$org_name);
		
		// $arr_data[$org_id] = $org_full_name;
		return $arr_data;
		
	}

	//ส่งไปออกคำสั่งขอบรรจุ
	public function getDataSendDirective()
	{
		$hID = $this->request->getPost('hID');
		$arr_data = array();
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select("t3.pid,
						t3.codePrefix AS prename,
						t3.firstName AS first_name,
						t3.lastName AS last_name,
						t3.cardID AS idcard,
						t4.orgID AS org_id,
						t3.hrTypeID AS hr_type,
						DATE(t2.dateBegin) AS date_in,
						'' AS no_cmd_for_out,
						'' AS date_cmd_in_for_out,
						'' AS date_out,
						IF(t4.directiveType = '1','I',IF(t4.directiveType='2','O',IF(t4.directiveType='5','IO',''))) AS type_cmd,
						t3.positionCivilianID AS personalPositionCivilianID");
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '1'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		$builder->join("DataPersonalForcesMapHead AS t4","t2.hID = t4.id AND t4.directiveType = 1","left");
		$builder->where("t2.hID = '{$hID}'");
		$builder->orderBy("t1.org_id ASC,t1.positionMapID ASC");
		$result = $builder->get()->getResult();
		// echo $db->getLastQuery();
		
		$arr_data['staffid'] = 1;
		$arr_data['ref_id'] = $hID;
		// echo '<pre>'; print_r($result); echo '</pre>'; exit;

		$positionCivilian = $this->generalModel->getPositionCivilianList();
		$row = 0;
		// if(!empty($result)){
		// 	foreach($result AS $key=>$value){
		// 		$row++;
		// 		$result[$key]->row_id = $row;
		// 		// echo '<pre>'; print_r($value); echo '</pre>';
		// 		$personalPositionCivilianTxt = !empty($value->personalPositionCivilianID)?$positionCivilian[$value->personalPositionCivilianID]:'';
		// 		$result[$key]->position1 = $personalPositionCivilianTxt;
				
		// 		$orgFullName = $this->getOrgFullNameArr($value->orgID);

		// 		$i=0;
		// 		if(!empty($orgFullName)){
		// 			foreach($orgFullName AS $key_org=>$val_org){
		// 				echo '<pre>'; print_r($val_org); echo '</pre>';
		// 				if($val_org != ''){
		// 					$i++;
		// 					$result[$key]->position_isoc = @$val_org;

		// 				}
		// 			}
		// 		}
		// 	}
		// }

		$arr_persons = array();
		if(!empty($result)){
			foreach($result AS $key=>$value){
				$row++;
				$arr_persons[$key]['row_id'] = $row;
				$arr_persons[$key]['pid'] = $value->pid;
				$arr_persons[$key]['prename'] = $value->prename;
				$arr_persons[$key]['first_name'] = $value->first_name;
				$arr_persons[$key]['last_name'] = $value->last_name;
				$arr_persons[$key]['idcard'] = $value->idcard;
				$arr_persons[$key]['org_id'] = $value->org_id;
				$arr_persons[$key]['hr_type'] = $value->hr_type;
				$arr_persons[$key]['date_in'] = $value->date_in;
				$arr_persons[$key]['no_cmd_for_out'] = $value->no_cmd_for_out;
				$arr_persons[$key]['date_cmd_in_for_out'] = $value->date_cmd_in_for_out;
				$arr_persons[$key]['date_out'] = $value->date_out;
				$arr_persons[$key]['type_cmd'] = $value->type_cmd;

				$personalPositionCivilianTxt = !empty($value->personalPositionCivilianID)?$positionCivilian[$value->personalPositionCivilianID]:'';
				$arr_persons[$key]['position1'] = $personalPositionCivilianTxt;
				$arr_persons[$key]['position2'] = "";
				$arr_persons[$key]['position3'] = "";
				$arr_persons[$key]['position4'] = "";
				$arr_persons[$key]['position5'] = "";
				
				$orgFullName = $this->getOrgFullNameArr($value->org_id);

				$i=0;
				for($r=0;$r<8;$r++){
					$i++;
					$arr_persons[$key]['position_isoc'.$i] = (@$orgFullName[$r] != '')?@$orgFullName[$r]:"";
				}
			}
		}
		$arr_data['persons'] = $arr_persons;
		echo json_encode($arr_data,JSON_UNESCAPED_UNICODE);
	}
	
}

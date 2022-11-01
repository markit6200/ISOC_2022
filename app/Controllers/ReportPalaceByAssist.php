<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\OrganizeModel;
use App\Models\GeneralModel;
use App\Models\DataPositionMapOrganizeModel;
use App\Models\PersonalForceModel;
use App\Models\DataPersonalForcesMapHeadModel;
class ReportPalaceByAssist extends BaseController
{
	protected $perPage = 100;

	public function __construct()
    {
		$this->DataPositionMapOrganizeModel = new DataPositionMapOrganizeModel();
		$this->PersonalForceModel = new PersonalForceModel();
		$this->generalModel = new GeneralModel();
		$this->DataPersonalForcesMapHeadModel = new DataPersonalForcesMapHeadModel();
    }

	public function index()
	{
		helper('general');
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'รายงานคำสั่ง/ขอช่วยราชการ']),
			'page_title' => view('partials/page-title', ['title' => 'รายงานคำสั่ง/ขอช่วยราชการ', 'pagetitle' => 'Minible']),
		];

		$data['title'] = 'รายงานคำสั่ง/ขอช่วยราชการ';
		$headData = $this->DataPersonalForcesMapHeadModel->select("*");
		$headData->join('isoc_usermanager.organize_to_profile','organize_to_profile.org_id = DataPersonalForcesMapHead.orgID','left');
		$headData->join('(
						SELECT hID,COUNT(hID) AS c_num FROM DataPersonalForcesMap WHERE hID IS NOT NULL GROUP BY hID
						UNION ALL
						SELECT hIDRetire AS hID,COUNT(hIDRetire) AS c_num FROM DataPersonalForcesMap WHERE hIDRetire IS NOT NULL GROUP BY hIDRetire
					) AS c1','c1.hID = DataPersonalForcesMapHead.id','left');
		// $headData->join('DataPersonalForcesMap','DataPersonalForcesMap.fId = DataPersonalForces.fid','left');
		if ($txtSearch = $this->request->getGet('search')){
			// $where = "cardID LIKE '%{$txtSearch}%' OR firstName LIKE '%{$txtSearch}%' OR lastName LIKE '%{$txtSearch}%'";
			$where = "directiveNo LIKE '%{$txtSearch}%'";
			$headData->where($where);
		}
		
		$data['headData'] = $headData->paginate($this->perPage, 'bootstrap');
		// echo '<pre>'; print_r($data['headData']); echo '</pre>'; exit;
		// $orderType = $this->generalModel->getOrderType();
		$orderType = $this->generalModel->getOrderType();
		$data['orderType'] = $orderType;
		
		$data['pager'] = $this->DataPersonalForcesMapHeadModel->pager;
		$data['currentPage'] =$this->DataPersonalForcesMapHeadModel->pager->getCurrentPage('bootstrap'); // The current page number
        $data['totalPages']  = $this->DataPersonalForcesMapHeadModel->pager->getPageCount('bootstrap');   // The total page count
		$data['perPage'] = $this->perPage;
		return view('reportPalaceByAssist/index', $data);
	}

	public function dataForcesReq()
	{
		$org_id = $this->request->getPost('org_id');
		$hID = $this->request->getPost('hID');

		$arr_data = array();
		
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate,t2.hID,t4.directiveNo AS directiveBegin,t2.dateBegin,t2.dateEnd,t4.orderTypeID');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '1'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		$builder->join("DataPersonalForcesMapHead AS t4","t2.hID = t4.id AND t4.directiveType = 1","left");
		// $builder->join("DataPersonalForcesMapHead AS t5","t2.hIDRetire = t5.id AND t5.directiveType = 2","left");
		$builder->where("t1.org_id = '{$org_id}' AND t2.hID = '{$hID}'");
		// $builder->where("t1.org_id = '{$org_id}' AND t2.statusPackingRate = '4'");
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
				$dateBegin = $this->mydate2date($value->dateBegin,0,'en');
				$dateEnd = $this->mydate2date($value->dateEnd,0,'en');
				
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
										<button type="button" class="btn btn-danger" onclick="delRow('.$value->mId.','.$value->hID.')">ลบ</button>
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

	public function dataForcesReqRetire()
	{
		$org_id = $this->request->getPost('org_id');
		$hID = $this->request->getPost('hID');

		$arr_data = array();
		
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate,t2.hIDRetire,t5.directiveNo AS directiveRetire,t2.dateRetire,t5.orderTypeID');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '1'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		// $builder->join("DataPersonalForcesMapHead AS t4","t2.hID = t4.id AND t4.directiveType = 1","left");
		$builder->join("DataPersonalForcesMapHead AS t5","t2.hIDRetire = t5.id AND t5.directiveType = 2","left");
		$builder->where("t1.org_id = '{$org_id}' AND t2.hIDRetire = '{$hID}'");
		// $builder->where("t1.org_id = '{$org_id}' AND t2.statusPackingRate = '6'");
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
				$dateRetire = $this->mydate2date($value->dateRetire,0,'en');
				
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
										<button type="button" class="btn btn-danger" onclick="delRowRetire('.$value->mId.','.$value->hIDRetire.')">ลบ</button>
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
}
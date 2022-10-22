<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\OrganizeForcesModel;
use App\Models\GeneralModel;
use App\Models\DataPersonalForcesMapModel;
use App\Models\DataPersonalForcesModel;

class PalaceByAssistPRMN extends BaseController
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
			'page_title' => view('partials/page-title', ['title' => 'ระบบทำเนียบกำลังพลตามอัตราช่วยราชการ กอ.รมน.','pagetitle' => '']),
			
		];
		$data['title'] = 'ระบบทำเนียบกำลังพลตามอัตรา  สง.ปรมน.ทบ., สน.ปรมน.จว.';
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
		$data['typeForce'] = 2;
		
		return view('palaceByAsPRMN/index', $data);
	}

	public function view()
	{
		exit;
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
		];
		return view('palaceByAsPRMN/view', $data);
	}

	public function form()
	{
		exit;
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
		];
		return view('palaceByAsPRMN/form', $data);
	}

	public function savePalace()
    {
        $params = [
			'fId' => $_POST['fId'],
			'typeForce' => $_POST['typeForce'], //ประเภทกำลังพล 1=กอ.รมน.,2=สง.ปรมน.ทบ., สน.ปรมน.จว.
			'statusPackingRate' => '1', //สถานะ 0=ว่าง,1=บรรจุอัตรา,2=พ้น
			'positionMapID' => $_POST['positionMapID'],
			'datePackingRate' => date("Y-m-d H:i:s"),
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
			'statusPackingRate' => '2', //สถานะ 0=ว่าง,1=บรรจุอัตรา,2=พ้น
			'dateOffPackingRate' => date("Y-m-d H:i:s"), //วันที่พ้นบรรจุอัตรา
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
		$where = "fid NOT IN (SELECT fid FROM DataPersonalForcesMap WHERE statusPackingRate IN ('1','2')  GROUP BY fid)";
		if ($txtSearch = $this->request->getPost('search')){
			$where .= " AND (cardID LIKE '%{$txtSearch}%' OR firstName LIKE '%{$txtSearch}%' OR lastName LIKE '%{$txtSearch}%')";
		}
		$personalData->where($where);
		$personalData->where('profileType',2);
		
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

}

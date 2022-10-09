<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\OrganizeForcesModel;
use App\Models\GeneralModel;
use App\Models\DataPersonalForcesMapModel;

class PalaceByAssist extends BaseController
{
	public function __construct()
    {
		$this->DataPersonalForcesMapModel = new DataPersonalForcesMapModel();
    }

	public function index()
	{
		$org = new OrganizeForcesModel();
		$tree = $org->getTreeList(1,0,'');

		$params = array();
		$dataPersonal = $this->DataPersonalForcesMapModel->getData($params);

		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
			
		];
		if($_GET['typeForce'] == 1){
			$data['title'] = 'ระบบทำเนียบกำลังพลตามอัตราช่วยราชการ กอ.รมน.';
		}else{
			$data['title'] = 'ระบบทำเนียบกำลังพลตามอัตรา  สง.ปรมน.ทบ., สน.ปรมน.จว.';
		}
		$data['datas'] = '';
		$data['table_content'] = $tree;
		$data['personal'] = $dataPersonal;
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
			'statusPackingRate' => '1', //สถานะ 0=ว่าง,1=บรรจุอัตรา,2=พ้น
			'positionID' => $_POST['positionID'],
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

}
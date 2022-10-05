<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\OrganizeModel;
use App\Models\GeneralModel;
use App\Models\DataPositionMapOrganizeModel;
class StructureByAssistRate extends BaseController
{
	public function __construct()
    {
		$this->DataPositionMapOrganizeModel = new DataPositionMapOrganizeModel();
        // $this->data['currentAdminMenu'] = 'catalogue';
        // $this->data['currentAdminSubMenu'] = 'brand';
    }

	public function index()
	{
		// $db = db_connect('tests');
		// echo "<pre>";
		// print_r($db);
		// die();
		// // $db = \Config\Database::connect();
		// $db = db_connect();
		// $query   = $db->query('SELECT * FROM users');
		// $results = $query->getResult();
		// echo "<pre>";
		// print_r($results);
		// die();
	// echo 'Total Results: ' . count($results);
		// $user = new UsersModel();
		$org = new OrganizeModel();
		$tree = $org->getTreeList(1,0,'');
		
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
			
		];
		$data['title'] = 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.';
		$data['table_content'] = $tree;
		
		return view('structureByAsRate/index', $data);
	}

	public function view()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
		];
		return view('structureByAsRate/view', $data);
	}

	public function form($org_id,$id='')
	{
		$general_data = new GeneralModel();
		$position = $general_data->getPosition();
		$positionGroup = $general_data->getPositionGroup();
		$positionCivilian = $general_data->getPositionCivilian();
		$positionCivilianGroup = $general_data->getPositionCivilianGroup();
		$positionRank = $general_data->getPositionRank();
		$save_data = array();
		if($id != ''){
			$save_data = $this->DataPositionMapOrganizeModel->find($id);
		}
		// echo "<pre>";
		// print_r($save_data);
		// die();
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.', 'pagetitle' => 'Minible']),
			'position' => $position,
			'positionGroup' => $positionGroup,
			'positionCivilian' => $positionCivilian,
			'positionCivilianGroup' => $positionCivilianGroup,
			'positionRank' => $positionRank,
			'org_id'=>$org_id,
			'save_data'=>$save_data
		];
		return view('structureByAsRate/form', $data);
	}

	public function save()
    {
		// echo "<pre>";
		// print_r($this->request->getVar());
		// die();
        $params = [
			'positionID' => $this->request->getVar('position'),
			'positionCivilianID' => $this->request->getVar('positionCivilian'),
			'rankID' => $this->request->getVar('positionRank'),
			'org_id' => $this->request->getVar('org_id'),
			'positionNumber' => $this->request->getVar('positionNumber'),
			'ordering' => '1',
			'activeStatus' => '1',
        ];
		

        if ($this->DataPositionMapOrganizeModel->save($params)) {
			// echo $this->DataPositionMapOrganizeModel->getLastQuery();
			// die();
            // $this->session->setFlashdata('success', 'Brand has been saved.');
            return redirect()->to('StructureByAssistRate');
        } else {
            // $this->getBrands();
            $this->data['errors'] = $this->DataPositionMapOrganizeModel->errors();
            return view('structureByAsRate/form/1', $this->data);
        }
    }

}
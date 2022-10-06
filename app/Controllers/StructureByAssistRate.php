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
        $params = [
			'positionID' => $this->request->getVar('position'),
			'positionGroupID' => $this->request->getVar('positionGroup'),
			'positionType' => $this->request->getVar('positionType'),
			'positionCivilianID' => $this->request->getVar('positionCivilian'),
			'positionCivilianGroupID' => $this->request->getVar('positionCivilianGroup'),
			'rankID' => $this->request->getVar('positionRank'),
			'rankIDTo' => $this->request->getVar('positionRankTo'),
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
            return view('structureByAsRate/form/'.$this->request->getVar('org_id'), $this->data);
        }
    }

	public function update($id)
    {
		$params = [
			'positionMapID' => $this->request->getVar('id'),
			'positionID' => $this->request->getVar('position'),
			'positionGroupID' => $this->request->getVar('positionGroup'),
			'positionType' => $this->request->getVar('positionType'),
			'positionCivilianID' => $this->request->getVar('positionCivilian'),
			'positionCivilianGroupID' => $this->request->getVar('positionCivilianGroup'),
			'rankID' => $this->request->getVar('positionRank'),
			'rankIDTo' => $this->request->getVar('positionRankTo'),
			'org_id' => $this->request->getVar('org_id'),
			'positionNumber' => $this->request->getVar('positionNumber'),
			'ordering' => '1',
			'activeStatus' => '1',
        ];

		if ($this->DataPositionMapOrganizeModel->save($params)) {
			// $this->session->setFlashdata('success', 'Brand has been updated!');
			return redirect()->to('StructureByAssistRate');
		} else {
			// $this->data['errors'] = $this->DataPositionMapOrganizeModel->errors();
			return view('structureByAsRate/form/'.$this->request->getVar('org_id').'/'.$this->request->getVar('id'), $this->data);
		}
    }

    // public function delete($id)
    // {
    //     $brand = $this->DataPositionMapOrganizeModel->find($id);
	// 	if (!$brand) {
	// 		$this->session->setFlashdata('errors', 'Invalid brand');
	// 		return redirect()->to('/admin/brands');
	// 	}

	// 	if ($this->DataPositionMapOrganizeModel->delete($brand->id)) {
	// 		$this->session->setFlashdata('success', 'The brand has been deleted');
	// 		return redirect()->to('/admin/brands');
	// 	} else {
	// 		$this->session->setFlashdata('errors', 'Could not delete the brand');
	// 		return redirect()->to('/admin/brands');
	// 	}
    // }

}
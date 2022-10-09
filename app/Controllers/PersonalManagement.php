<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\OrganizeModel;
use App\Models\GeneralModel;
use App\Models\DataPositionMapOrganizeModel;
use App\Models\PersonalForceModel;
class PersonalManagement extends BaseController
{
	protected $perPage = 100;

	public function __construct()
    {
		$this->DataPositionMapOrganizeModel = new DataPositionMapOrganizeModel();
		$this->PersonalForceModel = new PersonalForceModel();
    }

	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'ข้อมูลกำลังพล']),
			'page_title' => view('partials/page-title', ['title' => 'ข้อมูลกำลังพล', 'pagetitle' => 'Minible']),
		];

		$data['title'] = 'ข้อมูลกำลังพล';
		$personalData = $this->PersonalForceModel->select("*");
		$data['personalData'] = $personalData->paginate($this->perPage, 'bootstrap');
		
		$data['pager'] = $this->PersonalForceModel->pager;
		return view('personalManagement/index', $data);
	}

	public function view()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
		];
		return view('personalManagement/view', $data);
	}

	public function form($id='')
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
			'save_data'=>$save_data
		];
		return view('personalManagement/form', $data);
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
            return view('personalManagement/form/1', $this->data);
        }
    }

}
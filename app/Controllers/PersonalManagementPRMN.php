<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\OrganizeModel;
use App\Models\GeneralModel;
use App\Models\DataPositionMapOrganizeModel;
use App\Models\PersonalForceModel;
class PersonalManagementPRMN extends BaseController
{
	protected $perPage = 100;

	public function __construct()
    {
		$this->DataPositionMapOrganizeModel = new DataPositionMapOrganizeModel();
		$this->PersonalForceModel = new PersonalForceModel();
		$this->GeneralModel = new GeneralModel();
    }

	public function index()
	{
		helper('general');
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'ข้อมูลกำลังพล']),
			'page_title' => view('partials/page-title', ['title' => 'ข้อมูลกำลังพล', 'pagetitle' => 'Minible']),
		];
		$prefix = $this->GeneralModel->getPrefix();
		$personalType = $this->GeneralModel->getPersonalType(); 
		$positionList = $this->GeneralModel->getPositionList(); 
		$positionGroupList = $this->GeneralModel->getPositionGroupList(); 
		$positionCivilianList = $this->GeneralModel->getPositionCivilianList(); 
		$positionCivilianGroupList = $this->GeneralModel->getPositionCivilianGroupList(); 

		$data['title'] = 'ข้อมูลกำลังพล';
		$personalData = $this->PersonalForceModel->select("*");
		$personalData->join('DataPersonalForcesMap','DataPersonalForcesMap.fId = DataPersonalForces.fid','left');
		$personalData->where('profileType',2);
		if ($txtSearch = $this->request->getGet('search')){
			$where = "cardID LIKE '%{$txtSearch}%' OR firstName LIKE '%{$txtSearch}%' OR lastName LIKE '%{$txtSearch}%'";
		$personalData->where($where);
		}
		$data['personalData'] = $personalData->paginate($this->perPage, 'bootstrap');
		$data['prefix'] = $prefix;
		$data['personalType'] = $personalType;
		$data['positionList'] = $positionList;
		$data['positionGroupList'] = $positionGroupList;
		$data['positionCivilianList'] = $positionCivilianList;
		$data['positionCivilianGroupList'] = $positionCivilianGroupList;
		$data['pager'] = $this->PersonalForceModel->pager;
		$data['currentPage'] =$this->PersonalForceModel->pager->getCurrentPage('bootstrap'); // The current page number
        $data['totalPages']  = $this->PersonalForceModel->pager->getPageCount('bootstrap');   // The total page count
		$data['perPage'] = $this->perPage;
		return view('personalManagementPRMN/index', $data);
	}

	public function view()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
		];
		return view('personalManagementPRMN/view', $data);
	}

	public function form($id='')
	{
		$general_data = new GeneralModel();
		$position = $general_data->getPosition();
		$positionGroup = $general_data->getPositionGroup();
		$positionCivilian = $general_data->getPositionCivilian();
		$positionCivilianGroup = $general_data->getPositionCivilianGroup();
		$positionRank = $general_data->getPositionRank();
		$codePrefix = $general_data->getPrefix();
		$hrType = $general_data->getHRType();
		$save_data = array();
		if($id != ''){
			$save_data = $this->PersonalForceModel->find($id);
		}
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'ข้อมูลกำลังพล']),
			'page_title' => view('partials/page-title', ['title' => 'ข้อมูลกำลังพล', 'pagetitle' => 'ข้อมูลกำลังพล']),
			'position' => $position,
			'positionGroup' => $positionGroup,
			'positionCivilian' => $positionCivilian,
			'positionCivilianGroup' => $positionCivilianGroup,
			'positionRank' => $positionRank,
			'save_data' => $save_data,
			'codePrefix' => $codePrefix,
			'hrType' => $hrType,
		];
		return view('personalManagementPRMN/form', $data);
	}

	public function save()
    {
        $params = [
			'cardID' => $this->request->getVar('cardID'),
			'hrTypeID' => $this->request->getVar('hrTypeID'),
			'codePrefix' => $this->request->getVar('codePrefix'),
			'firstName' => $this->request->getVar('firstName'),
			'lastName' => $this->request->getVar('lastName'),
			'positionID' => $this->request->getVar('position'),
			'positionGroupID' => $this->request->getVar('positionGroup'),
			'positionCivilianID' => $this->request->getVar('positionCivilian'),
			'positionCivilianGroupID' => $this->request->getVar('positionCivilianGroup'),
			'profileType' => '2',
        ];
		
        if ($this->PersonalForceModel->save($params)) {
            // $this->session->setFlashdata('success', 'Brand has been saved.');
            return redirect()->to('PersonalManagementPRMN');
        } else {
            // $this->getBrands();
            $this->data['errors'] = $this->PersonalForceModel->errors();
            return view('personalManagementPRMN/form', $this->data);
        }
    }

	public function update($id)
    {
        $params = [
			'fid' => $id,
			'cardID' => $this->request->getVar('cardID'),
			'hrTypeID' => $this->request->getVar('hrTypeID'),
			'codePrefix' => $this->request->getVar('codePrefix'),
			'firstName' => $this->request->getVar('firstName'),
			'lastName' => $this->request->getVar('lastName'),
			'positionID' => $this->request->getVar('position'),
			'positionGroupID' => $this->request->getVar('positionGroup'),
			'positionCivilianID' => $this->request->getVar('positionCivilian'),
			'positionCivilianGroupID' => $this->request->getVar('positionCivilianGroup'),
			'profileType' => '2',
        ];
		

        if ($this->PersonalForceModel->save($params)) {
            // $this->session->setFlashdata('success', 'Brand has been saved.');
            return redirect()->to('PersonalManagementPRMN');
        } else {
            // $this->getBrands();
            $this->data['errors'] = $this->PersonalForceModel->errors();
            return view('personalManagementPRMN/form/'.$id, $this->data);
        }
    }

	public function delete($id)
    {
        $personal = $this->PersonalForceModel->find($id);
		if (!$personal) {
			// $this->session->setFlashdata('errors', 'Invalid brand');
			return redirect()->to('PersonalManagementPRMN');
		}

		if ($this->PersonalForceModel->delete($personal['fid'])) {
			// $this->session->setFlashdata('success', 'The brand has been deleted');
			return redirect()->to('PersonalManagementPRMN');
		} else {
			// $this->session->setFlashdata('errors', 'Could not delete the brand');
			return redirect()->to('PersonalManagementPRMN');
		}
    }

	public function updateStatus($id,$status)
    {
        $params = [
			'fid' => $id,
			'status' => $status
        ];
		

        if ($this->PersonalForceModel->save($params)) {
            // $this->session->setFlashdata('success', 'Brand has been saved.');
            return redirect()->to('PersonalManagementPRMN');
        } else {
            // $this->getBrands();
            $this->data['errors'] = $this->PersonalForceModel->errors();
            return view('personalManagementPRMN/form/'.$id, $this->data);
        }
    }

}
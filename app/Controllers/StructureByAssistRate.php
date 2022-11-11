<?php namespace App\Controllers;

use App\Models\OrganizeProfileModel;
use App\Models\UsersModel;
use App\Models\OrganizeModel;
use App\Models\GeneralModel;
use App\Models\DataPositionMapOrganizeModel;
class StructureByAssistRate extends BaseController
{
	public function __construct()
    {
		$this->DataPositionMapOrganizeModel = new DataPositionMapOrganizeModel();
		$this->OrganizeModel = new OrganizeModel();
		$this->GeneralModel = new GeneralModel();
        $this->organizeProfileModel = new OrganizeProfileModel();
        // $this->data['currentAdminMenu'] = 'catalogue';
        // $this->data['currentAdminSubMenu'] = 'brand';
    }

	public function index($profileId = '')
	{
        $profile = $this->organizeProfileModel->find($profileId);
		$tree = $this->OrganizeModel->getTreeList($profileId,0,'',$profile['profileType'] == '' ? '1' : $profile['profileType']);
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
		$positionType = $general_data->getPersonalType();
		$org = $this->OrganizeModel->getOrg($org_id);
		$save_data = array();
		$org_name = isset($org->org_name)?$org->org_name:'';
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
			'positionRankTo' => $positionRank,
			'positionType' => $positionType,
			'org_id' => $org_id,
			'save_data' => $save_data,
			'org_name' => $org_name
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
			'profileType' => '1',
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
			'profileType' => '1',
        ];

		if ($this->DataPositionMapOrganizeModel->save($params)) {
			// $this->session->setFlashdata('success', 'Brand has been updated!');
			return redirect()->to('StructureByAssistRate');
		} else {
			// $this->data['errors'] = $this->DataPositionMapOrganizeModel->errors();
			return view('structureByAsRate/form/'.$this->request->getVar('org_id').'/'.$this->request->getVar('id'), $this->data);
		}
    }

    public function delete($id)
    {
        $orginize = $this->DataPositionMapOrganizeModel->find($id);
		if (!$orginize) {
			$this->session->setFlashdata('errors', 'Invalid brand');
			return redirect()->to('StructureByAssistRate');
		}

		if ($this->DataPositionMapOrganizeModel->delete($orginize['positionMapID'])) {
			$this->session->setFlashdata('success', 'The brand has been deleted');
			return redirect()->to('StructureByAssistRate');
		} else {
			$this->session->setFlashdata('errors', 'Could not delete the brand');
			return redirect()->to('StructureByAssistRate');
		}
    }

	public function ajaxGetRank($id)
	{
		$positionRank = $this->GeneralModel->getPositionRankTo($id);
		$data['positionRank'] = $positionRank;

		return view('structureByAsRate/ajaxRankTo', $data);
	}
}

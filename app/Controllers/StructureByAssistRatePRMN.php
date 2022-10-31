<?php namespace App\Controllers;

use App\Models\OrganizeModel;
use App\Models\GeneralModel;
use App\Models\DataPositionMapOrganizeModel;
use App\Libraries\ExportExcel;
class StructureByAssistRatePRMN extends BaseController
{
	public function __construct()
    {
		$this->DataPositionMapOrganizeModel = new DataPositionMapOrganizeModel();
		$this->OrganizeModel = new OrganizeModel();
		$this->GeneralModel = new GeneralModel();
        // $this->data['currentAdminMenu'] = 'catalogue';
        // $this->data['currentAdminSubMenu'] = 'brand';
    }

	public function index()
	{
		$tree = $this->OrganizeModel->getTreeList(1,0,'',2);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
			
		];
		$data['title'] = 'ระบบโครงสร้างตามอัตราช่วยราชการ สง.ปรมน.ทบ., สน.ปรมน.จว.';
		$data['table_content'] = $tree;
		
		return view('structureByAsRatePRMN/index', $data);
	}

	public function view()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
		];
		return view('structureByAsRatePRMN/view', $data);
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
			'org_name' => $org_name,
		];
		return view('structureByAsRatePRMN/form', $data);
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
			'profileType' => '2',
        ];
		

        if ($this->DataPositionMapOrganizeModel->save($params)) {
			// echo $this->DataPositionMapOrganizeModel->getLastQuery();
			// die();
            // $this->session->setFlashdata('success', 'Brand has been saved.');
            return redirect()->to('StructureByAssistRatePRMN');
        } else {
            // $this->getBrands();
            $this->data['errors'] = $this->DataPositionMapOrganizeModel->errors();
            return view('structureByAsRatePRMN/form/'.$this->request->getVar('org_id'), $this->data);
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
			'profileType' => '2',
        ];

		if ($this->DataPositionMapOrganizeModel->save($params)) {
			// $this->session->setFlashdata('success', 'Brand has been updated!');
			return redirect()->to('StructureByAssistRatePRMN');
		} else {
			// $this->data['errors'] = $this->DataPositionMapOrganizeModel->errors();
			return view('structureByAsRatePRMN/form/'.$this->request->getVar('org_id').'/'.$this->request->getVar('id'), $this->data);
		}
    }

    public function delete($id)
    {
        $orginize = $this->DataPositionMapOrganizeModel->find($id);
		if (!$orginize) {
			$this->session->setFlashdata('errors', 'Invalid brand');
			return redirect()->to('StructureByAssistRatePRMN');
		}

		if ($this->DataPositionMapOrganizeModel->delete($orginize['positionMapID'])) {
			$this->session->setFlashdata('success', 'The brand has been deleted');
			return redirect()->to('StructureByAssistRatePRMN');
		} else {
			$this->session->setFlashdata('errors', 'Could not delete the brand');
			return redirect()->to('StructureByAssistRatePRMN');
		}
    }

	public function ajaxGetRank($id)
	{
		$positionRank = $this->GeneralModel->getPositionRankTo($id);
		$data['positionRank'] = $positionRank;

		return view('structureByAsRatePRMN/ajaxRankTo', $data);
	}

	// EXCEL
	public function exportExcel()
	{
		$exportexcel = new ExportExcel();
		$data = array();
		$file_name = 'รายงานสิทธิ์สวัสดิการเจ้าหน้าที่';
		$data['file_name'] = $file_name;

		// จัดให้อยู่ในรูปแบบ html
		$html = view('structureByAsRatePRMN/export', $data,);
		// echo $html;die();
		$result =  $exportexcel->export($data, $file_name, $html, 'L');
	}
}
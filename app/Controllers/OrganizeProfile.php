<?php namespace App\Controllers;

use App\Models\OrganizeProfileModel;

class OrganizeProfile extends BaseController
{
	public function __construct()
    {
		$this->organizeProfileModel = new OrganizeProfileModel();
    }

	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'โปรไฟล์ผังองค์กร']),
			'page_title' => view('partials/page-title', ['title' => 'โปรไฟล์ผังองค์กร', 'pagetitle' => 'Minible']),
			
		];
		$data['title'] = 'ผังองค์กร';
		$data['profile'] = $this->organizeProfileModel->findAll();
		return view('organizeProfile/index', $data);
	}

	public function form($id='')
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'โปรไฟล์ผังองค์กร']),
			'page_title' => view('partials/page-title', ['title' => 'โปรไฟล์ผังองค์กร', 'pagetitle' => 'Minible']),
			
		];
		$year = array();
		$year_now = date('Y');
		$year_start = $year_now - 5;
		for ($i=0; $i <= 10 ; $i++) { 
			$year[$year_start+$i] = $year_start+$i+543;
		}
		$save_data = array();
		if ($id !== '') {
			$save_data = $this->organizeProfileModel->find($id);
		}
		$data['title'] = 'ผังองค์กร';
		$data['profile'] = $this->organizeProfileModel->findAll();
		$data['org_profile_id'] = $id !== ''? $id : '';
		$data['year'] = $year;
		$data['save_data'] = $save_data;
		return view('organizeProfile/form', $data);
	}

	public function view()
	{
		$data['title'] = 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.';
		$data['user'] = $this->userModel->findAll();
		echo "<pre>";
		print_r($data);
		die();
		return view('organizeProfile/view', $data);
	}

	public function saveProfile()
	{
		$params = [
			'org_profile_name' => $this->request->getVar('org_profile_name'),
			'org_profile_year' => $this->request->getVar('org_profile_year'),
			'org_profile_status' => $this->request->getVar('org_profile_status'),
			'org_date_announce' => $this->request->getVar('org_date_announce'),
		];
		if ($this->organizeProfileModel->save($params)) {
            // $this->session->setFlashdata('success', 'Brand has been saved.');
            return redirect()->to('OrganizeProfile');
        } else {
            // $this->getBrands();
            $this->data['errors'] = $this->organizeProfileModel->errors();
            return view('organizeProfile/form', $this->data);
        }
	}

	public function updateProfile()
	{
		
		$params = [
			'org_profile_id' => $this->request->getVar('org_profile_id'),
			'org_profile_name' => $this->request->getVar('org_profile_name'),
			'org_profile_year' => $this->request->getVar('org_profile_year'),
			'org_profile_status' => $this->request->getVar('org_profile_status'),
			'org_date_announce' => $this->request->getVar('org_date_announce'),
		];
		if ($this->organizeProfileModel->save($params)) {
            // $this->session->setFlashdata('success', 'Brand has been saved.');
            return redirect()->to('OrganizeProfile');
        } else {
            // $this->getBrands();
            $this->data['errors'] = $this->organizeProfileModel->errors();
            return view('organizeProfile/form', $this->data);
        }
	}

}
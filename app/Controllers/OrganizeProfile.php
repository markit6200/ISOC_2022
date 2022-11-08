<?php namespace App\Controllers;

use App\Models\OrganizeProfileModel;
use App\Models\OrganizeModel;

class OrganizeProfile extends BaseController
{
	public function __construct()
    {
		$this->organizeProfileModel = new OrganizeProfileModel();
		$this->organizeModel = new OrganizeModel();
    }

	public function index()
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
		$data['title'] = 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.';
		$data['profile'] = $this->organizeProfileModel->findAll();
		$data['year'] = $year;
		return view('organizeProfile/index', $data)
				. view('organizeProfile/modalDuplicate', $data);
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

	public function structure($profileId = '')
	{
		if ($profileId == '') {
			return redirect()->to('OrganizeProfile');
		}
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'โปรไฟล์ผังองค์กร']),
			'page_title' => view('partials/page-title', ['title' => 'โปรไฟล์ผังองค์กร', 'pagetitle' => 'Minible']),
			
		];
        $profile = $this->organizeProfileModel->find($profileId);
		$tree = $this->organizeModel->getOrgList($profileId,0,'',$profile['profileType']);
		$data['title'] = 'ผังองค์กร';
		$data['org_profile_id'] = $profileId;
		// $data['profile'] = $this->organizeProfileModel->findAll();
		$data['table_content'] = $tree;
		return view('organizeProfile/structure', $data);
	}


	public function structureForm($profileId,$org_parent=0,$org_id='')
	{
		if ($profileId == '') {
			return redirect()->to('OrganizeProfile');
		}
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'โปรไฟล์ผังองค์กร']),
			'page_title' => view('partials/page-title', ['title' => 'โปรไฟล์ผังองค์กร', 'pagetitle' => 'Minible']),
			
		];
		$save_data = array();
		if ($org_id != '') {
			$save_data = $this->organizeModel->where(array('org_profile_id'=>$profileId,'org_id'=>$org_id))->get()->getResultArray();
		}else{
		    $parent_data = $this->organizeModel->where(array('org_profile_id'=>$profileId,'org_id'=>$org_parent))->get()->getResultArray();
        }
		$data['title'] = 'ผังองค์กร';
		$data['save_data'] = !empty($save_data)?$save_data[0]:$save_data;
		$data['org_profile_id'] = $profileId;
		$data['org_parent'] = $org_parent;
		$data['parent_data'] = !empty($parent_data)?$parent_data[0]:$parent_data;
		$data['org_id'] = $org_id; 
		return view('organizeProfile/formStructure', $data);
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

	public function saveOrganize()
	{
		$params = [
			'org_profile_id' => $this->request->getVar('org_profile_id'),
			'org_id' => $this->request->getVar('org_id'),
			'org_name' => $this->request->getVar('org_name'),
			'org_profile_year' => $this->request->getVar('org_profile_year'),
			'org_short_name' => $this->request->getVar('org_short_name'),
			'org_parent' => $this->request->getVar('org_parent'),
			'profileType' => $this->request->getVar('profileType'),
		];
		
		if ($this->organizeModel->save($params)) {
            // $this->session->setFlashdata('success', 'Brand has been saved.');
            return redirect()->to('OrganizeProfile');
        } else {
            // $this->getBrands();
            $this->data['errors'] = $this->organizeModel->errors();
            return view('organizeProfile/form', $this->data);
        }
	}

	public function updateOrganize()
	{
		$params = [
			'org_profile_id' => $this->request->getVar('org_profile_id'),
			'org_id' => $this->request->getVar('org_id'),
			'org_name' => $this->request->getVar('org_name'),
			'org_profile_year' => $this->request->getVar('org_profile_year'),
			'org_short_name' => $this->request->getVar('org_short_name'),
			'org_parent' => $this->request->getVar('org_parent'),
			'profileType' => $this->request->getVar('profileType'),
		];
		if ($this->organizeModel->save($params)) {
            // $this->session->setFlashdata('success', 'Brand has been saved.');
            return redirect()->to('OrganizeProfile');
        } else {
            // $this->getBrands();
            $this->data['errors'] = $this->organizeModel->errors();
            return view('organizeProfile/form', $this->data);
        }
	}

	public function ajax_org_list()
	{
		$data = $this->organizeModel->where(array('org_parent'=>0))->get()->getResult();
		
		$test = array();
		foreach ($data as $key => $value) {
			$count = $this->organizeModel->where(array('org_parent'=> $value->org_id))->countAllResults();
			$tmp = array();
			$tmp['id'] = $value->org_id;
			$tmp['text'] = $value->org_name;
			$tmp['type'] = 'root';
			$tmp['children'] = $count>0 ? true : false;
			$test[] = $tmp;

		}
		return json_encode($test);
	}

	public function ajax_org_list_child()
	{
		$id = $_GET['id'];
		$data = $this->organizeModel->where(array('org_parent'=>$id))->get()->getResult();
		
		$test = array();
		foreach ($data as $key => $value) {
			$count = $this->organizeModel->where(array('org_parent'=> $value->org_id))->countAllResults();
			$tmp = array();
			$tmp['id'] = $value->org_id;
			$tmp['text'] = $value->org_name;
			$tmp['type'] = 'root';
			$tmp['children'] = $count>0 ? true : false;
			$test[] = $tmp;

		}
		return json_encode($test);
	}

	public function saveStructure(){
        $params = [
            'org_profile_id' => $this->request->getVar('org_profile_id'),
            'org_id' => $this->request->getVar('org_id'),
            'org_name' => $this->request->getVar('org_name'),
            'org_profile_year' => $this->request->getVar('org_profile_year'),
            'org_short_name' => $this->request->getVar('org_short_name'),
            'org_parent' => $this->request->getVar('org_parent'),
            'profileType' => $this->request->getVar('profileType'),
        ];
        if ($this->organizeModel->save($params)) {
            // $this->session->setFlashdata('success', 'Brand has been saved.');
            return redirect()->to('OrganizeProfile/structure/'.$params['org_profile_id']);
        } else {
            // $this->getBrands();
            $this->data['errors'] = $this->organizeModel->errors();
            return view('organizeProfile/form', $this->data);
        }
    }

	public function updateStructure(){
        $params = [
            'org_profile_id' => $this->request->getVar('org_profile_id'),
            'org_id' => $this->request->getVar('org_id'),
            'org_name' => $this->request->getVar('org_name'),
            'org_profile_year' => $this->request->getVar('org_profile_year'),
            'org_short_name' => $this->request->getVar('org_short_name'),
            'org_parent' => $this->request->getVar('org_parent'),
            'profileType' => $this->request->getVar('profileType'),
        ];
        if ($this->organizeModel->save($params)) {
            // $this->session->setFlashdata('success', 'Brand has been saved.');
            return redirect()->to('OrganizeProfile/structure/'.$params['org_profile_id']);
        } else {
            // $this->getBrands();
            $this->data['errors'] = $this->organizeModel->errors();
            return view('organizeProfile/form', $this->data);
        }
    }

	public function duplicateProfile()
	{
		// echo "<pre>";
		// print_r($this->request->getVar());
		// die();
		$id = $this->request->getVar('org_profile_id');
		$params = [
			'org_profile_name' => $this->request->getVar('org_profile_name'),
			'org_profile_year' => $this->request->getVar('org_profile_year'),
			'org_profile_status' => $this->request->getVar('org_profile_status'),
			'org_date_announce' => $this->request->getVar('org_date_announce'),
		];

		if ($this->organizeProfileModel->save($params)){
			$new_id = $this->organizeProfileModel->insertID;
			$profileData = $this->organizeModel->where(array('org_profile_id'=>$id))->get()->getResultArray();
			
			if (!empty($profileData)) {
				$this->organizeModel->transBegin();
				foreach ($profileData as $key => $value) {
					// $value['org_profile_id'] = $new_id;
					$params = [
						'org_profile_id' => $new_id,
						'org_id' => $value['org_id'],
						'org_name' => $value['org_name'],
						'org_profile_year' => $value['org_profile_year'],
						'org_short_name' => $value['org_short_name'],
						'org_parent' => $value['org_parent'],
						'profileType' => $value['profileType']
					];
					
					$saveData = $this->organizeModel->insert($params);
					echo "<pre>";
					print_r($params);
					print_r($saveData);
					die();
				}

				if ($this->organizeModel->transStatus() === false) {
					$this->organizeModel->transRollback();
					echo 'fail';
				} else {
					$this->organizeModel->transCommit();
					echo 'success';
				}
			} else {
				echo 'success';
			}
		} else {
			echo 'fail';
		}
	}

}

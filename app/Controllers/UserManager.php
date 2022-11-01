<?php namespace App\Controllers;

use App\Models\GeneralModel;
use App\Models\UsersModel;
use App\Models\UserMainMenuModel;

class UserManager extends BaseController
{
	public function __construct()
    {
		$this->userModel = new UsersModel();
		$this->UserMainMenuModel = new UserMainMenuModel();
        $this->GeneralModel = new GeneralModel();
    }

	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
			
		];
		$data['title'] = 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.';
		// $data['table_content'] = $tree;
		$data['users'] = $this->userModel->findAll();
		return view('userManager/index', $data);
	}

	public function view()
	{
		$data['title'] = 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.';
		$data['user'] = $this->userModel->findAll();
//		echo "<pre>";
//		print_r($data);
//		die();
		return view('userManager/view', $data);
	}

	public function form($id = ''){
        $general_data = new GeneralModel();
        $codePrefix = $general_data->getPrefix();
        $save_data = array();
        if($id != ''){
            $save_data = $this->userModel->find($id);
        }
        $codePrefix = $general_data->getPrefix();
        $data = [
            'title' => 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.',
            'title_meta' => view('partials/title-meta', ['title' => 'ข้อมูลกำลังพล']),
            'page_title' => view('partials/page-title', ['title' => 'ข้อมูลกำลังพล', 'pagetitle' => 'ข้อมูลกำลังพล']),
            'save_data' => $save_data,
            'codePrefix' => $codePrefix,
        ];
        return view('userManager/form', $data);
    }

    public function userGroupView(){
        $data['title'] = 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.';
        $data['user_group'] = $this->UserMainMenuModel->findAll();
        return view('userManager/userGroupView', $data);
    }

    public function userGroupForm(){
        $data['title'] = 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.';
        return view('userManager/userGroupForm', $data);
    }

	public function saveUserGroup()
	{
		$param = [
			'NLABEL' => $this->request->getVar('NLABEL'),
			'department_name' => $this->request->getVar('department_name'),
			'NLABEL_ENG' => $this->request->getVar('NLABEL_ENG'),
			'department_name_eng' => $this->request->getVar('department_name_eng'),
			'address' => $this->request->getVar('address'),
			'address_en' => $this->request->getVar('address_en'),
			'tel1' => $this->request->getVar('tel1'),
			'email' => $this->request->getVar('email'),
			'website' => $this->request->getVar('website'),
			'status_login' => $this->request->getVar('status_login'),
			'date_start' => $this->request->getVar('date_start'),
			'date_end' => $this->request->getVar('date_end'),
			'time_start' => $this->request->getVar('time_start'),
			'time_end' => $this->request->getVar('time_end'),
			'banner' => $this->request->getVar('banner'),
		];
	}

	public function updateUserGroup()
	{
		$param = [
			'NLABEL' => $this->request->getVar('NLABEL'),
			'department_name' => $this->request->getVar('department_name'),
			'NLABEL_ENG' => $this->request->getVar('NLABEL_ENG'),
			'department_name_eng' => $this->request->getVar('department_name_eng'),
			'address' => $this->request->getVar('address'),
			'address_en' => $this->request->getVar('address_en'),
			'tel1' => $this->request->getVar('tel1'),
			'email' => $this->request->getVar('email'),
			'website' => $this->request->getVar('website'),
			'status_login' => $this->request->getVar('status_login'),
			'date_start' => $this->request->getVar('date_start'),
			'date_end' => $this->request->getVar('date_end'),
			'time_start' => $this->request->getVar('time_start'),
			'time_end' => $this->request->getVar('time_end'),
			'banner' => $this->request->getVar('banner'),
		];
	}

	public function saveUser()
	{
		$params = [
			'username' => $this->request->getVar('username'),
			'pwd' => md5($this->request->getVar('pwd')),
			'idcard' => $this->request->getVar('idcard'),
			'prename_th' => $this->request->getVar('prename_th'),
			'name_th' => $this->request->getVar('name_th'),
			'surname_th' => $this->request->getVar('surname_th'),
			'name_en' => $this->request->getVar('name_en'),
			'surname_en' => $this->request->getVar('surname_en'),
			'office' => $this->request->getVar('office'),
			'sex' => $this->request->getVar('sex'),
			'birthday' => $this->request->getVar('birthday'),
//			'org_id' => $this->request->getVar('org_id'),
			'address' => $this->request->getVar('address'),
			'telno' => $this->request->getVar('telno'),
			'email' => $this->request->getVar('email'),
			'login_image' => $this->request->getVar('login_image'),
		];
        if ($this->userModel->save($params)) {
             $this->session->setFlashdata('success', 'บันทึกข้อมูลสำเร็จ');
            return redirect()->to('userManager');
        } else {
            // $this->getBrands();
            $this->data['errors'] = $this->userModel->errors();
            return view('userManager/form/'.$id, $this->data);
        }
	}

    public function updateUser($id)
    {
        $params = [
            'runid' => $id,
//            'username' => $this->request->getVar('username'),
//            'pwd' => $this->request->getVar('pwd'),
            'idcard' => $this->request->getVar('idcard'),
            'prename_th' => $this->request->getVar('prename_th'),
            'name_th' => $this->request->getVar('name_th'),
            'surname_th' => $this->request->getVar('surname_th'),
            'name_en' => $this->request->getVar('name_en'),
            'surname_en' => $this->request->getVar('surname_en'),
            'office' => $this->request->getVar('office'),
            'sex' => $this->request->getVar('sex'),
            'birthday' => $this->request->getVar('birthday'),
//            'org_id' => $this->request->getVar('org_id'),
            'address' => $this->request->getVar('address'),
            'telno' => $this->request->getVar('telno'),
            'email' => $this->request->getVar('email'),
            'login_image' => $this->request->getVar('login_image'),
        ];
        if ($this->userModel->save($params)) {
            $this->session->setFlashdata('success', 'บันทึกข้อมูลสำเร็จ');
            return redirect()->to('userManager');
        } else {
            // $this->getBrands();
            $this->data['errors'] = $this->userModel->errors();
            return view('userManager/form/'.$id, $this->data);
        }
    }
}

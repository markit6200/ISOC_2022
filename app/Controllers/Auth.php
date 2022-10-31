<?php


namespace App\Controllers;
use App\Models\UsersModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UsersModel();
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
        helper(['form']);
        return view('auth/signin', $data);
    }

    public function log_out(){
        $session = session();
        $session->destroy();
        return redirect()->to('/auth');
    }

    public function recoverpw(){
        return view('auth/auth-recoverpw');
    }

}

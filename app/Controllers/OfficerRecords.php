<?php

namespace App\Controllers;
use App\Models\OrganizeForcesModel;

class OfficerRecords extends BaseController
{
    public function __construct()
    {
    }

    public function index(){

        $org = new OrganizeForcesModel();
        $tree = $org->getOfficerTreeList(1,640,'', 3);

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'ระบบทำเนียบกำลังพลตามอัตราช่วยราชการ กอ.รมน.']),
            'page_title' => view('partials/page-title', ['title' => 'ระบบทำเนียบกำลังพลตามอัตราช่วยราชการ กอ.รมน.','pagetitle' => '']),

        ];
        $data['title'] = 'ระบบทำเนียบรายชื่อข้าราชการพลเรือน/ลูกจ้างชั่วคราว/พนักงานราชการ';
        $data['datas'] = '';
        $data['table_content'] = $tree;

        $data['typeForce'] = 3;

        return view('officerRecords/index', $data);
    }

}
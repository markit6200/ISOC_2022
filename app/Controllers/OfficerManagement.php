<?php

namespace App\Controllers;

use App\Models\DataPersonalForcesMapModel;
use App\Models\DataPersonalForcesModel;
use App\Models\GeneralModel;
use App\Models\OrganizeForcesModel;
use App\Models\PersonalForceModel;

class OfficerManagement extends BaseController
{

    protected $perPage = 100;

    public function __construct()
    {
        $this->DataPersonalForcesMapModel = new DataPersonalForcesMapModel();
        $this->personalForcesModel = new DataPersonalForcesModel();
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
        return view('officerManagement/index', $data);
    }

    public function view (){
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
            'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
        ];
        return view('officerManagement/view', $data);
    }

    public function form(){
        $data = array();
        return view('officerManagement/form', $data);
    }

    public function confirm(){
        $data = array();
        return view('officerManagement/confirm', $data);
    }

    public function history(){
        $data = [];
        return view('officerManagement/history', $data);
    }


}
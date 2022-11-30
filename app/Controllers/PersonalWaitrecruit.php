<?php


namespace App\Controllers;

use App\Models\DataPersonalWaitrecruitModel;
use App\Models\GeneralModel;

class PersonalWaitrecruit extends BaseController
{
    public function __construct()
    {
        $this->DataPersonalWaitrecruitModel = new DataPersonalWaitrecruitModel();
        $this->GeneralModel = new GeneralModel();
    }

    public function index()
    {
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'ระบบย่อยบันทึกรายชื่อผู้รอการบรรจุ']),
            'page_title' => view('partials/page-title', ['title' => 'ระบบย่อยบันทึกรายชื่อผู้รอการบรรจุ', 'pagetitle' => 'Minible']),
        ];

        $person = $this->DataPersonalWaitrecruitModel->select('*')
            ->join('isoc_master.DSLPrefix', 'isoc_master.DSLPrefix.codePrefix = DataPersonalWaitrecruit.codePrefix');
        if ($txtSearch = $this->request->getGet('search')) {
            $where = "cardID LIKE '%{$txtSearch}%' OR firstName LIKE '%{$txtSearch}%' OR lastName LIKE '%{$txtSearch}%'";
            $person->where($where);
        }
        $data['personal'] = $person->findAll();

        $num = $this->DataPersonalWaitrecruitModel->select("count(*) AS total,
                                                        count( CASE WHEN gender = '0' THEN 1 END ) AS male,
                                                        count( CASE WHEN gender = '1' THEN 1 END ) AS female ");
        $data['number'] = $num->findAll();
        return view('personalWaitrecruit/index', $data);
    }

    public function form($id = '')
    {
        $general_data = new GeneralModel();
        $codePrefix = $general_data->getPrefix();
        $save_data = array();
        if ($id != '') {
            $save_data = $this->DataPersonalWaitrecruitModel->find($id);
        }
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'ระบบย่อยบันทึกรายชื่อผู้รอการบรรจุ']),
            'page_title' => view('partials/page-title', ['title' => 'ระบบย่อยบันทึกรายชื่อผู้รอการบรรจุ', 'pagetitle' => 'Minible']),
            'codePrefix' => $codePrefix,
            'save_data' => $save_data,
        ];
        return view('personalWaitrecruit/form', $data);
    }

    public function save()
    {
        $cardid = $this->request->getVar('cardID');
        $pattern = '/-/i';
        $newcard = preg_replace($pattern, '', $cardid);
        
        $sum = 0;
        $digi = 13;
        foreach ($newcard as $key) {
            $digi > 1 ? $sum += $digi * intval($key) : null;
            $digi--;
        }
        $x = $sum % 11;
        $n13 = $x <= 1 ? 1 - $x : 11 - $x;
        if ($n13 != $newcard[12]) {
            return  'เลขบัตรประชาชนไม่ถูกต้องกรุณาตรวจสอบอีกครั้ง';
        } else {
            return  'ok';
            date_default_timezone_set("Asia/Bangkok");
            $params = [
                'cardID' => $newcard,
                'codePrefix' => $this->request->getVar('codePrefix'),
                'firstName' => $this->request->getVar('firstName'),
                'lastName' => $this->request->getVar('lastName'),
                'originPosition' => $this->request->getVar('originPosition'),
                'gender' => $this->request->getVar('gender'),
                'dateInsert' => date("Y-m-d")
            ];
            if ($this->DataPersonalWaitrecruitModel->save($params)) {
                return redirect()->to('personalWaitrecruit');
            } else {
                $this->data['errors'] = $this->DataPersonalWaitrecruitModel->errors();
                return view('personalWaitrecruit/form', $this->data);
            }
        }
    }

    public function update($id)
    {
        $cardid = $this->request->getVar('cardID');
        $pattern = '/-/i';
        $newcard = preg_replace($pattern, '', $cardid);
        $params = [
            'pid' => $id,
            'cardID' => $newcard,
            'codePrefix' => $this->request->getVar('codePrefix'),
            'firstName' => $this->request->getVar('firstName'),
            'lastName' => $this->request->getVar('lastName'),
            'originPosition' => $this->request->getVar('originPosition'),
            'gender' => $this->request->getVar('gender'),
        ];


        if ($this->DataPersonalWaitrecruitModel->save($params)) {
            return redirect()->to('personalWaitrecruit');
        } else {
            $this->data['errors'] = $this->DataPersonalWaitrecruitModel->errors();
            return view('personalWaitrecruit/form/' . $id, $this->data);
        }
    }

    public function delete($id)
    {
        $personal = $this->DataPersonalWaitrecruitModel->find($id);
        if (!$personal) {
            $this->session->setFlashdata('errors', 'Invalid brand');
            return redirect()->to('personalWaitrecruit');
        }

        if ($this->DataPersonalWaitrecruitModel->delete($personal['pid'])) {
            $this->session->setFlashdata('success', 'The brand has been deleted');
            return redirect()->to('personalWaitrecruit');
        } else {
            $this->session->setFlashdata('errors', 'Could not delete the brand');
            return redirect()->to('personalWaitrecruit');
        }
    }
}

<?php namespace App\Controllers;
ini_set('memory_limit', '-1');

use App\Models\OrganizeProfileModel;
use App\Models\UsersModel;
use App\Models\OrganizeModel;
use App\Models\GeneralModel;
use App\Models\DataPositionMapOrganizeModel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Libraries\CompareText;

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

	public function index($profileId = '1')
	{
        $profile = $this->organizeProfileModel->find($profileId);
		$tree = $this->OrganizeModel->getTreeList($profileId,0,'',$profile['profileType']);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
			
		];
		$data['title'] = 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.';
		$data['table_content'] = $tree;
		$data['id'] = $profileId;
		
		return view('structureByAsRate/index', $data);
	}

	public function view($profileId = '1')
	{
		$profile = $this->organizeProfileModel->find($profileId);
		$tree = $this->OrganizeModel->getTreeList($profileId,0,'',$profile['profileType']);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
			
		];
		$data['title'] = 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.';
		$data['table_content'] = $tree;
		$data['id'] = $profileId;
		
		return view('structureByAsRate/index', $data);
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
            'profile_id' => $org->org_profile_id
		];
		return view('structureByAsRate/form', $data);
	}

	public function import($id)
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.', 'pagetitle' => 'Minible']),
			'profileId' => $id
		];
		return view('structureByAsRate/import', $data);
	}

	public function save()
    {
        $profile = $this->organizeProfileModel->find($this->request->getVar('profile_id'));
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
			'profileType' => $profile['profileType'],
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

	public function importFile()
	{
		// echo 'a';
		// echo $this->request->getVar('rowStarts');
		// print_r($this->request->getFile('uploadFile'));
		// die();
		// Validation
		// $input = $this->validate([
		// 	'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,csv],'
		// ]);
		// if (!$input) { // Not valid
		// 	$data['validation'] = $this->validator;
		// 	echo "<pre>";
		// 	print_r($data['validation']);
		// 	die();
		// 	return view('structureByAsRate/import', $data);
		// } else { // Valid
			$profileId = $this->request->getVar('profileId') != '' ? $this->request->getVar('profileId') : 2;
			$rowStart = $this->request->getVar('rowStart') != '' ? $this->request->getVar('rowStart') : 2;
			if ($file = $this->request->getFile('uploadFile')) {
				$extensi = $file->getClientExtension();

				if ($extensi == 'xls') {
					$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
				} else if ($extensi == 'xlsx') {
					$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				} else {
					session()->setFlashdata('error', 'Error');
					return redirect()->back()->withInput();
				}
				$preadsheet = $render->load($file);
        		$data = $preadsheet->getActiveSheet()->toArray();
				if (!empty($data)) {
					$this->DataPositionMapOrganizeModel->transBegin();
					$db = db_connect();
					$builder = $db->table('TmpImportExcel');
					$uploadId = $builder->selectMax('uploadId')->get()->getResult()[0]->uploadId + 1;
					foreach($data as $key => $value){
						if ($key-1 >= $rowStart) {
							$this->DataPositionMapOrganizeModel->query(
								"insert into `TmpImportExcel` (
									`positionName`,
									`positionType`,
									`prename`,
									`firstname`,
									`lastname`,
									`cardId`,
									`cardNo`,
									`group`,
									`dateStart`,
									`monthStart`,
									`yearStart`,
									`dateEnd`,
									`monthEnd`,
									`yearEnd`,
									`position`,
									`orgId1`,
									`orgId2`,
									`orgId3`,
									`orgId4`,
									`orgId5`,
									`orgId6`,
									`orgId7`,
									`orgId8`,
									`orgId9`,
									`orgId10`,
									`orgId11`,
									`orgId12`,
									`positionGroup`,
									`positionCivilian`,
									`level`,
									`rank`,
									`positionNo`,
									`cmdNo`,
									`cmdOutNo`,
									`profileType`,
									`uploadId`
								) values (
									'".trim($value[1])."',
									'".trim($value[2])."',
									'".trim($value[3])."',
									'".trim($value[4])."',
									'".trim($value[5])."',
									'".preg_replace('/\s+/', '', trim($value[6]))."',
									'".trim($value[7])."',
									'".trim($value[8])."',
									'".trim($value[9])."',
									'".trim($value[10])."',
									'".trim($value[11])."',
									'".trim($value[12])."',
									'".trim($value[13])."',
									'".trim($value[14])."',
									'".trim($value[15])."',
									'".trim($value[16])."',
									'".trim($value[17])."',
									'".trim($value[18])."',
									'".trim($value[19])."',
									'".trim($value[20])."',
									'".trim($value[21])."',
									'".trim($value[22])."',
									'".trim($value[23])."',
									'".trim($value[24])."',
									'".trim($value[25])."',
									'".trim($value[26])."',
									'".trim($value[27])."',
									'".trim($value[28])."',
									'".trim($value[29])."',
									'".trim($value[30])."',
									'".trim($value[31])."',
									'".trim($value[32])."',
									'".trim($value[33])."',
									'".trim($value[34])."',
									'".trim($value[35])."',
									'".($uploadId)."'
								);"
							);
						}
					}
					if ($this->DataPositionMapOrganizeModel->transStatus() === false) {
						$this->DataPositionMapOrganizeModel->transRollback();
						$this->session->setFlashdata('errors', 'upload fail');
						return redirect()->to('StructureByAssistRate/import');
					} else {
						$this->DataPositionMapOrganizeModel->transCommit();
						$previewData = $this->OrganizeModel->importToDB($uploadId,2);
						if ($previewData) {
							return redirect()->to('StructureByAssistRate/view/'.$profileId);
						}else{
							$this->session->setFlashdata('errors', 'import fail');
							return redirect()->to('StructureByAssistRate/import');
						}
						// echo 'success';
						// return redirect()->to('StructureByAssistRate/preview/1');
					}
				}
				
				// if ($file->isValid() && !$file->hasMoved()) {
				// 	// Get random file name
				// 	$newName = $file->getRandomName();
				// 	// Store file in public/csvfile/ folder
				// 	$file->move('../public/csvfile', $newName);
				// 	// Reading file
				// 	$file = fopen("../public/csvfile/" . $newName, "r");
				// 	$i = 0;
				// 	$numberOfFields = 4; // Total number of fields
				// 	$importData_arr = array();
				// 	echo "<pre>";
				// 	print_r(($filedata = fgets($file, 1000, ",")));
				// 	die();
				// 	// Initialize $importData_arr Array
				// 	while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
				// 		$num = count($filedata);
				// 		// Skip first row & check number of fields
				// 		if ($i > 0 && $num == $numberOfFields) {
				// 			// Key names are the insert table field names - name, email, city, and status
				// 			$importData_arr[$i]['name'] = $filedata[0];
				// 			$importData_arr[$i]['email'] = $filedata[1];
				// 			$importData_arr[$i]['city'] = $filedata[2];
				// 			$importData_arr[$i]['status'] = $filedata[3];
				// 		}
				// 		$i++;
				// 	}
				// 	fclose($file);
				// 	// Insert data
				// 	// $count = 0;
				// 	// foreach ($importData_arr as $userdata) {
				// 	// 	$users = new Users();
				// 	// 	// Check record
				// 	// 	$checkrecord = $users->where('email', $userdata['email'])->countAllResults();
				// 	// 	if ($checkrecord == 0) {
				// 	// 		## Insert Record
				// 	// 		if ($users->insert($userdata)) {
				// 	// 			$count++;
				// 	// 		}
				// 	// 	}
				// 	// }
				// 	// Set Session
				// 	// session()->setFlashdata('message', $count . ' Record inserted successfully!');
				// 	// session()->setFlashdata('alert-class', 'alert-success');
				// 	echo 'Pass';
				// 	die();
				// } else {
				// 	// Set Session
				// 	// session()->setFlashdata('message', 'File not imported.');
				// 	// session()->setFlashdata('alert-class', 'alert-danger');
				// 	echo 'failed';
				// 	die();
				// }
			// } else {
			// 	// Set Session
			// 	// session()->setFlashdata('message', 'File not imported.');
			// 	// session()->setFlashdata('alert-class', 'alert-danger');
			// 	echo 'failed';
			// 	die();
			// }
		}
		// return redirect()->route('/');
	}
	
	public function preview($id)
	{
		$previewData = $this->OrganizeModel->importToDB($id,2);
		die();
		$previewData = $this->OrganizeModel->getTempImport($id);
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
			'previewData' => $previewData
		];
		
		return view('structureByAsRate/preview', $data);
	}

	public function ajaxGetRank($id)
	{
		$positionRank = $this->GeneralModel->getPositionRankTo($id);
		$data['positionRank'] = $positionRank;

		return view('structureByAsRate/ajaxRankTo', $data);
	}
}

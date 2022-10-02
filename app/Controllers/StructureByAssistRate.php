<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\OrganizeModel;
class StructureByAssistRate extends BaseController
{
	public function index()
	{
		$db = db_connect('tests');
		echo "<pre>";
		print_r($db);
		die();
		// // $db = \Config\Database::connect();
		// $db = db_connect();
		// $query   = $db->query('SELECT * FROM users');
		// $results = $query->getResult();
		// echo "<pre>";
		// print_r($results);
		// die();
	// echo 'Total Results: ' . count($results);
		// $user = new UsersModel();
		// $test = $user->findAll();
		// echo "<pre>";
		// print_r($test);
		// die();
		
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
			
		];
		$data['title'] = 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.';
		
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

	public function form()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.', 'pagetitle' => 'Minible']),
		];
		return view('structureByAsRate/form', $data);
	}

}
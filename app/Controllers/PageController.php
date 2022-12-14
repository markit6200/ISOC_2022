<?php namespace App\Controllers;

class PageController extends BaseController
{
	public function index()
	{
		//index method
	}

	public function show_auth_login(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Login'])
		];
		return view('example/auth-login', $data);
	}

	public function show_auth_register(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Register'])
		];
		return view('example/auth-register', $data);
	}

	public function show_auth_recoverpw(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Recover Password'])
		];
		return view('example/auth-recoverpw', $data);
	}

	public function show_auth_lock_screen(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Lock screen'])
		];
		return view('example/auth-lock-screen', $data);
	}

	public function show_pages_starter(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Starter Page']),
			'page_title' => view('partials/page-title', ['title' => 'Starter Page', 'pagetitle' => 'Utility'])
		];
		return view('example/pages-starter', $data);
	}

	public function show_pages_maintenance(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Maintenance'])
		];
		return view('example/pages-maintenance', $data);
	}

	public function show_pages_comingsoon(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Coming Soon'])
		];
		return view('example/pages-comingsoon', $data);
	}

	public function show_pages_timeline(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Timeline']),
			'page_title' => view('partials/page-title', ['title' => 'Timeline', 'pagetitle' => 'Utility'])
		];
		return view('example/pages-timeline', $data);
	}

	public function show_pages_faqs(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'FAQS']),
			'page_title' => view('partials/page-title', ['title' => 'FAQS', 'pagetitle' => 'Utility'])
		];
		return view('example/pages-faqs', $data);
	}

	public function show_pages_pricing(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Pricing']),
			'page_title' => view('partials/page-title', ['title' => 'Pricing', 'pagetitle' => 'Utility'])
		];
		return view('example/pages-pricing', $data);
	}

	public function show_pages_404(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Error 404'])
		];
		return view('example/pages-404', $data);
	}

	public function show_pages_500(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Error 500'])
		];
		return view('example/pages-500', $data);
	}

	public function show_invoices_list(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Invoice List']),
			'page_title' => view('partials/page-title', ['title' => 'Invoice List', 'pagetitle' => 'Invoices'])
		];
		return view('example/invoices-list', $data);
	}

	public function show_invoices_detail(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Invoice Detail']),
			'page_title' => view('partials/page-title', ['title' => 'Invoice Detail', 'pagetitle' => 'Invoices'])
		];
		return view('example/invoices-detail', $data);
	}

	public function show_contacts_grid(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'User Grid']),
			'page_title' => view('partials/page-title', ['title' => 'User Grid', 'pagetitle' => 'Contacts'])
		];
		return view('example/contacts-grid', $data);
	}

	public function show_contacts_list(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'User List']),
			'page_title' => view('partials/page-title', ['title' => 'User List', 'pagetitle' => 'Contacts'])
		];
		return view('example/contacts-list', $data);
	}

	public function show_contacts_profile(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Profile']),
			'page_title' => view('partials/page-title', ['title' => 'Profile', 'pagetitle' => 'Contacts'])
		];
		return view('example/contacts-profile', $data);
	}

	//--------------------------------------------------------------------

}

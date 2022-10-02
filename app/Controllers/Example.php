<?php namespace App\Controllers;

class Example extends BaseController
{
	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Minible']),
		];
		return view('example', $data);
	}

	public function show_layouts_horizontal(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Horizontal', 'pagetitle' => 'Layouts'])
		];
		return view('example/layouts-horizontal', $data);
	}

	public function show_layouts_vertical(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Vertical Layout']),
			'page_title' => view('partials/page-title', ['title' => 'Vertical', 'pagetitle' => 'Layouts'])
		];
		return view('example/layouts-vertical', $data);
	}

	public function show_layouts_dark_sidebar(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dark Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Dark Sidebar', 'pagetitle' => 'Vertical'])
		];
		return view('example/layouts-dark-sidebar', $data);
	}

	public function show_layouts_hori_topbar_dark(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dark Topbar']),
			'page_title' => view('partials/page-title', ['title' => 'Dark Topbar', 'pagetitle' => 'Horizontal'])
		];
		return view('example/layouts-hori-topbar-dark', $data);
	}

	public function show_layouts_hori_boxed_width(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Boxed Width']),
			'page_title' => view('partials/page-title', ['title' => 'Boxed Width', 'pagetitle' => 'Horizontal'])
		];
		return view('example/layouts-hori-boxed-width', $data);
	}

	public function show_layouts_hori_preloader(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Preloader']),
			'page_title' => view('partials/page-title', ['title' => 'Preloader', 'pagetitle' => 'Horizontal'])
		];
		return view('example/layouts-hori-preloader', $data);
	}

	public function show_layouts_compact_sidebar(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Compact Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Compact Sidebar', 'pagetitle' => 'Vertical'])
		];
		return view('example/layouts-compact-sidebar', $data);
	}

	public function show_layouts_icon_sidebar(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Icon Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Icon Sidebar', 'pagetitle' => 'Vertical'])
		];
		return view('example/layouts-icon-sidebar', $data);
	}

	public function show_layouts_boxed(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Boxed Width']),
			'page_title' => view('partials/page-title', ['title' => 'Boxed Width', 'pagetitle' => 'Vertical'])
		];
		return view('example/layouts-boxed', $data);
	}

	public function show_layouts_preloader(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Preloader']),
			'page_title' => view('partials/page-title', ['title' => 'Preloader', 'pagetitle' => 'Vertical'])
		];
		return view('example/layouts-preloader', $data);
	}

	public function show_layouts_colored_sidebar(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Colored Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Colored Sidebar', 'pagetitle' => 'Vertical'])
		];
		return view('example/layouts-colored-sidebar', $data);
	}

	/* App  */
	
	public function show_calendar(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Calendar']),
			'page_title' => view('partials/page-title', ['title' => 'Calendar', 'pagetitle' => 'Apps'])
		];
		return view('example/calendar', $data);
	}

	public function show_chat(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Chat']),
			'page_title' => view('partials/page-title', ['title' => 'Chat', 'pagetitle' => 'Apps'])
		];
		return view('example/chat', $data);
	}

	public function show_ecommerce_products(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Products']),
			'page_title' => view('partials/page-title', ['title' => 'Products', 'pagetitle' => 'Ecommerce'])
		];
		return view('example/ecommerce-products', $data);
	}

	public function show_ecommerce_product_detail(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Product Detail']),
			'page_title' => view('partials/page-title', ['title' => 'Product Detail', 'pagetitle' => 'Products'])
		];
		return view('example/ecommerce-product-detail', $data);
	}

	public function show_ecommerce_orders(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Orders']),
			'page_title' => view('partials/page-title', ['title' => 'Orders', 'pagetitle' => 'Ecommerce'])
		];
		return view('example/ecommerce-orders', $data);
	}

	public function show_ecommerce_customers(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Customers']),
			'page_title' => view('partials/page-title', ['title' => 'Customers', 'pagetitle' => 'Ecommerce'])
		];
		return view('example/ecommerce-customers', $data);
	}

	public function show_ecommerce_cart(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Cart']),
			'page_title' => view('partials/page-title', ['title' => 'Cart', 'pagetitle' => 'Ecommerce'])
		];
		return view('example/ecommerce-cart', $data);
	}

	public function show_ecommerce_checkout(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Checkout']),
			'page_title' => view('partials/page-title', ['title' => 'Checkout', 'pagetitle' => 'Ecommerce'])
		];
		return view('example/ecommerce-checkout', $data);
	}

	public function show_ecommerce_shops(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Shops']),
			'page_title' => view('partials/page-title', ['title' => 'Shops', 'pagetitle' => 'Ecommerce'])
		];
		return view('example/ecommerce-shops', $data);
	}

	public function show_ecommerce_add_product(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Add Product']),
			'page_title' => view('partials/page-title', ['title' => 'Add Product', 'pagetitle' => 'Ecommerce'])
		];
		return view('example/ecommerce-add-product', $data);
	}

	public function show_email_inbox(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Inbox']),
			'page_title' => view('partials/page-title', ['title' => 'Inbox', 'pagetitle' => 'Email'])
		];
		return view('example/email-inbox', $data);
	}

	public function show_email_read(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Read Email']),
			'page_title' => view('partials/page-title', ['title' => 'Read Email', 'pagetitle' => 'Email'])
		];
		return view('example/email-read', $data);
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

	/* End App */

	/* Component */

	public function show_ui_alerts(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Alerts']),
			'page_title' => view('partials/page-title', ['title' => 'Alerts', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-alerts', $data);
	}

	public function show_ui_buttons(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Buttons']),
			'page_title' => view('partials/page-title', ['title' => 'Buttons', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-buttons', $data);
	}

	public function show_ui_cards(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Cards']),
			'page_title' => view('partials/page-title', ['title' => 'Cards', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-cards', $data);
	}

	public function show_ui_carousel(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Carousel']),
			'page_title' => view('partials/page-title', ['title' => 'Carousel', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-carousel', $data);
	}

	public function show_ui_dropdowns(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dropdowns']),
			'page_title' => view('partials/page-title', ['title' => 'Dropdowns', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-dropdowns', $data);
	}

	public function show_ui_grid(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Grid']),
			'page_title' => view('partials/page-title', ['title' => 'Grid', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-grid', $data);
	}

	public function show_ui_images(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Images']),
			'page_title' => view('partials/page-title', ['title' => 'Images', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-images', $data);
	}

	public function show_ui_lightbox(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Lightbox']),
			'page_title' => view('partials/page-title', ['title' => 'Lightbox', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-lightbox', $data);
	}

	public function show_ui_modals(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Modals']),
			'page_title' => view('partials/page-title', ['title' => 'Modals', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-modals', $data);
	}

	public function show_ui_rangeslider(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Range Slider']),
			'page_title' => view('partials/page-title', ['title' => 'Range Slider', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-rangeslider', $data);
	}

	public function show_ui_session_timeout(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Session Timeout']),
			'page_title' => view('partials/page-title', ['title' => 'Session Timeout', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-session-timeout', $data);
	}

	public function show_ui_progressbars(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Progress Bars']),
			'page_title' => view('partials/page-title', ['title' => 'Progress Bars', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-progressbars', $data);
	}

	public function show_ui_placeholders(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Placeholders']),
			'page_title' => view('partials/page-title', ['title' => 'Placeholders', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-placeholders', $data);
	}

	public function show_ui_sweet_alert(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'SweetAlert 2']),
			'page_title' => view('partials/page-title', ['title' => 'SweetAlert 2', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-sweet-alert', $data);
	}

	public function show_ui_tabs_accordions(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Tabs & Accordions']),
			'page_title' => view('partials/page-title', ['title' => 'Tabs & Accordions', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-tabs-accordions', $data);
	}

	public function show_ui_typography(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Typography']),
			'page_title' => view('partials/page-title', ['title' => 'Typography', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-typography', $data);
	}

	public function show_ui_video(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Video']),
			'page_title' => view('partials/page-title', ['title' => 'Video', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-video', $data);
	}

	public function show_ui_general(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'General']),
			'page_title' => view('partials/page-title', ['title' => 'General', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-general', $data);
	}

	public function show_ui_colors(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Colors']),
			'page_title' => view('partials/page-title', ['title' => 'Colors', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-colors', $data);
	}

	public function show_ui_rating(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Rating']),
			'page_title' => view('partials/page-title', ['title' => 'Rating', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-rating', $data);
	}

	public function show_ui_toasts(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Toasts']),
			'page_title' => view('partials/page-title', ['title' => 'Toasts', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-toasts', $data);
	}

	public function show_ui_notifications(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Notifications']),
			'page_title' => view('partials/page-title', ['title' => 'Notifications', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-notifications', $data);
	}

	public function show_ui_offcanvas(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Offcanvas']),
			'page_title' => view('partials/page-title', ['title' => 'Offcanvas', 'pagetitle' => 'UI Elements'])
		];
		return view('example/ui-offcanvas', $data);
	}

	public function show_form_elements(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Basic Elements']),
			'page_title' => view('partials/page-title', ['title' => 'Basic Elements', 'pagetitle' => 'Forms'])
		];
		return view('example/form-elements', $data);
	}

	public function show_form_validation(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Validation']),
			'page_title' => view('partials/page-title', ['title' => 'Validation', 'pagetitle' => 'Forms'])
		];
		return view('example/form-validation', $data);
	}

	public function show_form_advanced(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Advanced Plugins']),
			'page_title' => view('partials/page-title', ['title' => 'Advanced Plugins', 'pagetitle' => 'Forms'])
		];
		return view('example/form-advanced', $data);
	}

	public function show_form_editors(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Editors']),
			'page_title' => view('partials/page-title', ['title' => 'Editors', 'pagetitle' => 'Forms'])
		];
		return view('example/form-editors', $data);
	}

	public function show_form_uploads(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'File Upload']),
			'page_title' => view('partials/page-title', ['title' => 'File Upload', 'pagetitle' => 'Forms'])
		];
		return view('example/form-uploads', $data);
	}

	public function show_form_xeditable(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Xeditable']),
			'page_title' => view('partials/page-title', ['title' => 'Xeditable', 'pagetitle' => 'Forms'])
		];
		return view('example/form-xeditable', $data);
	}
	
	public function show_form_repeater(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Repeater']),
			'page_title' => view('partials/page-title', ['title' => 'Repeater', 'pagetitle' => 'Forms'])
		];
		return view('example/form-repeater', $data);
	}

	public function show_form_wizard(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Wizard']),
			'page_title' => view('partials/page-title', ['title' => 'Wizard', 'pagetitle' => 'Forms'])
		];
		return view('example/form-wizard', $data);
	}

	public function show_form_mask(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Mask']),
			'page_title' => view('partials/page-title', ['title' => 'Mask', 'pagetitle' => 'Forms'])
		];
		return view('example/form-mask', $data);
	}

	public function show_tables_basic(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Bootstrap Basic']),
			'page_title' => view('partials/page-title', ['title' => 'Bootstrap Basic', 'pagetitle' => 'Tables'])
		];
		return view('example/tables-basic', $data);
	}

	public function show_tables_datatable(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Datatables']),
			'page_title' => view('partials/page-title', ['title' => 'Datatables', 'pagetitle' => 'Tables'])
		];
		return view('example/tables-datatable', $data);
	}

	public function show_tables_responsive(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Responsive']),
			'page_title' => view('partials/page-title', ['title' => 'Responsive', 'pagetitle' => 'Tables'])
		];
		return view('example/tables-responsive', $data);
	}

	public function show_tables_editable(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Editable']),
			'page_title' => view('partials/page-title', ['title' => 'Editable', 'pagetitle' => 'Tables'])
		];
		return view('example/tables-editable', $data);
	}

	public function show_charts_apex(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Apex']),
			'page_title' => view('partials/page-title', ['title' => 'Apex', 'pagetitle' => 'Charts'])
		];
		return view('example/charts-apex', $data);
	}

	public function show_charts_chartjs(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Chartjs']),
			'page_title' => view('partials/page-title', ['title' => 'Chartjs', 'pagetitle' => 'Charts'])
		];
		return view('example/charts-chartjs', $data);
	}

	public function show_charts_flot(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Flot']),
			'page_title' => view('partials/page-title', ['title' => 'Flot', 'pagetitle' => 'Charts'])
		];
		return view('example/charts-flot', $data);
	}

	public function show_charts_knob(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Jquery Knob']),
			'page_title' => view('partials/page-title', ['title' => 'Jquery Knob', 'pagetitle' => 'Charts'])
		];
		return view('example/charts-knob', $data);
	}

	public function show_charts_sparkline(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Sparkline']),
			'page_title' => view('partials/page-title', ['title' => 'Sparkline', 'pagetitle' => 'Charts'])
		];
		return view('example/charts-sparkline', $data);
	}

	public function show_icons_unicons(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Unicons']),
			'page_title' => view('partials/page-title', ['title' => 'Unicons', 'pagetitle' => 'Icons'])
		];
		return view('example/icons-unicons', $data);
	}

	public function show_icons_boxicons(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Boxicons']),
			'page_title' => view('partials/page-title', ['title' => 'Boxicons', 'pagetitle' => 'Icons'])
		];
		return view('example/icons-boxicons', $data);
	}

	public function show_icons_materialdesign(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Material Design']),
			'page_title' => view('partials/page-title', ['title' => 'Material Design', 'pagetitle' => 'Icons'])
		];
		return view('example/icons-materialdesign', $data);
	}

	public function show_icons_dripicons(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dripicons']),
			'page_title' => view('partials/page-title', ['title' => 'Dripicons', 'pagetitle' => 'Icons'])
		];
		return view('example/icons-dripicons', $data);
	}

	public function show_icons_fontawesome(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Font Awesome']),
			'page_title' => view('partials/page-title', ['title' => 'Font Awesome', 'pagetitle' => 'Icons'])
		];
		return view('example/icons-fontawesome', $data);
	}

	public function show_maps_google(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Google']),
			'page_title' => view('partials/page-title', ['title' => 'Google', 'pagetitle' => 'Maps'])
		];
		return view('example/maps-google', $data);
	}

	public function show_maps_vector(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Vector']),
			'page_title' => view('partials/page-title', ['title' => 'Vector', 'pagetitle' => 'Maps'])
		];
		return view('example/maps-vector', $data);
	}

	public function show_maps_leaflet(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Leaflet']),
			'page_title' => view('partials/page-title', ['title' => 'Leaflet', 'pagetitle' => 'Maps'])
		];
		return view('example/maps-leaflet', $data);
	}

	/* End component */

	/* Page */

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

	/* End Page */

}
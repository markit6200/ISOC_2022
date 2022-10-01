<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/lang/{locale}', 'Language::index');
// example
$routes->get('/example', 'Example::index');

// Main
$routes->get('/structure-assistant-rate', 'StructureByAssistRateController::index');


//Layout page routing
$routes->get('example/layouts-horizontal', 'Example::show_layouts_horizontal');
$routes->get('example/layouts-hori-topbar-dark', 'Example::show_layouts_hori_topbar_dark');
$routes->get('example/layouts-hori-boxed-width', 'Example::show_layouts_hori_boxed_width');
$routes->get('example/layouts-hori-preloader', 'Example::show_layouts_hori_preloader');
$routes->get('example/layouts-vertical', 'Example::show_layouts_vertical');
$routes->get('example/layouts-dark-sidebar', 'Example::show_layouts_dark_sidebar');
$routes->get('example/layouts-compact-sidebar', 'Example::show_layouts_compact_sidebar');
$routes->get('example/layouts-icon-sidebar', 'Example::show_layouts_icon_sidebar');
$routes->get('example/layouts-boxed', 'Example::show_layouts_boxed');
$routes->get('example/layouts-preloader', 'Example::show_layouts_preloader');
$routes->get('example/layouts-colored-sidebar', 'Example::show_layouts_colored_sidebar');

//App page routing
$routes->get('example/calendar', 'AppController::show_calendar');
$routes->get('example/chat', 'AppController::show_chat');

$routes->get('example/ecommerce-products', 'AppController::show_ecommerce_products');
$routes->get('example/ecommerce-product-detail', 'AppController::show_ecommerce_product_detail');
$routes->get('example/ecommerce-orders', 'AppController::show_ecommerce_orders');
$routes->get('example/ecommerce-customers', 'AppController::show_ecommerce_customers');
$routes->get('example/ecommerce-cart', 'AppController::show_ecommerce_cart');
$routes->get('example/ecommerce-checkout', 'AppController::show_ecommerce_checkout');
$routes->get('example/ecommerce-shops', 'AppController::show_ecommerce_shops');
$routes->get('example/ecommerce-add-product', 'AppController::show_ecommerce_add_product');

$routes->get('example/email-inbox', 'AppController::show_email_inbox');
$routes->get('example/email-read', 'AppController::show_email_read');
$routes->get('example/invoices-list', 'AppController::show_invoices_list');
$routes->get('example/invoices-detail', 'AppController::show_invoices_detail');
$routes->get('example/contacts-grid', 'AppController::show_contacts_grid');
$routes->get('example/contacts-list', 'AppController::show_contacts_list');
$routes->get('example/contacts-profile', 'AppController::show_contacts_profile');

//Pages section routing
$routes->get('example/auth-login', 'PageController::show_auth_login');
$routes->get('example/auth-register', 'PageController::show_auth_register');
$routes->get('example/auth-recoverpw', 'PageController::show_auth_recoverpw');
$routes->get('example/auth-lock-screen', 'PageController::show_auth_lock_screen');

$routes->get('example/pages-starter', 'PageController::show_pages_starter');
$routes->get('example/pages-maintenance', 'PageController::show_pages_maintenance');
$routes->get('example/pages-comingsoon', 'PageController::show_pages_comingsoon');
$routes->get('example/pages-timeline', 'PageController::show_pages_timeline');
$routes->get('example/pages-faqs', 'PageController::show_pages_faqs');
$routes->get('example/pages-pricing', 'PageController::show_pages_pricing');
$routes->get('example/pages-404', 'PageController::show_pages_404');
$routes->get('example/pages-500', 'PageController::show_pages_500');

//Component section routing
$routes->get('example/ui-alerts', 'ComponentController::show_ui_alerts');
$routes->get('example/ui-buttons', 'ComponentController::show_ui_buttons');
$routes->get('example/ui-cards', 'ComponentController::show_ui_cards');
$routes->get('example/ui-carousel', 'ComponentController::show_ui_carousel');
$routes->get('example/ui-dropdowns', 'ComponentController::show_ui_dropdowns');
$routes->get('example/ui-grid', 'ComponentController::show_ui_grid');
$routes->get('example/ui-images', 'ComponentController::show_ui_images');
$routes->get('example/ui-lightbox', 'ComponentController::show_ui_lightbox');
$routes->get('example/ui-modals', 'ComponentController::show_ui_modals');
$routes->get('example/ui-rangeslider', 'ComponentController::show_ui_rangeslider');
$routes->get('example/ui-session-timeout', 'ComponentController::show_ui_session_timeout');
$routes->get('example/ui-progressbars', 'ComponentController::show_ui_progressbars');
$routes->get('example/ui-sweet-alert', 'ComponentController::show_ui_sweet_alert');
$routes->get('example/ui-tabs-accordions', 'ComponentController::show_ui_tabs_accordions');
$routes->get('example/ui-typography', 'ComponentController::show_ui_typography');
$routes->get('example/ui-placeholders', 'ComponentController::show_ui_placeholders');
$routes->get('example/ui-toasts', 'ComponentController::show_ui_toasts');
$routes->get('example/ui-video', 'ComponentController::show_ui_video');
$routes->get('example/ui-general', 'ComponentController::show_ui_general');
$routes->get('example/ui-colors', 'ComponentController::show_ui_colors');
$routes->get('example/ui-rating', 'ComponentController::show_ui_rating');
$routes->get('example/ui-notifications', 'ComponentController::show_ui_notifications');
$routes->get('example/ui-offcanvas', 'ComponentController::show_ui_offcanvas');


$routes->get('example/form-elements', 'ComponentController::show_form_elements');
$routes->get('example/form-validation', 'ComponentController::show_form_validation');
$routes->get('example/form-advanced', 'ComponentController::show_form_advanced');
$routes->get('example/form-editors', 'ComponentController::show_form_editors');
$routes->get('example/form-uploads', 'ComponentController::show_form_uploads');
$routes->get('example/form-xeditable', 'ComponentController::show_form_xeditable');
$routes->get('example/form-repeater', 'ComponentController::show_form_repeater');
$routes->get('example/form-wizard', 'ComponentController::show_form_wizard');
$routes->get('example/form-mask', 'ComponentController::show_form_mask');

$routes->get('example/tables-basic', 'ComponentController::show_tables_basic');
$routes->get('example/tables-datatable', 'ComponentController::show_tables_datatable');
$routes->get('example/tables-responsive', 'ComponentController::show_tables_responsive');
$routes->get('example/tables-editable', 'ComponentController::show_tables_editable');

$routes->get('example/charts-apex', 'ComponentController::show_charts_apex');
$routes->get('example/charts-chartjs', 'ComponentController::show_charts_chartjs');
$routes->get('example/charts-flot', 'ComponentController::show_charts_flot');
$routes->get('example/charts-knob', 'ComponentController::show_charts_knob');
$routes->get('example/charts-sparkline', 'ComponentController::show_charts_sparkline');

$routes->get('example/icons-unicons', 'ComponentController::show_icons_unicons');
$routes->get('example/icons-boxicons', 'ComponentController::show_icons_boxicons');
$routes->get('example/icons-materialdesign', 'ComponentController::show_icons_materialdesign');
$routes->get('example/icons-dripicons', 'ComponentController::show_icons_dripicons');
$routes->get('example/icons-fontawesome', 'ComponentController::show_icons_fontawesome');

$routes->get('example/maps-google', 'ComponentController::show_maps_google');
$routes->get('example/maps-vector', 'ComponentController::show_maps_vector');
$routes->get('example/maps-leaflet', 'ComponentController::show_maps_leaflet');


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
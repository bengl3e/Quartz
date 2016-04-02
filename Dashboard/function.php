/*---------------------------------------------------
register settings
----------------------------------------------------*/
function theme_settings_init(){
register_setting( 'theme_settings', 'theme_settings' );
}
 
/*---------------------------------------------------
add settings page to menu
----------------------------------------------------*/
function add_settings_page() {
add_menu_page( __( 'Your theme name' .' Theme Panel' ), __( 'Your theme name' .' Theme Panel' ), 'manage_options', 'settings', 'theme_settings_page');
}
 
/*---------------------------------------------------
add actions
----------------------------------------------------*/
add_action( 'admin_init', 'theme_settings_init' );
add_action( 'admin_menu', 'add_settings_page' );
 
/*---------------------------------------------------
Theme Panel Output
----------------------------------------------------*/
function theme_settings_page() {}
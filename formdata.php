<?php

function datatable_admin_page2() {
	add_menu_page(
		__( 'Our Data', 'tabledata' ),
		__( 'Our Data', 'tabledata' ),
		'manage_options',
		'formdata',
		'formdata_display_table',
		'dashicons-database'
	);
}

function formdata_display_table() {
    require_once "class.registration-form.php";
	global $wpdb;
	?>

    <div class="form_box" style="margin-top: 30px;">
        <div class="wrap">
        <h2><strong><?php _e( "Registration Form Data", "tabledata" ); ?></strong></h2>
			<?php
			global $wpdb;
			$dbdemo_users = $wpdb->get_results( "SELECT id, first_name,last_name,email,phone_number,present_address,present_city,permanent_address,permanent_city,position_words,yourself_goal,current_salary,expected_salary,linkedin_url,facebook_url,upload_file FROM {$wpdb->prefix}registration_form ORDER BY id DESC", ARRAY_A );
			$dbtu         = new Registartion_data( $dbdemo_users );
			$dbtu->prepare_items();
			$dbtu->display();
			?>
        </div>
    </div>
	<?php

}

add_action( "admin_menu", "datatable_admin_page2" );
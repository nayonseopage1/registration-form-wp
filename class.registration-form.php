<?php
if ( ! class_exists( "WP_List_Table" ) ) {
	require_once( ABSPATH . "wp-admin/includes/class-wp-list-table.php" );
}

class Registartion_data extends WP_List_Table {
	function __construct( $data ) {
		parent::__construct();
		$this->items = $data;
	}

	function get_columns() {
		return [
			'cb'    => '<input type="checkbox">',
			'first_name'  => __( 'First Name', 'tabledata' ),
			'last_name' =>__('Last Name','tabledata'),
			'email' => __( 'E-mail', 'tabledata' ),
			'phone_number'   => __( 'Phone Number', 'tabledata' ),
			'present_address'   => __( 'Present Address', 'tabledata' ),
			'present_city'   => __( 'Present City', 'tabledata' ),
			'permanent_address'   => __( 'Permanent Address', 'tabledata' ),
			'permanent_city'   => __( 'Permanent City', 'tabledata' ),
			'position_words'   => __( 'Position Words', 'tabledata' ),
			'yourself_goal'   => __( 'Yourself Goal', 'tabledata' ),
			'current_salary'   => __( 'Current Salary', 'tabledata' ),
			'expected_salary'   => __( 'Expected Salary', 'tabledata' ),
			'linkedin_url'   => __( 'Linkedin Url', 'tabledata' ),
			'facebook_url'   => __( 'Facebook Url', 'tabledata' ),
			'upload_file'   => __( 'Upload File', 'tabledata' ),
		];
	}

    function column_cb( $item ) {
		return "<input type='checkbox' value='{$item['id']}'>";
	}

    // function column_upload_file( $item ) {
	// 	return "<a href='{$item['upload_file']}' target='_blank'>Download Cv</a>";
	// }
    
	function prepare_items() {
		$this->_column_headers = array( $this->get_columns(), [], [] );
	}

	function column_default( $item, $column_name ) {
		return $item[ $column_name ];
	}

}
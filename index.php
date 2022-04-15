<?php 

/*
Plugin Name: Registration Form Db
Author: Nayon
Author Uri: #
Description: It is very useful plugin
Version:1.0
*/


class Rfdb_main_class{

	public function __construct(){
		add_action('init',array($this,'Rfdb_main_area'));
		add_action('wp_enqueue_scripts',array($this,'Rfdb_main_script_area'));
		add_shortcode('registration-form-db',array($this,'Rfdb_main_shortcode_area'));
	}

	public function Rfdb_main_area(){
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');

		global $wpdb;
		$prefix =$wpdb->prefix;
		$table =$prefix.'registration_form';

		require_once( ABSPATH .'wp-admin/includes/upgrade.php');
	    require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );

		dbDelta("CREATE TABLE $table (id int(11) AUTO_INCREMENT,first_name varchar(250),last_name varchar(250),email varchar(250),phone_number varchar(250),present_address varchar(250),present_city varchar(250),permanent_address varchar(250),permanent_city varchar(250),position_words varchar(250),yourself_goal varchar(250),current_salary varchar(250),expected_salary varchar(250),linkedin_url varchar(250),facebook_url varchar(250),upload_file varchar(250),UNIQUE KEY id(id))");

		if( isset($_POST['submit']) ){

			$first_name = sanitize_text_field( $_POST['first_name'] );
			$last_name = sanitize_text_field($_POST['last_name'] );
			$email = sanitize_text_field($_POST['email']);
			$phone_number = sanitize_text_field($_POST['phone_number'] );
			$present_address = sanitize_text_field($_POST['present_address'] );
			$present_city = sanitize_text_field($_POST['present_city'] );
			$permanent_address = sanitize_text_field($_POST['permanent_address'] );
			$permanent_city = sanitize_text_field($_POST['permanent_city'] );
			$position_words = sanitize_textarea_field($_POST['position_words'] );
			$yourself_goal = sanitize_textarea_field($_POST['yourself_goal'] );
			$current_salary = sanitize_text_field($_POST['current_salary'] );
			$expected_salary = sanitize_text_field($_POST['expected_salary'] );
			$linkedin_url = sanitize_text_field($_POST['linkedin_url'] );
			$facebook_url = sanitize_text_field($_POST['facebook_url'] );
			$upload     = wp_upload_bits($_FILES["upload_file"]["name"], null, file_get_contents($_FILES["upload_file"]["tmp_name"]));

			$wpdb->insert($table,array(
				'first_name'=>$first_name,
				'last_name'=>$last_name,
				'email'=>$email,
				'phone_number'=>$phone_number,
				'present_address'=>$present_address,
				'present_city'=>$present_city,
				'permanent_address'=>$permanent_address,
				'permanent_city'=>$permanent_city,
				'position_words'=>$position_words,
				'yourself_goal'=>$yourself_goal,
				'current_salary'=>$current_salary,
				'expected_salary'=>$expected_salary,
				'linkedin_url'=>$linkedin_url,
				'facebook_url'=>$facebook_url,
				'upload_file'  => $upload['url']
			));

			wp_redirect( home_url('/?page_id=6') ); 
				exit;
		}
	}

	public function Rfdb_main_script_area(){
		wp_enqueue_style('customcss',PLUGINS_URL('css/custom.css',__FILE__));
	
	}

	public function Rfdb_main_shortcode_area(){
	ob_start();
	?>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="contact-form"> 
				<div class="contact-input"> 
					<label>First Name
						<input type="text" name="first_name" required />
					</label>
				</div>
				<div class="contact-input"> 
					<label>Last Name
						<input type="text" name="last_name" required />
					</label>
				</div>
				<div class="contact-input"> 
					<label>E-mail address
						<input type="email" name="email" required />
					</label>
				</div>
				<div class="contact-input"> 
					<label>Phone Number
						<input type="text" name="phone_number" required />
					</label>
				</div>
				<div class="contact-input">
					<label>Present Address
						<input type="text" name="present_address" required />
					</label>
				</div>
				<div class="contact-input">
					<label>City
						<input type="text" name="present_city" required />
					</label>
				</div>	
				<div class="contact-input">
					<label>Permanent Address
						<input type="text" name="permanent_address" required />
					</label>
				</div>
				<div class="contact-input">
					<label>City
						<input type="text" name="permanent_city" required />
					</label>
				</div>
				<h4 class="pro-detail-title">Professional Details</h4>													
				<div class="contact-taxrarea"> 
					<label>Write in 200 words why you are the best fit for this position
						<textarea name="position_words"  id="" cols="30" rows="4" required ></textarea>
					</label>
				</div>
				<div class="contact-taxrarea"> 
					<label>Where do you see yourself in 2 years?
						<textarea name="yourself_goal"  id="" cols="30" rows="4" required ></textarea>
					</label>
				</div>	
				<div class="contact-input">
					<label>Current Salary
						<input type="text" name="current_salary" required />
					</label>
				</div>
				<div class="contact-input">
					<label>Expected Salary
						<input type="text" name="expected_salary" required />
					</label>
				</div>
				<div class="contact-input">
					<label>Linkedin Profile URL
						<input type="text" name="linkedin_url" required />
					</label>
				</div>
				<div class="contact-input">
					<label>Facebook Profile URL
						<input type="text" name="facebook_url" required />
					</label>
				</div>
				<div class="contact-taxrarea"> 
					<input type="file" name="upload_file" id="fileToUpload">
				</div>																											
				<div class="contact-button"> 
					<input type="submit" value="Submit" name="submit" />
				</div>
			</div>
		</form>
	<?php
	return ob_get_clean();
}

}

new Rfdb_main_class();

require_once "formdata.php";






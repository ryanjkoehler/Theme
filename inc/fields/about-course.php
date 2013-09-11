<?php
/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

if ( function_exists("register_field_group") ) {
	register_field_group(array (
		'id' => 'acf_about-course',
		'title' => 'About Course',
		'fields' => array (
			array (
				'key' => 'field_521f36e0d691b',
				'label' => 'Introduction Text',
				'name' => 'introduction_text',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_521f2689e2b5e',
				'label' => 'News Category',
				'name' => 'news_category',
				'type' => 'taxonomy',
				'instructions' => 'Which category would you like to pull your news field from?',
				'taxonomy' => 'category',
				'field_type' => 'select',
				'allow_null' => 0,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
			),
			array (
				'key' => 'field_521f345552fac',
				'label' => 'UCAS Code',
				'name' => 'ucas_code',
				'type' => 'text',
				'instructions' => 'What is the UCAS code for your course?',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_521f35434968e',
				'label' => 'Ucreative Course Page',
				'name' => 'ucreative_course_page',
				'type' => 'text',
				'instructions' => 'The URL for the course on ucreative.ac.uk',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-course.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
?>
<?php
class acf_field_custom_modules extends acf_field
{
        // vars
        var $settings, // will hold info such as dir / path
            $defaults; // will hold default field options


        /*
        * __construct
        *
        * Set name / label needed for actions / filters
        *
        * @since        3.6
        * @date        23/01/13
        */

        function __construct()
		{
                // vars
                $this->name = 'custom_modules';
                $this->label = __('Custom Modules');
                $this->category = __("Layout",'acf'); // Basic, Content, Choice, etc
				$this->defaults = array(
					'formatting' 	=>	'none'
				);

                // do not delete!
			    parent::__construct();
			
			    // settings
                $this->settings = array(
                        'path' => apply_filters('acf/helpers/get_path', __FILE__),
                        'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
                        'version' => '1.0.0'
                );

        }

        /*
        * create_field()
        *
        * Create the HTML interface for your field
        *
        * @param        $field - an array holding all the field's data
        *
        * @type        action
        * @since        3.6
        * @date        23/01/13
        */

        function create_field( $field )
        {
                // defaults?
                $field = array_merge($this->defaults, $field);			
				
				// update modules
				modules_to_json();
				
				// include the custom modules dropzone
				echo '<div class="custom-modules-upload">';
				
				// upload form
				echo '<div id="custom-modules-upload" data-upload-url="' . get_stylesheet_directory_uri() . '/content-editor/modules_upload.php"></div>';
					
				// close semplice div
				echo '</div>';
				
				// installed modules
				echo '<div class="installed-modules">';
				
				// list modules
				echo list_modules(false, false, false, false);
				
				echo '</div>';
        }

        /*
        * update_value()
        *
        * This filter is appied to the $value before it is updated in the db
        *
        * @type        filter
        * @since        3.6
        * @date        23/01/13
        *
        * @param        $value - the value which will be saved in the database
        * @param        $post_id - the $post_id of which the value will be saved
        * @param        $field - the field array holding all the field options
        *
        * @return        $value - the modified value
        */

        function update_value($value, $post_id, $field)
        {
			return $value;
        }
		
		
}
// create field
new acf_field_custom_modules();

?>
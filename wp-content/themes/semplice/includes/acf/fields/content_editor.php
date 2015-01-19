<?php
class acf_field_content_editor extends acf_field
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
                $this->name = 'content_editor';
                $this->label = __('Content Editor');
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
				
				// include the content editor
				echo '<div class="start-editor">';
				echo '<div class="start">';
				echo '<a class="add-semplice-editor">Semplice Content Editor</a>';
				echo '</div>';
				echo '<div class="content-code">';
				
				// has content?
				if(get_post_meta( get_the_ID(), 'semplice_ce_stats', true )) {
					echo get_post_meta( get_the_ID(), 'semplice_ce_stats', true );
				} else {
					echo '<span class="comment">// content stats</span><br /><br />No content so far!';
				}
				
				echo '</div></div>';

				// editor container
				echo '<div id="semplice">';
				
				// include the editor
				include(get_template_directory() . '/content-editor/index.php');
				
				// close semplice div
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
new acf_field_content_editor();

?>
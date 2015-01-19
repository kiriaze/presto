<?php

class acf_field_font extends acf_field
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
                $this->name = 'font';
                $this->label = __('Font');
                $this->category = __("Layout",'acf'); // Basic, Content, Choice, etc
                $this->defaults = array(
					'is_italic'		=>	'no'
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
        * create_options()
        *
        * Create extra options for your field. This is rendered when editing a field.
        * The value of $field['name'] can be used (like bellow) to save extra data to the $field
        *
        * @type        action
        * @since        3.6
        * @date        23/01/13
        *
        * @param        $field        - an array holding all the field's data
        */

        function create_options($field)
        {
                // defaults?
                isset($field['value']['font_name']) ? $field['value']['font_name'] : '';
				isset($field['value']['font_style']) ? $field['value']['font_style'] : '';
				isset($field['value']['use_font_weight']) ? $field['value']['use_font_weight'] : '';
				isset($field['value']['category']) ? $field['value']['category'] : '';
				isset($field['value']['font_weight']) ? $field['value']['font_weight'] : '';

                // key is needed in the field names to correctly save the data
                $key = $field['name'];
				
                // Create Field Options HTML
                ?>
					<tr class="field_option field_option_<?php echo $this->name; ?>">
						<td class="label">
							<label><?php _e("Is italic?",'acf'); ?></label>
						</td>
						<td>
							<?php
							do_action('acf/create_field', array(
								'type'		=>	'radio',
								'name'		=>	'fields['.$key.'][is_italic]',
								'value'		=>	$field['is_italic'],
								'layout'	=>	'horizontal',
								'choices'	=> array(
									'yes'	=>	__("Yes",'acf'),
									'no'		=>	__("No",'acf')
								)
							));
							?>
						</td>
					</tr>
					<tr class="field_option field_option_<?php echo $this->name; ?>">
						<td class="label">
							<label><?php _e("Is custom one?",'acf'); ?></label>
						</td>
						<td>
							<?php
							do_action('acf/create_field', array(
								'type'		=>	'radio',
								'name'		=>	'fields['.$key.'][is_custom_one]',
								'value'		=>	$field['is_custom_one'],
								'layout'	=>	'horizontal',
								'choices'	=> array(
									'yes'	=>	__("Yes",'acf'),
									'no'		=>	__("No",'acf')
								)
							));
							?>
						</td>
					</tr>
                <?php

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
				if(!isset($field['value']['font_name'])) : $field['value']['font_name'] = ''; endif;
				if(!isset($field['value']['font_style'])) : $field['value']['font_style'] = ''; endif;
				if(!isset($field['value']['use_font_weight'])) : $field['value']['use_font_weight'] = ''; endif;
				if(!isset($field['value']['category'])) : $field['value']['category'] = ''; endif;
				if(!isset($field['value']['font_weight'])) : $field['value']['font_weight'] = ''; endif;
				
				// font style
				$field['choices']['font_style'] = array(
					'italic' 		=> 'Italic',
		            'normal' 		=> 'Normal'
		        );
				
				// use font weight
				$field['choices']['use_font_weight'] = array(
					'yes' 			=> 'Via CSS (default)',
		            'no' 			=> 'Via Fontname'
		        );
				
				// font category
				$field['choices']['category'] = array(
					'sans-serif' 	=> 'sans serif',
		            'serif'			=> 'serif'
		        );
				
				// font weight css
				$field['choices']['font_weight'] = array(
					'fw100' => 'Fontweight: 100',
		            'fw200'	=> 'Fontweight: 200',
		            'fw300'	=> 'Fontweight: 300',
		            'fw400'	=> 'Fontweight: 400',
		            'fw500'	=> 'Fontweight: 500',
		            'fw600'	=> 'Fontweight: 600',
		            'fw700'	=> 'Fontweight: 700',
		            'fw800'	=> 'Fontweight: 800',
		            'fw900'	=> 'Fontweight: 900'
		        );

				//input wrap
				echo '<div class="font-wrap">';
				
                // fontname
                echo '<input type="text" id="' . $field['id'] . '" placeholder="Fontname" class="text ' . $field['class'] . '" name="' . $field['name'] . '[font_name]" value="' . $field['value']['font_name'] . '">';

				// font weight
				echo '<div class="font-label">';
				echo '<div class="font-label-inner"><label>Font Weight</label></div>';
				echo '<select id="' . $field['id'] . '" class="select ' . $field['class'] . '" name="' . $field['name'] . '[font_weight]" value="' . $field['value']['font_weight'] . '">';
				// loop through values and add them as options
				if( is_array($field['choices']['font_weight']) )
				{
					foreach( $field['choices']['font_weight'] as $key => $value )
					{
					
						if($key === $field['value']['font_weight']) {
							$selected = 'selected="selected"';
						// Light
						} elseif($key === 'fw300' && $field['_name'] === 'light' && !$field['value']['font_weight']) {
							$selected = 'selected="selected"';
						// Light Italic
						} elseif($key === 'fw300' && $field['_name'] === 'light_italic' && !$field['value']['font_weight']) {
							$selected = 'selected="selected"';
						// Regular
						} elseif($key === 'fw400' && $field['_name'] === 'regular' && !$field['value']['font_weight']) {
							$selected = 'selected="selected"';
						// Regular Italic
						} elseif($key === 'fw400' && $field['_name'] === 'regular_italic' && !$field['value']['font_weight']) {
							$selected = 'selected="selected"';
						// Semibold
						} elseif($key === 'fw600' && $field['_name'] === 'semibold' && !$field['value']['font_weight']) {
							$selected = 'selected="selected"';
						// Semibold Italic
						} elseif($key === 'fw600' && $field['_name'] === 'semibold_italic' && !$field['value']['font_weight']) {
							$selected = 'selected="selected"';
						// Bold
						} elseif($key === 'fw700' && $field['_name'] === 'bold' && !$field['value']['font_weight']) {
							$selected = 'selected="selected"';
						// Bold Italic
						} elseif($key === 'fw700' && $field['_name'] === 'bold_italic' && !$field['value']['font_weight']) {
							$selected = 'selected="selected"';
						} else {
							$selected = '';
						}
						echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
					}
				}
				
				echo '</select>';
				echo '<div class="select-arrow"></div>';
				echo '</div>';
				
				// use font weight
				echo '<div class="font-label">';
				echo '<div class="font-label-inner"><label>Font Weight Usage</label></div>';
				echo '<select id="' . $field['id'] . '" class="select ' . $field['class'] . '" name="' . $field['name'] . '[use_font_weight]" value="' . $field['value']['use_font_weight'] . '">';
				
				// loop through values and add them as options
				if( is_array($field['choices']['use_font_weight']) )
				{
					foreach( $field['choices']['use_font_weight'] as $key => $value )
					{
						if($key === $field['value']['use_font_weight']) {
							$selected = 'selected';
						} else {
							$selected = '';
						}
						echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
					}
				}
				
				echo '</select>';
				echo '<div class="select-arrow"></div>';
				echo '</div>';
						
				// category
				echo '<div class="font-label">';
				echo '<div class="font-label-inner"><label>Category</label></div>';
				echo '<select id="' . $field['id'] . '" class="select ' . $field['class'] . '" name="' . $field['name'] . '[category]" value="' . $field['value']['category'] . '">';
				
				// loop through values and add them as options
				if( is_array($field['choices']['category']) )
				{
					foreach( $field['choices']['category'] as $key => $value )
					{
						if($key === $field['value']['category']) {
							$selected = 'selected';
						} else {
							$selected = '';
						}
						echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
					}
				}
				
				echo '</select>';
				echo '<div class="select-arrow"></div>';
				echo '</div>';
				
				// font style
				if($field['is_italic'] === 'yes') {
					echo '<div class="font-label last-label">';
					echo '<div class="font-label-inner"><label>Fontstyle</label></div>';
					echo '<select id="' . $field['id'] . '" class="select ' . $field['class'] . '" name="' . $field['name'] . '[font_style]" value="' . $field['value']['font_style'] . '">';
					
					// loop through values and add them as options
					if( is_array($field['choices']['font_style']) )
					{
						foreach( $field['choices']['font_style'] as $key => $value )
						{
							if($key === $field['value']['font_style']) {
								$selected = 'selected';
							} else {
								$selected = '';
							}
							echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
						}
					}
					echo '</select>';
					echo '<div class="select-arrow"></div>';
					echo '</div>';
				}
				
				// clear
				echo '<div class="clearfix"></div>';
				
				// acf input wrap close
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
new acf_field_font();

?>
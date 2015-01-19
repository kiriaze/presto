<?php

/*
	Paragraph Module
	Made by: Semplicelabs
*/

if($this->edit_mode) {
	
	// edit head
	$this->edit_head($values);

	// options head
	if(!$values['in_column'] && $this->edit_mode !== 'single-edit') {
	
		// width, offset
		$width = array();
		$offset = array();
		
		for($i=1; $i<=12; $i++) {
			$width['span' . $i] = $i . ' Col';
		}
		
		for($i=0; $i<=12; $i++) {
			if($i < 1) {
				$offset['no-offset'] = 'No Offset';
			} else {
				$offset['offset' . $i] = $i . ' Col';
			}
		}
		
		// options head
		echo '<div class="row"><div class="span12 options">';
		
		// options
		$this->get_option('select', 'Paragraph Width', 'span', 'span12', $width, $values);
		
		// options
		$this->get_option('select', 'Paragraph Offset', 'offset', 'no-offset', $offset, $values);
		
	} else {
		echo '<div class="options">';
	}

	// wyiwyg bg color
	$wysiwyg_bg_color = array(
		'white' => 'White',
		'black' => 'Black'
	);

	// options
	$this->get_option('select', 'WYSIWYG Background Color', 'wysiwyg_bg_color', 'white', $wysiwyg_bg_color, $values);

	// seperator
	$this->option_seperator();

	if(!$values['in_column'] && $this->edit_mode !== 'single-edit') {
		// close options
		echo '</div></div>';
	} else {
		// close options
		echo '</div>';
	}

	// define e
	$e = '';

	// content area
	$e .= '
		<div class="ckeditor-container">
			<textarea name="' . $values['id'] . '" class="is-content">';
			if($content) {
				$e .= $content;
			} else {
				$e .= "<h3>Semplice Theme</h3><p>I'm foolish and I'm funny and I'm needy. Am I needy? Are you sure I'm not needy? 'Cause I feel needy sometimes. That coat costs more than your house! Look, you are playing adults…with fully formed libidos, not 2 young men playing grab-ass in the shower. You go buy a tape recorder and record yourself for a whole day. I think you'll be surprised at some of your phrasing. Friend of mine from college. He also has a boat tho not called the Seaward. </p>";
			}
	$e .= '
			</textarea>
		</div>
	';
	// check if editor bg is inverted
	if(isset($values['options']['wysiwyg_bg_color']) && $values['options']['wysiwyg_bg_color'] === 'black') {
		$wysiwyg_bg = '$("#cke_'. $values['id'] . ' .cke_wysiwyg_div").css("backgroundColor", "#000000");';
	} else {
		$wysiwyg_bg = '$("#cke_'. $values['id'] . ' .cke_wysiwyg_div").css("backgroundColor", "#ffffff");';
	}

	// initialize ckeditor
	$e .= '
		<script type="text/javascript">
			(function($) {
				$(document).ready(function () {
					$("textarea[name=' . $values['id'] . ']").ckeditor(function() { ' . $wysiwyg_bg . ' });
				});
			})(jQuery);
		
		</script>
	';

	// display paragraph
	echo $e;

	// edit foot
	$this->edit_foot($values);
	
} else {

	$e = '';
	$span = '';
	$offset = '';

	// offset
	isset($this->rom['options']['offset']) ? $offset = $this->rom['options']['offset'] : '';

	// span
	isset($this->rom['options']['span']) ? $span = $this->rom['options']['span'] : '';

	// cs header
	$this->view_head($values);
	$e .= '<div data-content-id="' . $this->id . '" data-paragraph-id="' . $this->id . '" data-content-type="' . $this->content_type . '" class="wysiwyg-ce ' . $offset . ' ' . $span . '">';
	$e .= $content;
	$e .= '</div>';

	// display paragraph
	echo $e;

	// cs footer
	$this->view_foot($values);

}

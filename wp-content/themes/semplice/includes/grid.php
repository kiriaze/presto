<?php

/*
 * grid
 * semplice.theme
 */

// semplice grid
function semplice_grid($id, $content, $is_fluid, $remove_gutter, $index, $pre) {

	// output
	$grid = '';
	
	// masonry id
	$masonry = 'masonry-' . $id;
	
	// fit width
	$fit_width = '';
	
	// fluid
	$fluid = '';
	
	if($is_fluid) {
		$container_class = '';
		// if gutter, center masonry
		if(!$remove_gutter) {
			$fit_width = 'isFitWidth: true';
			$container_class = 'class="masonry-full"';
			$fluid = ' .masonry-full-inner';
		}
	} else {
		$container_class = 'class="container"';
	}
	
	// output masonry container
	$grid .= '<div id="' . $masonry . '" ' . $container_class . '>';
	
	if($is_fluid && !$remove_gutter) {
		// masonry inner
		$grid .= '<div class="masonry-full-inner">';
	}
	
	// remove gutter
	if($remove_gutter) {
		$grid .= '<div class="no-gutter-grid-sizer"></div>';
		$grid .= '<div class="no-gutter-gutter-sizer"></div>';
	} else {
		$grid .= '<div class="grid-sizer"></div>';
		$grid .= '<div class="gutter-sizer"></div>';
	}
	
	// close masonry inner
	if($is_fluid && !$remove_gutter) {
		$grid .= '</div>';	
	}

	// index
	$index = $index - 1;
	
	// close masonry container
	$grid .= '</div>';
	
	// javascript
	$grid .= '
		<script type="text/javascript">
			(function ($) {
				$(document).ready(function () {
					
					/* init masonry */
					var $container = $("#' . $masonry . $fluid . '");
					$container.masonry({
						itemSelector: ".' . $masonry . '-item",
						columnWidth: ".' . $pre . 'grid-sizer",
						gutter: ".' . $pre . 'gutter-sizer",
						transitionDuration: 0,
						isResizable: true,
						' . $fit_width . '
					});

					/* masonry data */
					var msnry = $container.data("masonry");

					/* get dribbble thumbs */
					$items = $("#' . $masonry . '-holder").find(".' . $masonry . '-item");

					/* remove thumbHolder */
					$("#' . $masonry . '-holder").remove();
					
					/* append thumbs to the masonry container */
					$("#' . $masonry . $fluid . '").append( $items );
					
					var index = 0;
					var size = ' . $index . ';

					function loadThumb(index) {
						$(".' . $masonry . '-item-" + index).find("img").imagesLoaded().done(function() {
							if(index <= size) {
								msnry.appended($(".' . $masonry . '-item-" + index));
								$(".' . $masonry . '-item-" + index).css("opacity", 1);
								loadThumb(index + 1);
							}
						});
					}
					
					/* add thumbs to masonry */
					loadThumb(index);
				});
			})(jQuery);
		</script>
	';
		
	// output
	return $grid;
}

?>
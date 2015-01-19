<!-- styles -->
<div class="atts">
	<ul class="atts-save">
		<?php if($this->edit_mode !== 'single-edit') : ?>
			<li class="rem-atts">
				<a class="remove get-id" data-content-id="<?php echo $values['id']; ?>"></a>
				<div class="tooltip">
					<div class="tt-arrow"></div>
					<div class="tt-text">Delete Layer</div>
				</div>
			</li>
		<?php endif; ?>
		<?php if($values['in_column'] && $this->edit_mode !== 'single-edit') : ?>
			<li>
				<a class="up" data-content-id="<?php echo $values['id']; ?>"></a>
				<div class="tooltip">
					<div class="tt-arrow"></div>
					<div class="tt-text">Move Layer Up</div>
				</div>
			</li>
			<li>
				<a class="down" data-content-id="<?php echo $values['id']; ?>"></a>
				<div class="tooltip">
					<div class="tt-arrow"></div>
					<div class="tt-text">Move Layer Down</div>
				</div>
			</li>
		<?php endif; ?>
		<?php if(!$values['in_column'] && $this->edit_mode !== 'single-edit') : ?>
			<li>
				<a class="show-layers" data-content-id="<?php echo $values['id']; ?>"></a>
				<div class="tooltip">
					<div class="tt-arrow"></div>
					<div class="tt-text">Re-Order</div>
				</div>
			</li>
		<?php endif; ?>
		<?php
			// has bg color?
			$has_color = false;
			
			if(preg_match('/^#[a-f0-9]{6}$/i', $values['styles']['background-color'])) {
				$has_color = true;
			}
		?>
		<?php if(!$values['in_column'] && $this->edit_mode !== 'single-edit') : ?>
		<li>
			<a class="duplicate" data-content-id="<?php echo $values['id']; ?>" data-content-type="<?php echo $this->content_type; ?>"></a>
			<div class="tooltip">
				<div class="tt-arrow"></div>
				<div class="tt-text">Save &amp; Duplicate</div>
			</div>
		</li>
		<?php endif; ?>
		<li>
			<a class="color">BG Color</a>
		</li>
		<li><div class="wp-color"><input type="text" value="<?php if($has_color === true) : echo $values['styles']['background-color']; else : echo 'transparent'; endif; ?>" class="color-picker <?php echo $values['style_class']; ?>" data-default-color="transparent" name="background-color" /></div></li>
		<li>
			<a class="background get-id">Bg Image</a>
			<ul class="background-sub">
				<li>
					<div class="semplice-arrow"></div>
					<a class="media-upload semplice-button bg-image-upload" data-upload-type="background" data-content-id="<?php echo $values['id']; ?>">Upload image</a><a class="remove-media remove-bg" data-content-id="<?php echo $values['id']; ?>" data-media="bg-image"></a>
					<input type="hidden" name="background-image" class="is-bg-image <?php echo $values['style_class']; ?>" value="<?php if($values['styles']['background-image']) : echo $values['styles']['background-image']; endif; ?>">
					<img src="<?php if($values['styles']['background-image']) : echo $values['styles']['background-image']; endif; ?>" class="bg-image-preview">
				</li>
				<li>
					<div class="ce-label">Background Scale</div>
					<?php	
						$bg_scale = array(
							'auto' 	=> 'No Scale',
						    'cover' => 'Cover (full-width)'
						);
					?>
					<div class="ce-select-box">
						<select name="background-size" class="<?php echo $values['style_class']; ?> select-box">
							<?php $this->select($bg_scale, $values['styles']['background-size']); ?>
						</select>
					</div>
				</li>
				<li>
					<div class="ce-label">Background Position</div>
					<?php
						$bg_pos = array(
							'0% 0%' 	=> 'Top Left',
						    '50% 0%' 	=> 'Top Center',
						    '100% 0%' 	=> 'Top Right',
						    '0% 50%' 	=> 'Middle Left',
						    '50% 50%' 	=> 'Middle Center',
						    '100% 50%' 	=> 'Middle Right',
						    '0% 100%' 	=> 'Bottom Left',
						    '50% 100%' 	=> 'Bottom Center',
						    '100% 100%' => 'Bottom Right'
						); 
					?>
					<div class="ce-select-box">
						<select name="background-position" class="<?php echo $values['style_class']; ?> select-box">
							<?php $this->select($bg_pos, $values['styles']['background-position']); ?>
						</select>
					</div>
				</li>
				<li>
					<div class="ce-label">Background Repeat</div>
					<?php
						$bg_repeat = array(
							'no-repeat' => 'No Repeat',
						    'repeat-x' 	=> 'Repeat horizontal',
						    'repeat-y' 	=> 'Repeat vertical',
						    'repeat' 	=> 'Repeat both'
						);
					?>
					<div class="ce-select-box">
						<select name="background-repeat" class="<?php echo $values['style_class']; ?> select-box">
							<?php $this->select($bg_repeat, $values['styles']['background-repeat']); ?>
						</select>
					</div>
				</li>
			</ul>
		</li>
		<li>
			<a class="padding">Padding</a>
			<ul class="padding-sub">
				<li>
					<div class="semplice-arrow"></div>
					<div class="ce-label">Padding Top</div>
					<input type="text" name="padding-top" value="<?php echo $values['styles']['padding-top']; ?>" class="<?php echo $values['style_class']; ?>">
				</li>
				<li class="padding-right">
					<div class="ce-label">Padding Right</div>
					<input type="text" name="padding-right" value="<?php echo $values['styles']['padding-right']; ?>" class="<?php echo $values['style_class']; ?>">
				</li>
				<li>
					<div class="ce-label">Padding Bottom</div>
					<input type="text" name="padding-bottom" value="<?php echo $values['styles']['padding-bottom']; ?>" class="<?php echo $values['style_class']; ?>">
				</li>
				<li class="padding-left">
					<div class="ce-label">Padding Left</div>
					<input type="text" name="padding-left" value="<?php echo $values['styles']['padding-left']; ?>" class="<?php echo $values['style_class']; ?>">
				</li>
			</ul>
		</li>
		<li>
		<?php if(!$values['in_column'] && $this->edit_mode !== 'single-edit') : ?>
			<li class="save-align">
				<a class="save" data-content-id="<?php echo $this->id; ?>" data-content-type="<?php echo $this->content_type; ?>"></a>
			</li>
		<?php elseif($this->edit_mode === 'single-edit') : ?>
			<li class="save-align">
				<a class="save-se" data-container-id="<?php echo str_replace('#', '', $this->ccId); ?>" data-content-id="<?php echo $this->id; ?>" data-content-type="<?php echo $this->content_type; ?>" data-column-id="<?php echo $this->column_id; ?>"></a>
			</li>
		<?php endif; ?>
		<?php if(!$values['in_column'] && $this->edit_mode !== 'single-edit') : ?>
		<li class="layer-atts">
			<p class="layer-name">Layer Name:</p><input type="text" name="layer-name" class="is-option" value="<?php echo isset($values['options']['layer-name']) ? $values['options']['layer-name'] : 'Layer Name'; ?>">
		</li>
		<?php endif; ?>
	</ul>
	<div class="clear"></div>
</div>
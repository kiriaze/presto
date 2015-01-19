<section id="category-archives">
	<div class="container">
		<div class="row">
			<div class="span11">
				<h2 class="bold"><?php echo __('Blog Archives', 'semplice'); ?></h2>
			</div>
			<div class="span1">
				<a class="archives-close right"><?php echo setIcon('close_big'); ?></a>
			</div>
		</div>
		<div class="row">
			<div class="span6 archive-heading">
				<h4 class="light first"><?php echo __('Latest Posts', 'semplice')?></h4>
				<nav>
					<ul>
						<?php
							// get the last 10 posts
							$args = array('numberposts' => '10', 'post_status' => 'publish, private');
							$recent_posts = wp_get_recent_posts($args);
							foreach( $recent_posts as $recent ){
								echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a> </li> ';
							}
						?>
					</ul>
				</nav>
			</div>
			<div class="span3 archive-heading">
				<h4 class="light"><?php echo __('Monthly', 'semplice')?></h4>
				<nav>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 10 ) ); ?>
					</ul>
				</nav>
			</div>
			<div class="span3 archive-heading">
				<h4 class="light"><?php echo __('Categories', 'semplice')?></h4>
				<nav>
					<ul>
						<?php wp_list_categories('title_li='); ?>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<div class="post-divider search-divider"></div>
</section>

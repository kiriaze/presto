<?php 

/* ------------------------------------------- */
/* Semplice Theme							   */
/* Comments Ttemplate						   */
/* ------------------------------------------- */

?>

<?php

if ( post_password_required() )
	return;
?>

<?php if ( have_comments() ) : ?>
    <h3 class="comments light" id="comments"><?php echo __( 'Comments', 'semplice'); ?></h3>
    <?php
    function show_comments($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment; 
        ?>
        <div class="comment-content wysiwyg">
        	<div class="avatar">
        		<?php echo get_avatar( $comment, 48 ); ?>
        	</div>
            <p class="comment-meta">
				<span class="bold comment-autor"><?php echo get_comment_author_link(); ?></span><br /><span class="comment-time"><?php printf(__('%1$s at %2$s', 'semplice'), get_comment_date(),  get_comment_time()) ?></span>
			</p>
            <div class="edit-reply">
            	<?php edit_comment_link(__('Edit', 'semplice')); ?>
            	<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>
            <div class="comment-text">
            	<?php if ($comment->comment_approved == '0') : ?>
		            <span class="moderation"><?php echo __('Your comment is awaiting moderation.', 'semplice') ?></span>
		        <?php endif; ?>
				<?php comment_text() ?>
				<div class="edit-reply reply-mobile">
	            	<?php edit_comment_link(__('Edit', 'semplice')); ?>
	            	<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	            </div>
			</div>
        </div>
		<?php if ( ! comments_open() ) : ?>
			<div class="comments-closed">
				<h5 class="light"><?php echo __( 'Comments are closed.', 'semplice'); ?></h5>
			</div>
		<?php endif; ?>
    <?php } ?>
	<div class="comments-wrapper">
		<?php 
			/* Show Comments  */
			wp_list_comments('type=comment&callback=show_comments');
		?>
		<div class="comments-pagination">
			<?php if( get_comment_pages_count() > 1) : ?><span><?php echo __('Go to page: ', 'semplice'); ?></span><?php paginate_comments_links( array('prev_text' => '&laquo;', 'next_text' => '&raquo;') ); ?><?php endif; ?>
		</div>
	</div>
<?php endif; ?>

<?php if ( ! comments_open() && ! have_comments() ) : ?>
    <div class="comments-closed">
        <h5 class="light"><?php echo __( 'Comments are closed.', 'semplice'); ?></h5>
    </div>
<?php endif; ?>

<?php
if ( !have_comments() ) :
	$noComment = "no-comment";
endif;
$comment_form_args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit',
	'title_reply' => __('Leave a Reply', 'semplice'),
	'cancel_reply_link' => __('Cancel Reply', 'semplice'),
	'label_submit' => __('Post Comment', 'semplice'),
	'logged_in_as' => '',
	'comment_field' => '<div class="comment-input"><textarea id="comment-input" class="mb10" name="comment" cols="45" rows="8" placeholder="' . __('Your comment*', 'semplice') . '" required email></textarea></div>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="comment-input"><input id="author" class="input" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . __( 'Author*', 'semplice' ) . '" required /></div>',
		'email'  => '<div class="comment-input"><input id="email" class="input" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . __( 'E-Mail Address*', 'semplice' ) . '" required /></div>',
		'url'    => '<div class="comment-input"><input id="url" class="input" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . __( 'Website', 'semplice' ) . '" /></div>'
		))
	);
?>
<?php comment_form($comment_form_args); ?>
<script type="text/javascript">
	(function($) {
		$(document).ready(function () {
			$("#commentform").validate();
		});
	})(jQuery); 
</script>





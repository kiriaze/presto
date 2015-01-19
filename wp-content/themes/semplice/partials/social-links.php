<?php if(get_field('social_networks_facebook', 'options')) : ?>
    <li><a class="facebook social-link" href="<?php echo get_field('social_networks_facebook', 'options'); ?>"  title="Facebook" target="_blank"><?php echo setIcon('facebook'); ?></a></li>
<?php endif; ?>
<?php if(get_field('social_networks_twitter', 'options')) : ?>
    <li><a class="twitter social-link" href="<?php echo get_field('social_networks_twitter', 'options'); ?>"  title="Twitter" target="_blank"><?php echo setIcon('twitter'); ?></a></li>
<?php endif; ?>
<?php if(get_field('social_networks_dribbble', 'options')) : ?>
    <li><a class="dribbble social-link" href="<?php echo get_field('social_networks_dribbble', 'options'); ?>"  title="Dribbble" target="_blank"><?php echo setIcon('dribbble'); ?></a></li>
<?php endif; ?>
<?php if(get_field('social_networks_behance', 'options')) : ?>
    <li><a class="behance social-link" href="<?php echo get_field('social_networks_behance', 'options'); ?>"  title="Behance" target="_blank"><?php echo setIcon('behance'); ?></a></li>
<?php endif; ?>
<?php if(get_field('social_networks_pinterest', 'options')) : ?>
    <li><a class="pinterest social-link" href="<?php echo get_field('social_networks_pinterest', 'options'); ?>"  title="Pinterest" target="_blank"><?php echo setIcon('pinterest'); ?></a></li>
<?php endif; ?>
<?php if(get_field('social_networks_gplusone', 'options')) : ?>
    <li><a class="gplusone social-link" href="<?php echo get_field('social_networks_gplusone', 'options'); ?>"  title="Google +1" target="_blank"><?php echo setIcon('gplusone'); ?></a></li>
<?php endif; ?>
<?php if(get_field('social_networks_linkedin', 'options')) : ?>
    <li><a class="linkedin social-link" href="<?php echo get_field('social_networks_linkedin', 'options'); ?>"  title="Linked In" target="_blank"><?php echo setIcon('linkedin'); ?></a></li>
<?php endif; ?>
<?php if(get_field('social_networks_instagram', 'options')) : ?>
    <li><a class="instagram social-link" href="<?php echo get_field('social_networks_instagram', 'options'); ?>"  title="Instagram" target="_blank"><?php echo setIcon('instagram'); ?></a></li>
<?php endif; ?>
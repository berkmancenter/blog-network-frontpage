<?php get_header(); ?>

	<?php if (have_posts()) : ?>
	
		<?php $post = $posts[0]; // Thanks Kubrick for this code ?>
		<h2 class="arch-title">~ 
		<?php 
		if (is_category()) {
			_e('Archive for '); echo single_cat_title();
		} elseif (is_day()) {
 	  		_e('Archive for '); the_time('F j, Y');
		} elseif (is_month()) {
	 		_e('Archive for '); the_time('F, Y');
		} elseif (is_year()) {
			_e('Archive for '); the_time('Y');
		} elseif (is_author()) { 
			_e('Author Archive ');
		} ?>
		 ~</h2>
		<div class="posts">
		<?php while (have_posts()) : the_post(); ?>
		
			<div class="post">
	
				<h2 class="posttitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent link to'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<p class="discuss"><?php comments_popup_link(__('0'), __('1'), __('%'), 'commentslink', __('<span class="no-comment">&oslash;</span>')); ?></p>
				<p class="postmeta"> 
				<span class="author"><?php the_author() ?></span> - <?php the_time('F j, Y') ?> @ <?php the_time() ?> 
				&#183; <?php _e('Filed under'); ?> <?php the_category(', ') ?>
				<?php edit_post_link(__('Edit'), ' &#183; ', ''); ?>
				</p>
			
				<div class="postentry">
				<?php the_content(); ?>
				</div>
				
				<!--
				<?php trackback_rdf(); ?>
				-->
			
			</div>
				
		<?php endwhile; ?>
		<div class="nav">
			<div class="prev"><?php posts_nav_link('','','&laquo; Previous Entries') ?></div>
			<div class="next"><?php posts_nav_link('','Next Entries &raquo;','') ?></div>
		</div>
		
	<?php else : ?>
	<?php include (TEMPLATEPATH . '/_not_found.php'); ?>
	<?php endif; ?>
		</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
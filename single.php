<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="post">
	
			<h2 class="posttitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent link to'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			
			<p class="postmeta"> 
			<span class="author"><?php the_author() ?></span> - <?php the_time('F j, Y') ?> @ <?php the_time() ?> 
			&#183; <?php _e('Filed under'); ?> <?php the_category(', ') ?>
			<?php edit_post_link(__('Edit'), ' &#183; ', ''); ?>
			</p>
			
			<div class="postentry">
			<?php the_content("<p>__('Read the rest of this entry &raquo;')</p>"); ?>
			<?php wp_link_pages(); ?>
			</div>
			
		</div>
		<?php comments_template(); ?>
				
	<?php endwhile; else : ?>
	<?php include (TEMPLATEPATH . '/_not_found.php'); ?>
	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

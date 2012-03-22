<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="border_no_pad">
  			<div id="post-thumbnail">
    			  <?php the_post_thumbnail('large'); ?>
  			</div>
			</div>
			
			<div class="border">
  			<div class="entry-content">
  			
  			<?php include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>
  			<h1 class="entry-title"><?php the_title(); ?></h1>
  			<?php the_content(); ?>
  			
  			<span class="byline author vcard">
  				by <span class="fn"><?php the_author() ?></span>
  			</span>
  			
  			<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
  				
  			<?php the_tags('<p class="tags">','','</p>'); ?>
          
  	  	<?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments-link', ''); ?>
  
  			</div>
			</div>
			<?php edit_post_link('Edit this entry'); ?>
		</article>
    <?php get_sidebar(); ?> 
    <div class="navigation"><p><?php posts_nav_link(); ?></p></div>	
    <div class="comment_wrap">
      <?php comments_template(); ?>
	  </div>

	<?php endwhile; endif; ?>
<?php get_footer(); ?>
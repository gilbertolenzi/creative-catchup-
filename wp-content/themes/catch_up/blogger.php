<?php
/*
* Template Name: blogger
*/
 get_header(); ?>
  <?php query_posts(array('post_type'=>'blogger')); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
      <div class="border">
      <div class="entry">
        <?php the_post_thumbnail('medium'); ?>
      </div>
      <?php include (TEMPLATEPATH . '/_/inc/meta_hompage.php' ); ?>
      
			<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
			

			<footer class="postmetadata">
				<a href="<?php the_permalink() ?>">view now >></a>
			</footer>
      </div>
	</article>

	<?php endwhile; ?>

	<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

	<?php else : ?>

		<h2>Not Found</h2>

	<?php endif; ?>

<?php get_footer(); ?>

<?php /* Template Name: Policies Template */ 

get_header();

global $post;
$post_slug = $post->post_name;
?>

<div class="container <?php echo $post_slug;?>-container policies-container">

    <h1 class="page-title"><?php the_title(); ?></h1>

    <?php while ( have_posts() ) : the_post(); ?>

        <div class="page-content">
            <?php the_content(); ?> 
        </div>

    <?php
    endwhile; 
    wp_reset_query();
    ?>

</div>

<?php get_footer();?>
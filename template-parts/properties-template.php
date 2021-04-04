<?php /* Template Name: Properties Template */ 

get_header();

global $post;
$post_slug = $post->post_name;
?>

<div class="<?php echo $post_slug;?>-container ">
    <div class="desktop-map-container">
        <div id="ajax-map">
        </div>
    </div>
</div>

<?php echo do_shortcode('[property_overview]'); ?>

<?php get_footer();?>

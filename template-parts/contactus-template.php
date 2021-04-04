<?php /* Template Name: Contact Us Template */ 

get_header();

$fields = get_fields();
global $post;
$post_slug = $post->post_name;
?>

<div class="container <?php echo $post_slug;?>-container">
    <h1 class="page-title"><?php echo $fields['page_title']; ?></h1>

    <div class="contact-form">
        <?php echo do_shortcode($fields['contact_form_shortcode']); ?>
    </div>

    <div class="company-details">

        <div class="company-address-section">
            <span class="company-address"><?php echo $fields['address']['address_line_1']; ?></span>
            <span class="company-address"><?php echo $fields['address']['address_line_2']; ?></span>
            <span class="company-address"><?php echo $fields['address']['address_line_3']; ?></span>
        </div>

        <div class="company-phone-section">
            <span class="company-phone"><?php echo $fields['telephone_number'];?></span>
        </div>

    </div>

    <div id="map">
    </div>

</div>

<?php get_footer();?>
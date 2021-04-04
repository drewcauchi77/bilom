<?php /* Template Name: Home Template */ 

get_header();

$fields = get_fields();
global $post;
$post_slug = $post->post_name;
?>

<div class="<?php echo $post_slug;?>-container">

    <div class="home-property-search">
        
        <div class="desktop-container">
            <img class="background-image" src="<?php echo $fields['desktop_background_image']['url']; ?>" alt="<?php echo $fields['desktop_background_image']['alt']; ?>">
            <div class="image-overlay"></div>
        </div>
        <div class="container desktop-only-container">
            <div class="container search-container">
                <div class="rent-sale-select">
                    <span class="selection-button sale-button active">Buy</span>
                    <span class="selection-button rent-button">Rent</span>
                </div>

                <div class="rent-sale-title-tagline">

                    <div class="title-tagline-section sale-section visible">
                        <h2 class="title sale-title">
                            <?php echo $fields['search_text']['sale']['title']; ?>
                        </h2>
                        <p class="tagline sale-tagline">
                            <?php echo $fields['search_text']['sale']['tagline']; ?> 
                        </p>
                    </div>

                    <div class="title-tagline-section rent-section">
                        <h2 class="title rent-title">
                            <?php echo $fields['search_text']['rent']['title']; ?>
                        </h2>
                        <p class="tagline rent-tagline">
                            <?php echo $fields['search_text']['rent']['tagline']; ?> 
                        </p>
                    </div>

                </div>

                <?php dynamic_sidebar( 'homepage-search' ); ?>

            </div>
        </div>

    </div>

    <div class="home-listings container">

        <h2 class="main-listings-title">
            <?php echo $fields['listings']['main_title']; ?>
        </h2>

        <div class="listing listing-one">
            <h3 class="listing-title">
                <?php echo $fields['listings']['listing_one']['title']; ?>
            </h3>

            <div class="property-list">

                <div class="listings">
                    <?php
                        foreach($fields['listings']['listing_one']['listings'] as $property){
                            $shortcode = '[property_overview property_id='.$property['post_object']->ID.']';
                            echo do_shortcode($shortcode);
                        }
                    ?>
                </div>

                <span class="load-more-button">
                    <a href="<?php echo $fields['listings']['listing_one']['button_link']; ?>">
                        <?php echo $fields['listings']['listing_one']['button_text']; ?>
                    </a>
                </span>
            </div>

        </div>

        <div class="listing listing-two">
            <h3 class="listing-title">
                <?php echo $fields['listings']['listing_two']['title']; ?>
            </h3>

            <div class="property-list">

                <div class="listings">
                <?php
                    foreach($fields['listings']['listing_two']['listings'] as $property){
                        $shortcode = '[property_overview property_id='.$property['post_object']->ID.']';
                        echo do_shortcode($shortcode);
                    }
                ?>
                </div>
                <span class="load-more-button">
                    <a href="<?php echo $fields['listings']['listing_two']['button_link']; ?>">
                        <?php echo $fields['listings']['listing_two']['button_text']; ?>
                    </a>
                </span>
            </div>

        </div>

    </div>

</div>

<?php get_footer();?>
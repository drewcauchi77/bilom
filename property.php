<?php
/**
 * Property Default Template for Single Property View
 *
 * Overwrite by creating your own in the theme directory called either:
 * property.php
 * or add the property type to the end to customize further, example:
 * property-building.php or property-floorplan.php, etc.
 *
 * By default the system will look for file with property type suffix first,
 * if none found, will default to: property.php
 *
 * Copyright 2010 Andy Potanin <andy.potanin@twincitiestech.com>
 *
 * @version 1.3
 * @author Andy Potanin <andy.potnain@twincitiestech.com>
 * @package WP-Property
*/

// Uncomment to disable fancybox script being loaded on this page
//wp_deregister_script('wpp-jquery-fancybox');
//wp_deregister_script('wpp-jquery-fancybox-css');
?>

<?php 

get_header(); 
global $post;
$post_slug = $post->post_name;
$fields = get_fields();

$contactus_page = get_page_by_path('contact-us');
$contactus_fields = get_fields($contactus_page->ID);
?>

  <div id="container" class="<?php wpp_css('property::container', array((!empty($post->property_type) ? $post->property_type . "_container" : ""))); ?> single-property-container">
    <div id="content" class="<?php wpp_css('property::content', "property_content"); ?>" role="main">
      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <!-- Images for the property - main image + gallery images -->
      <div class="single-property-gallery-property-images <?php echo $post_slug;?>-gallery-property-images">
        <div class="property-image">
          <a href="<?php echo $property['featured_image_url']; ?>" data-lightbox="image">
            <img class="image" src="<?php echo $property['featured_image_url']; ?>">
          </a>
        </div>
        
        <?php 

        $gallery_switch = ($fields['property_uploads'] == false) ? false : true;

        if($gallery_switch == true){

          foreach($fields['property_photos'] as $image){
            ?>

            <div class="property-image">
              <a href="<?php echo $image['image']['url']; ?>" data-lightbox="image">
                <img class="image" src="<?php echo $image['image']['url']; ?>">
              </a>
            </div>

          <?php } 

        }?>

      </div>
        
      <div class="single-property-content container">
        <!-- Content under image -->
        <div class="intro-content">
          <div class="property-price">
            <?php 
            // checking if price is entered or not, otherwise not shown
            if($property['price'] !== NULL){

              // checking whether the property is on sale or rent to set the price accordingly

              if($property['rent_or_buy'] == 'Sale'){ ?>
                <p class="price-text">
                  <?php echo $property['price']; ?>
                </p>
              <?php }else if($property['rent_or_buy'] == 'Rent'){ ?>
                <p class="price-text">
                  <?php echo $property['price']; ?>
                  <span class="per-month">/month</span>
                </p>
              <?php }

            }
            
            ?>
          </div>

          <div class="property-wishlist">
            <?php
              echo do_shortcode('[favorite_button]');
            ?>
          </div>
          
          <div class="desktop-enquire">
            <h3 class="enquire-button">ENQUIRE</h3>
          </div>

          <div class="property-status">
            <?php
            // checking if property status is available for display (available now) or not (not available)
            if($property['system']['prepared_for_display'] == true){ ?>

              <span class="available-tag">Available now</span>

            <?php }else{ ?>

              <span class="available-tag">Not Available</span>

            <?php } ?>
          </div>
        </div>
        
        <!-- Property amenities -->
        <div class="main-amenities">

          <!-- Property bedrooms -->
          <?php if($property['no_of_bedrooms'] !== NULL){ ?>

            <div class="main-amenity property-bedrooms">
                <img class="section-icon" src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/bedrooms.svg" alt="Bedrooms">
                <span class="section-details"><?php echo $property['no_of_bedrooms'];?>

                  <?php 
                  // if($property['no_of_bedrooms'] == 1){ 
                  //   echo $property['no_of_bedrooms'] . ' bed';
                  // }else if($property['no_of_bedrooms'] > 1){
                  //   echo $property['no_of_bedrooms'] . ' beds';
                  // } 
                  ?>

                </span>
            </div>

          <?php } ?>
          
          <!-- Property bathrooms -->
          <?php if($property['bathrooms'] !== NULL){ ?>

            <div class="main-amenity property-bathrooms">
                <img class="section-icon" src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/bathrooms.svg" alt="Bathrooms">
                <span class="section-details"><?php echo $property['bathrooms'];?>

                  <?php 
                  // if($property['bathrooms'] == 1){ 
                  //   echo $property['bathrooms'] . ' bath';
                  // }else if($property['bathrooms'] > 1){
                  //   echo $property['bathrooms'] . ' baths';
                  // } 
                  ?>

                </span>
            </div>

          <?php } ?>
          
          <!-- Property Pets Ok -->
          <?php if($property['pets_ok'] !== NULL){ ?>

            <div class="main-amenity property-pets-ok">
                <img class="section-icon" src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/pets-ok.svg" alt="Pets">
                <span class="section-details">Pets Ok</span>
            </div>

          <?php } ?>
          
        </div>
        
        <!-- Property content -->
        <div class="property-content">

          <!-- Property title -->
          <?php if($property['post_title'] !== NULL){?>

            <div class="property-title">
              <h1 class="title"><?php echo $property['post_title']; ?></h1>
            </div>

          <?php } ?>

          <!-- Property content text -->
          <?php if($property['post_content'] !== NULL){?>

            <div class="property-info-text">
              <p class="content"><?php echo $property['post_content']; ?></p>
            </div>

          <?php } ?>

          <!-- Checking if files are present -->
          <?php $switch = ($fields['property_uploads'] == false) ? false : true; ?>

          <?php if($switch == true){?>

            <!-- Property files are shown -->
            <div class="property-files">

              <?php foreach($fields['property_uploads'] as $file_upload){ ?>

                <div class="property-file">

                    <div class="file-name">
                      <a href="<?php echo $file_upload['property_pdfs']['url']; ?>" download title="Download File">
                        <img src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/download-icon.svg">
                      </a>
                      <a href="<?php echo $file_upload['property_pdfs']['url']; ?>" target="_blank" title="View File">
                        <img src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/view-icon.svg">
                      </a> 
                      <span class="name"><?php echo $file_upload['property_pdf_name']; ?></span>
                    </div>
                  </a>
                </div>

              <?php } ?>

            </div>

          <?php }?>

        </div>
        
        <!-- Property unit amenities -->
        <?php if($property['listing_amenities'] !== NULL){ ?>
          <div class="unit-amenities">
            <h2 class="unit-amenities-title">Unit Amenities</h2>
            
            <?php 
            // Obtained the list of amenities and exploded them within an array for foreach usage
            $listing_amenities = explode(', ', $property['listing_amenities']); ?>

            <!-- List of main property amenities -->
            <div class="listing-amenities">
              <?php foreach($listing_amenities as $amenity){ ?>

                <div class="amenity">

                  <img src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/unit-amenities.svg" alt="Available Amenity">
                  <span class="amenity-title"><?php echo $amenity;?></span>

                </div>

              <?php } ?>

              <?php 
              // Obtaining a no fee amenity - if no fee is set to Yes - it means there is no fee, else do nothing
              if($property['no_fee'] === 'Yes'){?>

                <div class="amenity">

                  <img src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/no-fee.svg" alt="No Fee Applied">
                  <span class="amenity-title">No Fee</span>

                </div>

              <?php } ?>

            </div>

          </div>
        <?php } ?>
        <div class="enquire-property">
          <h3 class="enquire-button">ENQUIRE</h3>
        </div>

      </div>

      <div class="property-upsells">
        <div class="upsell-container container">

        <?php 

        if($property['locality'] !== NULL){
          $locality_only = substr($property['locality'], strpos($property['locality'], ",") + 1);
        } 
        
        if($property['property_type'] !== NULL){
          $property_type = $property['property_type'];
        }
        
        ?>
        
          <div class="upsell-listings">

            <h3 class="upsells-listings-title">Properties in <?php echo $locality_only; ?></h3>

            <!-- Same property locality ($locality_only) + same property type ($property_type) -->
            <div class="listing">
              <a href="/properties/?wpp_search%5Bpagination%5D=on&wpp_search%5Bper_page%5D=10&wpp_search%5Bstrict_search%5D=false&wpp_search%5Bproperty_type%5D=apartment%2Cboathouse%2Cfarmhouse%2Cgarage%2Chouse_of_character%2Cmaisonette%2Cpalazzo%2Cpenthouse%2Cterraced_house%2Ctownhouse%2Cvilla%2Cstudio&wpp_search%5Brent_or_buy%5D=-1&wpp_search%5Blocality%5D%5B0%5D=<?php echo $locality_only; ?>&wpp_search%5Bprice%5D%5Bmin%5D=&wpp_search%5Bprice%5D%5Bmax%5D=&wpp_search%5Bproperty_types%5D%5B0%5D=<?php echo $property_type;?>">
                <span class="listing-title"><?php echo $locality_only . ' ' . $property_type . 's'; ?></span>
                <img src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/file-forward.svg" alt="Search">
              </a>
            </div>

            <!-- Same property locality ($locality_only) + 1 bedroom irrespective of property type -->
            <!-- <div class="listing">
              <a href="/properties/?wpp_search%5Bpagination%5D=on&wpp_search%5Bper_page%5D=10&wpp_search%5Bstrict_search%5D=false&wpp_search%5Bproperty_type%5D=apartment%2Cboathouse%2Cfarmhouse%2Cgarage%2Chouse_of_character%2Cmaisonette%2Cpalazzo%2Cpenthouse%2Cterraced_house%2Ctownhouse%2Cvilla%2Cstudio&wpp_search%5Brent_or_buy%5D=-1&wpp_search%5Blocality%5D%5B0%5D=<?php echo $locality_only; ?>&wpp_search%5Bprice%5D%5Bmin%5D=&wpp_search%5Bprice%5D%5Bmax%5D=&wpp_search%5Bno_of_bedrooms%5D=1">
                <span class="listing-title"><?php //echo $locality_only . ' 1 bedroom properties'; ?></span>
                <img src="<?php //echo get_template_directory_uri();?>/resources/single-property-icons/file-forward.svg" alt="Search">
              </a>
            </div> -->

            <!-- Same property locality ($locality_only) + 2 bedrooms irrespective of property type -->
            <div class="listing">
              <a href="/properties/?wpp_search%5Bpagination%5D=on&wpp_search%5Bper_page%5D=10&wpp_search%5Bstrict_search%5D=false&wpp_search%5Bproperty_type%5D=apartment%2Cboathouse%2Cfarmhouse%2Cgarage%2Chouse_of_character%2Cmaisonette%2Cpalazzo%2Cpenthouse%2Cterraced_house%2Ctownhouse%2Cvilla%2Cstudio&wpp_search%5Brent_or_buy%5D=-1&wpp_search%5Blocality%5D%5B0%5D=<?php echo $locality_only; ?>&wpp_search%5Bprice%5D%5Bmin%5D=&wpp_search%5Bprice%5D%5Bmax%5D=&wpp_search%5Bno_of_bedrooms%5D=2">
                <span class="listing-title"><?php echo $locality_only . ' 2 bedroom properties'; ?></span>
                <img src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/file-forward.svg" alt="Search">
              </a>
            </div>

            <!-- Same property locality ($locality_only) + 3 bedrooms irrespective of property type -->
            <div class="listing">
              <a href="/properties/?wpp_search%5Bpagination%5D=on&wpp_search%5Bper_page%5D=10&wpp_search%5Bstrict_search%5D=false&wpp_search%5Bproperty_type%5D=apartment%2Cboathouse%2Cfarmhouse%2Cgarage%2Chouse_of_character%2Cmaisonette%2Cpalazzo%2Cpenthouse%2Cterraced_house%2Ctownhouse%2Cvilla%2Cstudio&wpp_search%5Brent_or_buy%5D=-1&wpp_search%5Blocality%5D%5B0%5D=<?php echo $locality_only; ?>&wpp_search%5Bprice%5D%5Bmin%5D=&wpp_search%5Bprice%5D%5Bmax%5D=&wpp_search%5Bno_of_bedrooms%5D=3">
                <span class="listing-title"><?php echo $locality_only . ' 3 bedroom properties'; ?></span>
                <img src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/file-forward.svg" alt="Search">
              </a>
            </div>

            <?php if($property_type !== 'garage'){ ?>
            <!-- Same property locality ($locality_only) + garage property_type (specified at end of url) -->
              <div class="listing">
                <a href="/properties/?wpp_search%5Bpagination%5D=on&wpp_search%5Bper_page%5D=10&wpp_search%5Bstrict_search%5D=false&wpp_search%5Bproperty_type%5D=apartment%2Cboathouse%2Cfarmhouse%2Cgarage%2Chouse_of_character%2Cmaisonette%2Cpalazzo%2Cpenthouse%2Cterraced_house%2Ctownhouse%2Cvilla%2Cstudio&wpp_search%5Brent_or_buy%5D=-1&wpp_search%5Blocality%5D%5B0%5D=<?php echo $locality_only; ?>&wpp_search%5Bprice%5D%5Bmin%5D=&wpp_search%5Bprice%5D%5Bmax%5D=&wpp_search%5Bproperty_types%5D%5B0%5D=Garage">
                  <span class="listing-title"><?php echo $locality_only . ' garages'; ?></span>
                  <img src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/file-forward.svg" alt="Search">
                </a>
              </div>
            <?php } ?>

          </div>

          <div class="similar-listings">

            <?php $upsells_switch = ($fields['upsell_properties'] == false) ? false : true; ?>
            
            <?php 
            //Obtaining similar properties from property backend page
            if($upsells_switch == true){ ?>

            <h3 class="upsells-title">Similar listings</h3>
            
              <div class="upsell-properties">

                <?php
                foreach($fields['upsell_properties'] as $property){
                  $shortcode = '[property_overview property_id='.$property['property'].']';
                  echo do_shortcode($shortcode);
                }
                ?>

              </div>
            <?php
            }
            ?>

          </div>

        </div>

      </div>

      <div class="enquire-form">
        <div class="enquire-container">

          <div class="enquire-form-header">
            <div class="inner-enquire-container container">
              <div class="site-logo-section">
                <a class="site-logo-link" href="/">
                  <img class="site-logo" src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/bilom-logo.svg" alt="Bilom Group Logo">
                </a>
              </div>

              <div class="close-enquire-form-section">
                <img class="close-enquire-form-icon" src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/close-enquire-form-icon.svg" alt="Close Form">
              </div>
            </div>
          </div>
          
          <div class="form-container container">
            <h1 class="form-enquire-title">Enquire</h1>
            <?php echo do_shortcode('[contact-form-7 id="176" title="Enquire Form"]'); ?>
          </div>

          <div class="company-details container">

            <div class="company-address-section">
                <span class="company-address"><?php echo $contactus_fields['address']['address_line_1']; ?></span>
                <span class="company-address"><?php echo $contactus_fields['address']['address_line_2']; ?></span>
                <span class="company-address"><?php echo $contactus_fields['address']['address_line_3']; ?></span>
            </div>

            <div class="company-phone-section">
                <span class="company-phone"><?php echo $contactus_fields['telephone_number'];?></span>
            </div>

          </div>

        </div>
      </div>

    </div><!-- #post-## -->

    </div><!-- #content -->
  </div><!-- #container -->

<?php get_footer(); ?>

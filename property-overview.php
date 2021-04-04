<?php

/**

 * WP-Property Overview Template

 *

 * To customize this file, copy it into your theme directory, and the plugin will

 * automatically load your version.

 *

 * You can also customize it based on property type.  For example, to create a custom

 * overview page for 'building' property type, create a file called property-overview-building.php

 * into your theme directory.

 *

 *

 * Settings passed via shortcode:

 * $properties: either array of properties or false

 * $show_children: default true

 * $thumbnail_size: slug of thumbnail to use for overview page

 * $thumbnail_sizes: array of image dimensions for the thumbnail_size type

 * $fancybox_preview: default loaded from configuration

 * $child_properties_title: default "Floor plans at location:"

 *

 *

 *

 * @version 1.4

 * @author Andy Potanin <andy.potnain@twincitiestech.com>

 * @package WP-Property

 */ ?>

<?php



global $post;

$post_slug = $post->post_name;

$post_type = $post->post_type;

//Variable to get the property ID of the single property page and compare it when upsells to avoid repetition of same building in upsells

$property_id_match = $property['ID'];



if (have_properties()) {



  $thumbnail_dimentions = WPP_F::get_image_dimensions($wpp_query['thumbnail_size']);



  ?>

<div class="<?php wpp_css('property_overview::row_view', "wpp_row_view wpp_property_view_result"); ?>">

<div class="<?php wpp_css('property_overview::all_properties', "all-properties"); ?>">

  <?php foreach (returned_properties('load_gallery=false') as $property) { 

      //Variable that stores the ID of the current shown property within a property_overview shortcode

      $prop_id = $property['ID'];

    ?>



  

  <?php 

  // Compares the ids and separates by post_type for property

  if($property_id_match !== $prop_id){ ?>

    <div class="<?php wpp_css('property_overview::property_div', "property_div {$property['post_type']}"); ?>">



      <?php 

      //If the page is the single-property page for upsells of buildings, do not render images

      if($post_type !== 'property'){



        if($post_slug == NULL){

          $post_slug = 'properties';

        }



        ?>

        <div class="<?php wpp_css('property_overview::left_column', "wpp_overview_left_column"); ?>">

          

        <?php if($post_slug == 'properties'){ 

          $fields = get_fields($prop_id);

          ?>

          <div class="map-details" style="display: none;">

            <p class="longitude"><?php echo $fields['google_maps_location']['longitude']; ?></p>

            <p class="latitude"><?php echo $fields['google_maps_location']['latitude']; ?></p>

          </div>

        <?php } ?>

        

          <div class="gallery-property-images <?php echo $post_slug; ?>-gallery-property-images">

            <div>

              <a <?php echo $in_new_window; ?> href="<?php echo $property['permalink']; ?>">

                <img src="<?php echo $property['featured_image_url']; ?>">

              </a>

            </div>

            <?php 



            if($property['gallery']){



              foreach($property['gallery'] as $image){?>



                <div>



                  <a <?php echo $in_new_window; ?> href="<?php echo $property['permalink']; ?>">



                    <img src="<?php echo $image['medium']; ?>">



                  </a>



                </div>



              <?php }



            } ?>

          </div>



        </div>

      <?php } ?>



    <div class="<?php wpp_css('property_overview::right_column', "wpp_overview_right_column"); ?>">



      <div class="<?php wpp_css('property_overview::data', "wpp_overview_data"); ?>">

        <div class="property-information">

          <a <?php echo $in_new_window; ?> href="<?php echo $property['permalink']; ?>">

            <div class="property-details">



              <?php 

              // If on single-property page, show title of property

              if($post_type == 'property'){ ?>

                <div class="property-title">

                  <h4><?php echo $property['post_title']; ?></h4>

                </div>



              <?php } ?>



              <?php 

              // If on single-property page, do not show location

              if($post_type !== 'property'){?>

                <div class="property-location">

                  <?php 

                  // $property['locality'] is rendered as South, M'scala - we require M'scala only.

                  // substr to get only what is after the comma character

                  // in case of no locality entered, no locality is shown

                  if($property['locality'] !== NULL){



                    $locality_only = substr($property['locality'], strpos($property['locality'], ",") + 1); ?>

                    <h4 class="location-text"><?php echo $locality_only; ?></h4>



                  <?php } ?>



                </div>

              <?php } ?>



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



              <div class="property-main-amenities">



                <div class="amenities-section property-bedrooms">

                  <?php

                    if($property['no_of_bedrooms'] !== NULL){?>

                      <img src="<?php echo get_template_directory_uri();?>/resources/bedrooms-icon.svg">

                      <span class="no-of no-of-bedrooms"><?php echo $property['no_of_bedrooms']; ?></span>

                    <?php }

                  ?>

                </div>



                <div class="amenities-section property-bathrooms">

                <?php

                    if($property['bathrooms'] !== NULL){?>

                      <img src="<?php echo get_template_directory_uri();?>/resources/bathrooms-icon.svg">

                      <span class="no-of no-of-bathrooms"><?php echo $property['bathrooms']; ?></span>

                    <?php }

                  ?>

                </div>

              </div>



            </div>

          </a>

          

          <?php 

          // If single-property page, do not show wishlist icon

          //if($post_type !== 'property'){?>

            <!-- <div class="add-to-wishlist">

                <img src="<?php //echo get_template_directory_uri();?>/resources/wishlist-icon.svg" alt="">

            </div> -->

          <?php //} ?>

        </div>



        <?php 

        // if( is_array($wpp_query[ 'attributes' ]) ){

        //   foreach ($wpp_query[ 'attributes' ] as $attribute){

        //     if(!empty($property[$attribute])){

        //       $attribute_data = WPP_F::get_attribute_data($attribute);

        //       $data = $property[$attribute];

        //       if(is_array($data)){

        //         $data = implode( ', ', $data);

        //       }

        //       echo "<div class='property_attributes property_$attribute'><span class='title'>{$attribute_data['title']}:</span> {$property[$attribute]}</div>";

        //     }

        //   }

        // }

        ?>



        <?php if (($show_children == "true" || $show_children === true) && !empty($property['children'])): ?>

          <li class="child_properties">

            <div class="wpd_floorplans_title"><?php echo $child_properties_title; ?></div>

            <table class="wpp_overview_child_properties_table">

              <?php foreach ($property['children'] as $child): ?>

                <tr class="property_child_row">

                  <th class="property_child_title"><a

                      href="<?php echo $child['permalink']; ?>"><?php echo $child['post_title']; ?></a></th>

                  <td class="property_child_price"><?php echo isset($child['price']) ? $child['price'] : ''; ?></td>

                </tr>

              <?php endforeach; ?>

            </table>

          </li>

        <?php endif; ?>



        <?php if (!empty($wpp_query['detail_button'])) : ?>

          <li>

          <a <?php echo $in_new_window; ?> class="button" href="<?php echo $property['permalink']; ?>"><?php echo $wpp_query['detail_button'] ?></a>

          </li>

        <?php endif; ?>

      </div>



      </div><?php // .wpp_right_column ?>



      </div><?php // .property_div ?>

      <?php }  //end of if statement for comparing property ids?>

    <?php } /** end of the propertyloop. */ ?>

    </div><?php // .all-properties ?>

    </div><?php // .wpp_row_view ?>

  

<?php } else { ?>

  <div class="wpp_nothing_found">

    <p style="font-family:OpenSansRegular,sans-serif;font-size:14px;"><?php echo sprintf(__('Try expanding your search, or <a href="%s" style="color:black;">view all</a>.', ud_get_wp_property()->domain), site_url() . '/' . $wp_properties['configuration']['base_slug']); ?></p>

  </div>

<?php } ?>
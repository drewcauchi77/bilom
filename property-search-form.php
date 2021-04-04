<?php
/**
 * Property Search Widget Template
 *
 * Called by draw_property_search_form();
 *
 * @version 2.0.3
 * @author Denis Virobjov <den@udx.io>
 * @package WP-Property
 */
global $post;
$post_slug = $post->post_name;
?>
<form action="<?php echo WPP_F::base_url($wp_properties['configuration']['base_slug']); ?>" method="post"
            class="wpp_shortcode_search_form">
        <?php do_action("draw_property_search_form", $args); ?>
<?php if ($sort_order) { ?>
  <input type="hidden" name="wpp_search[sort_order]" value="<?php echo $sort_order; ?>"/>
<?php } ?>
<?php if (!empty($sort_by)) { ?>
  <input type="hidden" name="wpp_search[sort_by]" value="<?php echo $sort_by; ?>"/>
<?php } ?>
<?php if (!empty($use_pagination)) { ?>
  <input type="hidden" name="wpp_search[pagination]" value="<?php echo $use_pagination; ?>"/>
<?php } ?>
<?php if (!empty($per_page)) { ?>
  <input type="hidden" name="wpp_search[per_page]" value="<?php echo $per_page; ?>"/>
<?php } ?>
<?php if (!empty($strict_search)) { ?>
  <input type="hidden" name="wpp_search[strict_search]" value="<?php echo $strict_search; ?>"/>
<?php } ?>
<?php
//** If no property_type passed in search_attributes, we get defaults */
if (is_array($searchable_property_types) && !array_key_exists('property_type', array_fill_keys($search_attributes, 1))) {
  echo '<input type="hidden" name="wpp_search[property_type]" value="' . implode(',', $searchable_property_types) . '" />';
}
?>
<ul class="wpp_search_elements">
  <?php

  if (isset($group_attributes) && $group_attributes) {
    //** Get group data */
    $groups = $wp_properties['property_groups'];
    $_search_attributes = array();

    foreach ($search_attributes as $attr) {
      $_search_attributes[$attr] = $attr;
    }
    $search_groups = sort_stats_by_groups($_search_attributes);
    unset($_search_attributes);
  } else {
    //** Create an ad-hoc group */
    $search_groups['ungrouped'] = $search_attributes;
  }

  $main_stats_group = isset($wp_properties['configuration']['main_stats_group']) ? $wp_properties['configuration']['main_stats_group'] : false;
  $count = 0;

  foreach ($search_groups as $this_group => $search_attributes) {
    $count++;
    if ($this_group == 'ungrouped' || $this_group === 0 || $this_group == $main_stats_group) {
      $is_a_group = false;
      $this_group = 'not_a_group';
    } else {
      $is_a_group = true;
    }
    ?>
    <li class="wpp_search_group wpp_group_<?php echo $this_group; ?>">
      <?php if ($is_a_group) { ?>
        <span
          class="wpp_search_group_title wpp_group_<?php echo $this_group; ?>_title"><?php echo $groups[$this_group]['name']; ?></span>
      <?php } elseif ($group_attributes && $count == count($search_groups)) { ?>
        <span class="wpp_search_group_title" style="height:1px;line-height:1px;">&nbsp;</span>
      <?php } ?>
      <ul class="wpp_search_group wpp_group_<?php echo $this_group; ?>">
        <?php
        //** Begin Group Attributes */
        foreach ($search_attributes as $attrib) {
          //** Override search values if they are set in the developer tab */
          if (!empty($wp_properties['predefined_search_values'][$attrib])) {
            //*wpp::attribute::value will return predefined values based on attribute name
            // if WPML not active will return the first value @fadi*/
            $maybe_search_values = explode(',', apply_filters('wpp::attribute::value', $wp_properties['predefined_search_values'][$attrib], $attrib));

            $maybe_search_values = array_map('trim', $maybe_search_values);
            if (is_array($maybe_search_values)) {
              $using_predefined_values = true;
              $search_values[$attrib] = $maybe_search_values;
            } else {
              $using_predefined_values = true;
            }
          }
          //** Don't display search attributes that have no values */
          if (!apply_filters('wpp::show_search_field_with_no_values', isset($search_values[$attrib]), $attrib)) {
            continue;
          }
          $label = apply_filters('wpp::search_attribute::label', (empty($property_stats[$attrib]) ? WPP_F::de_slug($attrib) : $property_stats[$attrib]), $attrib);

          ?>
          <li
            class="wpp_search_form_element seach_attribute_<?php echo $attrib; ?>  wpp_search_attribute_type_<?php echo isset($wp_properties['searchable_attr_fields'][$attrib]) ? $wp_properties['searchable_attr_fields'][$attrib] : $attrib; ?> <?php echo((!empty($wp_properties['searchable_attr_fields'][$attrib]) && $wp_properties['searchable_attr_fields'][$attrib] == 'checkbox') ? 'wpp-checkbox-el' : ''); ?><?php echo((!empty($wp_properties['searchable_attr_fields'][$attrib]) && ($wp_properties['searchable_attr_fields'][$attrib] == 'multi_checkbox' && count($search_values[$attrib]) == 1) || (isset($wp_properties['searchable_attr_fields'][$attrib]) && $wp_properties['searchable_attr_fields'][$attrib] == 'checkbox')) ? ' single_checkbox' : '') ?>">
            <?php $random_element_id = 'wpp_search_element_' . rand(1000, 9999); ?>

            <label for="<?php echo $random_element_id; ?>"
                   class="wpp_search_label wpp_search_label_<?php echo $attrib; ?>">
                   <!-- Custom code -->
                   <span class="title"><?php echo $label; ?></span>
                   <img src="<?php echo get_template_directory_uri();?>/resources/search-icon.svg" alt="Search">
            </label>

            <div class="wpp_search_attribute_wrap wpp_selectors_<?php echo $attrib; ?>">
              <?php
              $value = isset($_REQUEST['wpp_search'][$attrib]) ? $_REQUEST['wpp_search'][$attrib] : '';
              // Custom code
              if($post_slug == "home" && ($attrib == "property_types" || $attrib == "locality")){ ?>

                <div class="mobile-header <?php echo $attrib; ?>-header container">
                  <span class="clear-desktop-filters">Clear Filters</span>
                  <img class="site-logo" src="<?php echo get_template_directory_uri();?>/resources/single-property-icons/bilom-logo.svg" alt="Bilom Logo">
                  <img class="close-section" src="<?php echo get_template_directory_uri();?>/resources/close-search-filtering-icon.svg" alt="Search">
                  <img class="close-desktop-section" src="<?php echo get_template_directory_uri();?>/resources/close-search-filtering-icon.svg" alt="Search">
                </div>

                <?php } ?>

                <?php if($post_slug == "home" && $attrib == "property_types"){?>
                <div class="<?php echo $attrib; ?>-top-title container">
                  <span class="title">Type of Property</span>
                  <span class="apply-filters">Apply</span>
                </div>

                <div class="select-all-container container">
                  <input type="checkbox" id="select-all" name="select-all" value="Select All">
                  <label for="select-all">Select All</label>
                </div>

                <?php }

                if($post_slug == "home" && $attrib == "locality"){
                  $localities_array = $search_values['locality'];
                  $list_of_localities = array_map("trim", explode(',', $wp_properties['predefined_values']['locality']));
                  ?>

                  <div class="<?php echo $attrib; ?>-top-title container">
                    <span class="title">Locality</span>
                    <span class="apply-filters">Apply</span>
                  </div>

                  <div class="area-selectors container">
                    <?php 
                    $north_switch = false;
                    $north_key = array_search('North', $list_of_localities);

                    if(in_array('North', $localities_array)) { 
                      $localities_array = array_diff($localities_array, array('North'));
                      $north_switch = true;
                      ?>

                      <span id="north" class="area enabled">North</span>

                    <?php } ?>
                    <?php 
                    $central_switch = false;
                    $central_key = array_search('Central', $list_of_localities);

                    if(in_array('Central', $localities_array)) { 
                      $localities_array = array_diff($localities_array, array('Central'));
                      $central_switch = true;
                      ?>

                      <span id="central" class="area">Central</span>

                    <?php } ?>
                    <?php 
                    $south_switch = false;
                    $south_key = array_search('South', $list_of_localities);

                    if(in_array('South', $localities_array)) { 
                      $localities_array = array_diff($localities_array, array('South'));
                      $south_switch = true;
                      ?>

                      <span id="south" class="area">South</span>

                    <?php } ?>
                    <?php 
                    $gozo_switch = false;
                    $gozo_key = array_search('Gozo', $list_of_localities);

                    if(in_array('Gozo', $localities_array)) { 
                      $localities_array = array_diff($localities_array, array('Gozo'));
                      $gozo_switch = true;
                      
                      ?>

                      <span id="gozo" class="area">Gozo</span>

                    <?php } ?>
                  </div>

                  <div class="localities container">
                    <?php if($north_switch == true) { 
                      ?>
                      <section class="north-localities list-of-localities visible">
                        <div class="select-all-north container select-area">
                          <input type="checkbox" id="north-cities" name="north-cities" value="North">
                          <label for="north-cities">North</label>
                        </div>
                        <ul>
                          <?php 
                          foreach($localities_array as $loc){ 
                            $key = array_search($loc, $list_of_localities);
                            if($key > $north_key && $key < $central_key){ ?>

                              <li>
                                <input value=<?php echo $loc; ?> type="checkbox" id="<?php echo $loc; ?>-checkbox">
                                <label for="<?php echo $loc; ?>-checkbox"><?php echo $loc; ?></label>
                              </li>

                            <?php }
                            } ?>
                        </ul>
                      </section>
                    <?php } ?>

                    <?php if($central_switch == true) { 
                      ?>
                      <section class="central-localities list-of-localities">
                        <div class="select-all-central container select-area">
                          <input type="checkbox" id="central-cities" name="central-cities" value="Central">
                          <label for="central-cities">Central</label>
                        </div>
                        <ul>
                          <?php 
                          foreach($localities_array as $loc){ 
                            $key = array_search($loc, $list_of_localities);
                            if($key > $central_key && $key < $south_key){ ?>

                              <li>
                                <input value=<?php echo $loc; ?> type="checkbox" id="<?php echo $loc; ?>-checkbox">
                                <label for="<?php echo $loc; ?>-checkbox"><?php echo $loc; ?></label>
                              </li>

                            <?php }
                            } ?>
                        </ul>
                      </section>
                    <?php } ?>

                    <?php if($south_switch == true) { 
                      ?>
                      <section class="south-localities list-of-localities">
                        <div class="select-all-south container select-area">
                          <input type="checkbox" id="south-cities" name="south-cities" value="South">
                          <label for="south-cities">South</label>
                        </div>
                        <ul>
                          <?php 
                          foreach($localities_array as $loc){ 
                            $key = array_search($loc, $list_of_localities);
                            if($key > $south_key && $key < $gozo_key){ ?>

                              <li>
                                <input value=<?php echo $loc; ?> type="checkbox" id="<?php echo $loc; ?>-checkbox">
                                <label for="<?php echo $loc; ?>-checkbox"><?php echo $loc; ?></label>
                              </li>

                            <?php }
                            } ?>
                        </ul>
                      </section>
                    <?php } ?>

                    <?php if($gozo_switch == true) { 
                      ?>
                      <section class="gozo-localities list-of-localities">
                        <div class="select-all-gozo container select-area">
                          <input type="checkbox" id="gozo-cities" name="gozo-cities" value="Gozo">
                          <label for="gozo-cities">Gozo</label>
                        </div>
                        <ul>
                          <?php 
                          foreach($localities_array as $loc){ 
                            $key = array_search($loc, $list_of_localities);
                            if($key > $gozo_key){ ?>

                              <li>
                                <input value=<?php echo $loc; ?> type="checkbox" id="<?php echo $loc; ?>-checkbox">
                                <label for="<?php echo $loc; ?>-checkbox"><?php echo $loc; ?></label>
                              </li>

                            <?php }
                            } ?>
                        </ul>
                      </section>
                    <?php } ?>
                  </div>

                <?php }
              ob_start();

              wpp_render_search_input(array(
                'attrib' => $attrib,
                'random_element_id' => $random_element_id,
                'search_values' => $search_values,
                'value' => $value
              ));

              $this_field = ob_get_contents();

              ob_end_clean();
              echo apply_filters('wpp_search_form_field_' . $attrib, $this_field, $attrib, $label, $value, (isset($wp_properties['searchable_attr_fields'][$attrib]) ? $wp_properties['searchable_attr_fields'][$attrib] : false), $random_element_id);
              ?>
            </div>
            <div class="clear"></div>
          </li>
          <?php
        }
        //** End Group Attributes */
        ?>
        <?php if($post_slug == "properties"){?>
          <div class="toggle-additional-filters">
            <span class="filters-title">Filters</span>
            <img class="filters-icon" src="<?php echo get_template_directory_uri();?>/resources/filters-icon.svg" alt="">
          </div>
        <?php } ?>
      </ul>

      <div class="clear"></div>
    </li>
  <?php } ?>
  <li class="wpp_search_form_element submit"><input type="submit" class="wpp_search_button submit btn btn-large"
                                                    value="<?php _e('Search', ud_get_wp_property()->domain) ?>"/>
  </li>
</ul>
</form>
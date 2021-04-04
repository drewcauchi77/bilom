<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package stevesandco
 */

?>
<?php

global $post;
$post_slug = $post->post_name;

?>
		<?php if(!is_user_logged_in()){ ?>
			<div class="user-account-container login-form-container">
				<div class="container">
					<div class="header-close-container">
						<img class="close-user-window" src="<?php echo get_template_directory_uri();?>/resources/close-search-filtering-icon.svg">
					</div>
					<?php echo do_shortcode('[profilepress-login id="1"]'); ?>
				</div>
			</div>

			<div class="user-account-container register-form-container">
				<div class="container">
					<div class="header-close-container">
						<img class="close-user-window" src="<?php echo get_template_directory_uri();?>/resources/close-search-filtering-icon.svg">
					</div>
					<?php echo do_shortcode('[profilepress-registration id="1"]'); ?>
				</div>
			</div>

			<div class="user-account-container reset-password-form-container">
				<div class="container">
					<div class="header-close-container">
						<img class="close-user-window" src="<?php echo get_template_directory_uri();?>/resources/close-search-filtering-icon.svg">
					</div>
					<?php echo do_shortcode('[profilepress-password-reset id="1"]'); ?>
				</div>
			</div>
		<?php } ?>

		<?php if(is_user_logged_in()){ ?>

			<div class="user-account-welcome-screen">
				<div class="container">

					<img class="close-user-welcome-screen" src="<?php echo get_template_directory_uri();?>/resources/close-search-filtering-icon.svg">

					<?php 
					$user_id = get_current_user_id();	
					$url = get_avatar_url($user_id);
					?>
					<div class="welcome-details">
						<img class="user-avatar" src="<?php echo $url; ?>">
						<h2 class="user-name"><?php echo get_user_name(); ?></h2>
					</div>
					
					<div class="account-details">
						<div class="account-manage-section favourite-listings">
							<h3 class="account-settings-title">Favourite Listings</h3>
							<img src="<?php echo get_template_directory_uri();?>/resources/wishlist-icon-full.svg">
						</div>
						<div class="account-manage-section account-settings">
							<h3 class="account-settings-title">Account Settings</h3>
							<img src="<?php echo get_template_directory_uri();?>/resources/account-settings-icon.svg">
						</div>
						<div class="log-out">
							<a href="<?php echo wp_logout_url(get_permalink()); ?>">Logout</a>
						</div>
					</div>
				</div>
			</div>

			<?php if($post_slug !== 'properties'){ ?>
				<div class="user-account-dashboard">
					<div class="container">
						<?php
						/* Get user info. */
						global $current_user, $wp_roles;
						//get_currentuserinfo(); //deprecated since 3.1

						/* Load the registration file. */
						//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
						$error = array();    
						/* If profile was saved, update profile. */
						if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

							/* Update user password. */
							if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
								if ( $_POST['pass1'] == $_POST['pass2'] )
									wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
								else
									$error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
							}

							/* Update user information. */
							if ( !empty( $_POST['url'] ) )
								wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] ) ) );
							if ( !empty( $_POST['email'] ) ){
								if (!is_email(esc_attr( $_POST['email'] )))
									$error[] = __('The Email you entered is not valid.  please try again.', 'profile');
								elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
									$error[] = __('This email is already used by another user.  try a different one.', 'profile');
								else{
									wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
								}
							}

							if ( !empty( $_POST['first-name'] ) )
								update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
							if ( !empty( $_POST['last-name'] ) )
								update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
							if ( !empty( $_POST['description'] ) )
								update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );

							/* Redirect so the page will show updated info.*/
						/*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
							if ( count($error) == 0 ) {
								//action hook for plugins and extra fields saving
								do_action('edit_user_profile_update', $current_user->ID);
								wp_redirect( get_permalink() );
								exit;
							}
						}

						if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<div id="post-<?php the_ID(); ?>">
								<div class="entry-content entry">
									<?php if ( !is_user_logged_in() ) : ?>
										<p class="warning">
											<?php _e('You must be logged in to edit your profile.', 'profile'); ?>
										</p><!-- .warning -->
									<?php else : ?>
										<?php if ( count($error) > 0 ){
											echo '<p class="account-settings-errors">' . implode("<br />", $error) . '</p>';
										}?>
										<img class="go-back-welcome-screen" src="<?php echo get_template_directory_uri();?>/resources/arrow-back.svg">
										<h1 class="dashboard-settings-title">Account Settings</h1>
										<form method="post" id="adduser" action="<?php the_permalink(); ?>">
											<p class="form-row form-name">
												<label for="first-name"><?php _e('Name', 'profile'); ?></label>
												<input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
											</p><!-- .form-username -->
											<p class="form-row form-surname">
												<label for="last-name"><?php _e('Surname', 'profile'); ?></label>
												<input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" />
											</p><!-- .form-username -->
											<p class="form-row form-email">
												<label for="email"><?php _e('E-mail', 'profile'); ?></label>
												<input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
											</p><!-- .form-email -->
											<p class="form-submit">
												<?php echo $referer; ?>
												<input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Save Changes', 'profile'); ?>" />
												<?php wp_nonce_field( 'update-user' ) ?>
												<input name="action" type="hidden" id="action" value="update-user" />
											</p><!-- .form-submit -->
											<p class="form-row form-password">
												<label for="pass1"><?php _e('Password *', 'profile'); ?> </label>
												<input class="text-input" name="pass1" type="password" id="pass1" />
											</p><!-- .form-password -->
											<p class="form-row form-password-confirm">
												<label for="pass2"><?php _e('Repeat Password *', 'profile'); ?></label>
												<input class="text-input" name="pass2" type="password" id="pass2" />
											</p><!-- .form-password -->
											<?php 
												//action hook for plugin and extra fields
												do_action('edit_user_profile',$current_user); 
											?>
											<div id="message"></div>
											<p class="form-change-password">
												<?php echo $referer; ?>
												<input name="updateuser" type="submit" id="updateuser" class="submit button password-confirm-button" value="<?php _e('Change Password', 'profile'); ?>" />
												<?php wp_nonce_field( 'update-user' ) ?>
												<input name="action" type="hidden" id="action" value="update-user" />
											</p><!-- .form-submit -->
										</form><!-- #adduser -->
									<?php endif; ?>
								</div><!-- .entry-content -->
							</div><!-- .hentry .post -->
							<?php endwhile; ?>
						<?php else: ?>
							<p class="no-data">
								<?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
							</p><!-- .no-data -->
						<?php endif; ?>
					</div>
				</div>

				<div class="favourites-list">
					<div class="container">
						<img class="go-back-welcome-screen" src="<?php echo get_template_directory_uri();?>/resources/arrow-back.svg">
						<h1 class="favourite-listings-title">Favourite Listings</h1>
						<?php 
						echo do_shortcode('[user_favorites]'); 
						echo do_shortcode('[clear_favorites_button text="Clear Favourites"]');
						?>
					</div>
				</div>
			<?php } ?>

		<?php } ?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<?php 

		// ID for Site Footer
		$id = 3;
		$footer = wp_get_nav_menu_object( $id );
		// Custom Fields for Main Menu
		$fields = get_fields($footer);

		$args = array(
			'menu' => $id
		);

		// Getting the Menu items
		$menu_locations = wp_get_nav_menu_items($id);
		?>

		<div class="container footer-container">

			<?php $social_links_count = count($fields['social_media']); ?>

			<div class="footer-social-media-section" style="display:grid; grid-template-columns:repeat(<?php echo $social_links_count; ?>,40px);">

				<?php 
				foreach($fields['social_media'] as $sm){ 
				// Obtaining the values (link, logo, alt for image) within the social media section with ACF
				?>

					<a class="social-link" href="<?php echo $sm['link'];?>">
						<img class="social-icon" src="<?php echo $sm['logo']['url'];?>" alt="<?php echo $sm['logo']['alt'];?>">
					</a>
			
				<?php } ?>

			</div>

			<nav class="footer-navigation-section">

				<?php 
				// Foreach counter to compare with the menu size
				$counter = 0;
				// Obtaining menu size
				$menu_count = count($menu_locations);
				// As per design the columns on desktop in footer are 2, therefore we are counting how much is in each column
				$columns_items = $menu_count / 2;
				// Checking whether menu count is odd or even since this will change the div start and end placement
				$menu_remainder = $menu_count % 2;
				
				foreach($menu_locations as $ml){ 
					
					// Check for even numbers when either the list starts or when the list is halfway there EG.: if menu size = 6, start will be at 0 and 3
					if($menu_remainder == 0 && ($counter == 0 || $counter == $columns_items)){ ?>

						<div class="footer-nav-column">

					<?php } 
					
					// Check for odd numbers when  either the list starts or when the list is halfway there EG.: if menu size = 7, start will be at 0 and 4 - rounded up since return of 3.5 when division occurs
					if($menu_remainder == 1 && ($counter == 0 || $counter == round($columns_items))){ ?>

						<div class="footer-nav-column">

					<?php } 
					//Obtaining url and title by ACF from site footer
					?>
						
					<a class="footer-nav-link" href="<?php echo $ml->url; ?>">
						<span class="footer-nav-item"><?php echo $ml->title; ?></span>
					</a><br>

					<?php
					
					// Check for even numbers when either the list end or when the list is halfway there EG.: if menu size = 6, end will be at 2 and 5
					if($menu_remainder == 0 && ($counter == $menu_count || $counter == $columns_items-1)){ ?>

						</div>

					<?php }

					// Check for odd numbers when  either the list ends or when the list is halfway there EG.: if menu size = 7, end will be at 3 and 6 - rounded down since return of 3.5 when division occurs
					if($menu_remainder == 1 && ($counter == $menu_count || $counter == floor($columns_items))){ ?>

						</div>

					<?php }

					// Counter increment
					$counter++; 
				
				} ?>

			</nav>

			<div class="footer-copyright-section">

				<!-- Getting copyright text with ACF -->
				<span class="footer-company-copyright"><?php echo $fields['footer_text'];?></span>

				<div class="sco-container">
					<a class="sco-link" href="https://stevesandco.com">
						<img class="sco-logo" src="<?php echo get_template_directory_uri();?>/resources/sco-logo.svg" alt="Steves&Co Logo">
						<span class="sco-tagline">another steves&co. website</span>
					</a>
				</div>

			</div>

		</div>

	</footer><!-- #colophon -->
	<?php wp_footer(); ?>

</div><!-- #page -->

<script src="<?php echo get_template_directory_uri();?>/js/footer.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/header.js"></script>
<?php if($post_slug == 'contact-us'){ ?>
	<script src="<?php echo get_template_directory_uri();?>/js/contact-us-map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDh9loTRlWJ1yzQlCjQ88wRqvXZ2sZ3-_M&callback=initMap" async defer></script>
<?php }else if($post_slug == 'properties'){ ?>
	<script src="<?php echo get_template_directory_uri();?>/js/properties-map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDh9loTRlWJ1yzQlCjQ88wRqvXZ2sZ3-_M&callback=initPropertiesMap" async defer></script>
<?php } ?>
<script src="<?php echo get_template_directory_uri();?>/js/home.js?v=4356623"></script>
<script src="<?php echo get_template_directory_uri();?>/js/single-property.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/properties.js?v=385736"></script>
<script src="<?php echo get_template_directory_uri();?>/js/account.js"></script>
<script src="<?php echo get_template_directory_uri();?>/lightbox/dist/js/lightbox.min.js"></script>
</body>

</html>

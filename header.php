<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package stevesandco
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<?php
global $post;
$post_slug = $post->post_name;
?>

<head>
	<?php if($post_slug !== 'properties'){
		wp_head();
	}
	?> 
	<title>Bilom Group</title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- URL Path to parent theme directory -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/styles.css?v=627zxh7">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/lightbox/dist/css/lightbox.min.css">
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<header id="masthead" class="site-header">

		<?php 
		//ID for Main Menu
		$id = 2;
		$menu = wp_get_nav_menu_object( $id );
		//Custom Fields for Main Menu
		$fields = get_fields($menu);
		// var_dump($fields);

		$args = array(
			'menu' => $id
		);

		// Getting the Menu items
		$menu_locations = wp_get_nav_menu_items($id);
		// echo '<pre>' . var_export($menu_locations, true) . '</pre>';
		?>

		<div class="container header-container">
			
			<div class="menu-container">
				<div class="site-logo-section">
					<a class="site-logo-link" href="/">
						<img class="site-logo" src="<?php echo $fields['bilom_logo']['url']; ?>" alt="<?php echo $fields['bilom_logo']['alt']; ?>">
					</a>
				</div>

				<div class="menu-icons">

					<div class="desktop-nav-section sales-section">
						<?php 
						$counter = 1;
						$sales_counter = 0;
						
						foreach($menu_locations as $dml){
							
							if($dml->title == 'Sales'){
								$sales_id = $dml->ID; 

								foreach($menu_locations as $menu_counter){

									if($menu_counter->menu_item_parent == $sales_id){
										$sales_counter++;
									}

								}
								
								?>
								<div class="menu-title sales-title">
									<!-- <a class="menu-item parent-menu-item sales-menu-item" href="<?php echo $dml->url; ?>"> -->
										<span class="nav-item"><?php echo $dml->title; ?></span>
									<!-- </a> -->
									<i class="fa fa-chevron-down"></i>
								</div>

							<?php } 

							if($dml->menu_item_parent == $sales_id){
								
								if($counter == 1){ ?>

									<div class="child-menu sales-menu-children">

								<?php }
								
								?>

								<a class="menu-item child-menu-item" href="<?php echo $dml->url; ?>">
									<span class="nav-item"><?php echo $dml->title; ?></span>
								</a>

								<?php 
								
								if($counter == $sales_counter){ ?>

									</div>

								<?php }

								$counter++;

							}
							
						} ?>
					</div>

					<div class="desktop-nav-section rentals-section">
						<?php 
						$counter = 1;
						$rentals_counter = 0;
						
						foreach($menu_locations as $dml){
							
							if($dml->title == 'Rentals'){
								$rentals_id = $dml->ID; 

								foreach($menu_locations as $menu_counter){

									if($menu_counter->menu_item_parent == $rentals_id){
										$rentals_counter++;
									}

								}
								
								?>
								<div class="menu-title rentals-title">
									<!-- <a class="menu-item parent-menu-item sales-menu-item" href="<?php echo $dml->url; ?>"> -->
										<span class="nav-item"><?php echo $dml->title; ?></span>
									<!-- </a> -->
									<i class="fa fa-chevron-down"></i>
								</div>

							<?php } 

							if($dml->menu_item_parent == $rentals_id){
								
								if($counter == 1){ ?>

									<div class="child-menu rentals-menu-children">

								<?php }
								
								?>

								<a class="menu-item child-menu-item" href="<?php echo $dml->url; ?>">
									<span class="nav-item"><?php echo $dml->title; ?></span>
								</a>

								<?php 
								
								if($counter == $rentals_counter){ ?>

									</div>

								<?php }

								$counter++;

							}
							
						} ?>
					</div>

					<div class="my-account-section">
						<?php if(is_user_logged_in()){ 
							$user_id = get_current_user_id();
							$url = get_avatar_url($user_id);
							?>
							<img class="user-avatar" src="<?php echo $url; ?>">
						<?php } else { ?>
							<img class="my-account-icon" src="<?php echo $fields['my_account_icon']['url']; ?>" alt="<?php echo $fields['my_account_icon']['alt']; ?>">
							<span class="desktop-my-account-text">Log in</span>
						<?php } ?>
					</div>

					<div class="mobile-menu-section">
						<img class="mobile-menu-icon" src="<?php echo $fields['mobile_menu_icon']['url']; ?>" alt="<?php echo $fields['mobile_menu_icon']['alt']; ?>">
					</div>
					
				</div>
			</div>
			
			<div class="mobile-menu">
				<div class="mobile-menu-content container">
					<img class="close-mobile-menu-icon" src="<?php echo $fields['close_mobile_menu_icon']['url']; ?>" alt="<?php echo $fields['close_mobile_menu_icon']['alt']; ?>">
				
					<nav class="mobile-nav-menu">
						<?php foreach($menu_locations as $ml){

							if($ml->menu_item_parent == 0){?>

								<a class="menu-item parent-menu-item" href="<?php echo $ml->url; ?>">
									<span class="nav-item"><?php echo $ml->title; ?></span>
								</a><br>

							<?php }else{ ?>

								<a class="menu-item child-menu-item" href="<?php echo $ml->url; ?>">
									<span class="nav-item"><?php echo $ml->title; ?></span>
								</a><br>
							
						<?php }

						} ?>
					</nav>
				</div>
			</div>

		</div>
		
		<?php if($post_slug == 'properties'){?>

			<div class="toggle-properties-search container">
				<span class="toggle-properties-search-text">Toggle Filters</span>
			</div>

			<div class="properties-search">

				<div class="search-header container">
					<img class="close-properties-search-icon" src="<?php echo $fields['close_mobile_menu_icon']['url']; ?>" alt="<?php echo $fields['close_mobile_menu_icon']['alt']; ?>">
				</div>

				<div class="search-form container">
					<?php dynamic_sidebar( 'properties-search' ); ?>
				</div>
				
			</div>

		<?php } ?>

	</header><!-- #masthead -->

	<div id="content" class="site-content">

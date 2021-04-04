<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package stevesandco
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<div class="content-404">
					<h1 class="main-text-404">ERROR <span class="red-text">404</span></h1>
					<h2 class="tagline-404">PAGE NOT FOUND</h2>
					<a class="return-to-home-404" href="/">
						<span>RETURN TO HOME</span>
					</a>
				</div>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

<?php
get_header();
$heroine_img = get_template_directory_uri(  ) . "/template-parts/img/" . rand(1,9) . ".jpg";
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="sic-page-heroine-wrapper bg-accent-20">
        <div class="sic-page-heroine-image-wrapper lg-container">
            <div class="sic-page-heroine-image-inner">
                <img src="<?php echo $heroine_img; ?>" alt="">
                <div class="sic-page-heroine-image-overlay"></div>
                <h1 class="sic-page-heroine-image-title"><span class="sic-highlight sic-highlight-neg nohypen"><?= the_title() ?></span></h1>
            </div>
        </div>
    </div>

    <main class="mt-32">
        <?php
        the_content();
        echo(do_shortcode( "[sic-element elem='mitmachen']" ))
        ?>
    </main>

    <?php endwhile;?>

<?php endif; ?>

<?php
get_footer();
?>
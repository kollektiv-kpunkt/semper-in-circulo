<?php
get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <main class="smcont mt-14">
        <?php the_content(); ?>
    </main>

    <?php endwhile;?>

<?php endif; ?>

<?php
get_footer();
?>
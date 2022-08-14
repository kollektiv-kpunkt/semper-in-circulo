<?php
$logo_svg = file_get_contents(get_template_directory() . '/template-parts/img/logo.svg');
?>

<div class="sic-footer-wrapper bg-secondary-20 mt-32 pt-16 pb-4">
    <div class="md-container">
        <?php if ( is_active_sidebar( 'footer_widget' ) ) : ?>
                <?php dynamic_sidebar( 'footer_widget' ); ?>
        <?php endif; ?>
        <hr class="sic-hr">
    </div>
    <div class="lg-container">
        <div class="sic-2col items-center justify-between">
            <div class="sic-footer-logo">
                <a href="/" class="flex gap-4">
                    <?php
                    echo $logo_svg;
                    ?>
                    <div class="sic-logo-text text-secondary-120 sic-akrobat flex flex-col ml-0">
                        <span>Kreislauf</span>
                        <span>Initiative</span>
                        <span>Gegenvorschlag</span>
                    </div>
                </a>
            </div>
            <div class="sic-footer-menu flex gap-10 justify-end text-secondary-70">
                <?php
                $menuitems = sic_menu_items("sic-footer-nav");
                foreach($menuitems as $item):
                    ?>
                    <a href="<?= $item->url ?>" class="sic-footer-menu-item sic-akrobat sic-noline"><?= $item->title ?></a>
                    <?php
                endforeach;
                ?>
                <a href="https://kpunkt.ch" class="sic-footer-menu-item sic-akrobat sic-noline">Built with 💙 by K.</a>
            </div>
        </div>
    </div>
</div>
<div class="sic-copyright-wrapper bg-secondary-120">
    <div class="sic-copyright lg-container text-end text-xs text-white py-2">
        © <?= date("Y") ?> Komitee «JA zum Kreislauf-Initiative Gegenvorschlag»
    </div>
</div>
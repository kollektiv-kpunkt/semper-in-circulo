<?php
$logo_svg = file_get_contents(get_template_directory() . '/template-parts/img/logo.svg');
?>
<div class="sic-navbar-wrapper">
    <div class="sic-navbar-inner xl-container flex justify-between">
        <div class="sic-navbar-logo-container my-auto">
            <a href="/" class="flex gap-9">
                <?php
                echo $logo_svg;
                ?>
                <div class="sic-logo-text text-white sic-akrobat flex flex-col">
                    <span>Kreislauf</span>
                    <span>Initiative</span>
                    <span>Gegenvorschlag</span>
                </div>
            </a>
        </div>
        <div class="sic-navbar-menu-container flex items-center mr-6">
            <?php
            wp_nav_menu( [
                'theme_location' => 'sic-main-nav',
                'menu_class' => 'sic-navbar-menu flex',
            ] );
            ?>
        </div>
        <div class="sic-navbar-mobile-menu-container flex mr-4">
            <div class="sic-navbar-mobile-menu-button my-auto flex gap-2 items-center">
                <span class="sic-akrobat pointer text-xl text-white">Menu</span>
                <div class="sic-tofuburger"></div>
            </div>
        </div>
    </div>
    <div class="sic-navbar-mobile-menu-items">
        <?php
        wp_nav_menu( [
            'theme_location' => 'sic-main-nav',
            'menu_class' => 'sic-navbar-mobile-menu flex flex-col p-8 bg-accent-30 text-end',
        ] );
        ?>
    </div>
</div>
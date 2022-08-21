<?php
$orgas = array_values(array_filter(scandir(__DIR__ . "/img/logos"), function($var) {
    return !(substr( $var, 0, 1 ) === ".");
}));
?>

<div class="sic-logos-wrapper">
    <div class="sic-logos-inner flex flex-wrap">
        <?php
        foreach ($orgas as $orga) :
        ?>
            <div class="sic-logos-logo-wrapper p-4">
                <div class="sic-logos-logo">
                    <img src='<?= get_template_directory_uri(  ) . "/template-parts/blocks/img/logos/" . $orga ?>' alt='<?= $orga ?>' />
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>
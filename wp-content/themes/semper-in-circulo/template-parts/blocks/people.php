<?php
$people = get_field("people");
?>

<div class="sic-people-wrapper">
    <div class="sic-people-inner flex flex-wrap justify-center">
        <?php
        foreach ($people as $person):
        ?>
        <div class="sic-person-wrapper">
            <div class="sic-person-image">
                <img src="<?= wp_get_attachment_image_url( $person["image"]["ID"], "medium" ) ?>" alt="<?= $person["name"] ?>">
            </div>
            <div class="sic-person-content mt-4">
                <p class="sic-person-name mb-1 text-2xl text-accent"><b><?= $person["name"] ?></b></p>
                <p class="sic-person-position mt-0 mb-0"><?= $person["position"] ?></p>
            </div>
        </div>
        <?php
        endforeach;
        ?>
    </div>
</div>
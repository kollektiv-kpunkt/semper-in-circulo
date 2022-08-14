<?php
$images = ["flohmarkt", "repaircafe", "kleidertausch", "velomech", "foodwaste", "baustelle", "recycling"];
?>
<div class="sic-fp-heroine-wrapper mb-40">
    <div class="sic-fp-heroine-inner bg-accent-20">
        <div class="sic-fp-heroine-illus">
        <?php
        foreach ($images as $image) :
        ?>
        <img class="sic-fp-heroine-illu" src="<?= get_template_directory_uri() ?>/template-parts/blocks/img/<?= $image ?>.png" alt="<?= $image ?>" data-image="<?= $image ?>">
        <?php
        endforeach;
        ?>
        <img src="<?= get_template_directory_uri() ?>/template-parts/blocks/img/fp-heroine-mobile.png" alt="Mobile heroine background image" class="sic-fp-heroine-illu sic-fp-heroine-mobile">
        </div>
        <div class="sic-fp-heroine-content-wrapper">
            <div class="sic-fp-heroine-content text-center text-white p-8 md-container">
                <?= the_field("content") ?>
                <div class="sic-fp-heroine-buttons flex gap-4 mt-6 justify-center">
                    <?php
                    foreach (get_field("buttons") as $button) :
                        ?>
                    <a href="<?= $button["link"] ?>" class="sic-button <?= $button["type"] ?>"><?= $button["text"] ?></a>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
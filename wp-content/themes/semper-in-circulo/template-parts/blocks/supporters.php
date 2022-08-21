<?php
global $wpdb;
$supporters = $wpdb->get_results("SELECT * from `wp_supporters` WHERE `status` = 1 ORDER BY `fname` ASC", ARRAY_A);
// $supporters = [];
?>

<div class="sic-komitee-wrapper mt-4">
    <p class="text-sm"><?php
    $i = 0;
    foreach ($supporters as $supporter): ?>

    <b><?= $supporter["fname"] ?> <?= $supporter["lname"] ?><?php if ($supporter["position"] && $supporter["position"] != ""): ?>,</b> <?= $supporter["position"] ?><?php else: ?></b><?php endif; ?><?= ($i < count($supporters) - 1) ? ";" : "" ?>
    <?php
    $i++;
    endforeach;
    ?>
    </p>
    <div class="komitee-form-wrapper mt-10" id="beitreten">
        <h3 class="text-xl mb-2"><span class="sic-highlight">Möchtest du dem Komitee beitreten?</span></h3>
        <p>Dann füll bitte dieses Formular aus:</p>
        <form action="#" class="sic-api-form sic-form-wrapper mt-4" data-endpoint="/api/v1/supporter">
            <div class="sic-alertBar p-3 leading-none my-4" hidden></div>
            <div class="sic-form-group">
                <label for="fname">Vorname</label>
                <input type="text" name="fname" id="fname" class="sic-form-input" required>
            </div>
            <div class="sic-form-group">
                <label for="lname">Nachname</label>
                <input type="text" name="lname" id="lname" class="sic-form-input" required>
            </div>
            <div class="sic-form-group">
                <label for="position">Position (Beruf, Amt etc.)</label>
                <input type="text" name="position" id="position" class="sic-form-input" placeholder="optional">
            </div>
            <div class="sic-form-group">
                <label for="email">E-Mail Adresse</label>
                <input type="email" name="email" id="email" class="sic-form-input" required>
            </div>
            <div class="sic-form-group sic-form-group-checkbox sic-form-group-fullwidth">
                <input type="checkbox" name="optin" id="optin" checked>
                <label for="optin" class="text-xs">Ich bin einverstanden, dass das Komitee mich auf dem Laufenden hält.</label>
            </div>
            <button type="submit" class="sic-button sic-button-next w-full">Ich bin dabei</button>
        </form>
    </div>
</div>
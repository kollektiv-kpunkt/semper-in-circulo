<?php
$formid = rand(1,100000);
$prefil = [
    "name" => "",
    "email" => "",
];
if (isset($_GET["testi-name"])) {
    $prefil["name"] = " value='{$_GET["testi-name"]}'";
}
if (isset($_GET["testi-email"])) {
    $prefil["email"] = " value='{$_GET["testi-email"]}'";
}
?>

<?php
if ($_ENV["BROWSER"]["browser_firefox_original"] == 1) :
?>
<div class="sm-container">
    <p><b>Tut uns leid, aber dein Browser wird für das generieren von Testimonials nicht unterstützt.</b> Wir sind derzeit daran das Problem zu lösen. In der Zwischenzeit, benutze bitte einen anderen Browser wie Chrome, Safari, Edge, Opera oder Brave.</p>
</div>
<?php
else:
?>

<div class="sm-container">
    <div class="sic-testimonial-form-wrapper">
        <form action="#" id="formid-<?= $formid ?>-1" class="sic-api-form sic-form-wrapper sic-step-wrapper" data-endpoint="/api/v1/testimonial/1" data-step="current">
            <script formconfig type="application/json">
                {
                    "action" : "nextStep"
                }
            </script>
            <div class="sic-form-group">
                <label for="name-<?=$formid?>">Name</label>
                <input type="text" name="name" id="name-<?=$formid?>" class="sic-form-input"<?= $prefil["name"] ?>required>
            </div>
            <div class="sic-form-group">
                <label for="email-<?=$formid?>">E-Mail Adresse</label>
                <input type="email" name="email" id="email-<?=$formid?>" class="sic-form-input"<?= $prefil["email"] ?> required>
            </div>
            <div class="sic-form-group sic-form-group-fullwidth">
                <label for="position-<?=$formid?>">Position (Beruf, Amt etc.)</label>
                <input type="text" name="position" id="position-<?=$formid?>" class="sic-form-input" placeholder="optional">
            </div>
            <div class="sic-form-group sic-form-group-fullwidth">
                <label for="quote-<?=$formid?>">Dein Zitat</label>
                <textarea name="quote" id="quote-<?=$formid?>" class="sic-form-input autosize">Ich unterstütze den Gegenvorschlag zur Kreislauf-Initiative, weil...</textarea>
            </div>
            <div class="sic-form-group sic-form-group-checkbox sic-form-group-fullwidth">
                <input type="checkbox" name="optin" id="optin-<?=$formid?>" class="sic-form-input" checked>
                <label for="optin-<?=$formid?>">Ich bin einverstanden, dass mich das Komitee auf dem Laufenden hält. Mehr <a href="/datenschutz">Informationen zum Datenschutz.</a></label>
            </div>
            <button type="submit" class="sic-button sic-button-next w-full">Weiter</button>
        </form>
        <div class="sic-step-wrapper sic-testimonial-photo-step" data-step="hidden">
            <h3><span class="sic-highlight nohypen">Dein Foto</span></h3>
            <p>Damit wir dein Testimonial erstellen können, brauchen wir hier noch ein Foto von dir:</p>
            <input type="file" name="sic-testimonial-picture" id="sic-testimonial-picture" class="mt-2">
            <div class="sic-testimonial-cropper-wrapper" hidden>
                <p class="my-4"><b>Bitte schneide dein Bild noch ins gewünschte Format:</b></p>
                <img src="#" alt="" id="sic-testimonial-cropper">
                <a href="#" class="sic-button sic-button-next mt-4" id="sic-testimonial-crop">Testimonial erstellen</a>
            </div>
        </div>
    </div>
    <div class="sic-testimonial-stage" hidden>
        <h3><span class="sic-highlight">Dein Testimonial</span></h3>
        <?php
        echo(do_shortcode("[sic-element elem='testi-stage']"));
        ?>
        <div class="sic-tesimonial-colors flex gap-2 mt-4 flex-wrap">
            <p class="w-full"><i>Farbe ändern:</i></p>
            <div class="testimonial-color" data-color="accent"></div>
            <div class="testimonial-color" data-color="secondary"></div>
        </div>
        <a href="#" class="sic-button sic-button-next mt-12 sic-testimonial-download">Testimonial herunterladen</a>
    </div>
</div>

<?php
endif;
?>
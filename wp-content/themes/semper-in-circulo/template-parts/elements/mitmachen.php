<?php
$formid = rand(1,100000);
?>

<div class="sic-mitmachen-wrapper mt-40 mb-28 lg-container bg-accent-20" id="mitmachen">
    <div class="sic-2col sic-2col-nogap md-container items-center px-8">
        <div class="sic-mitmachen-image-wrapper">
            <div class="sic-mitmachen-imager-inner">
                <img src="<?= get_template_directory_uri(  ) ?>/template-parts/img/<?= rand(1,10) ?>.jpg">
            </div>
        </div>
        <div class="sic-mitmachen-form-wrapper">
            <h2 class="text-6xl"><span class="sic-highlight">Sei Dabei!</span></h2>
            <form action="#" id="formid-<?= $formid ?>" class="sic-api-form sic-form-wrapper" data-endpoint="/api/v1/mitmachen">
                <div class="sic-form-group">
                    <label for="name-<?=$formid?>">Name</label>
                    <input type="text" name="name" id="name-<?=$formid?>" class="sic-form-input" required>
                </div>
                <div class="sic-form-group">
                    <label for="email-<?=$formid?>">E-Mail Adresse</label>
                    <input type="email" name="email" id="email-<?=$formid?>" class="sic-form-input" required>
                </div>
                <div class="sic-form-group sic-form-group-checkbox sic-form-group-fullwidth">
                    <input type="checkbox" name="optin" id="optin-<?=$formid?>" class="sic-form-input" checked>
                    <label for="optin-<?=$formid?>">Ich bin einverstanden, dass mich das Komitee auf dem Laufenden hält. Mehr <a href="/datenschutz">Informationen zum Datenschutz.</a></label>
                </div>
                <button type="submit" class="sic-button sic-button-next w-full">Ich bin dabei</button>
            </form>
        </div>
    </div>
</div>
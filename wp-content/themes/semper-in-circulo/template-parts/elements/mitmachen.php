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
            <form action="#" id="formid-<?= $formid ?>" class="sic-api-form sic-form-wrapper sic-step-wrapper" data-endpoint="/api/v1/mitmachen" data-step="current">
                <h2 class="text-6xl mr-auto ml-0"><span class="sic-highlight">Sei Dabei!</span></h2>
                <script formconfig type="application/json">
                    {
                        "action" : "nextStep"
                    }
                </script>
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
            <div class="sic-step-wrapper text-accent-120" data-step="hidden">
                <h3><span class="sic-highlight nohypen">Danke für deine Unterstützung!</span></h3>
                <p>Danke, dass du den Gegenvorschlag zur Kreislaufinitiative unterstützt! Wenn du uns weiterhilfen willst, kannst du hier verschiedene Dinge tun:</p>
                <div class="sic-mitmachen-buttons flex flex-wrap gap-1 mt-4">
                    <a href="/spenden" class="sic-button sic-button-next text-sm w-full">Spenden</a>
                    <a href="/testimonial" class="sic-button sic-button-neg sic-button-next text-sm w-full">Testimonial schreiben</a>
                    <a href="/material-bestellen" class="sic-button sic-button-next text-sm w-full">Material bestellen</a>
                </div>
            </div>
        </div>
    </div>
</div>
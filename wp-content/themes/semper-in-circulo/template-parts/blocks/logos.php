<?php
// $orgas = array_values(array_filter(scandir(__DIR__ . "/img/logos"), function($var) {
//     return !(substr( $var, 0, 1 ) === ".");
// }));
// shuffle($orgas);

$orgas = array(
    "JG" => [
        "img" => "Logo_ZH2.png",
        "name" => "junge Grüne"
    ],
    "GP" => [
        "img" => "Logo_GrueneKantonZuerich_RGB.png",
        "name" => "Grüne Partei Kanton Zürich"
    ],
    "SP" => [
        "img" => "SP_Logo_cmyk.png",
        "name" => "Sozialdemokratische Partei Kanton Zürich"
    ],
    "AL" => [
        "img" => "AL.png",
        "name" => "Alternative Liste Kanton Zürich"
    ],
    "GLP" => [
        "img" => "Gruenliberale_Logo_RGB_pos.png",
        "name" => "Grünliberale Partei Kanton Zürich"
    ],
    "EVP" => [
        "img" => "Logo_EVP.png",
        "name" => "Evangelische Volkspartei Kanton Zürich"
    ],
    "Mitte" => [
        "img" => "Kanton-Zuerich_Die_Mitte_Kanton_Zuerich_RGB.png",
        "name" => "die Mitte Kanton Zürich"
    ],
    "FDP" => [
        "img" => "FDP Kanton ZH-logo_deutsch_pos_Zürich.png",
        "name" => "FDP. Die Liberalen Kanton Zürich"
    ],
    "SVP" => [
        "img" => "SVP_dt_rgb.jpg",
        "name" => "Schweizerische Volkspartei Kanton Zürich"
    ],
    "jglp" => [
        "img" => "logo_jglp_zh500px.png",
        "name" => "junge Grünliberale Kanton Zürich"
    ],
    "jevp" => [
        "img" => "jevp_Logo_RGB_claim.png",
        "name" => "junge Evangelische Volkspartei Kanton Zürich"
    ],
    "junge Mitte" => [
        "img" => "Die Junge Mitte_Zürich.png",
        "name" => "junge Mitte Kanton Zürich"
    ],
    "JSVP" => [
        "img" => "JSVP-Logo_kontur_512.png",
        "name" => "junge Schweizerische Volkspartei Kanton Zürich"
    ],
    "WWF" => [
        "img" => "wwf_logo_ohne Rahmen_gross.jpg",
        "name" => "World Wildlife Fund"
    ],
    "Greenpeace" => [
        "img" => "Greenpeace_Logo_Green_RGB.png",
        "name" => "Greenpeace"
    ],
    "gv" => [
        "img" => "blau_Zuerich.png",
        "name" => "Gewerbeverein Zürich"
    ],
    "sct" => [
        "img" => "SwissCleanTech.png",
        "name" => "Swiss Clean Tech"
    ],
    "öbu" => [
        "img" => "oebu_c_rgb_pos_weiss.jpg",
        "name" => "öbu"
    ]
)
?>

<div class="sic-logos-wrapper">
    <div class="sic-logos-inner flex flex-wrap justify-center">
        <?php
        foreach ($orgas as $orga) :
        ?>
            <div class="sic-logos-logo-wrapper p-4">
                <div class="sic-logos-logo">
                    <img src='<?= get_template_directory_uri(  ) . "/template-parts/blocks/img/logos/" . $orga["img"]  ?>' alt='Logo «<?= $orga["name"] ?>»' />
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>
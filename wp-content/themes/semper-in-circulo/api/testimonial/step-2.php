<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if (isset($_COOKIE["mtm_consent"])) {
    $mtm->doTrackEvent("Testimonial", "Step 2", $data["uuid"]);
}

$result = $wpdb->update("wp_testimonial", [
    "testi_img" => $data["image"]
], [
    "testi_uuid" => $data["uuid"]
]);

if ($result != 1) {
    echo json_encode(
        [
            "status" => "error",
            "message" => "Da ist etwas schief gelaufen, bitte versuch es nochmals.",
            "code" => 501
        ]);
    exit;
}

$testimonial = $wpdb->get_row($wpdb->prepare("SELECT * from `wp_testimonial` WHERE `testi_uuid` = %s", $data["uuid"]));

echo (json_encode([
    "status" => "success",
    "message" => "Dein Eintrag wurde gespeichert.",
    "testimonial" => $testimonial
]));
exit;
<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
if ( !is_user_logged_in() ) {
    wp_redirect( "/wp-login.php?redirect_to=" . urlencode($actual_link . "/api/v1/freischalten/{$uuid}") );
    exit;
}

global $wpdb;

$result = $wpdb->update( "wp_supporters", array( 'status' => 1 ), array( 'uuid' => $uuid ) );
if ($result === 1 ) {
    echo json_encode(
        [
            "status" => "success",
            "message" => "Dein Eintrag wurde freigeschaltet."
        ]);
} else {
    echo json_encode(
        [
            "status" => "error",
            "message" => "Da ist etwas schief gelaufen, bitte versuch es nochmals.",
            "code" => 501
        ]);
}
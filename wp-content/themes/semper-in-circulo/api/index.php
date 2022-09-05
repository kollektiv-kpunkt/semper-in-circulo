<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/../vendor/autoload.php';
use Pecee\SimpleRouter\SimpleRouter as Router;
use Mautic\Auth\ApiAuth;
use Mautic\MauticApi;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$mtmpageid = $_ENV["MATOMOID"];
$mtmurl = $_ENV["MATOMOURL"];
$mtmtoken = $_ENV["MATOMOTOKEN"];
global $mtm;
$mtm = new MatomoTracker((int)$mtmpageid, $mtmurl);

$mcapi = $_ENV["MCAPI"];
$mclistid = $_ENV["MCLISTID"];
$mcserver = $_ENV["MCSERVERPREFIX"];
$client = new \MailchimpMarketing\ApiClient();
global $client;
$client->setConfig([
    'apiKey' => $mcapi,
    'server' => $mcserver
]);

$mail = new PHPMailer(true);
global $mail;
try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = $_ENV["MAILSERVER"];
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV["MAILUSER"];
    $mail->Password   = $_ENV["MAILPW"];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = $_ENV["MAILPORT"];
    $mail->CharSet = 'UTF-8';
    $mail->setFrom($_ENV["MAILUSER"], $_ENV["MAILFROM"]);
} catch (Exception $e) {
    echo "Error setting up Email: {$mail->ErrorInfo}";
}


include_once __DIR__ . "/../../../../wp-load.php";

Router::post('/api/v1/supporter', function() {
    global $wpdb;
    global $client;
    global $mtm;
    global $mail;
    include(__DIR__ . '/supporters.php');
});

Router::post('/api/v1/mitmachen', function() {
    global $wpdb;
    global $client;
    global $mtm;
    global $mail;
    include(__DIR__ . '/mitmachen.php');
});

Router::post('/api/v1/testimonial/{step}', function($step) {
    global $wpdb;
    global $client;
    global $mtm;
    global $mail;
    include(__DIR__ . "/testimonial/step-{$step}.php");
});


Router::get('/api/v1/freischalten/{uuid}', function($uuid) {
    global $wpdb;
    global $client;
    global $mtm;
    global $mail;
    include(__DIR__ . '/freischalten.php');
});

Router::post('/api/v1/spende', function() {
    global $client;
    include(__DIR__ . '/donation.php');
});

Router::start();

?>
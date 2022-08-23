<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if (isset($_COOKIE["mtm_consent"])) {
    $mtm->doTrackEvent("Testimonial", "Step 1", $data["uuid"]);
}

if (!isset($data["optin"])) {
    $data["optin"] = 0;
} else {
    $data["optin"] = 1;
}

$result = $wpdb->insert("wp_testimonial", [
    "testi_uuid" => $data["uuid"],
    "testi_name" => $data["name"],
    "testi_email" => $data["email"],
    "testi_position" => $data["position"],
    "testi_quote" => $data["quote"],
    "testi_optin" => $data["optin"]
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

if ($data["optin"] == 1) {
    try {
        $response = $client->lists->setListMember($_ENV["MCLISTID"], strtolower(md5($data["email"])), [
            "email_address" => $data["email"],
            'merge_fields' => [
                    "FNAME" => $data["fname"],
                    "LNAME" => $data["lname"]
            ],
            'tags' => ["Testimonial"],
            "status" => "subscribed",
        ]);
    } catch (GuzzleHttp\Exception\ClientException $e) {
    $return = [
      "status" => "error",
      "message" => "Da ist etwas schief gelaufen, bitte versuch es nochmals.",
      "content" => $e->getResponse()->getBody()->getContents(),
      "errors" => [$e->getMessage()]
    ];
    echo json_encode($return);
    exit;
    }

    try {
        $response = $client->lists->createListMemberNote(
            $_ENV["MCLISTID"],
            strtolower(md5($data["email"])),
            [
                "note" => "Form submission: " . $data["uuid"]
            ]
        );
    } catch (GuzzleHttp\Exception\ClientException $e) {
        $return = [
        "sucess" => false,
        "content" => $e->getResponse()->getBody()->getContents(),
        "errors" => [$e->getMessage()]
        ];
        echo json_encode($return);
        exit;
    }
}

$emailcontent = <<<EOD
<div style="font-family: sans-serif">
    <p>Hallo {$data["name"]},</p>
    <p>Vielen Dank, dass du den Gegenvorschlag zur Kreislauf-Initiative unterstützt, indem du dein Testimonial auf möglichst vielen Kanälen teilst.</p>
    <p>Solltest du uns noch weiter unterstützen können, wären wir dir <a href="{$actual_link}/spenden">für eine Spende ausgesprochen dankbar</a>.</p>
    <p>Viele Grüße,<br>
    <b>Julian Croci</b><br>
    Kampagnen-Team vom Gegenvorschlag zur Kreislauf-Initiative
    </p>
<div>
EOD;

global $mail;
$mail->addAddress($data["email"], "{$data["fname"]} {$data["lname"]}");
$mail->isHTML(true);
$mail->Subject = "Danke für deine Unterstützung!";
$mail->Body    = $emailcontent;

try {
    $mail->send();
} catch (Exception $e) {
    $return = [
      "status" => "error",
      "message" => "Da ist etwas schief gelaufen, bitte versuch es nochmals.",
      "errors" => $mail->ErrorInfo
    ];
    echo json_encode($return);
    exit;
}


echo json_encode(
    [
        "status" => "success",
        "code" => 200
    ]
);

exit;
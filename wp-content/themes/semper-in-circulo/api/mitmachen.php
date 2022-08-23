<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if (isset($_COOKIE["mtm_consent"])) {
    $mtm->doTrackEvent("Mitmachen Signup", "Final", $data["uuid"]);
}

if (!isset($data["optin"])) {
    $data["optin"] = 0;
} else {
    $data["optin"] = 1;
}


if ($data["optin"] == 1) {
    try {
        $response = $client->lists->setListMember($_ENV["MCLISTID"], strtolower(md5($data["email"])), [
            "email_address" => $data["email"],
            'merge_fields' => [
                    "FNAME" => $data["name"],
            ],
            'tags' => ["Mitmachen"],
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

echo json_encode(
    [
        "status" => "success",
        "message" => "Danke für deinen Eintrag! Wir werden ihn so schnell wie möglich freischalten!",
        "code" => 200
    ]
);
exit;
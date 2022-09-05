<?php
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if ($data["stored_customer_email"]) {
    if ($data["stored_customer_firstname"] && $data["stored_customer_firstname"] != "") {
        try {
            $response = $client->lists->setListMember($_ENV["MCLISTID"], strtolower(md5($data["stored_customer_email"])), [
                "email_address" => $data["stored_customer_email"],
                'merge_fields' => [
                        "FNAME" => $data["stored_customer_firstname"],
                        "LNAME" => $data["stored_customer_lastname"]
                ],
                'tags' => ["Spende"],
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
    }

    try {
        $amount = $data["datatrans_amount"] / 100;
        $response = $client->lists->createListMemberNote(
            $_ENV["MCLISTID"],
            strtolower(md5($data["stored_customer_email"])),
            [
                "note" => "Donation Amount: {$amount} {$data["datatrans_currency"]} / Donation ID: {$data["epp_transaction_id"]}",
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
    echo(json_encode(
        [
            "status" => "success",
            "message" => "Donation logged successfully.",
            "code" => 200
        ]
    ));
} else {
    exit;
}
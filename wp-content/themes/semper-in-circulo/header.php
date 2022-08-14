<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        var Hyphenopoly = {
            require: {
                "de": "FORCEHYPHENOPOLY"
            },
            setup: {
                selectors: {
                    "#main-content": {}
                },
                exceptions: {
                    "global": "F-35"
                },
            }
        };
    </script>
    <?php
    wp_head();
    ?>
</head>
<body>
    <?php
    get_template_part( "template-parts/elements/navbar" );
    ?>
    <div id="main-content">
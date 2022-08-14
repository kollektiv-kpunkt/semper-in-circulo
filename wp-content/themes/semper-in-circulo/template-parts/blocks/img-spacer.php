<?php
$heroine_img = get_template_directory_uri(  ) . "/template-parts/img/" . rand(1,10) . ".jpg";
?>

<div class="sic-img-spacer-wrapper my-20">
    <div class="sic-img-spacer-inner">
        <img src="<?php echo $heroine_img; ?>" alt="">
    </div>
</div>
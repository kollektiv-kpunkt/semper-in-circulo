<?php
$cutout = file_get_contents(get_template_directory() . '/template-parts/elements/img/cutout.svg');
$arrows = file_get_contents(get_template_directory() . '/template-parts/elements/img/arrows.svg');
$logo = file_get_contents(get_template_directory() . '/template-parts/elements/img/logo_hi.svg');
?>


<div class="sic-testimonial-stage-wrapper mt-12">
    <div class="sic-testimonial-stage-inner">
        <div class="sic-testimonial-wrapper">
            <div class="sic-testimonial-inner" data-browser="<?= $_ENV["BROWSER"]["browser_name"] ?>">
                <div class="sic-testimonial-layer">
                    <div class="sic-testimonial-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=928&q=80" alt="">
                    </div>
                </div>
                <div class="sic-testimonial-layer">
                    <div class="sic-testimonial-cutout-wrapper">
                        <div class="sic-testimonial-cutout">
                            <?php echo $cutout; ?>
                        </div>
                    </div>
                </div>
                <div class="sic-testimonial-layer">
                    <div class="sic-testimonial-arrows-wrapper">
                        <div class="sic-testimonial-arrows">
                            <?php echo $arrows; ?>
                        </div>
                    </div>
                </div>
                <div class="sic-testimonial-layer">
                    <div class="sic-testimonial-logo-wrapper">
                        <div class="sic-testimonial-logo">
                            <?php echo $logo; ?>
                        </div>
                    </div>
                </div>
                <div class="sic-testimonial-layer">
                    <div class="sic-testimonial-text-wrapper">
                        <div class="sic-testimonial-text-outer text-white">
                            <div class="sic-testimonial-ghost"></div>
                            <div class="sic-testimonial-text-inner">
                                <p class="sic-testimonial-quote">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione voluptatem fuga atque perferendis, commodi libero quidem facere, vero fugiat quos omnis veniam.</p>
                                <p class="sic-testimonial-claim mt-8">JA zur kantonalen Abstimmung<br>
                                am 25. September 2022</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sic-testimonial-layer">
                    <div class="sic-testimonial-boxes-wrapper">
                        <div class="sic-testimonial-box">
                            <span class="sic-testimonial-name" style="color: #25A97A">Kathrin Heierlein</span>
                        </div>
                        <div class="sic-testimonial-box">
                            <span class="sic-testimonial-position" style="color: #095A6E">Vorstandsmitglied Junge Grüne Kanton ZH</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
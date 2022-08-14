<details class="sic-toggle-details mt-4 text-start"<?= (get_field("default_setting")) ? " open" : "" ?>>
    <summary class="sic-toggle-summary sic-akrobat text-xl flex justify-between leading-none">
        <span class="sic-toggle-title"><?= get_field("title") ?></span>
        <div class="sic-toggle-icon text-center">›</div>
    </summary>
    <div class="sic-toggle-content mt-4">
        <?= get_field("content") ?>
    </div>
</details>
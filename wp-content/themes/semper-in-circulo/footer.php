</div>
<?php
get_template_part( "template-parts/elements/footer");
?>
<script type="text/plain" data-cookiecategory="analytics">
  var _paq = window._paq = window._paq || [];
  _paq.push(['requireConsent']);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="<?= $_ENV["MATOMOSRC"] ?>";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '<?= $_ENV["MATOMOID"] ?>']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>

<?php
wp_footer(  );
?>
</body>
</html>
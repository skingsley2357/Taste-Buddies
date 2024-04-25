    
    </div>
    <footer>
      <nav>
        <a href="https://www.facebook.com"><img src="<?php echo url_for('/images/facebook-logo.png'); ?>" alt="Facebook"></a>
        <a href="https://www.instagram.com"><img src="<?php echo url_for('/images/instagram-logo.png'); ?>" alt="Instagram"></a>
        <a href="https://www.tiktok.com"><img src="<?php echo url_for('/images/tiktok-logo.png'); ?>" alt="TikTok"></a>
        <a href="https://www.twitter.com"><img src="<?php echo url_for('/images/twitter-logo.png'); ?>" alt="Twitter"></a>
      </nav>

      <h1>Taste Buddies</h1>
    </footer>
    <script src="<?php echo url_for('/js/app.js'); ?>"></script>
  </body>
</html>
<?php
db_disconnect($database);
?>

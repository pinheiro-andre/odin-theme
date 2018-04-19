<?php
define('WP_USE_THEMES', false);
include("../../../../wp-blog-header.php");
include "wengosense_cached.php";

set_experts_tabs();
set_astroshopping_products();

//   */5 * * * * /usr/bin/php /var/www/html/blog_astrocentro/blog/wp-content/themes/odin/cron/cron.php > /dev/null 2>&1

?>

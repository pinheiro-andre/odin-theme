<?php


add_action('wp_head','my_tracking');
function my_tracking() {

?>



<!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');

    fbq('init', '00000000000');
    fbq('track', "PageView");</script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=681509141962022&ev=PageView&noscript=1"
    /></noscript>


<!-- Google Analytics -->
<script sync type="text/javascript">
//<![CDATA[
    var _gaq = _gaq || [];
    var search_matches = window.location.pathname.match(/\/search\/(.*?)\/(.*)/);

    _gaq.push(['_setAccount', 'UA-0000000000-2']);
    _gaq.push(['_setDomainName', '.astrocentro.com.br']);
    _gaq.push(['_trackPageview']);

    // doubleclick checker -
    window.onload = function () {

        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);


    setTimeout(function(){ if(typeof _gat === "undefined"){
    (function(){ var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 })(); _gaq.push(['_trackEvent','GA Remarketing Tag','DC Script','Failed',0,true]);
    gaCustomVar.save();
 } }, 1500); }
//]]>
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-00000000-19', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>


<?php
}

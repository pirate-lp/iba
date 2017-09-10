<footer>
	<p>
		<b><a href="/">Lost Ideas Lab</a></b> | <a href="/about/">About</a> | <a href="/contact/">Contact</a> { <a href="/contact/privacy-policy/">Privacy Policy</a>, <a onclick="jQuery('#cookie-options').slideToggle()">Cookie Options</a> } | 2012 - 2017 &copy; all rights reserved. 
		    <span style="color: rgba(255, 255, 255, 0.1)"><?php
				sleep(1);
				$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
				echo "PT: {$time}";
		    ?></span>
	</p>
	
	<div id="cookie-options" class="no">
		<div class="pure-g">
			<div class="{{ $mainStandard }}">
				<article class="text shadow">
				<p><b><a onclick="jQuery('#cookie-options').slideToggle()">Cookie Options</a></b></p>
				<p><iframe style="border: 0; height: 200px; width: 100%;" src="http://analytics.lostideaslab.com/index.php?module=CoreAdminHome&action=optOut&language=en"></iframe></p>
				</article>
			</div>
		</div>
	</div>
	
</footer>


<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//analytics.lostideaslab.com/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->

<a id="back" href="<?php echo site_url(); ?>"><?php if (!isset($noLinkToFrontpage)) echo "« Tillbaka till startsidan"; ?></a>
<h5 id="copyright">Copyright 2011-2012  &copy; <a target="_blank" href="http://www.jacob-andersson.com/">Jacob Andersson</a></h5>
<div id="fbrss" class="fb-like" data-href="<?php echo $facebookLink; ?>" data-send="false" data-layout="box_count" data-width="100" data-show-faces="true" data-font="tahoma"></div>

<script type="text/javascript" src="<?php echo site_url(); ?>js/jquery.tipsy.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#foodfooter a').tipsy({
		gravity: 's',
		delayIn: 800,
		delayOut: 0
	});
	<?php if (isset($shortFood) && isset($food) && $shortFood !== $food) { ?>
	$('.food h1').tipsy({
		gravity: 's',
		delayIn: 500,
		delayOut: 0
	});
	<?php } ?>
});
</script>

<script type="text/javascript">window.scrollTo(1, 1)</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28946863-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
    
</body>
</html>
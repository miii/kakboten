<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width,height=device-height">
<meta property="og:title" content="Käkboten - Dagens lunch på JB-gymnasiet Gävle"/>
<meta property="og:description" content="Käkboten levererar information om dagens käk på din skola med möjlighet att kommentera, gilla och söka på maträtter och tillfällen. Allt på ett snyggt och smidigt sätt!"/>
<meta property="og:url" content="http://kakboten.se/"/>
<meta property="og:type" content="blog"/>
<meta property="og:image" content="http://kakboten.se/images/v3/logo/fb_image.png"/>
<meta property="fb:admins" content="100000758672423" />
<meta property="fb:app_id" content="175974195843586" />
<link href="css/v3/reset.css" type="text/css" rel="stylesheet" />
<link href="css/v3/style.css" type="text/css" rel="stylesheet" />
<link href="images/favicon.png" rel="icon" type="image/png" sizes="48x48" />
<title>Käkboten - Dagens lunch på JB-gymnasiet Gävle</title>
</head>
<body id="tablet">

<div id="footer" class="tutorial">
    <img src="images/v3/html5_logo.png" alt="html5" />
    <div id="copyright">
    	<h5>&copy; Copyright</h5>
    	<h4>Jacob Andersson</h4>
    </div>
    <div class="fb-like" data-href="http://www.facebook.com/pages/K%C3%A4kboten-John-Bauergymnasiet/256583497745874" data-send="false" data-layout="box_count" data-width="100" data-show-faces="false" data-font="segoe ui"></div>
</div>

<div id="sidebar" class="tutorial">
	<img src="images/v3/logo_700x200.png" alt="Logotyp" />
	<h1>Vecka <?php echo $week; ?></h1>
    <ul>
    	<li class="<?php echo $class[0]; ?>" day="0">
        	Måndag
            <span><?php echo date('d', strtotime("{$year}W{$week}1")); ?></span>
        </li>
    	<li class="<?php echo $class[1]; ?>" day="1">
        	Tisdag
            <span><?php echo date('d', strtotime("{$year}W{$week}2")); ?></span>
        </li>
    	<li class="<?php echo $class[2]; ?>" day="2">
        	Onsdag
            <span><?php echo date('d', strtotime("{$year}W{$week}3")); ?></span>
        </li>
    	<li class="<?php echo $class[3]; ?>" day="3">
        	Torsdag
            <span><?php echo date('d', strtotime("{$year}W{$week}4")); ?></span>
       </li>
    	<li class="<?php echo $class[4]; ?>" day="4">
        	Fredag
            <span><?php echo date('d', strtotime("{$year}W{$week}5")); ?></span>
        </li>
    </ul>
</div>

<div id="content">
	<h4 class="nofood">Laddar innehåll...</h4>
</div>

<script src="js/jquery.js"></script>
<script>
scrollTo(1, 0);

$(document).ready(function() {
	
	week = <?php echo $week; ?>;
		
	// Resize content on window resize
	function resizeContent() {
		
		// Set body height to browser window height
		$('body').height($(window).height());
		
		// Fit content to window size
		$('#content').width($('body').width() - $('#sidebar').outerWidth());
		
		// Detect screen orientation
		if ($(window).width() > $(window).height()) $('body').removeClass('portrait').addClass('landscape');
		else $('body').removeClass('landscape').addClass('portrait');
		
		// Set image radio to 1:0.67
		$('.image').height(($('.image').width() * 0.67));
		
		// Center images with padding
		$('.imageWrapper').each(function() {
			$(this).height($(this).parent().width() * 0.67);
			
			var imageWidth = $(this).children().attr('originalWidth');
			var imageHeight = $(this).children().attr('originalHeight');
			
			if (!imageWidth) {
				
				imageWidth = $(this).children().width();
				imageheight = $(this).children().height();
				
				$(this).children().attr('originalWidth', imageWidth);
				$(this).children().attr('originalHeight', imageHeight);
			}
			
			if (imageWidth * 0.67 < imageHeight) {
				if (imageHeight > $(this).height()) $(this).children('img').height('100%');
				else $(this).children('img').height(imageHeight);
			} else {
				if (imageWidth > $(this).width()) $(this).children('img').width('100%');
				else $(this).children('img').width(imageWidth);
			}
			
			var padding = ($(this).height() - $(this).children().height()) / 2;
			$(this).css('padding-top', padding)
		});
		
		// Resize the h4 to fit with the content
		$('h4').css('maxWidth', $('.image').width() - 20);
		
		$('.historyWrapper, h3').hide();
		
		$('.history').each(function() {
			$(this).css('padding', ($('#content').width() - 868) / 20 + 'px');
		})
		
	}

	// Resize content on load½½
	$(window).resize(function() {
		resizeContent();
	});
	
	// Bind sidebar nav buttons
	$('#sidebar ul li').click(function() {
		
		// Make it active
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		
		// Load page content
		$('#content').css('opacity', 0);
		$('#content').load('content/get/' + week + '/' + $(this).attr('day'), function() {
			$(this).animate({
				opacity: 1
			});
			resizeContent();
		});
	});
	
	// Load content for current day
	$('#sidebar ul li.active').click();
	resizeContent();
	
});
</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=175974195843586";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
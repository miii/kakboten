<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta property="og:title" content="Käkboten - Dagens lunch på JB-gymnasiet Gävle"/>
<meta property="og:description" content="Käkboten levererar information om dagens käk på din skola med möjlighet att kommentera, gilla och söka på maträtter och tillfällen. Allt på ett snyggt och smidigt sätt!"/>
<meta property="og:url" content="http://kakboten.se/"/>
<meta property="og:type" content="blog"/>
<meta property="og:image" content="http://kakboten.se/images/v3/logo/fb_image.png"/>
<meta property="fb:admins" content="100000758672423" />
<meta property="fb:app_id" content="175974195843586" />
<link href="css/v3/reset.css" type="text/css" rel="stylesheet" />
<link href="css/v3/style.css" type="text/css" rel="stylesheet" />
<link href="http://kakboten.se/images/favicon.png" rel="icon" type="image/png" sizes=48x48"" />
<title>Käkboten - Dagens lunch på JB-gymnasiet Gävle</title>
</head>
<body id="desktop">

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
    <ul class="disabled">
    	<li day="0">
        	Måndag
            <span>-</span>
        </li>
    	<li day="1">
        	Tisdag
            <span>-</span>
        </li>
    	<li day="2">
        	Onsdag
            <span>-</span>
        </li>
    	<li day="3">
        	Torsdag
            <span>-</span>
        </li>
    	<li day="4">
        	Fredag
            <span>-</span>
        </li>
    </ul>
</div>

<div id="content">
	<h4 class="nofood">Det finns ingen matinformation att visa...</h4>
</div>

<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script>
$(document).ready(function() {

	// If user uses IE version 8 or less, they will be redirected to the old site
	if($.browser.msie && ($.browser.version < 9)) oldSite();
	function oldSite() { document.location.href = 'http://www.browserchoice.eu/'; }
		
	// Resize content on window resize
	function resizeContent() {
		
		// Set body height to browser window height
		$('body').height($(window).height());
		
		// Fit content to window size
		$('#content').width($('body').width() - $('#sidebar').outerWidth());
		$('#content').show();
		
		// Adapt font size to window size/screen resolution (max 25 px)
		var font = $('body').width() / 55;
		if (font > 25) font = 25;
		
		$('h2').css('font-size', font);
		
		// Set image radio to 1:0.67
		$('.image').height(($('.image').width() * 0.67));
		
		// Center images with padding
		$('.imageWrapper').each(function() {
			var padding = ($(this).parent().height() + 3 - $(this).height()) / 2;
			$(this).css('padding-top', padding);
		});
		
		// Resize the h4 to fit with the content
		$('h4').css('maxWidth', $('.image').width() - 20);
		
		// If screen width is less than 1366px, hide the history wrapper
		if ($('body').width() < 1366) $('.historyWrapper, h3').hide();
		else $('.historyWrapper, h3').show();
		
	}
	
	// HTML5 Storage
	if(typeof(Storage) !== "undefined") {
		
		// New user? Start tutorial
		if (!localStorage.tutorial) {
			$.get('tutorial.php', function(data) {
				$('body').append(data);
				$.getScript('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
				$.getScript('tutorial.js', function() {
					tutorial(0);
					$('#tutorial').draggable();
				});
			});
		}
		
	// If HTML5 Storage isn't supported, redirect to old site
	} else oldSite();

	// Resize content on load½½
	$(window).resize(function() {
		resizeContent();
	});
	
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
</body>
</html>
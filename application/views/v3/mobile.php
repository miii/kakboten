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
<link href="images/favicon.png" rel="icon" type="image/png" sizes="48x48" />
<title>Käkboten - Dagens lunch på JB-gymnasiet Gävle</title>
</head>
<body id="mobile">

<div id="content">
    <img src="images/v3/logo_700x200.png" alt="Käkboten" />
	<div id="food" class="tutorial">
    	<header>
        	<h2><?php echo $food['food']; ?></h2>
        </header>
    	<article class="simple">
            <div class="image">
                <div class="imageWrapper">
                    <img src="<?php echo $food['image_url']; ?>" alt="<?php echo $food['food']; ?>" />
                </div>
            </div>
        </article>
    </div>
    <div id="veg" class="tutorial">
    	<div class="borderleft">
            <h2><?php echo $veg['food']; ?></h2>
            <article class="simple">
                <div class="image">
                    <div class="imageWrapper">
                        <img src="<?php echo $veg['image_url']; ?>" alt="<?php echo $veg['food']; ?>" />
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>

<div id="footer">
    <img src="images/v3/html5_logo.png" alt="HTML5"/>
    <div class="fb-like" data-href="http://www.facebook.com/pages/K%C3%A4kboten-John-Bauergymnasiet/256583497745874" data-send="false" data-layout="box_count" data-width="100" data-show-faces="false" data-font="segoe ui"></div>
    <div id="copyright">
    	<h5>&copy; Copyright</h5>
    	<h4>Jacob Andersson</h4>
    </div>
</div>

<div id="fb-root"></div>
<script src="js/jquery.js"></script>
<script>
$(document).ready(function() {
	
	if ($(window).width() > $(window).height() && $(window).width() >= 1024 && $(window).height() >= 525) document.location.href = 'http://tablet.kakboten.se/';
	else if ($(window).width() > $(window).height() && $(window).width() >= 800 && $(window).height() >= 1024) document.location.href = 'http://tablet.kakboten.se/';
	
}
</script>
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
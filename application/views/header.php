<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
<link href="<?php echo site_url(); ?>images/favicon.png" rel="shortcut icon" />
<link href="<?php echo site_url(); ?>css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo site_url(); ?>css/light.css" rel="stylesheet" type="text/css" />
<link href="<?php echo site_url(); ?>css/tipsy.css" rel="stylesheet" type="text/css" />
<?php if ($mobile) { ?><link href="<?php echo site_url(); ?>css/mobile.css" rel="stylesheet" type="text/css" /><?php } ?>
<link rel="canonical" href="<?php echo current_url(); ?>" />
<meta property="og:title" content="<?php echo $title; ?>"/>
<meta property="og:description" content="<?php echo $description; ?>"/>
<meta property="og:url" content="<?php echo current_url(); ?>"/>
<meta property="og:type" content="<?php echo $ogType; ?>"/>
<meta property="og:image" content="<?php echo site_url($ogImage); ?>"/>
<meta property="fb:admins" content="<?php echo $fbAdmins; ?>" />
<meta property="fb:app_id" content="<?php echo $fbAppID; ?>" />
<meta name="viewport" content="user-scalable=no,width=device-width" />
<title><?php echo $title; ?></title>
<style type="text/css">
a:link:hover,
a:visited:hover,
.highlight {
	color:#<?php echo $logoColor; ?>;
}
</style>
<!--[if IE]><link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>css/ie.css" /><![endif]-->
</head>

<body>
	
<div id="fb-root"></div>
<script type="text/javascript">(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/sv_SE/all.js#xfbml=1&appId=260620370645268";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript" src="<?php echo site_url(); ?>js/jquery.js"></script>

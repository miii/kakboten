<?php

if (!isset($veg)) {
		
	$veg['url'] = $food['url'];
	$veg['food'] = $food['food'];
	
}

if ($page == 'index') {

?>
<div id="menu">
	<a class="left">John Bauergymnasiet</a>
	<a class="right"><?php echo $dayString; ?>, vecka <?php echo $week; ?>, <?php echo $year; ?></a>
</div>
<?php

} elseif ($page == 'menu') {

?>
<div id="menu">
	<a class="left">John Bauergymnasiet - <?php echo $dayString; ?>, vecka <?php echo $week; ?>, <?php echo $year; ?></a>
	<a href="<?php echo site_url(); ?>jb/" class="right ielink">Visa dagens mat</a>
</div>
<?php

}

?>
<a href="<?php echo site_url("/{$schoolURL}/sok/"); ?>"><div id="searchbox"></div></a>

<img id="logo" src="<?php echo base_url(); ?>images/logo/logo_700x200_<?php echo $logoColor; ?>.png" alt="" />

<div id="foodwrapper">
	<div class="food iemenu">
		<h1 <?php if ($shortFood !== $food['food']) echo "title=\"{$food['food']}\""; ?>>
			<a href="<?php echo site_url("/{$schoolURL}/matratt/{$food['url']}/"); ?>">
				<?php echo $shortFood; ?>
			</a>
		</h1>
		<h2><a href="<?php echo site_url("/{$schoolURL}/matratt/{$veg['url']}/"); ?>"><?php echo $veg['food']; ?></a></h2>
		<div class="fb-like fblike" data-href="<?php echo site_url("/{$schoolURL}/matratt/{$food['url']}/"); ?>" data-send="false" data-layout="box_count" data-width="100" data-show-faces="true" data-font="tahoma"></div>
		<img src="<?php echo $food['image_url']; ?>" alt="Var snäll och rapportera bruten bildlänk till admin" />
		<div id="foodfooter" class="textleft">
			<a class="left">Hitta tillbaka:&nbsp;</a>
			<a class="left" href="<?php echo site_url("/{$schoolURL}/meny/{$dayURL}-vecka-{$week}-{$year}/"); ?>"><?php echo site_url("/{$schoolURL}/meny/{$dayURL}-vecka-{$week}-{$year}/"); ?></a>
		</div>
	</div>
	<div class="fb-comments" data-href="<?php echo site_url("/{$schoolURL}/meny/{$dayURL}-vecka-{$week}-{$year}/"); ?>" data-num-posts="5" data-width="600"></div>
</div>
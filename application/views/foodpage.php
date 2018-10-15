<?php

if ($served < 1) {
	$servedString = 'inte serverats någon gång';
} elseif ($served < 2) {
	$servedString = "serverats {$served} gång";
} else {
	$servedString = "serverats {$served} gånger";
}
	
?>
<div id="menu">
	<a class="left">John Bauergymnasiet</a>
	<a href="<?php echo site_url(); ?>jb/" class="right ielink">Visa dagens mat</a>
</div>
<a href="<?php echo site_url("/{$schoolURL}/sok/"); ?>"><div id="searchbox"></div></a>

<img id="logo" src="<?php echo site_url(); ?>images/logo/logo_700x200_<?php echo $logoColor; ?>.png" alt="" />

<div id="foodwrapper">
	<div class="food">
		<h1 style="width:auto" <?php if ($shortFood !== $food) echo "title=\"{$food}\""; ?> class="mobileimg">
			<?php echo $shortFood; ?>
		</h1>
		<div style="<?php echo $type < 1 ? 'display:none' : ''; ?>" id="label" class="highlight">
			<h3>Veg</h3>
			alternativ
		</div>
		<img class="noMarginTop" src="<?php echo $imageURL; ?>" alt="" />
		<div id="foodfooter">
			<div class="fb-like foodpage_fblike" data-href="<?php echo site_url("/{$schoolURL}/matratt/{$foodURL}/"); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true" data-font="tahoma"></div>
			<a name="more"></a>
			<a href="#more" onclick="javascript:document.getElementById('served').style.display = 'block'" title="Notera att den här informationen gäller från Januari 2012">Denna maträtt har <?php echo $servedString ?> hittills</a>
		</div>
	</div>
	<?php
	
	if ($served > 0) {
		
		echo '<div id="served"><table><tr class="title"><td>Som huvudrätt:</td><td>Som vegetariskt alternativ:</td></tr>';
				
		$c = 0;
				
		foreach($servedArray as $data) {
			
			$date = "{$data['date']['day']}, vecka {$data['date']['week']}, {$data['date']['year']}";
			
			$servedFood = $data['food'] ? $date : '-';
			$servedVeg = $data['veg'] ? $date : '-';
			
			$class = $c % 2 == 0 ? 'dark' : '';
			$c++;
				
			echo "<tr class=\"{$class}\"><td>{$servedFood}</td><td>{$servedVeg}</td></tr>";
				
		}
				
		echo '</table></div>';
	
	}
	
	?>
	<div class="fb-comments" data-href="<?php echo site_url("/{$schoolURL}/matratt/{$foodURL}/"); ?>" data-num-posts="5" data-width="600"></div>
</div>

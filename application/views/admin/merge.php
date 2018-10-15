<title>Käkboten - Slå ihop maträtter</title>
</head>

<body>
<div id="menu">
	<a class="right" href="<?php echo site_url('haxor/'); ?>">Startsida</a>
</div>
<form id="admin" action="<?php echo site_url('haxor/mergepage'); ?>" method="post">
<a href="javascript:document.forms['admin'].submit()"><div id="adminSave">Fortsätt</div></a>

<div id="foodwrapper">
	<div class="food">
		<h1>Administration:</h1>
			<?php
			
			foreach($foodArray as $i => $food) {
				
				$food['image'] = empty($food['image_url']) ? site_url() .'images/defaultImage.png' : $food['image_url'];
				$food['type'] = $food['type'] > 0 ? 'VEG' : '';
				
			?>
				<table class="<?php echo $i % 2 == 0 ? 'dark' : ''; ?>">
					<tr>
						<td class="image" rowspan="2">
							<img src="<?php echo $food['image']; ?>" alt="Bruten bildlänk" />
						</td>
						<td class="title">
							<a target="_blank" href="<?php echo site_url("{$food['school_id']}/matratt/{$food['url']}"); ?>">
								<?php echo $food['food']; ?>
							</a>
						</td>
						<td class="type"><?php echo $food['type']; ?></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="text" name="merge[<?php echo $food['id']; ?>]" value="" style="opacity:0" />
						</td>
					</tr>
				</table>
			<?php
				
			}
			
			?>
	</div>
</div>
</form>

<a id="back" href="../">« Tillbaka till startsidan</a>

<script type="text/javascript" src="<?php echo site_url(); ?>js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('table').hover(function() {
		$(this).addClass('hover');
	}, function() {
		$(this).removeClass('hover');
	});
	$('table').click(function() {
		$(this, 'input[type=text]').addClass('marked');
		$('input[type=text]', this).val('1');
	});
});
</script>

</body>
</html>
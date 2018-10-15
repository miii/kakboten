<title>Käkboten - Slå ihop maträtter</title>
</head>

<body>
<div id="menu">
	<a class="left" href="<?php echo site_url('haxor/merge'); ?>">Tillbaka</a>
	<a class="right" href="<?php echo site_url('haxor/'); ?>">Startsida</a>
</div>
<form id="admin" action="<?php echo site_url('haxor/mergesave'); ?>" method="post">
<a href="javascript:document.forms['admin'].submit()"><div id="adminSave">Slå ihop</div></a>

<div id="foodwrapper">
	<div class="food">
		<h1>Valda maträtter:</h1>
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
							<input type="text" name="trash" value="<?php echo $food['image_url']; ?>" />
							<input type="hidden" name="merge[old][]" value="<?php echo $food['id']; ?>" />
						</td>
					</tr>
				</table>
			<?php
				
			}
			
			?>
	</div>
	<div class="food">
		<h1>Ny information:</h1>
		<table class="newInformation">
			<tr>
				<td>
					Namn:<br />
					<input type="text" name="merge[new][food]" value="<?php echo $foodArray[0]['food']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					Typ:<br />
					<select name="merge[new][type]">
						<option value="0">Huvudrätt</option>
						<option value="1"<?php if ($onlyVeg) echo ' selected="selected"'; ?>>Vegetariskt alternativ</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					Bild-URL:<br />
					<input type="text" name="merge[new][image_url]" value="<?php echo $foodArray[0]['image_url']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					URL:<br />
					<input type="text" name="merge[new][url]" value="<?php echo $foodArray[0]['url']; ?>" />
				</td>
			</tr>
		</table>
	</div>
</div>
</form>

<a id="back" href="../">« Tillbaka till startsidan</a>

</body>
</html>
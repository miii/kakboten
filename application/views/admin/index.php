<title>Käkboten - Adminstrera maträtter</title>
</head>

<body>
<div id="menu">
	<a class="left"><?php echo "{$hasNotImage} / {$foodTotal} maträtter saknar bild" ?></a>
	<a class="right" href="<?php echo site_url('haxor/merge/'); ?>">Slå ihop maträtter</a>
</div>
<form id="admin" action="<?php echo site_url('haxor/save'); ?>" method="post">
<a href="javascript:document.forms['admin'].submit()"><div id="adminSave">Spara ändringar</div></a>

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
							<a class="sup" href="<?php echo site_url("haxor/edit/{$food['url']}"); ?>">Ändra</a>
						</td>
						<td class="type"><?php echo $food['type']; ?></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="text" name="food[<?php echo $food['id']; ?>][new]" value="<?php echo $food['image_url']; ?>" />
							<input type="hidden" name="food[<?php echo $food['id']; ?>][old]" value="<?php echo $food['image_url']; ?>" />
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
    
</body>
</html>
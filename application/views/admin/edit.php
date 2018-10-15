<title>Käkboten - Slå ihop maträtter</title>
</head>

<body>
<div id="menu">
	<a class="right" href="<?php echo site_url('haxor/'); ?>">Startsida</a>
</div>
<form id="admin" action="<?php echo site_url('haxor/editsave'); ?>" method="post">
<a href="javascript:document.forms['admin'].submit()"><div id="adminSave">Spara</div></a>

<div id="foodwrapper">
	<div class="food">
		<h1>Ändra maträtt:</h1>
		<table class="newInformation">
			<tr>
				<td>
					Namn:<br />
					<input type="text" name="edit[food]" value="<?php echo $data['food']; ?>" />
					<input type="hidden" name="edit[id]" value="<?php echo $data['id']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					Typ:<br />
					<select name="edit[type]">
						<option value="0">Huvudrätt</option>
						<option value="1"<?php if ($data['type'] == 1) echo ' selected="selected"'; ?>>Vegetariskt alternativ</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					URL:<br />
					<input type="text" name="edit[url]" value="<?php echo $data['url']; ?>" />
				</td>
			</tr>
		</table>
		<img class="editimage" src="http://i.imm.io/frpT.jpeg" alt="" />
	</div>
</div>
</form>

<a id="back" href="../">« Tillbaka till startsidan</a>

</body>
</html>
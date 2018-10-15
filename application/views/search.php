<div id="menu">
	<a class="left">John Bauergymnasiet</a>
	<a href="<?php echo site_url(); ?>jb/" class="right ielink">Visa dagens mat</a>
</div>

<img id="logo" src="<?php echo site_url(); ?>images/logo/logo_700x200_<?php echo $logoColor; ?>.png" />

<div id="foodwrapper">
	<div class="food">
		<h1>Sök tillfälle:</h1>
		<form class="search" id="searchDay" method="post" action="">
			<table>
				<tr>
					<td>
						<select class="dropdown" id="year">
							<?php
							
							foreach ($years as $year) echo $year == $yearnow ? "<option selected=\"selected\">{$year}</option>" : "<option>{$year}</option>";
							
							?>
						</select>
					</td>
					<td>
						<select class="dropdown" id="week">
							<?php
							
							foreach ($weeks as $week) echo $week == $weeknow ? "<option selected=\"selected\" value=\"vecka-{$week}\">Vecka {$week}</option>" : "<option value=\"vecka-{$week}\">Vecka {$week}</option>";
							
							?>
						</select>
					</td>
					<td>
						<select class="dropdown" id="day">
							<?php
							
							foreach ($daysURL as $id => $dayURL) echo $id == $daynow ? "<option selected=\"selected\" value=\"{$dayURL}\">{$days[$id]}</option>" : "<option value=\"{$dayURL}\">{$days[$id]}</option>";
							
							?>
						</select>
					</td>
					<td><input class="submit" type="submit" value="Sök" /></td>
				</tr>
			</table>
		</form>
	</div>
	<div class="food">
		<h1>Sök maträtt:</h1>
		<form class="search" id="searchFood" method="post" action="">
			<table>
				<tr>
					<td><input id="searchterm" class="text" title="Ange namn på maträtt här..." onfocus="if (this.value == this.getAttribute('title')) { this.value = ''; this.style.color = '#333' }" onblur="if (this.value == '') { this.value = this.getAttribute('title'); this.style.color = '#888' }" type="text" value="Ange namn på maträtt här..." /></td>
					<td><input class="submit" id="searchSubmit" type="submit" disabled="disabled" value="Sök" /></td>
				</tr>
			</table>
		</form>
	</div>
	<div id="served" class="searchResults">
		<table id="searchResults"></table>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	
	$('#searchterm').keyup(function(event) {
		
		$('#searchSubmit').attr('value', 'Sök');
		if ($(this).val().length < 3) $('#searchSubmit').attr('disabled', '');
		else $('#searchSubmit').removeAttr('disabled');
		
	});
	
	$('#searchFood').submit(function() {
		
		$('#searchSubmit').val('Laddar...');
		$('#searchSubmit').attr('disabled', '');
		
		$.post('<?php echo site_url("{$schoolURL}/searchresults/"); ?>', {query: $('#searchterm').val()}, function(data) {
			data = data == '' ? '<h6>Inga maträtter hittades!</h6>' : data;
			$('#searchResults').html(data);
			$('#served').css('display', 'block');
			$('#searchSubmit').val('Visar resultat');
		});

		
		return false;
		
	});
	
	$('#searchDay').submit(function() {
		
		window.location.href = '<?php echo site_url("{$schoolURL}/meny"); ?>/' + $('#day').val() + '-' + $('#week').val() + '-' + $('#year').val();
		return false;
		
	});
	
	if ($('#searchterm').val() !== $('#searchterm').attr('title')) {
		
		$('#searchSubmit').removeAttr('disabled');
		$('#searchterm').css('color', '#333');
		$('#searchFood').submit();
		
	}
	
});
</script>

<tr class="<?php echo $class; ?>" onclick="location.href = '<?php echo site_url("{$schoolURL}/matratt/{$url}"); ?>'">
	<td>
		<?php
		
		echo preg_replace("#({$query})#i", '<span class="highlight">$1</span>', $food);
		
		?>
	</td>
	<td class="type">
		<?php
		
		if ($type == 1) echo 'VEG';
		
		?>
	</td>
</tr>
var tstep = 0;

function tutorial(step) {
	
	var tutorial = ['none', 'sidebar', 'food', 'veg', 'footer'];
	
	$('#tutorial div').hide();
	$('#tutorial .step' + step).show();
	$('#tutorial').show();
	$('#' + tutorial[step]).css('opacity', 1);
	$('.tutorial:not(#' + tutorial[step] + ')').css('opacity', 0.2);
	
	if (tstep > 4) {
	
		if(typeof(Storage)!=="undefined") localStorage.tutorial = true;
		else oldSite();
		
		$('#tutorial').hide();
		$('.tutorial').css('opacity', 1);
		
	}
	tstep++;
	
}
	
$('#tutorial form').submit(function() {
	tutorial(tstep);
	return false;
});
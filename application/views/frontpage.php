<img id="logo" src="<?php echo site_url(); ?>images/logo/logo_700x200_<?php echo $logoColor; ?>.png" alt="" />

<div id="foodwrapper" class="front">
	<h1>Välj skola:</h1>
	<a href="<?php echo site_url('/jb/'); ?>">
		<img class="school" src="<?php echo site_url(); ?>images/jb_logo.png" alt="" />
	</a>
	<div class="food mobilehide">
		<h1>Välkommen till käkboten 2.0</h1>
		
		<p>
			Efter många nerlagda programmeringstimmar och en helt ny domän öppnar vi nu för Käkboten version 2.
			Principen är densamma, men med många nya funktioner och riktig integrering mot facebook är det nu möjligt att kommentara och gilla varje maträtt och servering.
		</p>
		
		<h3 class="frontTitle">Vad är nytt?</h3>
		<p>
			- Helt ny domän och design<br />
			- Maten presenteras nu enskilt för varje dag<br />
			- Bilder på maträtterna<br />
			- Möjlighet att kommentera serveringar och maträtter<br />
			- Möjlighet att gilla maträtter<br />
			- Det går nu att söka på maträtter och tillfällen<br />
			- Möjlighet att se när och hur många gånger en maträtt blivit serverad<br />
			- Varje serveringstillfälle och maträtt har fått sin egen URL<br />
		</p>
		
		<h3 class="frontTitle">Nytt bakom kulisserna</h3>
		<p>
			- Gamla koden har gjorts om och flyttat in i ett ramverk<br />
			- Maten presenteras nu på facebook "via käkboten"<br />
			- All matdata sparas ner i en databas<br />
			- Parsningsfunktionen för hämtning av matdata förbättrad<br />
		</p>
		
	</div>
	<div class="food mobilehide">
		<h1>Vad är Käkboten?</h1>
		
		<p>
			Käkboten presenterar maten som serveras varje dag för John Bauergymnasiet i Gävle på ett smidigt sätt med möjlighet att gilla, kommentera med mera...
			<img src="<?php echo site_url(); ?>images/guide/foodpic.png" alt="" />
		</p>
		
		<p>
			Genom att gilla Käkboten på Facebook via knappen nere till höger på nästa sida så kan du få maten presenterad direkt i ditt nyhetsflöde varje dag. Kan det bli smidigare?
			<img src="<?php echo site_url(); ?>images/guide/facebook_like.png" alt="" />
			<img src="<?php echo site_url(); ?>images/guide/facebook_presenation.png" alt="" />
		</p>
		
		<p>
			Käkboten kan nu även presentera hur många gånger en maträtt har serverats och vilka dagar. Allt genom ett enkelt knapptryck.
			<img src="<?php echo site_url(); ?>images/guide/served.png" alt="" />
		</p>
		
		<p>
			Den nya sökningssidan låter dig hitta dina favoriträtter på ett ögonblick.
			<img src="<?php echo site_url(); ?>images/guide/search.png" alt="" />
		</p>
		
	</div>
	<div class="food mobilehide">
		
		<h3 class="frontTitle">Käkboten till fler skolor</h3>
		<p>
			Vill du ha käkboten till din skola?<br />
			Tveka inte med att kontakta oss så löser vi det!
		</p>
		
		<h3 class="frontTitle">Käkboten API</h3>
		<p>
			Nu har även käkboten ett API som ni programmeringsintresserade kan använda sig av.<br />
			I nuläget stöds endast dagens servering, men vid intresse kan mer data presenteras.<br />
			<br />
			John Bauergymnasiet Gävle: <a target="_blank" href="<?php echo site_url('api/feed/jb'); ?>"><?php echo site_url('api/feed/jb'); ?></a>
		</p>
		
		<h3 class="frontTitle">Kontakt</h3>
		<p>
			Email: <a target="_blank" href="mailto:info@kakboten.se">info@kakboten.se</a><br />
			Facebook: <a target="_blank" href="https://www.facebook.com/pages/K%C3%A4kboten/181136815315306">Käkboten</a>
		</p>
		
	</div>
	<div class="food mobilehide">
		
		<h3 class="frontTitle">Changelog</h3>
		<p>
			2012-02-06 - Käkboten 2.0 lanseras<br />
			2012-02-08 - Mindre designförändringar<br />
			2012-02-09 - Buggfixar<br />
			2012-02-10 - Maten presenteras nu på Facebook 08:15 istället för 10:00<br />
			2012-02-10 - Mobilversion introducerad<br />
			2012-02-17 - Käkboten API lanserat<br />
			2012-03-04 - Buggfixar<br />
			2012-03-04 - Maträttens titel visas nu rätt<br />
			2012-05-04 - Buggen som syntes tidigare i veckan är nu åtgärdad. Sidan uppe igen.<br />
		</p>
	</div>
</div>
<?php 
	$html->css('/event/css/fullcalendar', null, array('inline'=>false));
	$html->script(array('/event/js/fullcalendar.min'), array('inline'=>false));
?>
<div class="example">
    <h2>Events</h2>
	<div id="calendar"></div>

</div>
<script>
	$(document).ready(function() {
 		$('#calendar').fullCalendar({
 			events: "/event/calendar"
	 	});
 	});
 </script>
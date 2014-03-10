<?php 
	$this->Html->css('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.css', null, array('inline'=>false));
	$this->Html->script(array('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js'), array('inline'=>false));
?>
<div class="content">
	<h3>Calendar</h3>
	<div class="body">
		<div id="calendar"></div>
	</div>
</div>

<script>
	$(document).ready(function() {
 		$('#calendar').fullCalendar({
 			events: "<?php echo Router::url(array('plugin'=>'event', 'controller'=>'events', 'action'=>'calendar', '1.json'), true); ?>"
	 	});
 	});
 </script>
 

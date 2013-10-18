<?php 
	$this->Html->css('/event/css/fullcalendar', null, array('inline'=>false));
	$this->Html->script(array('/event/js/fullcalendar.min'), array('inline'=>false));
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
 			events: "<?php echo Router::url(array('plugin'=>'event', 'controller'=>'event', 'action'=>'calendar', '1.json'), true); ?>"
	 	});
 	});
 </script>
 

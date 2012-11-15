<?php 
	$this->Html->css('/event/css/fullcalendar', null, array('inline'=>false));
	$this->Html->script(array('/event/js/fullcalendar.min'), array('inline'=>false));
?>
<div class="example">
    <h2>Events</h2>
	<div id="calendar"></div>

</div>
<script>
	$(document).ready(function() {
 		$('#calendar').fullCalendar({
 			events: "<?php echo Router::url(array('plugin'=>'event', 'controller'=>'event', 'action'=>'calendar', '1.json'), true); ?>"
	 	});
 	});
 </script>
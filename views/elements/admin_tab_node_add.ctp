<?php 
	$html->script(array('/event/js/jquery.datetimepicker'), array('inline'=>false));

    echo $form->input('Event.start_date', array('class'=>'datetimepicker', 'type'=>'text'));
    echo $form->input('Event.end_date', array('class'=>'datetimepicker', 'type'=>'text'));
?>

<script type="text/javascript">
	$(document).ready(function(){
		$('#EventStartDate').datetimepicker({
			dateFormat: 'yy-mm-dd',
			timeFormat: 'hh:mm'
			
		});
		$('#EventEndDate').datetimepicker({
			dateFormat: 'yy-mm-dd',
			timeFormat: 'hh:mm'
			
		});
	
	});
</script>
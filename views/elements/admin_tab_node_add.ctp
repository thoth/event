<?php
    echo $form->input('Event.node_id', array('type'=>'hidden', 'value'=>$html->value('Node.id')));
    echo $form->input('Event.start_date', array('class'=>'datetimepicker'));
    echo $form->input('Event.end_date', array('class'=>'datetimepicker'));
?>

<script type="text/javascript">
	$(document).ready(function(){
		$('.datetimepicker').datetimepicker({
			dateFormat: 'yy-mm-dd'
		});
	
	});
</script>
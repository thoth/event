<?php
	$this->Html->script->link('/event/js/jquery.datetimepicker', false);

    echo $form->input('Event.id', array('type'=>'hidden'));
    echo $form->input('Event.node_id', array('type'=>'hidden', 'value'=>$html->value('Node.id')));
    echo $form->input('Event.start_date', array('class'=>'datetimepicker', 'type'=>'text'));
    echo $form->input('Event.end_date', array('class'=>'datetimepicker', 'type'=>'text'));
?>

<script type="text/javascript">
	$(document).ready(function(){
		$('.datetimepicker').datetimepicker({
			dateFormat: 'yy-mm-dd'
		});
	
	});
</script>
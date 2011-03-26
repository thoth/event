<?php
	$html->script(array('/event/js/jquery.datetimepicker'), array('inline'=>false));

    echo $form->input('Event.id', array('type'=>'hidden'));
    echo $form->input('Event.node_id', array('type'=>'hidden', 'value'=>$this->data['Node']['id']));
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
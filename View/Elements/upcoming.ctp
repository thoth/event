<?php

	$events = $this->requestAction(array('plugin'=>'event', 'controller'=>'events', 'action'=>'upcoming'), array('return'));

	foreach($events as $event){
		echo $this->Html->link($event['Node']['title'], $event['Node']['path']);
	}


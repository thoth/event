<?php
class Event extends EventAppModel{
	var $name = 'Event';

	var $belongsTo = array(
		'Node'
	);
}
<?php 
/* SVN FILE: $Id$ */
/* App schema generated on: 2010-06-06 02:06:57 : 1275792417*/
class EventSchema extends CakeSchema {
	var $name = 'Event';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var	$events = array(
			'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'node_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'start_date' => array('type' => 'datetime', 'null' => true),
			'end_date' => array('type' => 'datetime', 'null' => true),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
			'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
		); 
}
?>
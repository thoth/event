<?php
/**
 * Event Activation
 *
 * Activation class for Event plugin.
 *
 * @package  Croogo
 * @author   Thomas Rader <tom.rader@claritymediasolutions.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.claritymediasolutions.com/portfolio/croogo-event-plugin
 */
class EventActivation {

	public function beforeActivation(Controller $controller) {
		return true;
	}

	public function onActivation(Controller $controller) {

       // ACL: set ACOs with permissions
        $controller->Croogo->addAco('Event'); // ExampleController
        $controller->Croogo->addAco('Event/Events/admin_index'); // ExampleController::admin_index()
        $controller->Croogo->addAco('Event/Events/index', array('registered', 'public')); // ExampleController::index()
        $controller->Croogo->addAco('Event/Events/view', array('registered', 'public')); // ExampleController::index()
        $controller->Croogo->addAco('Event/Events/calendar', array('registered', 'public')); // ExampleController::index()

		App::uses('CroogoPlugin', 'Extensions.Lib');
		$CroogoPlugin = new CroogoPlugin();
		$CroogoPlugin->migrate('Event');

		//Ignore the cache since the tables wont be inside the cache at this point
		//$db->cacheSources = false;


		$controller->Setting->write('Event.use_hold_my_ticket','yes',array('description' => 'Use Hold My Tickets','editable' => 1));
        $controller->Setting->write('Event.hold_my_ticket_api_key','',array('description' => 'Hold My Tickets API Key','editable' => 1));

	}

	public function beforeDeactivation(Controller $controller) {
		return true;
	}

	public function onDeactivation(Controller $controller) {
		$controller->Croogo->removeAco('Event');
	}

 }
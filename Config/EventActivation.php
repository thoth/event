<?php
/**
 * Event Activation
 *
 * Activation class for Event plugin.
 *
 * @package  Croogo
 * @author   Thomas Rader <thomas.rader@tigerclawtech.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.tigerclawtech.com/portfolio/croogo-event-plugin
 */
class EventActivation{

/**
 * onActivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeActivation(&$controller) {
        return true;
    }/**
 * Called after activating the hook in ExtensionsHooksController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onActivation(&$controller) {
        // ACL: set ACOs with permissions
        $controller->Croogo->addAco('Event'); // ExampleController
        $controller->Croogo->addAco('Event/admin_index'); // ExampleController::admin_index()
        $controller->Croogo->addAco('Event/index', array('registered', 'public')); // ExampleController::index()
        $controller->Croogo->addAco('Event/calendar', array('registered', 'public')); // ExampleController::index()
        
		CakePlugin::load('Event');
		App::import('Model', 'CakeSchema');
		App::import('Model', 'ConnectionManager');
		include_once(APP.'Plugin'.DS.'Event'.DS.'Config'.DS.'Schema'.DS.'schema.php');
		$db = ConnectionManager::getDataSource('default');

		//Get all available tables
		$tables = $db->listSources();

		$CakeSchema = new CakeSchema();
		$EventSchema = new EventSchema();

		foreach ($EventSchema->tables as $table => $config) {
			if (!in_array($table, $tables)) {
				$db->execute($db->createSchema($EventSchema, $table));
			}
		}

		//Ignore the cache since the tables wont be inside the cache at this point
		//$db->cacheSources = false;
		@unlink(TMP . 'cache' . DS . 'models/cake_model_' . ConnectionManager::getSourceName($db). '_' . $db->config["database"] . '_list');
		$db->listSources();


		$controller->Setting->write('Event.use_hold_my_ticket','yes',array('description' => 'Use Hold My Tickets','editable' => 1));
        $controller->Setting->write('Event.hold_my_ticket_api_key','',array('description' => 'Hold My Tickets API Key','editable' => 1));
        
		
	}
/**
 * onDeactivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeDeactivation(&$controller) {
        return true;
    }
/**
 * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onDeactivation(&$controller) {
        // ACL: remove ACOs with permissions
        $controller->Croogo->removeAco('Event'); // ExampleController ACO and it's actions will be removed

    }

}
?>
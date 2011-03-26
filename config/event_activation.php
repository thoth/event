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
        
        // Bootstrap: app/plugins/example/config/bootstrap.php will be loaded in app/config/bootstrap.php
        $controller->Croogo->addPluginBootstrap('event');

        // Routes: app/plugins/example/config/routes.php will be loaded in app/config/routes.php
        $controller->Croogo->addPluginRoutes('event');

		$version  = $controller->Setting->read('Event.version');
		swtich($version){
			default:
		        // Add a table to the DB
		        App::import('Core', 'File');
		        App::import('Model', 'CakeSchema', false);
				App::import('Model', 'ConnectionManager');
		
				$db = ConnectionManager::getDataSource('default');
				if(!$db->isConnected()) {
						$this->Session->setFlash(__('Could not connect to database.', true));
					} else {
						$schema =& new CakeSchema(array('plugin'=>'event','name'=>'event'));
						$schema = $schema->load();
						foreach($schema->tables as $table => $fields) {
							$create = $db->createSchema($schema, $table);
							$db->execute($create);
						} 
				}      
		        
		        // Main menu: add an Example link
		        $mainMenu = $controller->Link->Menu->findByAlias('main');
		        $controller->Link->Behaviors->attach('Tree', array(
		            'scope' => array(
		                'Link.menu_id' => $mainMenu['Menu']['id'],
		            ),
		        ));
		        $controller->Link->save(array(
		            'menu_id' => $mainMenu['Menu']['id'],
		            'title' => 'Events',
		            'link' => 'plugin:event/controller:event/action:index',
		            'status' => 1,
		        ));
			break;
        }
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

        // Main menu: delete Event link
        $link = $controller->Link->find('first', array(
            'conditions' => array(
                'Menu.alias' => 'main',
                'Link.link' => 'plugin:event/controller:event/action:index',
            ),
        ));
        $controller->Link->Behaviors->attach('Tree', array(
            'scope' => array(
                'Link.menu_id' => $link['Link']['menu_id'],
            ),
        ));
        if (isset($link['Link']['id'])) {
            $controller->Link->delete($link['Link']['id']);
        }

    }/**

}
?>
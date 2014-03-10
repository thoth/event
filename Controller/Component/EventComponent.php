<?php
/**
 * Event Component
 *
 * Event component for tying events into the CMS.
 *
 * @category Component
 * @package  Croogo
 * @version  1.0
 * @author   Thomas Rader <tom.rader@claritymediasolutions.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.claritymediasolutions.com/portfolio/croogo-event-plugin
 */
class EventComponent extends Component {
/**
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param object $controller Controller with components to startup
 * @return void
 */
    public function startup(Controller $controller, $settings = array()){

        //hook in the has many model

    	$controller->Node->bindModel(
        	array('hasOne'=>array('Event')),
        	false
       	);

    }
/**
 * Called after the Controller::beforeRender(), after the view class is loaded, and before the
 * Controller::render()
 *
 * @param object $controller Controller with components to beforeRender
 * @return void
 */
    public function beforeRender(Controller $controller) {
        // Admin menu: admin_menu element of Example plugin will be shown in admin panel's navigation
        Configure::write('Admin.menus.event', 1);

        if($controller->name == 'Nodes'){
        	Configure::write('Admin.rowActions.Event', 'plugin:event/controller:event/action:index/:id');
        }

        // Bind the model to Nodes

    }


}
?>
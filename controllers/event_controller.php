<?php
/**
 * Event Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Thomas Rader <thomas.rader@tigerclawtech.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.tigerclawtech.com/portfolio/croogo-event-plugin
 */
class EventController extends EventAppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
    public $name = 'Event';
    public $helpers = array(
    	'Javascript'
    );
/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
        
    public function beforeFilter(){
    	parent::beforeFilter();
    	
    	$this->Event->bindModel(
        	array('belongsTo'=>array('Node')),
        	false
       	);
       	
    }
    
    public function admin_index() {
    	$this->layout = 'admin';
        $this->set('title_for_layout', __('Event', true));
    }

    public function index() {
        $this->set('title_for_layout', __('Event', true));
        $this->set('exampleVariable', 'value here');
    }

    public function calendar(){
		$events = $this->Event->find('all', array('conditions'=>array('Node.status'=>1)));
		$json = array();
		foreach($events as $event){
				$json[] = array(
					'id'=>$event['Event']['id'],
					'title'=>$event['Node']['title'],
					'start'=>$event['Event']['start_date'],
//					'end'=>date('Y-m-d', strtotime($event['Page']['end_date'])),
					'url'=>'/'.$event['Node']['slug']
				);
		}    	
		$this->autoLayout = false;
		$this->set('json', json_encode($json));
    }
    
    public function upcoming(){
		$events = $this->Event->find('all', array('conditions'=>array('Node.status'=>1, 'Event.start_date >'=>date('Y-m-d H:i'))));
		
		$this->autoLayout = false;
		$this->autoRender = false;
		return($events);
    }
    
}
?>
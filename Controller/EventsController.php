<?php
/**
 * Event Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Thomas Rader <tom.rader@claritymediasolutions.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.claritymediasolutions.com/portfolio/croogo-event-plugin
 */
class EventsController extends EventAppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
    public $name = 'Events';
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

    public function index(){

    }

	public function hmtview($id = -1){

		$event = array();
		if(strtolower(Configure::read('Event.use_hold_my_ticket')) == 'yes'){
			$this->loadModel('Event.HoldMyTicket');
			$event = array('Event'=>get_object_vars($this->HoldMyTicket->getEvent($id)));
			$this->set("event", $event);
		}
	}

    public function calendar(){
    	Configure::write('debug', 0);
		$this->autoLayout = false;

		$events = $this->Event->find('all', array('conditions'=>array('Node.status'=>1)));
		$json = array();
		foreach($events as $event){
				$json[] = array(
					'id'=>$event['Event']['id'],
					'title'=>$event['Node']['title'],
					'start'=>$event['Event']['start_date'],
					'end'=>$event['Event']['end_date'],
					'url'=>'/'.$event['Node']['type'].'/'.$event['Node']['slug']
				);
		}

		if(strtolower(Configure::read('Event.use_hold_my_ticket')) == 'yes'){
			$this->loadModel('Event.HoldMyTicket');
			$events = $this->HoldMyTicket->getEvents();
			//Configure::write('debug', 2);

			if(!empty($events)){
				foreach($events as $event) {

					$allday = (strtotime($event->end) - strtotime($event->start) > 86400);
					if($allday) {
						$end = $event->start;
					} else {
						$end = $event->end;
					}
					$json[] = array(
							'id' => $event->id,
							'title'=>$event->title,
							'start'=>$event->start,
							'end' => $end,
							'allDay' => $allday,
							'url' => '/events/hmtview/'.$event->id,
							'details' => $event->description
					);
				}
			} else {
				$data = array();
			}
		}

		$this->set('json', json_encode($json));
    }

    public function upcoming(){
		$events = $this->Event->find('all', array('conditions'=>array('Node.status'=>1, 'Event.start_date >'=>date('Y-m-d H:i'))));

		$this->autoLayout = false;
		$this->autoRender = false;
		return($events);
    }

}
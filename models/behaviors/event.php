<?php
/**
 * Event Behavior
 *
 * PHP version 5
 *
 * @category Behavior
 * @package  Croogo
 * @version  1.0
 * @author   Thomas Rader <thomas.rader@tigerclawtech.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.tigerclawtech.com/portfolio/croogo-event-plugin
 */
class EventBehavior extends ModelBehavior {

        /**
         * Nodeattachment model
         *
         * @var object
         */
        private $Event = null;

        /**
         * Setup
         *
         * @param object $model
         * @param array  $config
         * @return void
         */
        public function setup(&$model, $config = array()) {
                if (is_string($config)) {
                        $config = array($config);
                }

                $this->settings[$model->alias] = $config;
        }

        /**
         * After find callback
         *
         * @param object $model
         * @param array $results
         * @param boolean $primary
         * @return array
         */
         public function  afterFind(&$model, $results, $primary) {
                parent::afterFind($model, $results, $primary);

                if ($model->type != 'event') {
                        if ($primary && isset($results[0][$model->alias])) {
                            foreach ($results AS $i => $result) {
                                if (isset($results[$i][$model->alias]['title'])) {
                                    $results[$i]['Event'] = $this->_getEvents($model, $result[$model->alias]['id']);
                                }
                            }
                        } elseif (isset($results[$model->alias])) {
                            if (isset($results[$model->alias]['title'])) {
                                $results['Event'] = $this->_getEvents($model, $results[$model->alias]['id']);
                            }
                        }
                }

                return $results;

        }

        /**
         * Get all attachments for node
         *
         * @param object $model
         * @param integer $nodeid
         * @return array
         */
        private function _getEvents(&$model, $node_id) {

                if (!is_object($this->Event)) {
                        $this->Event = ClassRegistry::init('Event.Event');
                }

                // bind Node model
                $this->Event->bindModel(array(
                    'belongsTo' => array('Node')
                    
                ));
                // unbind unnecessary models from Node model
                $this->Event->Node->unbindModel(array(
                    'belongsTo' => array('User'),
                    'hasMany' => array('Comment', 'Meta'),
                    'hasAndBelongsToMany' => array('Taxonomy')
                ));
                
                $this->Event->Node->recursive = 0;
                $events = $this->Event->find('first', array(
                    'conditions' => array('Event.node_id' => $node_id)
                ));
                
                if(count($events)> 0){
	                return $events['Event'];            
                } else {
                	return null;
                }
                

        }


}
?>
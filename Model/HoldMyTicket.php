<?php
class HoldMyTicket extends EventAppModel {

	var $name = 'HoldMyTicket';
	var $useTable = false;
	var $apikey = '';
	var $cacheFolder;
	
	function __construct(){
		$this->cacheFolder = TMP.'/';
		$this->apikey = Configure::read('Event.hold_my_ticket_api_key');
	}

	function getEvent($id){
		
		$calData = $this->getEventRemote(array('event'=>$id));

		return json_decode($calData);

	}

	function getEventRemote($opts){

		$params = array();
		foreach($opts as $k=>$v):
			$params[] = $k."/".urlencode($v);
		endforeach;
		$url = "http://holdmyticket.com/api/events/getInfo/api_key/".$this->apikey."/json/true/".implode('/',$params);
		$json = $this->send_request($url);
		return $json;

	}

	function getEvents($opts=array()){
		
		$calData = $this->getCacheFile('events');
		if( $calData == false ):
#			debug('getting remote file');
			$calData = $this->getEventsRemote($opts);
			$this->saveCacheFile($calData,'events');
		else:
#			debug('getting cached file');
		endif;

		return json_decode($calData);

	}

	function getEventsRemote($opts){

		$params = array();
		foreach($opts as $k=>$v):
			$params[] = $k."/".urlencode($v);
		endforeach;
		$url = "http://holdmyticket.com/api/events/getList/api_key/".$this->apikey."/json/true/exclude/happy%20hour/".implode('/',$params);
		$json = $this->send_request($url);
		return $json;

	}
	
	/* MONTH VIEW */
	
	function getMonthView($unixTime){
		$calData = $this->getCacheFile('hmt_month_'.$unixTime);
		if( $calData == false ):
			$calData = $this->getMonthRemoteFile($unixTime);
			$this->saveCacheFile($calData,'hmt_month_'.$unixTime);
		endif;
		return $calData;
	}

	private function getMonthRemoteFile($unixTime){
		
		if(empty($unixTime)): 
			$unixTime = time(); 
		endif;
		$mm = date('m',$unixTime);
		$yyyy = date('Y',$unixTime);
		$cal_url = 'http://holdmyticket.com/widgets/month/yyyy/'.$yyyy.'/mm/'.$mm.'/api_key/'.$this->apikey.'/load_event_link/true/link_format/SLASHcalendarSLASHYYYYSLASHMMSLASHDD/link_base/SLASHeventSLASH/exclude/happy%20hour';
		return $this->send_request($cal_url);
		
	}

	/* END OF MONTH VIEW */

	private function getCacheFile($filename){
		$filename = $this->cacheFolder.$filename.'.txt';
		if( !file_exists($filename) ):
			return false;
		else:
			$last_modified = filemtime($filename);
			if($last_modified < strtotime('5 minutes ago')):
				return false;
			else:
				$handle = fopen($filename, "r");
				$contents = fread($handle, filesize($filename));
				fclose($handle);
				return $contents;
			endif;
		endif;
		return false;
	}
	
	private function saveCacheFile($data,$filename){
		$filename = $this->cacheFolder.$filename.'.txt';
		touch($filename);
		$fp = fopen($filename, 'w');
		fwrite($fp, $data);
		fclose($fp);
	}
	
	function send_request($url, $xml=''){
		$session = curl_init();
		curl_setopt($session, CURLOPT_URL, $url);
		curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		$request = curl_exec($session);
		curl_close($session);
		return $request;
	}    

}
?>
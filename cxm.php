<?php

class Cxm {
  public $debug = false;
  public $version = '0.0.1';
  private $trackerName = 'cxm-php';
  private $endpoint = 'tracker.cxmap.io';
  private $appKey;
  private $uid;
  private $person = array();
  
  public function __construct($appKey, $uid) {
    $this->appKey = (string) $appKey;
    $this->uid = (string) $uid;
  }

  public function endpoint($endpoint) {
    $this->endpoint = (string) $endpoint;
  }

  public function appKey($appKey) {
    $this->appKey = (string) $appKey;
  }

  public function uid($uid) {
    $this->uid = (string) $uid;
  }

  public function debug($value) {
    $this->debug = (bool) $value;
  }

  public function setPersonInfo($person) {
    foreach ($person as $key=>$value) $this->person[$key] = $value;
    return $this->person;
  }

  public function track($eventName, $properties = [], $data = [], $context = [], $truePerformedAt = null) {
    $eventNameCamelCase = preg_replace('/_/u', '', ucwords($eventName, '_'));
    $method = "track{$eventNameCamelCase}";
    if (method_exists($this, $method)) return $this->$method($properties, $data, $context, $truePerformedAt);
    else return $this->send($eventName, $properties, $data, $context, $truePerformedAt);
  }

  private function trackPageView($properties = [], $data = [], $context = [], $truePerformedAt = null) {
    if (empty($properties['url']) || empty($properties['referrer']) || empty($properties['page_title'])) return false;
    return $this->send('page_view', $properties, $data, $context, $truePerformedAt);
  }

  private function trackWebSessionStart($properties = [], $data = [], $context = [], $truePerformedAt = null) {
    if (empty($properties['url']) || empty($properties['referrer']) || empty($properties['page_title'])) return false;
    $sessionId = ($data && $data['session_id']) || uniqid('', true);
    $data['session_id'] = $sessionId;
    $this->send('web_session_start', $properties, $data, $context, $truePerformedAt);
    return $sessionId;
  }

  private function trackUpdatePerson($person, $data = [], $context = [], $truePerformedAt = null) {
    $this->setPersonInfo($person);
    return $this->send('update_person', [], $data, $context, $truePerformedAt);
  }

  private function send($eventName, $properties, $data, $context, $truePerformedAt) {
    $data = $data ? $data : array();
    $data['app_key'] = $this->appKey;
    $data['event'] = $eventName;
    $data['tracker_sent_at'] = date(DATE_ISO8601, time());
    $data['tracker_ver'] = $this->version;
    $data['tracker_name'] = $this->trackerName;
    if ($truePerformedAt) {
      $data['true_performed_at'] = String($truePerformedAt);
    }

    // person
    $data['person'] = $this->person;
    $data['person']['uid'] = $this->uid;

    // event properties
    if (count($properties) > 0) $data['event_properties'] = json_encode($properties);

    $this->putLog($data);
    
    // context
    if ($context) $data['context'] = json_encode($context);
    $post = http_build_query($data);
    $opts = stream_context_create(array(
    'http' => array(
      'method' => 'POST',
      'header' => 'Content-Type: application/x-www-form-urlencoded',
      'content' => $post,
    )
    ));
    return file_get_contents("https://{$this->endpoint}/event", false, $opts);
  }

  private function putLog($post) {
    if (!$this->debug) return true;
    ob_start();
    print_r($post);
    $str_post = ob_get_clean();
    $date = date('Y.m.d H:i:s');
    $row = "{$date}\n{$str_post}\n";
    $filename = dirname(__FILE__) . "/debug.log";
    return file_put_contents($filename, $row, FILE_APPEND);
  }

}
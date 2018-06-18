<html>
  <head>
    <title>CxMap php tracker</title></title>
    <style type="text/css">
body {
  padding: 20px;
  margin: 0;
  font-size: 14px;
  font-family: Arial;
}
h2 {
  margin-top: 25px 0 15px 0;
}
button {
  padding: 5 20px;
  cursor: pointer;
  background-color: #eee;
  border-color: #aaa;
  color: #333;
  border-radius: 3px;
  margin: 5px 0;
  outline-style: none;
  transition: all linear 0.2s;
}
button:hover {
  background-color: #1cc2ff;
  border-color: #10a1d7;
  color: #fff;
}
button:active {
  background-color: #10a1d7;
  border-color: #10a1d7;
  color: #fff;
}
ul {
  margin: 15px 0;
  padding: 0;
}
li {
  margin: 0;
  padding: 15px 0;
  list-style: none;
  border-bottom: 1px solid #bbb;
  position: relative;
}
li:last-child {
  border-style: none;
}
pre {
  color: #777;
  font-size: 12px;
  border: 1px solid #aaa;
  background-color: #fafafa;
  display: block;
  padding: 7px;
  overflow: scroll;
}
fieldset {
  background-color: #f0f0f0;
  border-style: none;
  padding: 10px 15px;
}
a {
  color: red;
  text-decoration: underline;
  cursor: pointer;
}
.columns {
  flex: 1;
  display: flex;
  flex-direction: row;
  min-height: 100%;
  margin: 0 -10px;
}
.coll {
  width: 33.33%;
  box-sizing: border-box;
  padding: 0 10px;
  border-right: 1px solid #bbb;
}
.coll:last-child {
  border-style: none;
}
.fade {
  animation-name: anumaciyoAppear;
  animation-duration: 200ms;
  animation-iteration-count: 1;
  animation-timing-function: ease-in-out;
}
@keyframes anumaciyoAppear {                
  0% {
    opacity: 0;
    background-color: #1cc2ff;
  }
  100% {
    opacity: 1;
  }
}
    </style>
    <script type="text/javascript">
var bindScript = function(el) {
  var code = el.parentNode.querySelector('pre').innerHTML;
  if (code) window.location.search = 'eval=' + encodeURIComponent(code);
};
    </script>
  </head>
  <body>

    <h1>CxMap php tracker</h1>
    <a href="https://github.com/CXMap/cxmap-enricher/wiki/Event-Model" target="_blank">Event model</a>
    
    <div class="columns">
      <div class="coll">

        <h2>Options</h2>

        <p>
          Format: $cxm-><b>[function]</b>(<b>[mixData]</b>);
        </p>

        <ul>
          
          <li>
            Set tracker endpoint<br />
            <pre>$cxm->endpoint('tracker-stage2.cxmap.io');</pre>
          </li>
          <li>
            Set app key<br />
            <pre>$cxm->appKey('yyyyyyyyyyyyyyyyyyyyyyy');</pre>
          </li>
          <li>
            Set uid<br />
            <pre>$cxm->uid('1');</pre>
          </li>
          <li>
            Debug mode<br />
            <pre>$cxm->debug(true);</pre>
          </li>
          <li>
            Set person info<br />
            <pre>
$cxm->setPersonInfo(array(
  'first_name' => 'Kong',
  'last_name' => 'Qiu'
));</pre>
          </li>

        </ul>

      </div>
      <div class="coll">

        <h2>Events</h2>

        <p>
          Format: $cxm->track(<b>[eventName]</b>, <b>[properties]</b>, <b>[data]</b>, <b>[context]</b>, <b>[truePerformedAt]</b>);
        </p>
        
        <ul>
          
          <li>
            Session start<br />
            <pre>
$cxm->track('web_session_start', array(
  'url' => 'http://site.net/page',
  'referrer' => 'http://site.net',
  'page_title' => 'Page'
),
array(
  'session_id' => '1'
));</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Page view<br />
            <pre>$cxm->track('page_view', array(
  'url' => 'http://site.net/page',
  'referrer' => 'http://site.net',
  'page_title' => 'Page'
),
array(
  'session_id' => '1'
));</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Update person info<br />
            <pre>
$cxm->track('update_person', array(
  'first_name' => 'Vladimir',
  'last_name' => 'Savelyev'
));</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Transaction (Purchase)<br />
            <pre>
$cxm->track('transaction', array(
  'order_id' => '123',
  'total' => '100',
  'currency_iso' => 'rub',
  'items' => array(
    'sku' => 'bb1',
    'name' => 'Sandwich',
    'category_id' => '1',
    'category_name' => 'Food',
    'price' => '50',
    'qnt' => '2'
  )
),
array(
  'my_payload' => 'some data'
));</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Login<br />
            <pre>$cxm->track('login');</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Signup<br />
            <pre>$cxm->track('signup');</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Subscribe<br />
            <pre>$cxm->track('subscribe');</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Unsubscribe<br />
            <pre>$cxm->track('unsubscribe');</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Email sent<br />
            <pre>$cxm->track('email_send', array('label' => 'my_compain'));</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Email opened<br />
            <pre>$cxm->track('email_open', array('label' => 'my_compain'));</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Email clicked<br />
            <pre>$cxm->track('email_click', array('label' => 'my_compain'));</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Form submit<br />
            <pre>$cxm->track('form_submit', array('label' => 'my_form'));</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Phone call<br />
            <pre>$cxm->track('phone_call', null, null, null, '2018-04-05T12:36:00.301Z');</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Meeting<br />
            <pre>$cxm->track('meeting');</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>
          <li>
            Custom<br />
            <pre>$cxm->track('custom', array('key' => 'my_event'));</pre>
            <button onclick="bindScript(this);">Execute</button>
          </li>

        </ul>

      </div>
      <div class="coll">

        <h2>Response</h2>

        <pre id="response">
<?php
if (!empty($_GET['eval'])) {

  include_once('cxm.php');
  $appKey = '0900737d3dad0d5e';
  $uid = '1';
  $cxm = new Cxm($appKey, $uid);
  $cxm->endpoint('tracker-stage.cxmap.io');
  $cxm->track('web_session_start');

  $code = htmlspecialchars_decode(urldecode($_GET['eval']), ENT_QUOTES);
  eval($code);
  print_r($cxm->postData);

}
?>
        </pre>

      </div>
    </div>
      
  </body>
</html>
# CxMap php-tracker

With this tracker you can collect user event data (page views, e-commerce transactions etc) from the client-side tier of your websites and web apps.

## Example html code for the site

```
include_once('cxm.php');
$appKey = 'xxxxxxxxxxxxxxxxxxxx';
$uid = '1';
$cxm = new Cxm($appKey, $uid);
$cxm->track('web_session_start');

```

## Initializarion

```
include_once('cxm.php');
$appKey = 'xxxxxxxxxxxxxxxxxxxx';
$uid = '1';
$cxm = new Cxm($appKey, $uid);

```

## Options

### Set tracker url

```
$cxm->endpoint('tracker-stage2.cxmap.io');
```

### Set app key

```
$cxm->appKey('yyyyyyyyyyyyyyyyyyyyyyy');
```

### Set uid

```
$cxm->uid('1');
```

### Debug mode

```
$cxm->debug(true);
```

### Set person info

```
$cxm->setPersonInfo(array(
  'first_name' => 'Kong',
  'last_name' => 'Qiu'
));
```

## Events

### Session start

```
$cxm->track('web_session_start', array(
  'url' => 'http://site.net/page',
  'referrer' => 'http://site.net',
  'page_title' => 'Page'
),
array(
  'session_id' => '1'
));
```

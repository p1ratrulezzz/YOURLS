<?php
if (empty($_SERVER['QUERYSTRING']) && empty($_SERVER['HTTPS'])) {
  header('Location: https://'. $_SERVER['HTTP_HOST'], true, 302);
  exit;
  header('HTTP/1.0 403 Forbidden');
  echo "Forbidden 403";
  exit;
}
?>
<html>
<head>
<script type="text/javascript">

var re = function() {
  window.location.href = window.location.origin + '/ui.php';
}

var ss = Math.round(Math.random() * (3000 - 500)) + 500;
setTimeout(re, ss);
</script>
</head>
<body>
Bots are not allowed. If you are not bot, just wait and you will be redirected to right place in <script type="text/javascript">document.write(ss);</script> seconds.
</body>
</html>

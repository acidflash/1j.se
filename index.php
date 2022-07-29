<?php
function Title()
{
$hostname = getenv('HTTP_HOST');
echo $hostname;
}
?>

<html>
<head>
<title>
  <?php title() ?> - Don't Worry, Be Happy
</title>
<style>
.containerBox {
  position: relative;
  display: inline-block;
}

.text-box {
  position: absolute;
  height: 30%;
  text-align: center;
  width: 100%;
  margin: auto;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  font-size: 25px;
  color: white;
}

.img-responsive {
  display: block;
  max-width: 100%;
  height: 100%;
  margin: auto;
  padding: auto;
}

.countdown {
  position: absolute;
  color: white;
  bottom: -100px;
  left: 25%;
  }
}
</style>
</head>
<body style="background-color:black;">

<center>
<div class="containerBox">
  <img class="img-responsive" src="img/bee.jpg">
  <div class='text-box'>
    <p class="countdown" id="timer">
        <span id="timer-days"></span>
        <span id="timer-hours"></span>
        <span id="timer-mins"></span>
        <span id="timer-secs"></span>
    </p>
  </div>
</div>
<script src="script.js"></script>

Bystrom.st
</center>
</body>
</html>

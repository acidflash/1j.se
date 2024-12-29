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
    <div class="countdown">
        <div id="timer"></div>
    </div>

    <script>
        function updateCountdown() {
            const targetDate = new Date("2023-12-01T16:00:00").getTime();
            const now = new Date().getTime();
            const timeRemaining = targetDate - now;

            if (timeRemaining > 0) {
                const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                const timerElement = document.getElementById("timer");
                timerElement.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
            } else {
                document.getElementById("timer").innerHTML = "EXPIRED";
            }
        }

        // Set the timezone to Europe/Stockholm using the toLocaleString method
        const options = { timeZone: 'Europe/Stockholm' };
        document.getElementById("timer").innerText = new Date().toLocaleString("sv-SE", options);
        setInterval(updateCountdown, 1000);
    </script>


</center>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Whats my IP?</title>
<meta charset="UTF-8">
</head>

<body>
<center>
<h1>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68395221-1', 'auto');
  ga('send', 'pageview');

</script>

<?php

function ip_details($ip) {
    $json = file_get_contents("https://ipinfo.io/{$ip}");
    $details = json_decode($json);
    return $details;
}
$IP = $_SERVER['REMOTE_ADDR'];
$details = ip_details("$IP");
$test = $details->region;

?>
<?php
        echo "IP: $IP";
        echo "<br>";
        echo "Hostname: ";
        if ($details->hostname == NULL) {
        echo "Unknown";
        } else {
        echo $details->hostname;
        }
        echo "<br>";
        echo "ISP: ";
        if ($details->org == NULL) {
        echo "Unknown";
        } else {
        echo $details->org;
        }
        echo "<br>";
        echo "City: ";
        if ($details->city == NULL) {
        echo "Unknown";
        } else {
        echo $details->city;
        }
        echo "<br>";
        echo "Region: ";
        if ($test == NULL) {
        echo "Unknown";
        } else {
        echo $test;
        }
        echo "<br>";
        echo "Country: ";
        if ($details->country == NULL) {
        echo "Unknown";
        } else {
        echo $details->country;
        }
        echo "<br>";
        echo "Location:";
        if ($details->loc == NULL) {
        echo "Unknown";
        } else {
        echo $details->loc;
        }
?>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "
http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>phpb13</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="crossorigin=""/>
<!-- Make sure you put this AFTER Leaflet’s CSS -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="crossorigin=""></script>
<style type="text/css">
#map { height: 500px; }
</style>
</head>
<body>
<form action="./phpb13.php" method="POST">
name:<input type="text" name="pname" size="20">
<input type="submit" value="send!">
</form>
<?php
if (isset($_POST['pname'])){$pname=$_POST['pname'];}
if (isset($pname)){
    $dbconn = pg_connect("host=localhost dbname=s2122090 user=s2122090 password=D8sxVHV5")
    or die('Could not connect: ' . pg_last_error());
    $query="select avg(lon),avg(lat) from anime2 where name like '%" .$pname . "%';";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    $line = pg_fetch_array($result);
    $avglat=$line[0];
    $avglon=$line[1];
    $query="select id,name,pre,lon,lat from anime2 where name like '%" . $pname . "%';";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    echo "<table>\n";
    while ($line = pg_fetch_array($result)) {
        echo "<tr>\n";
        echo "<td>" . $line[1] . "(" . $line[2] .")</td>";
        echo "<td>$line[3],$line[4]</td>";
        echo "</tr>\n";
    }
    echo "</table>\n";
}
else{
echo "<p>no data.</p>";
}
?>

<div id="map"></div>
<script type="text/javascript">
    var map = L.map('map', {
    <?php
    echo "center: [$avglat, $avglon],"
        ?>
    zoom: 12,
    });
    var tileLayer = L.tileLayer('https://osm.gdl.jp/styles/osm-bright-ja/{z}/{x}/{y}.png', {
        attribution: '&copy;<a href="http://osm.org/copyright"> OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
});
tileLayer.addTo(map);
<?php
$query="select id,name,pre,lon,lat from anime where name like '%" . $pname . "%';";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
while ($line = pg_fetch_array($result)) {
echo "L.marker([$line[3], $line[4]]).addTo(map); ";
}
?>
</script>
</body>
</html>
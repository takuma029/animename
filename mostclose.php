<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>most close spot</title>
</head>

<body>
    <h1>現在地から最も近い場所を検索する</h1>
    <a href="anime.html" class="btn">トップへ</a>
    <p>↓現在地の緯度軽度が表示されます</p>
    <script type="text/javascript">
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                // 成功
                function(pos) {
                    var location = "<li>" + "緯度:" + pos.coords.latitude + "</li>";
                    location += "<li>" + "経度:" + pos.coords.longitude + "</li>";
                    document.getElementById("loc").innerHTML = location;
                    document.getElementById("lat").value = pos.coords.latitude;
                    document.getElementById("lng").value = pos.coords.longitude;
                },
                // 失敗
                function(pos) {
                    var location = "<li>位置情報が取得できませんでした。</li>";
                    document.getElementById("loc").innerHTML = location;
                });
        } else {
            window.alert("本ブラウザでは Geolocation が使えません");
        }
    </script>

    <ul id="loc"></ul>
    <form action="mostclose.php" method="POST">
        <input type="hidden" name="lat" id="lat">
        <input type="hidden" name="lng" id="lng">
        表示されたらsendボタンを押してください:<input type="submit" value="send!">
    </form>
    <h3>ここに結果が表示されます。<br>結果は上から順に近い場所を表示します</h3>
    <?php
    if (isset($_POST['lat'])) {
        $lat = $_POST['lat'];
    }
    if (isset($_POST['lng'])) {
        $lng = $_POST['lng'];
    }
    if (isset($lat) && isset($lng)) {
        $dbconn = pg_connect("host=localhost dbname=s2122090
user=s2122090 password=D8sxVHV5") or die('Could not connect: ' . pg_last_error());
        $query = "select name,pre,muni from anime2 order by location<->ST_GeomFromText('POINT(139.7863502 35.63119745)',4326) desc;";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
        echo "<table>\n";
        while ($line = pg_fetch_array($result)) {
            $point = $line[2];
            $point = str_replace('(', '', $point);
            $point = str_replace(')', '', $point);
            $outp = preg_split("/[,\s]/", $point);
            echo "\t<tr>\n";
            echo "\t\t<td>$line[0]</td>\n";
            echo "\t\t<td>$line[1]</td>\n";
            echo "\t\t<td>$line[3]</td>\n";
            echo "\t\t<td>$line[4]</td>\n";
            echo "\t\t<td><button type=\"button\" " .
                "onclick=\"location.href='http://maps.apple.com/maps?q=" .
                "$outp[1],$outp[0]'\">ナビ起動</button></td>\n";
            echo "\t</tr>\n";
        }
        echo "</table>\n";
    } else {
        echo "<p>no data.</p>";
    }
    ?>
</body>

</html>
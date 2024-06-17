<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>watch image</title>
</head>

<body>
    <h1>アップロードされた画像を閲覧する</h1>
    <a href="anime.html" class="btn">トップへ</a>
    <p>閲覧したいアニメを選択してください</p>
    <form action="./gwatch.php" method="POST">
        <?php
        $query = "select id,abb from anime2 order by id;";
        $dbconn = pg_connect("host=localhost dbname=s2122090
user=s2122090 password=D8sxVHV5")
            or die("Could not connect: " . pg_last_error());
        $result = pg_query($query) or die("Query failed: " . pg_last_error());
        echo "<select name=\"abb\">";

        while ($line = pg_fetch_array($result)) {
            echo "<option value=\"$line[1]\">$line[1]</option>";
        }
        echo "</select>";
        ?>
        <br>
        選択できたらsendボタンを押してください:<input type="submit" value="send!">
    </form>
    <h3>選択されたアニメに関する画像がここに表示されます。</h3>
    <?php
    if (isset($_POST['abb'])) {
        $abb = pg_escape_literal($dbconn, $_POST['abb']);
        // 選択されたアニメの名前を取得する
        $query = "SELECT name FROM anime2 WHERE abb = $abb;";
        $result = pg_query($query) or die("Query failed: " . pg_last_error());
        $name = pg_fetch_result($result, 0, 0);
        echo "<p>選択されたアニメ: " . $name . "</p>";
        $sql = "SELECT filename FROM gupload WHERE gupload.title = $abb ORDER BY gid DESC;";
        $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
        echo "<div style=\"display: flex; flex-wrap: wrap;\">";
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            foreach ($line as $col_value) {
                echo "<img style=\"width: 400px; margin: 10px;\" src=\"./uploads/$col_value\">";
            }
        }
        echo "</div>";
    }
    ?>
</body>

</html>
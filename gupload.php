<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>image upload</title>
</head>

<body>
    <h1>画像をアップロードする</h1>
    <a href="anime.html" class="btn">トップへ</a>
    <p>どのアニメに関連するのか選択してください</p>
    <form enctype="multipart/form-data" action="anime/gupload.php" method="post">
        <?php
        $query = "select id, abb from anime2 order by id;";
        $dbconn = pg_connect("host=localhost dbname=s2122090 user=s2122090 password=D8sxVHV5") or die("Could not connect: " . pg_last_error());
        $result = pg_query($query) or die("Query failed: " . pg_last_error());
        echo "<select name=\"abb\">";
        while ($line = pg_fetch_array($result)) {
            echo "<option value=\"$line[1]\">$line[1]</option>";
        }
        echo "</select>";
        ?>
        <br>
        <br>
        ファイルを選択してください
        <br>
        <input type="file" name="file_data">
        <br>
        <br>
        選択できたらFILE 送信を押してください:<input type="submit" name="FILE 送信" value="FILE 送信">
    </form>
    <?php
    $dbconn = pg_connect("host=localhost dbname=s2122090
user=s2122090 password=D8sxVHV5") or die('Could not connect: ' . pg_last_error());
    // アップロードファイル情報を表示する。
    if (isset($_FILES['file_data'])) {
        echo "アップロードファイル名 : ", $_FILES["file_data"]["name"], "<BR>";
        echo "MIME タイプ: ", $_FILES["file_data"]["type"], "<BR>";
        echo "ファイルサイズ: ", $_FILES["file_data"]["size"], "<BR>";
        echo "テンポラリファイル名: ", $_FILES["file_data"]["tmp_name"], "<BR>";
        echo "エラーコード: ", $_FILES["file_data"]["error"], "<BR>";
        $nfn = time() . "_" . getmypid() . "." .
            pathinfo($_FILES["file_data"]["name"], PATHINFO_EXTENSION);
        // アップロードファイルを格納するファイルパスを指定,uploads フォルダの場合。
        //同フォルダは 777 にすること
        $filename = "./uploads/" . $nfn;
        if ($_FILES["file_data"]["size"] === 0) {
            echo "ファイルはアップロードされてません! " .
                "アップロードファイルを指定してください。";
        } else {
            // アップロードファイルされたテンポラリファイルをファイル格納パスにコピーする
            $result = @move_uploaded_file(
                $_FILES["file_data"]["tmp_name"],
                $filename
            );
            if ($result === true) {
                echo "アップロード成功 (" . $title . ")!!";
                $title = $_POST['abb'];
                $sql = "insert into gupload (title,filename) values('" . $title .
                    "','" . $nfn . "');";
                $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
            } else {
                echo "アップロード失敗!!";
            }
        }
    }

    ?>
</body>

</html>
<?php

include_once("./tools.php");

$url = "https://script.google.com/macros/s/" . GAS_DB_ID . "/exec?range=all";
$argary = [];
// URLエンコードされたクエリ文字列を生成する
$query_string = http_build_query($argary);

// HTTP設定
$options = array(
  'http' => array(
    'method' => 'GET',
    'header' => 'Content-type: application/x-www-form-urlencoded',
    'content' => $query_string,
    'ignore_errors' => true,
    'protocol_version' => '1.1'
  ),
  'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false
  )
);
$contents = json_decode(@file_get_contents($url, false, stream_context_create($options)));

// レスポンスステータス
$statusCode = http_response_code();
if ($statusCode === 200) {
  // 200 success
} elseif (preg_match("/^4\d\d/", $statusCode)) {
  // 4xx Client Error
  $contents = false;
} elseif (preg_match('/^5\d\d/', $statusCode)) {
  // 5xx Server Error
  $contents = false;
} else {
  $contents = false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Comlit14</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css" integrity="sha384-GvrOXuhMATgEsSwCs4smul74iXGOixntILdUW9XmUC6+HX0sLNAK3q71HotJqlAn" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./js/highlight/styles/github-dark-dimmed.min.css" />
  <link rel="stylesheet" href="./css/toppage.css">
</head>
<body>
  
  <?php insertHeader() ?>

  <main>
    <section class="main-header">
      <div class="header-phrase-parent">
        <div class="header-phrase">
          <p class="override">CROP</p>
          <p class="override">YOURSELF</p>
          <p><span class="br">コンピュータ</span><span class="br">リテラシ</span><span class="br">第14回</span><span class="br">総合課題</span></p>
        </div>
        <div class="header-button-parent">
          <a class="header-button override" href="#articles">
            <span>
              記事を見る
            </span>
          </a>
        </div>
      </div>
    </section>
    <section class="container">
      <h2 id="articles">最近の記事</h2>
      <?php foreach ($contents as $content) : ?>
        <a class="card" href="./article/?id=<?php echo $content[0] ?>">
          <h4 class=" card-title">
            <?php echo $content[2] ?>
          </h4>
          <p class="card-text">
            <?php echo $content[1] ?>
            <?php echo $content[4] ?>
          </p>
        </a>

      <?php endforeach; ?>
    </section>
  </main>
  
  <?php insertFooter() ?>
</body>
</html>
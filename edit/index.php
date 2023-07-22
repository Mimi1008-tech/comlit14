<?php
include_once("../tools.php");
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>記事編集</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css" integrity="sha384-GvrOXuhMATgEsSwCs4smul74iXGOixntILdUW9XmUC6+HX0sLNAK3q71HotJqlAn" crossorigin="anonymous" />

  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../js/highlight/styles/github-dark-dimmed.min.css" />
  <link rel="stylesheet" href="../css/edit.css" />
</head>

<body>
  <?php insertHeader() ?>

  <main>
    <div id="mdeditor">
      <input type="text" name="user" id="user" placeholder="記事の作成者の名前" />
      <input type="text" name="title" id="title" placeholder="記事のタイトル" />
      <div id="edit">
        <textarea id="editor" placeholder="記事を書く"></textarea>
      </div>
      <div id="preview" class=""></div>
      <input type="hidden" class="" id="article" name="article" />
      <div id="submitbtn">
        <button type="submit" class="btn btn-primary ml-1" onclick="submit();">この記事を投稿</button>
      </div>
    </div>
  </main>

  <?php insertFooter() ?>

  <script src="../js/highlight/highlight.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/marked/lib/marked.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/marked-katex-extension/lib/index.umd.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="../js/edit.js"></script>

  <script>
    function submit() {
      localStorage.clear();

      if ($("#user").val() === '' || $("#title").val() === '' || $("#article").val() === '') {
        alert("データを入力してください");
        return;
      }

      const data = {
        'user': $("#user").val(),
        'title': $("#title").val(),
        'article': $("#article").val(),
      };


      const url = "https://script.google.com/macros/s/<?php echo GAS_DB_ID ?>/exec"

      const postparam = {
        "method": "POST",
        "mode": "no-cors",
        "Content-Type": "application/json",
        "body": JSON.stringify(data)
      };

      fetch(url, postparam).then((response) => {
        location.href = '../';
      });
      return;
    }
  </script>


</body>

</html>
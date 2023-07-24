<?php

include_once("../tools.php");

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>このページについて</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css" integrity="sha384-GvrOXuhMATgEsSwCs4smul74iXGOixntILdUW9XmUC6+HX0sLNAK3q71HotJqlAn" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../js/highlight/styles/github-dark-dimmed.min.css" />
</head>

<body>

  <?php insertHeader() ?>

  <div class="container">
    <div class="alert alert-primary">記事の作成者 : 塩入 君道</div>

    <h2 id="このページについて">このページについて</h2>
    <p>
      このページは電気通信大学のコンピュータリテラシーの総合課題#14で作成した。このページを作成するまでの流れについて紹介する。
    </p>
    <h2 id="テーマ・グループメンバーについて">テーマ・グループメンバーについて</h2>
    <h5 id="グループで決定したテーマ">グループで決定したテーマ</h5>
    <p>
      グループメンバーの思考（主に技術系）をまとめたブログをテーマとしてページの作成を進めた。
    </p>
    <h5 id="グループメンバー">グループメンバー</h5>
    <ul>
      <li>
        <p>2311008 東 翔生</p>
      </li>
      <li>
        <p>2311024 伊藤 啓太</p>
      </li>
      <li>
        <p>2311108 塩入 君道</p>
      </li>
    </ul>
    <p>
      伊藤と東がHTMLで記事を作成し、塩入がCSSでデザインを作成した。 また、Google App
      Script と Spread Sheet
      でのデータベースは塩入が作成し、マークダウンからHTMLに変換するところは伊藤が、トップページのデザイン、及びデプロイ先の管理は東が行った。
    </p>
    <h2 id="ソース管理について">ソース管理について</h2>
    <p>ソース管理にはGithubを使用した。リポジトリのリンクは以下の通りである。</p>
    <p>
      <a href="https://github.com/Mimi1008-tech/comlit14">https://github.com/Mimi1008-tech/comlit14</a>
    </p>
    <h2 id="グループでの作業">グループでの作業</h2>
    <h5 id="コンセプトの決定">コンセプトの決定</h5>
    <p>
      3人とも同じサークルの同じチームのメンバーであるので、そこで開発に使った技術についてのサイトを作成すると決定した。
      そこで、技術系の記事をまとめたブログ形式のサイトを作ったら良いのではという意見が出たため、グループメンバーの思考（主に技術系）をまとめたブログを作成することにした。
    </p>
    <p>
      QiitaやZennのような既存のサービスのように、開発している人たちを対象にしたサイトとすることとした。
    </p>
    <p>
      また、PCやタブレットのような画面幅の広い端末だけでなく、スマートフォン等の幅が狭い端末での閲覧も対象とするため、レスポンシブデザインを採用することを決定した。
    </p>
    <h5 id="デザインの決定">デザインの決定</h5>
    <p>
      先に述べたように、様々な端末に対応するため、レスポンシブデザインを採用した。
    </p>
    <p>
      また、異なるOS間での表示が同じになるように、かつ、読みやすくするため、今回はGoogle
      FontsのNoto Sans JPを使用した。
    </p>
    <p>
      更に、文章の階層構造がわかりやすいように、また、コードを記載する必要があるため、シンタックスハイライトを適応したコードブロックを使用するため、演習12回で作成したCSSフレームワークを更にアップデートして使用することに決定した。
    </p>
    <h5 id="設計">設計</h5>
    <p>
      HTMLで記事を書くことはもちろんであるが、あまり書きにくいわけではないため、マークダウンで記事を執筆し、JavascriptのライブラリでHTMLと変換し、Google
      Spread Sheet と Google App Script
      を使用したデータベースに保存し、指定したIDで記事を表示することも可能とした。
    </p>
    <p>ディレクトリ階層は、以下に示す通りである。</p>
    <img src="https://raw.githubusercontent.com/Mimi1008-tech/comlit14/61b635f747c1e7fa104d53713289a657cb1cefce/struct.svg" />
  </div>

  <?php insertFooter() ?>

  <script src="../js/highlight/highlight.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/marked/lib/marked.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/marked-katex-extension/lib/index.umd.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script>
    hljs.highlightAll();
  </script>
</body>

</html>
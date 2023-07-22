<?php

$config['csrf_protection'] = FALSE;


if ($_GET["user"] == null || $_GET["article"] == null) {
    // header("Location: ../");
    exit();
}

$user = $_GET["user"];
$article = $_GET["article"];

// register data

// database name
$dbname = "test.sqlite3";

// open database
$db = new SQLite3('../db/' . $dbname);

// table existing check
$db->exec('CREATE TABLE IF NOT EXISTS articletbl(id INTEGER PRIMARY KEY AUTOINCREMENT, user TEXT, article TEXT, register DATETIME);');

// count now num
$stmt = $db->prepare('SELECT COUNT(*) AS num FROM articletbl;');
$res = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
$db->close();

$db = new SQLite3('../db/' . $dbname);

$num = $res['num'] + 1;

// register
$stmt = $db->prepare('INSERT INTO articletbl VALUES(NULL, :user, :article, :register);');
$stmt->bindValue(':user', $user, SQLITE3_TEXT);
$stmt->bindValue(':article', $article, SQLITE3_TEXT);
$stmt->bindValue(':register', date("Y/m/d H:i:s"), SQLITE3_TEXT);
$stmt->execute();

// close database
$db->close();

header("Location: ../article/?id=" . $num);

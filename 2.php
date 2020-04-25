<?php

require_once("./db_connector.php");

try {
$reader = new DBConnector('db_param.ini');
}
catch (Exception $ex)
{
  echo "Can not connect to database";
  exit();
}
$rows = $reader->getArticles("SELECT * FROM articles WHERE article SIMILAR TO :expression",
['expression' => '%http://asozd.duma.gov.ru/main.nsf/\\(Spravka\\)\\?OpenAgent&RN=%']);
echo count($rows) . " articles need to replace links<br>";
if (empty($rows))
{
  echo "Articles list is empty";
  exit();
}
foreach ($rows as $record)
{
  $newArticle = preg_replace("#http://asozd\\.duma\\.gov\\.ru/main\\.nsf/\\(Spravka\\)\\?OpenAgent&RN=([[:digit:]-]+)&(\d+)#",
  "http://sozd.parlament.gov.ru/bill/$1", $record['article']);
  if ($reader->storeArticle($record['id'], $newArticle) === 1)
    echo $record['id'] . " - article saved<br>";
}

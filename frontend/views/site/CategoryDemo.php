<?php


require_once('../sdk/Category.php');

/**
 * このプログラムのパスを取得
 */
$self_path = $_SERVER['SCRIPT_NAME'];

/**
 * いくつかの記号をHTMLの表現形式に変換する関数の定義
 */
function convert($str) {
    return htmlspecialchars($str, ENT_QUOTES);
}

/**
 * カテゴリIDを取得
 */
$categoryId = 0;
if (array_key_exists('category', $_GET)) {
    $categoryId = (int) $_GET['category'];
}

/**
 * カテゴリ情報APIのクラスオブジェクトを生成します。
 * 第１引数にアプリケーションID(appid)
 * 第２引数にAPIのバージョン(例：Version 2 ⇒　V2)
 * を指定してください。
 */
$obj = new Category('dj0zaiZpPWZsYXZjUzQwSURZNyZzPWNvbnN1bWVyc2VjcmV0Jng9OWM-', 'V2');

/**
 * カテゴリIDをセットします。
 */
$obj->setOption('category', $categoryId);

/**
 * Yahoo!オークションWeb APIにリクエストを投げ、
 * カテゴリ情報を取得します。
 */
$result = $obj->action();
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>オークションデモサイト - オークションカテゴリ情報</title>
</head>
<body>
<font color=purple><h3>オークションデモサイト - オークションカテゴリ情報</h3></font>

<?php if (is_object($result)) { ?>
<b><small><?php echo convert($result->Result->CategoryPath); ?></small></b>
<br /><br />
<table bgcolor="#fffacd" cellpadding="4" cellspacing="0" width="600" border="0">
<tr><td>
<font color="brown"><b>&nbsp;&nbsp;カテゴリ名&nbsp:<?php echo convert($result->Result->CategoryName); ?></b></font>

<?php if ($result->Result->ChildCategoryNum > 0) { ?>
&nbsp;&nbsp;(子カテゴリの数:<?php echo convert($result->Result->ChildCategoryNum); ?>)
<?php } else { ?>
&nbsp;&nbsp;(子カテゴリの数:0)
<?php } ?>

</td></tr>
<tr></tr><tr></tr>
<tr><td>
<table cellpadding="2" cellspacing="3" border="0" width="100%">
<?php if ($result->Result->IsLeaf == 'false') { ?>
<tr bgcolor="#ffffff" nowrap><td><small><b>&nbsp;カテゴリ名&nbsp;(オークション数)</b></small></td></tr>
<?php foreach ($result->Result->ChildCategory as $child) { ?>
<tr bgcolor="#ffffff" nowrap>
<td><small><b><a href="./CategoryDemo.php?category=<?php echo convert($child->CategoryId); ?>">
<?php echo convert($child->CategoryName); ?>
<?php if ($child->IsLink == 'true') { ?>@</a></b>
<?php } else { ?></a>&nbsp;(<?php echo convert($child->NumOfAuctions); ?>)</b>
<?php } ?>
</small></td>
</tr>
<?php } ?>
<?php } else { ?>
<tr bgcolor="#ffffff"><td><small><b>&nbsp;このカテゴリの子カテゴリはありません。</b></small></td></tr>
<?php } ?>
</table>
</td></tr>
</table>
<?php } ?>

<!-- Begin Yahoo! JAPAN Web Services Attribution Snippet -->
<a href="http://developer.yahoo.co.jp/about">
<img src="http://i.yimg.jp/images/yjdn/yjdn_attbtn2_105_17.gif" width="105" height="17" title="Webサービス by Yahoo! JAPAN" alt="Webサービス by Yahoo! JAPAN" border="0" style="margin:15px 15px 15px 15px" /></a>
<!-- End Yahoo! JAPAN Web Services Attribution Snippet -->
</body>
</html>

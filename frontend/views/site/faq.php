<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>
<script src="http://i.yimg.jp/images/yjdn/js/bakusoku-jsonp-v1-min.js"
  data-url="http://auctions.yahooapis.jp/AuctionWebService/V2/json/search"
  data-p-appid="dj0zaiZpPWZsYXZjUzQwSURZNyZzPWNvbnN1bWVyc2VjcmV0Jng9OWM-"
  data-p-query="ec5a"
>
{{#ResultSet.Result.Item}}
  <a href="{{AuctionItemUrl}}"><img src="{{Image}}" alt="{{Title}}" title="{{Title}}"></a>
{{/ResultSet.Result.Item}}
</script>

<?php
/**
 * ルビ振りAPIへのリクエストサンプル（POST）
 *
 */
$api = 'http://jlp.yahooapis.jp/FuriganaService/V1/furigana';
$appid = 'dj0zaiZpPWZsYXZjUzQwSURZNyZzPWNvbnN1bWVyc2VjcmV0Jng9OWM-';
$params = array(
    'sentence' => 'ec5a'
);
 
$ch = curl_init($api);
curl_setopt_array($ch, array(
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERAGENT      => "Yahoo AppID: $appid",
    CURLOPT_POSTFIELDS     => http_build_query($params),
));
 
$result = curl_exec($ch);
curl_close($ch);
?>
<pre>
<?php echo htmlspecialchars(
             print_r(new SimpleXMLElement($result), true)
           ) ?>
</pre>

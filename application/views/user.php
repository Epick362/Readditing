<h1><?=$username?></h1>
<hr />
<? foreach($listing as $item) { ?>
	<pre><?print_r($item)?></pre>
<? } ?>
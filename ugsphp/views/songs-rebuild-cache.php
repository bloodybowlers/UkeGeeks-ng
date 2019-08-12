<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php echo Lang::Get('cache_rebuilt');?> | <?php echo Config::SongbookHeadline?></title>
	<meta http-equiv="refresh" content="4;URL=<?php echo($model->SongbooktUri) ?>" />
	<link rel="stylesheet" href="<?php echo($model->StaticsPrefix); ?>css/ugsphp.css" />
</head>
<body class="songListPage">
	<section class="contentWrap">
   <h1><?php echo Config::SongbookHeadline?></h1>
    <div class="msgBorder">
      <h2 style='margin-bottom:10px'><?php echo Lang::Get('cache_rebuilt');?></h2>
      <h3><?php printf(Lang::Get('cache_rebuilt_info'), $model->ElapsedTime, $model->SongCount);?></h3>
      <p><?php printf(Lang::Get('cache_rebuilt_redirect'), '<a href="'.$model->SongbooktUri.'">', '</a>');?></p>
    </div>
	</section>
</body>
</html>

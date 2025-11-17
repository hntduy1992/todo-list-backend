<?php

/* @var $this yii\web\View */

use helpers\ViteAssetHelper;

$this->title = 'Todo List SPA';
// Vô hiệu hóa Layout và các Assets mặc định của Yii2 để Vue kiểm soát toàn bộ trang
$this->context->layout = false;

// Lấy đường dẫn CSS và JS đã được hash
$cssPath = ViteAssetHelper::getAssetPath('index.html', 'css');
$jsPath = ViteAssetHelper::getAssetPath('index.html', 'js');

?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->title ?></title>
    <?php if ($cssPath): ?>
        <link rel="stylesheet" href="<?= $cssPath ?>">
    <?php endif; ?>
</head>
<body>

<div id="app"></div>

<?php if ($jsPath): ?>
    <script type="module" src="<?= $jsPath ?>"></script>
<?php endif; ?>

</body>
</html>
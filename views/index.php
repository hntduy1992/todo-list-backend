<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\ViteAssetBundle;

use yii\bootstrap5\Html;

ViteAssetBundle::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

// 💡 Dữ liệu TÙY CHỈNH được truyền từ PHP sang JS
// Đối tượng này sẽ khả dụng toàn cục trong ứng dụng Vue của bạn (window.YII_VUE_CONFIG)
$configData = [
    'csrfToken' => Yii::$app->request->csrfToken,
    'apiBaseUrl' => '/api', // Ví dụ: Base URL cho tất cả các endpoint API
    // Thêm bất kỳ dữ liệu nào khác bạn cần (ví dụ: trạng thái người dùng ban đầu)
    // 'initialUserStatus' => 'guest',
];

// Mã hóa PHP array thành JSON string an toàn
$configJson = Json::encode($configData);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>
<div id="app">
    <!-- Loader hoặc nội dung fallback có thể ở đây -->
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

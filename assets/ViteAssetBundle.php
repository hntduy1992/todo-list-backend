<?php

namespace app\assets;

use helpers\ViteAssetHelper;
use yii\web\AssetBundle;

class ViteAssetBundle extends AssetBundle
{
    // Cài đặt cơ sở (Không cần base path vì chúng ta dùng URL tuyệt đối)
    public $sourcePath = null;
    public $baseUrl = null;

    // Đảm bảo được tải SAU YiiAsset và AppAsset
    public $depends = [
        'yii\web\YiiAsset',
    ];

    public function init()
    {
        parent::init();

        // Tên entry point JS mà bạn đã cấu hình trong Vue/Vite
        $jsEntry = 'src/main.js';
        // Tên entry point JS mà bạn đã cấu hình trong Vue/Vite
        $cssEntry = 'src/style.css';
        // 1. Đăng ký JS (dùng Helper)
        $this->js[] = ViteAssetHelper::getAssetPath($jsEntry);

        // 2. Đăng ký CSS (dùng Helper)
        $cssUrl = ViteAssetHelper::getAssetPath($cssEntry, 'css');
        if ($cssUrl) {
            $this->css[] = $cssUrl;
        }
    }

    /**
     * Đăng ký tệp JS với thuộc tính 'type="module"' bắt buộc của Vite
     */
    public function registerAssetFiles($view)
    {
        parent::registerAssetFiles($view);

        // Ghi đè để đảm bảo script được thêm type="module"
        foreach ($this->js as $js) {
            $view->registerJsFile($js, ['depends' => $this->depends, 'type' => 'module']);
        }
    }
}
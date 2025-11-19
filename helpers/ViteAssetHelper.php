<?php

namespace helpers;

use Yii;
use yii\helpers\Json;

class ViteAssetHelper
{
    private static $manifest = null;
    // Đường dẫn tuyệt đối đến tệp manifest.json
    const MANIFEST_PATH = '@webroot/dist/.vite/manifest.json';

    private static function getManifest(){
        if (self::$manifest === null) {
            $manifestFile = Yii::getAlias(self::MANIFEST_PATH);
            if (!file_exists($manifestFile)) {
                // Trong môi trường phát triển, có thể tệp này chưa được tạo.
                // Trả về mảng rỗng hoặc xử lý lỗi tùy ý.
                return [];
            }
            self::$manifest = Json::decode(file_get_contents($manifestFile));
        }
        return self::$manifest;
    }

    /**
     * Lấy đường dẫn của asset đã được hash
     * @param string $entry Tên entry point (ví dụ: 'index.html' hoặc 'src/main.js')
     * @param string $type Loại asset cần lấy ('js' hoặc 'css')
     * @return string|null Đường dẫn tương đối
     */
    public static function getAssetPath($entry, $type = 'js')
    {
        $manifest = self::getManifest();

        // Tên entry point của Vite thường là tên file JS/TS gốc, ví dụ: 'src/main.js'
        // Tuy nhiên, nếu dùng index.html làm entry point trong manifest, chúng ta sẽ dùng 'index.html'
        // Hãy kiểm tra tệp manifest thực tế của bạn
        $key = 'index.html'; // Tên entry point trong manifest file

        if (!isset($manifest[$key])) {
            Yii::warning("Vite manifest key '{$key}' not found.");
            return null;
        }

        $entryData = $manifest[$key];

        if ($type === 'js') {
            return '/dist/' . ($entryData['file'] ?? null);
        }

        if ($type === 'css' && !empty($entryData['css'][0])) {
            return '/dist/' . $entryData['css'][0];
        }

        return null;
    }
}
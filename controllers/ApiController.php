<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\filters\Cors;
use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        // 💡 Thêm hành vi CORS và Authentication vào đây
        // ...
// 💡 1. Thêm CorsFilter (Cho phép mọi Origin)
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
            ],
        ];
        // 💡 2. Thêm AccessControl (Để Lọc theo IP)
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    // Tên action (áp dụng cho tất cả action trong Controller này)
                    'actions' => ['index', 'view', 'create', 'update', 'delete'],
                    'allow' => false, // Quy tắc này để TỪ CHỐI
                    // Danh sách các IP bạn muốn cấm (chức năng phát triển sau)
                    'ips' => [
//                        '192.168.1.10', // Ví dụ: IP của máy chủ hoặc client cụ thể
                    ],
                ],
                // Sau đó là quy tắc cho phép tất cả các IP khác (đã được Auth)
                [
                    'allow' => true,
                    // Cho phép các request đã được xác thực Token (sau khi AuthFilter chạy)
                    'roles' => ['@'],
                ],
            ],
        ];

        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\HttpBearerAuth::class,
        ];
        return $behaviors;
    }
}
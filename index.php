<?php

// Nạp cấu hình chung của ứng dụng
$config = require __DIR__ . '/config/config.php';

// Nạp các file chứa hàm trợ giúp
require_once __DIR__ . '/src/helpers/helpers.php'; // Helper chứa các hàm trợ giúp (hàm xử lý view, block, asset, session, ...)
require_once __DIR__ . '/src/helpers/database.php'; // Helper kết nối database(kết nối với cơ sở dữ liệu)

// Nạp các file chứa model
require_once __DIR__ . '/src/models/User.php';

// Nạp các file chứa controller
require_once __DIR__ . '/src/controllers/HomeController.php';
require_once __DIR__ . '/src/controllers/AuthController.php';
require_once __DIR__ . '/src/controllers/AdminController.php';
require_once __DIR__ . '/src/controllers/GuideController.php';

// Khởi tạo các controller
$homeController = new HomeController();
$authController = new AuthController();
$adminController = new AdminController();
$guideController = new GuideController();

// Xác định route dựa trên tham số act (mặc định là trang chủ '/')
$act = $_GET['act'] ?? '/';

// Match đảm bảo chỉ một action tương ứng được gọi
match ($act) {
    // Trang welcome (cho người chưa đăng nhập) - mặc định khi truy cập '/'
    '/', 'welcome' => $homeController->welcome(),

    // Trang home (cho người đã đăng nhập)
    'home' => $homeController->home(),

    // Đường dẫn đăng nhập, đăng xuất
    'login' => $authController->login(),
    'check-login' => $authController->checkLogin(),
    'logout' => $authController->logout(),

    // Admin
    'admin/revenue' => $adminController->revenue(),
    'admin/customers' => $adminController->customers(),
    'admin/tours' => $adminController->tours(),
    'admin/tours/add' => $adminController->addTour(),
    'admin/tours/edit' => $adminController->editTour(),
    'admin/tours/view' => $adminController->viewTour(),

    // Hướng dẫn viên
    'guide/schedule' => $guideController->schedule(),
    'guide/customers' => $guideController->customers(),
    'guide/diary' => $guideController->diary(),
    'guide/checkin' => $guideController->checkin(),
    'guide/requirements' => $guideController->requirements(),

    // Đường dẫn không tồn tại
    default => $homeController->notFound(),
};

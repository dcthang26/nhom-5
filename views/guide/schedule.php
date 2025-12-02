<?php
ob_start();
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tour được phân công</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tour</th>
                                <th>Thời gian</th>
                                <th>Địa điểm</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tour Hạ Long 3N2Đ</td>
                                <td>15/01/2024 - 17/01/2024</td>
                                <td>Quảng Ninh</td>
                                <td><span class="badge bg-primary">Sắp diễn ra</span></td>
                                <td><button class="btn btn-info btn-sm">Xem chi tiết</button></td>
                            </tr>
                            <tr>
                                <td>Tour Sapa 2N1Đ</td>
                                <td>20/01/2024 - 21/01/2024</td>
                                <td>Lào Cai</td>
                                <td><span class="badge bg-warning">Đã phân công</span></td>
                                <td><button class="btn btn-info btn-sm">Xem chi tiết</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chi tiết lịch trình - Tour Hạ Long 3N2Đ</h3>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="time-label">
                        <span class="bg-primary">Ngày 1 - 15/01/2024</span>
                    </div>
                    <div>
                        <div class="timeline-item">
                            <span class="time">07:00</span>
                            <h3 class="timeline-header">Tập trung tại Hà Nội</h3>
                            <div class="timeline-body">
                                Đón khách tại điểm hẹn, kiểm tra danh sách, phát đồ dùng cá nhân
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="timeline-item">
                            <span class="time">12:00</span>
                            <h3 class="timeline-header">Đến Hạ Long</h3>
                            <div class="timeline-body">
                                Check-in khách sạn, ăn trưa, nghỉ ngơi
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="timeline-item">
                            <span class="time">14:00</span>
                            <h3 class="timeline-header">Du thuyền vịnh Hạ Long</h3>
                            <div class="timeline-body">
                                Tham quan vịnh, chụp ảnh, thưởng thức cảnh đẹp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nhiệm vụ của tôi</h3>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="bi bi-shield-check text-success"></i>
                        Hướng dẫn an toàn
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-geo-alt text-primary"></i>
                        Giới thiệu địa điểm
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-people text-info"></i>
                        Hỗ trợ khách hàng
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-journal-text text-warning"></i>
                        Ghi nhật ký tour
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Lịch trình Tour',
    'pageTitle' => $pageTitle ?? 'Lịch trình Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Lịch trình Tour', 'url' => BASE_URL . 'guide/schedule', 'active' => true],
    ],
]);
?>
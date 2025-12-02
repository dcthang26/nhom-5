<?php
ob_start();
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Điểm danh khách hàng</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Văn An</td>
                            <td><span class="badge bg-success">Đã có mặt</span></td>
                            <td><button class="btn btn-success btn-sm" disabled>Đã check-in</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Trần Thị Bình</td>
                            <td><span class="badge bg-warning">Chưa có mặt</span></td>
                            <td><button class="btn btn-primary btn-sm">Check-in</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Điểm danh',
    'pageTitle' => $pageTitle ?? 'Điểm danh',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Điểm danh', 'url' => BASE_URL . 'guide/checkin', 'active' => true],
    ],
]);
?>
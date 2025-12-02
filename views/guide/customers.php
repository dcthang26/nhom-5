<?php
ob_start();
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách khách trong đoàn</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Nhóm</th>
                                <th>Ghi chú đặc biệt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Nguyễn Văn An</td>
                                <td>0123456789</td>
                                <td>Gia đình A</td>
                                <td><span class="badge bg-warning">Ăn chay</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Trần Thị Bình</td>
                                <td>0987654321</td>
                                <td>Gia đình A</td>
                                <td><span class="badge bg-danger">Dị ứng hải sản</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Lê Minh Cường</td>
                                <td>0345678901</td>
                                <td>Nhóm bạn B</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Khách trong đoàn',
    'pageTitle' => $pageTitle ?? 'Khách trong đoàn',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Khách trong đoàn', 'url' => BASE_URL . 'guide/customers', 'active' => true],
    ],
]);
?>
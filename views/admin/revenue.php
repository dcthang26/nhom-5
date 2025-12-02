<?php
ob_start();
?>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>500M</h3>
                <p>Tổng Doanh thu</p>
            </div>
            <div class="icon">
                <i class="bi bi-currency-dollar"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>350M</h3>
                <p>Tổng Chi phí</p>
            </div>
            <div class="icon">
                <i class="bi bi-cash-stack"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>150M</h3>
                <p>Lợi nhuận</p>
            </div>
            <div class="icon">
                <i class="bi bi-graph-up"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>30%</h3>
                <p>Tỷ lệ lợi nhuận</p>
            </div>
            <div class="icon">
                <i class="bi bi-percent"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Báo cáo theo Tour</h3>
                <div class="card-tools">
                    <select class="form-select form-select-sm">
                        <option>Tháng này</option>
                        <option>Quý này</option>
                        <option>Năm này</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tên Tour</th>
                                <th>Doanh thu</th>
                                <th>Chi phí</th>
                                <th>Lợi nhuận</th>
                                <th>Tỷ lệ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tour Hạ Long 3N2Đ</td>
                                <td class="text-success">200,000,000 VNĐ</td>
                                <td class="text-danger">140,000,000 VNĐ</td>
                                <td class="text-primary">60,000,000 VNĐ</td>
                                <td><span class="badge bg-success">30%</span></td>
                            </tr>
                            <tr>
                                <td>Tour Sapa 2N1Đ</td>
                                <td class="text-success">150,000,000 VNĐ</td>
                                <td class="text-danger">100,000,000 VNĐ</td>
                                <td class="text-primary">50,000,000 VNĐ</td>
                                <td><span class="badge bg-success">33%</span></td>
                            </tr>
                            <tr>
                                <td>Tour Đà Nẵng 4N3Đ</td>
                                <td class="text-success">150,000,000 VNĐ</td>
                                <td class="text-danger">110,000,000 VNĐ</td>
                                <td class="text-primary">40,000,000 VNĐ</td>
                                <td><span class="badge bg-warning">27%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">So sánh theo thời gian</h3>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" width="400" height="200"></canvas>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Top Tour hiệu quả</h3>
            </div>
            <div class="card-body">
                <div class="progress-group">
                    Tour Sapa 2N1Đ
                    <span class="float-end"><b>33%</b></span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 33%"></div>
                    </div>
                </div>
                <div class="progress-group">
                    Tour Hạ Long 3N2Đ
                    <span class="float-end"><b>30%</b></span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 30%"></div>
                    </div>
                </div>
                <div class="progress-group">
                    Tour Đà Nẵng 4N3Đ
                    <span class="float-end"><b>27%</b></span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 27%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tăng trưởng theo tháng</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Thời gian</th>
                                <th>Doanh thu</th>
                                <th>Lợi nhuận</th>
                                <th>Tăng trưởng</th>
                                <th>Xu hướng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tháng 1/2024</td>
                                <td>120,000,000 VNĐ</td>
                                <td>36,000,000 VNĐ</td>
                                <td class="text-success">+15%</td>
                                <td><i class="bi bi-arrow-up text-success"></i></td>
                            </tr>
                            <tr>
                                <td>Tháng 2/2024</td>
                                <td>180,000,000 VNĐ</td>
                                <td>54,000,000 VNĐ</td>
                                <td class="text-success">+50%</td>
                                <td><i class="bi bi-arrow-up text-success"></i></td>
                            </tr>
                            <tr>
                                <td>Tháng 3/2024</td>
                                <td>200,000,000 VNĐ</td>
                                <td>60,000,000 VNĐ</td>
                                <td class="text-success">+11%</td>
                                <td><i class="bi bi-arrow-up text-success"></i></td>
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
    'title' => $title ?? 'Báo cáo Doanh thu',
    'pageTitle' => $pageTitle ?? 'Báo cáo Doanh thu Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Báo cáo Doanh thu', 'url' => BASE_URL . 'admin/revenue', 'active' => true],
    ],
]);
?>
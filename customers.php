<?php 
ob_start();
?>


<div class="row mb-3">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6>Tổng khách</h6>
                <h3><?= count($customers) ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6>Đã check-in</h6>
                <h3><?= count(array_filter($customers, fn($c) => $c['check_in_status'])) ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h6>Yêu cầu đặc biệt</h6>
                <h3><?= count(array_filter($customers, fn($c) => !empty($c['special_requirements']))) ?></h3>
            </div>
        </div>
    </div>
    <div class="co-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h6>Đã phân phòng</h6>
                <h3><?= count(array_filter($customers, fn($c) => !empty($c['room_number']))) ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách khách trong đoàn</h3>
    </div>
    <div class="card-body"></div>
</div>
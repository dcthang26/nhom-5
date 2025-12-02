<?php
ob_start();
?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thêm nhật ký mới</h3>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Thời gian</label>
                        <input type="datetime-local" class="form-control" name="time" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hoạt động</label>
                        <input type="text" class="form-control" name="activity" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ghi chú</label>
                        <textarea class="form-control" name="note" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu nhật ký</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nhật ký đã ghi</h3>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <span class="time">15/01 - 07:30</span>
                        <h3 class="timeline-header">Tập trung Hà Nội</h3>
                        <div class="timeline-body">Đoàn tập trung đúng giờ</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Nhật ký Tour',
    'pageTitle' => $pageTitle ?? 'Nhật ký Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Nhật ký Tour', 'url' => BASE_URL . 'guide/diary', 'active' => true],
    ],
]);
?>
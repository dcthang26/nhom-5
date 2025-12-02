<?php
// Xử lý thêm yêu cầu mới
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customer'])) {
    $customer = $_POST['customer'];
    $type = $_POST['type'];
    $detail = $_POST['detail'];
    
    // Lưu vào session (thực tế sẽ lưu vào database)
    startSession();
    if (!isset($_SESSION['requirements'])) {
        $_SESSION['requirements'] = [];
    }
    $_SESSION['requirements'][] = [
        'customer' => $customer,
        'type' => $type,
        'detail' => $detail,
        'status' => 'Đang chuẩn bị',
        'time' => date('Y-m-d H:i:s')
    ];
    
    // Chuyển hướng để tránh gửi lại form
    header('Location: ' . BASE_URL . '?act=guide/requirements');
    exit;
}

// Xử lý xóa yêu cầu
if (isset($_GET['delete'])) {
    $index = (int)$_GET['delete'];
    startSession();
    if (isset($_SESSION['requirements'][$index])) {
        unset($_SESSION['requirements'][$index]);
        $_SESSION['requirements'] = array_values($_SESSION['requirements']); // Re-index array
    }
    header('Location: ' . BASE_URL . '?act=guide/requirements');
    exit;
}

// Lấy danh sách yêu cầu từ session
startSession();
$requirements = $_SESSION['requirements'] ?? [];

ob_start();
?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thêm yêu cầu mới</h3>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Khách hàng</label>
                        <select class="form-control" name="customer" required>
                            <option value="">Chọn khách hàng</option>
                            <option>Nguyễn Văn An</option>
                            <option>Trần Thị Bình</option>
                            <option>Lê Minh Cường</option>
                            <option>Phạm Thị Dung</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loại yêu cầu</label>
                        <select class="form-control" name="type" required>
                            <option value="">Chọn loại</option>
                            <option>Ăn uống</option>
                            <option>Y tế</option>
                            <option>Hỗ trợ</option>
                            <option>Khác</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Chi tiết yêu cầu</label>
                        <textarea class="form-control" name="detail" rows="3" required placeholder="Mô tả chi tiết yêu cầu..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Thêm yêu cầu
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Yêu cầu hiện có (<?= count($requirements) ?>)</h3>
            </div>
            <div class="card-body">
                <?php if (empty($requirements)): ?>
                    <p class="text-muted">Chưa có yêu cầu nào.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Khách hàng</th>
                                    <th>Loại</th>
                                    <th>Chi tiết</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($requirements as $index => $req): ?>
                                <tr>
                                    <td><?= htmlspecialchars($req['customer']) ?></td>
                                    <td><span class="badge bg-info"><?= htmlspecialchars($req['type']) ?></span></td>
                                    <td><?= htmlspecialchars($req['detail']) ?></td>
                                    <td><span class="badge bg-warning"><?= htmlspecialchars($req['status']) ?></span></td>
                                    <td>
                                        <a href="?act=guide/requirements&delete=<?= $index ?>" 
                                           class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Bạn có chắc muốn xóa yêu cầu này?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Checklist chuẩn bị</h3>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check1">
                                <label class="form-check-label" for="check1">
                                    Chuẩn bị suất ăn chay
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check2">
                                <label class="form-check-label" for="check2">
                                    Kiểm tra thuốc dị ứng
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check3">
                                <label class="form-check-label" for="check3">
                                    Thông báo nhà hàng
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check4">
                                <label class="form-check-label" for="check4">
                                    Chuẩn bị thiết bị hỗ trợ
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check5">
                                <label class="form-check-label" for="check5">
                                    Chuẩn bị thuốc cơ bản
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-success" onclick="updateChecklist()">
                            <i class="bi bi-check-all"></i> Cập nhật checklist
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function updateChecklist() {
    alert('Checklist đã được cập nhật!');
}
</script>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Yêu cầu đặc biệt',
    'pageTitle' => $pageTitle ?? 'Yêu cầu đặc biệt',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Yêu cầu đặc biệt', 'url' => BASE_URL . 'guide/requirements', 'active' => true],
    ],
]);
?>
<?php
if (!isset($_GET['id'])) {
    header('Location: ' . BASE_URL . '?act=admin/tours');
    exit;
}

$tourId = $_GET['id'];
startSession();
$tours = $_SESSION['admin_tours'] ?? [];
$tour = null;
$tourIndex = null;

foreach ($tours as $index => $t) {
    if ($t['id'] == $tourId) {
        $tour = $t;
        $tourIndex = $index;
        break;
    }
}

if (!$tour) {
    header('Location: ' . BASE_URL . '?act=admin/tours');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_tour'])) {
    $_SESSION['admin_tours'][$tourIndex] = [
        'id' => $tour['id'],
        'name' => $_POST['name'],
        'destination' => $_POST['destination'],
        'duration' => $_POST['duration'],
        'price' => $_POST['price'],
        'status' => $_POST['status'] === 'active' ? 'Hoạt động' : 'Tạm dừng'
    ];
    
    header('Location: ' . BASE_URL . '?act=admin/tours');
    exit;
}

ob_start();
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Chỉnh sửa Tour: <?= htmlspecialchars($tour['name']) ?></h3>
      </div>
      <form method="post">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="tourName" class="form-label">Tên Tour *</label>
                <input type="text" class="form-control" id="tourName" name="name" value="<?= htmlspecialchars($tour['name']) ?>" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="destination" class="form-label">Điểm đến *</label>
                <input type="text" class="form-control" id="destination" name="destination" value="<?= htmlspecialchars($tour['destination']) ?>" required>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="duration" class="form-label">Thời gian</label>
                <input type="text" class="form-control" id="duration" name="duration" value="<?= htmlspecialchars($tour['duration']) ?>" placeholder="VD: 3 ngày 2 đêm">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="price" class="form-label">Giá Tour (VNĐ) *</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= $tour['price'] ?>" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-select" id="status" name="status">
                  <option value="active" <?= $tour['status'] === 'Hoạt động' ? 'selected' : '' ?>>Hoạt động</option>
                  <option value="inactive" <?= $tour['status'] === 'Tạm dừng' ? 'selected' : '' ?>>Tạm dừng</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        
        <div class="card-footer">
          <button type="submit" name="update_tour" class="btn btn-primary">
            <i class="bi bi-check"></i> Cập nhật Tour
          </button>
          <a href="<?= BASE_URL ?>?act=admin/tours" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Chỉnh sửa Tour',
    'pageTitle' => $pageTitle ?? 'Chỉnh sửa Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . '?act=admin/tours'],
        ['label' => 'Chỉnh sửa Tour', 'url' => BASE_URL . '?act=admin/tours/edit&id=' . $tour['id'], 'active' => true],
    ],
]);
?>
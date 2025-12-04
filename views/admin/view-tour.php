<?php
if (!isset($_GET['id'])) {
    header('Location: ' . BASE_URL . '?act=admin/tours');
    exit;
}

$tourId = $_GET['id'];
startSession();
$tours = $_SESSION['admin_tours'] ?? [];
$tour = null;

foreach ($tours as $t) {
    if ($t['id'] == $tourId) {
        $tour = $t;
        break;
    }
}

if (!$tour) {
    header('Location: ' . BASE_URL . '?act=admin/tours');
    exit;
}

ob_start();
?>

<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><?= htmlspecialchars($tour['name']) ?></h3>
        <div class="card-tools">
          <span class="badge <?= $tour['status'] === 'Hoạt động' ? 'bg-success' : 'bg-warning' ?> fs-6">
            <?= $tour['status'] ?>
          </span>
        </div>
      </div>
      <div class="card-body">
        <div class="row mb-4">
          <div class="col-md-6">
            <img src="<?= asset('images/tours/' . ($tour['image'] ?? 'default.jpg')) ?>" 
                 class="img-fluid rounded" 
                 alt="<?= htmlspecialchars($tour['name']) ?>"
                 style="width: 100%; height: 250px; object-fit: cover;">
          </div>
          <div class="col-md-6">
            <table class="table table-borderless">
              <tr>
                <td><strong>Điểm đến:</strong></td>
                <td><?= htmlspecialchars($tour['destination']) ?></td>
              </tr>
              <tr>
                <td><strong>Thời gian:</strong></td>
                <td><?= htmlspecialchars($tour['duration']) ?></td>
              </tr>
              <tr>
                <td><strong>Giá tour:</strong></td>
                <td class="text-danger fs-5"><strong><?= number_format($tour['price']) ?> VNĐ</strong></td>
              </tr>
              <tr>
                <td><strong>Mã tour:</strong></td>
                <td>#<?= $tour['id'] ?></td>
              </tr>
            </table>
          </div>
        </div>

        <div class="mb-4">
          <h5><i class="bi bi-info-circle text-primary"></i> Mô tả Tour</h5>
          <p class="text-muted"><?= nl2br(htmlspecialchars($tour['description'] ?? 'Chưa có mô tả')) ?></p>
        </div>

        <div class="mb-4">
          <h5><i class="bi bi-calendar-check text-success"></i> Lịch trình</h5>
          <div class="bg-light p-3 rounded">
            <?= nl2br(htmlspecialchars($tour['itinerary'] ?? 'Chưa có lịch trình chi tiết')) ?>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <h5><i class="bi bi-check-circle text-success"></i> Bao gồm</h5>
            <div class="bg-success bg-opacity-10 p-3 rounded">
              <?= nl2br(htmlspecialchars($tour['includes'] ?? 'Chưa có thông tin')) ?>
            </div>
          </div>
          <div class="col-md-6">
            <h5><i class="bi bi-x-circle text-danger"></i> Không bao gồm</h5>
            <div class="bg-danger bg-opacity-10 p-3 rounded">
              <?= nl2br(htmlspecialchars($tour['excludes'] ?? 'Chưa có thông tin')) ?>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <a href="<?= BASE_URL ?>?act=admin/tours/edit&id=<?= $tour['id'] ?>" class="btn btn-warning">
          <i class="bi bi-pencil"></i> Chỉnh sửa
        </a>
        <a href="<?= BASE_URL ?>?act=admin/tours" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Quay lại danh sách
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Thông tin nhanh</h5>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
          <span>Trạng thái:</span>
          <span class="badge <?= $tour['status'] === 'Hoạt động' ? 'bg-success' : 'bg-warning' ?>">
            <?= $tour['status'] ?>
          </span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>Mã tour:</span>
          <span class="fw-bold">#<?= $tour['id'] ?></span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>Thời gian:</span>
          <span><?= htmlspecialchars($tour['duration']) ?></span>
        </div>
        <hr>
        <div class="text-center">
          <div class="fs-4 text-danger fw-bold"><?= number_format($tour['price']) ?> VNĐ</div>
          <small class="text-muted">Giá cho 1 khách</small>
        </div>
      </div>
    </div>

    <div class="card mt-3">
      <div class="card-header">
        <h5 class="card-title">Thao tác</h5>
      </div>
      <div class="card-body">
        <div class="d-grid gap-2">
          <a href="<?= BASE_URL ?>?act=admin/tours/edit&id=<?= $tour['id'] ?>" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Chỉnh sửa tour
          </a>
          <button class="btn btn-danger" onclick="deleteTour(<?= $tour['id'] ?>)">
            <i class="bi bi-trash"></i> Xóa tour
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function deleteTour(id) {
  if (confirm('Bạn có chắc muốn xóa tour này?')) {
    window.location.href = '<?= BASE_URL ?>?act=admin/tours&delete=' + id;
  }
}
</script>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Chi tiết Tour',
    'pageTitle' => $pageTitle ?? 'Chi tiết Tour: ' . $tour['name'],
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . '?act=admin/tours'],
        ['label' => 'Chi tiết Tour', 'url' => BASE_URL . '?act=admin/tours/view&id=' . $tour['id'], 'active' => true],
    ],
]);
?>
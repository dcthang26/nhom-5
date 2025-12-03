<?php
if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    startSession();
    if (isset($_SESSION['admin_tours'][$index])) {
        unset($_SESSION['admin_tours'][$index]);
        $_SESSION['admin_tours'] = array_values($_SESSION['admin_tours']);
    }
    header('Location: ' . BASE_URL . '?act=admin/tours');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_tour'])) {
    $index = $_POST['tour_index'];
    startSession();
    if (isset($_SESSION['admin_tours'][$index])) {
        $_SESSION['admin_tours'][$index] = [
            'id' => $_SESSION['admin_tours'][$index]['id'],
            'name' => $_POST['name'],
            'destination' => $_POST['destination'],
            'duration' => $_POST['duration'],
            'price' => $_POST['price'],
            'status' => $_POST['status']
        ];
    }
    header('Location: ' . BASE_URL . '?act=admin/tours');
    exit;
}

startSession();
if (!isset($_SESSION['admin_tours'])) {
    $_SESSION['admin_tours'] = [
        ['id' => 1, 'name' => 'Tour Hạ Long 3N2Đ', 'destination' => 'Hạ Long, Quảng Ninh', 'duration' => '3 ngày 2 đêm', 'price' => '2500000', 'status' => 'Hoạt động'],
        ['id' => 2, 'name' => 'Tour Sapa 4N3Đ', 'destination' => 'Sapa, Lào Cai', 'duration' => '4 ngày 3 đêm', 'price' => '3200000', 'status' => 'Hoạt động'],
        ['id' => 3, 'name' => 'Tour Phú Quốc 5N4Đ', 'destination' => 'Phú Quốc, Kiên Giang', 'duration' => '5 ngày 4 đêm', 'price' => '4800000', 'status' => 'Tạm dừng'],
        ['id' => 4, 'name' => 'Tour Đà Nẵng 3N2Đ', 'destination' => 'Đà Nẵng, Hội An', 'duration' => '3 ngày 2 đêm', 'price' => '2800000', 'status' => 'Hoạt động'],
    ];
}
$tours = $_SESSION['admin_tours'];

ob_start();
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Danh sách Tour (<?= count($tours) ?>)</h3>
        <div class="card-tools">
          <a href="<?= BASE_URL ?>?act=admin/tours/add" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Thêm Tour mới
          </a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên Tour</th>
              <th>Điểm đến</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tours as $index => $tour): ?>
              <tr>
                <td><?= $tour['id'] ?></td>
                <td><?= $tour['name'] ?></td>
                <td><?= $tour['destination'] ?></td>
                <td>
                  <button class="btn btn-info btn-sm" onclick="viewTour(<?= $index ?>)">
                    <i class="bi bi-eye"></i>
                  </button>
                  <button class="btn btn-warning btn-sm" onclick="editTour(<?= $index ?>)">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn btn-danger btn-sm" onclick="deleteTour(<?= $index ?>)">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="viewTourModal" tabindex="-1">
<div class="modal fade" id="viewTourModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Chi tiết Tour</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <p><strong>Tên Tour:</strong> <span id="viewTourName"></span></p>
            <p><strong>Điểm đến:</strong> <span id="viewTourDestination"></span></p>
            <p><strong>Thời gian:</strong> <span id="viewTourDuration"></span></p>
          </div>
          <div class="col-md-6">
            <p><strong>Giá tour:</strong> <span id="viewTourPrice"></span> VNĐ</p>
            <p><strong>Trạng thái:</strong> <span id="viewTourStatus" class="badge"></span></p>
            <p><strong>ID Tour:</strong> <span id="viewTourId"></span></p>
          </div>
        </div>
        <hr>
        <div class="alert alert-info">
          <i class="bi bi-info-circle"></i>
          Đây là thông tin cơ bản của tour. Để chỉnh sửa, vui lòng sử dụng nút "Sửa".
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editTourModal" tabindex="-1">
<div class="modal fade" id="editTourModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Chỉnh sửa Tour</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="post" id="editTourForm">
        <div class="modal-body">
          <input type="hidden" name="tour_index" id="editTourIndex">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Tên Tour *</label>
                <input type="text" class="form-control" name="name" id="editTourName" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Điểm đến *</label>
                <input type="text" class="form-control" name="destination" id="editTourDestination" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label class="form-label">Thời gian</label>
                <input type="text" class="form-control" name="duration" id="editTourDuration">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label class="form-label">Giá (VNĐ) *</label>
                <input type="number" class="form-control" name="price" id="editTourPrice" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select class="form-select" name="status" id="editTourStatus">
                  <option value="Hoạt động">Hoạt động</option>
                  <option value="Tạm dừng">Tạm dừng</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" name="update_tour" class="btn btn-primary">Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function viewTour(index) {
  const tours = <?= json_encode($tours) ?>;
  const tour = tours[index];
  
  document.getElementById('viewTourName').textContent = tour.name;
  document.getElementById('viewTourDestination').textContent = tour.destination;
  document.getElementById('viewTourDuration').textContent = tour.duration;
  document.getElementById('viewTourPrice').textContent = new Intl.NumberFormat('vi-VN').format(tour.price);
  document.getElementById('viewTourId').textContent = tour.id;
  
  const statusBadge = document.getElementById('viewTourStatus');
  statusBadge.textContent = tour.status;
  statusBadge.className = 'badge ' + (tour.status === 'Hoạt động' ? 'bg-success' : 'bg-warning');
  
  new bootstrap.Modal(document.getElementById('viewTourModal')).show();
}

function editTour(index) {
  const tours = <?= json_encode($tours) ?>;
  const tour = tours[index];
  
  document.getElementById('editTourIndex').value = index;
  document.getElementById('editTourName').value = tour.name;
  document.getElementById('editTourDestination').value = tour.destination;
  document.getElementById('editTourDuration').value = tour.duration;
  document.getElementById('editTourPrice').value = tour.price;
  document.getElementById('editTourStatus').value = tour.status;
  
  new bootstrap.Modal(document.getElementById('editTourModal')).show();
}

function deleteTour(index) {
  if (confirm('Bạn có chắc muốn xóa tour này?')) {
    window.location.href = '?act=admin/tours&delete=' + index;
  }
}
</script>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Danh sách Tour',
    'pageTitle' => $pageTitle ?? 'Quản lý Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . '?act=admin/tours', 'active' => true],
    ],
]);
?>
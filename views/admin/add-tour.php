<?php
ob_start();
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Thông tin Tour</h3>
      </div>
      <form id="tourForm">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="tourName" class="form-label">Tên Tour *</label>
                <input type="text" class="form-control" id="tourName" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="destination" class="form-label">Điểm đến *</label>
                <input type="text" class="form-control" id="destination" required>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="duration" class="form-label">Thời gian</label>
                <input type="text" class="form-control" id="duration" placeholder="VD: 3 ngày 2 đêm">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="price" class="form-label">Giá Tour (VNĐ) *</label>
                <input type="number" class="form-control" id="price" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="maxGuests" class="form-label">Số khách tối đa</label>
                <input type="number" class="form-control" id="maxGuests" value="20">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="startDate" class="form-label">Ngày khởi hành</label>
                <input type="date" class="form-control" id="startDate">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-select" id="status">
                  <option value="active">Hoạt động</option>
                  <option value="inactive">Tạm dừng</option>
                </select>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Mô tả Tour</label>
            <textarea class="form-control" id="description" rows="4" placeholder="Mô tả chi tiết về tour..."></textarea>
          </div>

          <div class="mb-3">
            <label for="itinerary" class="form-label">Lịch trình</label>
            <textarea class="form-control" id="itinerary" rows="6" placeholder="Ngày 1: ...&#10;Ngày 2: ..."></textarea>
          </div>

          <div class="mb-3">
            <label for="includes" class="form-label">Bao gồm</label>
            <textarea class="form-control" id="includes" rows="3" placeholder="- Vé máy bay khứ hồi&#10;- Khách sạn 4 sao&#10;- Ăn uống theo chương trình"></textarea>
          </div>

          <div class="mb-3">
            <label for="excludes" class="form-label">Không bao gồm</label>
            <textarea class="form-control" id="excludes" rows="3" placeholder="- Chi phí cá nhân&#10;- Bảo hiểm du lịch&#10;- Tip hướng dẫn viên"></textarea>
          </div>
        </div>
        
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-check"></i> Lưu Tour
          </button>
          <a href="<?= BASE_URL ?>?act=admin/tours" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById('tourForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  const tourName = document.getElementById('tourName').value;
  const destination = document.getElementById('destination').value;
  const price = document.getElementById('price').value;
  
  if (!tourName || !destination || !price) {
    alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
    return;
  }
  
  alert('Đã lưu tour: ' + tourName);
  window.location.href = '<?= BASE_URL ?>?act=admin/tours';
});
</script>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Thêm Tour mới',
    'pageTitle' => $pageTitle ?? 'Thêm Tour mới',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . '?act=admin/tours'],
        ['label' => 'Thêm Tour mới', 'url' => BASE_URL . '?act=admin/tours/add', 'active' => true],
    ],
]);
?>
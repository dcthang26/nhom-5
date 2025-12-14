<?php
ob_start();
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Thêm khách hàng mới</h3>
      </div>
      <form method="post">
        <div class="card-body">
          <?php if (isset($booking)): ?>
            <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
            <div class="alert alert-info">
              <strong>Tour:</strong> <?= htmlspecialchars($booking['tour_name']) ?> - 
              <strong>Ngày:</strong> <?= date('d/m/Y', strtotime($booking['start_date'])) ?>
            </div>
          <?php else: ?>
            <div class="mb-3">
              <label>Chọn Booking (tùy chọn)</label>
              <select class="form-select" name="booking_id">
                <option value="">-- Không gắn với booking --</option>
                <?php foreach ($bookings as $b): ?>
                  <option value="<?= $b['id'] ?>">
                    #<?= $b['id'] ?> - <?= htmlspecialchars($b['tour_name']) ?> - <?= date('d/m/Y', strtotime($b['start_date'])) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          <?php endif; ?>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Họ tên <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="name" required>
            </div>
            <div class="col-md-3 mb-3">
              <label>Giới tính</label>
              <select class="form-select" name="gender">
                <option value="">Chọn</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
              </select>
            </div>
            <div class="col-md-3 mb-3">
              <label>Năm sinh</label>
              <input type="number" class="form-control" name="birth_year" min="1900" max="2024">
        <h3 class="card-title">Tạo Booking mới</h3>
      </div>
      <form method="post">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Tên khách hàng <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="customer_name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="customer_phone" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="customer_email">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Loại booking <span class="text-danger">*</span></label>
                <select class="form-select" name="booking_type" required>
                  <option value="">-- Chọn loại --</option>
                  <option value="Khách lẻ">Khách lẻ (1-2 người)</option>
                  <option value="Đoàn">Đoàn (Nhiều người/Công ty)</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            
            <div class="col-md-6 mb-3">
              <label>CMND/CCCD</label>
              <input type="text" class="form-control" name="id_number">
            </div>
            <div class="col-md-6 mb-3">
              <label>Điện thoại</label>
              <input type="text" class="form-control" name="phone">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Email</label>
              <input type="email" class="form-control" name="email">
            </div>
            <div class="col-md-6 mb-3">
              <label>Thanh toán</label>
              <select class="form-select" name="payment_status">
                <option value="Chưa thanh toán">Chưa thanh toán</option>
                <option value="Đã cọc">Đã cọc</option>
                <option value="Hoàn tất">Hoàn tất</option>
              </select>

            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Tour <span class="text-danger">*</span></label>
                <select class="form-select" name="tour_id" required>
                  <option value="">-- Chọn tour --</option>
                  <?php foreach ($tours as $t): ?>
                    <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?> - <?= number_format($t['price']) ?> VNĐ</option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Hướng dẫn viên</label>
                <select class="form-select" name="assigned_guide_id">
                  <option value="">-- Chọn HDV --</option>
                  <?php foreach ($guides as $g): ?>
                    <option value="<?= $g['user_id'] ?>"><?= htmlspecialchars($g['name']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label class="form-label">Số người <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="num_people" min="1" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label class="form-label">Ngày khởi hành <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="start_date" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label class="form-label">Ngày kết thúc</label>
                <input type="date" class="form-control" name="end_date">
              </div>
            </div>
          </div>

          <div class="mb-3">

            <label>Địa chỉ</label>
            <input type="text" class="form-control" name="address">
          </div>

          <div class="mb-3">
            <label>Yêu cầu cá nhân</label>
            <textarea class="form-control" name="special_requirements" rows="3" placeholder="Ví dụ: Ăn chay, dị ứng, cần hỗ trợ đặc biệt..."></textarea>

            <label class="form-label">Yêu cầu đặc biệt</label>
            <textarea class="form-control" name="special_requirements" rows="3" placeholder="Ví dụ: Ăn chay, phòng riêng, xe riêng..."></textarea>

          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">

            <i class="bi bi-check-circle"></i> Thêm khách
          </button>
          <a href="<?= BASE_URL ?><?= isset($booking) ? 'admin/bookings/customers?booking_id=' . $booking['id'] : 'admin/customers' ?>" class="btn btn-secondary">

            <i class="bi bi-check-circle"></i> Tạo Booking
          </button>
          <a href="<?= BASE_URL ?>admin/bookings" class="btn btn-secondary">

            <i class="bi bi-x-circle"></i> Hủy
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [

    'title' => 'Thêm khách hàng',
    'pageTitle' => 'Thêm khách hàng mới',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Booking', 'url' => BASE_URL . 'admin/bookings', 'active' => false],
        ['label' => 'Thêm khách', 'url' => '', 'active' => true],

    'title' => 'Thêm Booking',
    'pageTitle' => 'Tạo Booking mới',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Booking', 'url' => BASE_URL . 'admin/bookings', 'active' => false],
        ['label' => 'Thêm mới', 'url' => '', 'active' => true],
    ],
]);
?>

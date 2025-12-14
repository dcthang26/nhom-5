<?php 
ob_start();
?>

<div class="row mb-3">
  <div class="col-md-4">
    <div class="card bg-info text-white">
      <div class="card-body text-center">
        <h6>Tổng Khách</h6>
        <h3><?= count($customers) ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card bg-warning text-white">
      <div class="card-body text-center">
        <h6> Có yêu cầu đặc biệt</h6>
        <h3><?= count(array_filter($customers, fn($c) => !empty($c['special_requirements']))) ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card bg-success text-white">
      <div class="card-body text-center">
        <h6>Không Yêu Cầu</h6>
        <h3><?= count(array_filter($customers, fn($c) => empty($c['special_requirements']))) ?></h3>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Yêu Cầu đặc biệt của khách</h3>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>STT</th>
          <th>Họ Tên</th>
          <th>Liên Hệ</th>
          <th>Tour</th>
          <th>Yêu Cầu Đặc Biệt</th>
          <th>Thao Tác</th>
        </tr>
      </thead>
      <tbody>
        <?php if(empty($customers)): ?>
          <tr>
            <td colspan="6" class="text-center text-muted"> Chưa có khách</td>
          </tr>
          <?php else: ?>
            <?php foreach($customers as $index => $c): ?>
              <tr>
                <td><?=  $index + 1 ?></td>
                <td>
                  <strong><?=  htmlspecialchars($c['name']) ?></strong><br>
                  <small class="text-muted">
                    <?php if ($c['gender']): ?>
                      <?= $c['gender'] ?>
                      <?php endif; ?>
                      <?php if ($c['birth_year']): ?>
                      <?= $c['birth_year'] ?>
                      <?php endif; ?>
                  </small>
                </td>
                <td>
                  <?php if ($c['phone']): ?>
                    <i class=" bi bi-telephone"></i> <?=  htmlspecialchars($c['phone']) ?><br>
                    <?php endif; ?>
                    <?php if ($c['email']): ?>
                    <small><i class=" bi bi-envelope"></i> <?=  htmlspecialchars($c['email']) ?></small>
                    <?php endif; ?>
                </td>
                <td>
                  <?=  htmlspecialchars($c['tour_name'] ?? 'N/A') ?><br>
                  <?php if ($c['start_date']): ?>
                    <small class="text-muted"><?=  date('d/m/Y', strtotime(($c['start_date']))) ?></small>
                    <?php endif; ?>
                </td>
                <td>
                  <?php if (!empty($c['special_requirements'])): ?>
                    <span class="badge bg-warning text-dark mb-1">
                      <i class=" bi bi-exclamation-triangle"></i> Có yêu cầu
                    </span><br>
                    <small><?=  htmlspecialchars($c['special_requirements']) ?></small>
                    <?php else: ?>
                      <span class="badge bg-success">Không Có</span>
                      <?php endif; ?>
                </td>
                <td class="text-center">
                  <button class="btn btn-sm btn-primary" data-bstoggle="modal" data-bs-target="#editmodal<?=  $c['id'] ?>">
                    <i class="bi bi-pencil"></i> Cập Nhật
                  </button>
                </td>
              </tr>
              <div class="modal fade" id="editmodal<?=  $c['id'] ?>" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form method="post" action="<?= BASE_URL ?>guide/update-requirement">
                      <div class="modal-header">
                        <h5 class="modal-title">Cập Nhật Yêu Cầu - <?=  htmlspecialchars($c['name']) ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="customer_id" value="<?= $c['id'] ?>">
                        <div class="mb-3">
                          <label> Yêu Cầu Đặc Biệt </label>
                          <textarea class="form-control" name="special_requirements" rows="4"><?= htmlspecialchars($c['special_requirements'] ?? '') ?></textarea>
                          <small class="text-muted"> Ví dụ: ăn chay, dị ứng, bệnh lý...</small>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
              <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php 
$content = ob_get_clean();
view('layouts.GuideLayout', [
  'title' => 'Yêu Cầu Đặc Biệt Khách',
  'content' => $content
]);
 ?>
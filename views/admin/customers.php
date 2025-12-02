<?php
// Xử lý thêm khách hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_customer'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    startSession();
    if (!isset($_SESSION['admin_customers'])) {
        $_SESSION['admin_customers'] = [];
    }
    $_SESSION['admin_customers'][] = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'status' => 'Hoạt động'
    ];
    
    header('Location: ' . BASE_URL . '?act=admin/customers');
    exit;
}

// Lấy danh sách khách hàng
startSession();
if (!isset($_SESSION['admin_customers'])) {
    $_SESSION['admin_customers'] = [
        ['name' => 'Nguyễn Văn An', 'email' => 'customer1@gmail.com', 'phone' => '0123456789', 'address' => 'Hà Nội', 'status' => 'Hoạt động'],
        ['name' => 'Trần Thị Bình', 'email' => 'customer2@gmail.com', 'phone' => '0987654321', 'address' => 'TP.HCM', 'status' => 'Hoạt động'],
        ['name' => 'Lê Minh Cường', 'email' => 'customer3@gmail.com', 'phone' => '0345678901', 'address' => 'Đà Nẵng', 'status' => 'Hoạt động'],
    ];
}
$customers = $_SESSION['admin_customers'];

ob_start();
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách Khách hàng (<?= count($customers) ?>)</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                        <i class="bi bi-plus"></i> Thêm Khách hàng
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="customersTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customers as $index => $customer): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($customer['name']) ?></td>
                                <td><?= htmlspecialchars($customer['email']) ?></td>
                                <td><?= $customer['phone'] ?></td>
                                <td><?= htmlspecialchars($customer['address']) ?></td>
                                <td><span class="badge bg-success"><?= $customer['status'] ?></span></td>
                                <td>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteCustomer(<?= $index ?>)">
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
</div>

<!-- Modal thêm khách hàng -->
<div class="modal fade" id="addCustomerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm Khách hàng mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tên khách hàng <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <textarea class="form-control" name="address" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" name="add_customer" class="btn btn-primary">Thêm khách hàng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function deleteCustomer(index) {
    if (confirm('Bạn có chắc muốn xóa khách hàng này?')) {
        window.location.href = '?act=admin/customers&delete=' + index;
    }
}
</script>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Quản lý Khách hàng',
    'pageTitle' => $pageTitle ?? 'Quản lý Khách hàng',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Khách hàng', 'url' => BASE_URL . 'admin/customers', 'active' => true],
    ],
]);
?>
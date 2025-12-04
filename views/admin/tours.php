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
        [
            'id' => 1, 
            'name' => 'Tour Hạ Long 3N2Đ', 
            'destination' => 'Hạ Long, Quảng Ninh', 
            'duration' => '3 ngày 2 đêm', 
            'price' => '2500000', 
            'status' => 'Hoạt động',
            'description' => 'Khám phá vẻ đẹp thiên nhiên kỳ vĩ của Vịnh Hạ Long với hàng nghìn hòn đảo lớn nhỏ.',
            'itinerary' => 'Ngày 1: Đón khách - Tham quan Động Thiên Cung\nNgày 2: Du thuyền trên vịnh - Tham quan Làng chèo\nNgày 3: Tham quan chợ Đồng Xuân - Trở về',
            'includes' => '- Vé tàu khứ hồi\n- Khách sạn 3 sao\n- Ăn 3 bữa/ngày\n- Hướng dẫn viên',
            'excludes' => '- Chi phí cá nhân\n- Bảo hiểm du lịch\n- Tip hướng dẫn viên',
            'image' => 'halong.jpg'
        ],
        [
            'id' => 2, 
            'name' => 'Tour Sapa 4N3Đ', 
            'destination' => 'Sapa, Lào Cai', 
            'duration' => '4 ngày 3 đêm', 
            'price' => '3200000', 
            'status' => 'Hoạt động',
            'description' => 'Trải nghiệm vùng núi Tây Bắc hùng vĩ với ruộng bậc thang và văn hóa dân tộc.',
            'itinerary' => 'Ngày 1: Hà Nội - Sapa\nNgày 2: Trekking Cat Cat - Ta Van\nNgày 3: Chinh phục đỉnh Fansipan\nNgày 4: Tham quan chợ Sapa - Trở về',
            'includes' => '- Vé tàu giường nằm\n- Homestay + Khách sạn\n- Ăn theo chương trình\n- Vé cáp treo Fansipan',
            'excludes' => '- Ăn uống ngoài chương trình\n- Giặt ủi\n- Đồ dùng cá nhân',
            'image' => 'sapa.jpg'
        ],
        [
            'id' => 3, 
            'name' => 'Tour Phú Quốc 5N4Đ', 
            'destination' => 'Phú Quốc, Kiên Giang', 
            'duration' => '5 ngày 4 đêm', 
            'price' => '4800000', 
            'status' => 'Tạm dừng',
            'description' => 'Nghỉ dưỡng tại đảo ngọc Phú Quốc với những bãi biển tuyệt đẹp và hải sản tươi ngon.',
            'itinerary' => 'Ngày 1: Bay đến Phú Quốc - Nhận phòng\nNgày 2-3: Tour 4 đảo - Lặn biển ngắm san hô\nNgày 4: Cáp treo Hòn Thơm - Chợ đêm Diênh Cau\nNgày 5: Tự do - Bay về',
            'includes' => '- Vé máy bay khứ hồi\n- Resort 4 sao\n- Ăn sáng hàng ngày\n- Tour theo chương trình',
            'excludes' => '- Ăn trưa, tối\n- Dịch vụ Spa\n- Mua sắm cá nhân',
            'image' => 'phuquoc.jpg'
        ],
        [
            'id' => 4, 
            'name' => 'Tour Đà Nẵng 3N2Đ', 
            'destination' => 'Đà Nẵng, Hội An', 
            'duration' => '3 ngày 2 đêm', 
            'price' => '2800000', 
            'status' => 'Hoạt động',
            'description' => 'Khám phá thành phố Đà Nẵng hiện đại và phố cổ Hội An thơ mộng.',
            'itinerary' => 'Ngày 1: Bay đến Đà Nẵng - Bà Nà Hills\nNgày 2: Hội An - Phố cổ - Đèn lồng\nNgày 3: Cầu Vàng - Chùa Linh Ứng - Bay về',
            'includes' => '- Vé máy bay\n- Khách sạn 4 sao\n- Ăn theo tour\n- Vé tham quan',
            'excludes' => '- Ăn uống tự túc\n- Mua sắm\n- Massage, Spa',
            'image' => 'danang.jpg'
        ],
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
                  <a href="<?= BASE_URL ?>?act=admin/tours/view&id=<?= $tour['id'] ?>" class="btn btn-info btn-sm">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href="<?= BASE_URL ?>?act=admin/tours/edit&id=<?= $tour['id'] ?>" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i>
                  </a>
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


<div class="modal fade" id="editTourModal" tabindex="-1">


<script>




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
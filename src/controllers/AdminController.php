<?php

class AdminController
{
    public function revenue()
    {
        view('admin.revenue', [
            'title' => 'Báo cáo Doanh thu',
            'pageTitle' => 'Báo cáo Doanh thu Tour',
        ]);
    }

    public function customers()
    {
        view('admin.customers', [
            'title' => 'Quản lý Khách hàng',
            'pageTitle' => 'Quản lý Khách hàng',
        ]);
    }

    public function tours()
    {
        view('admin.tours', [
            'title' => 'Danh sách Tour',
            'pageTitle' => 'Quản lý Tour',
        ]);
    }

    public function addTour()
    {
        view('admin.add-tour', [
            'title' => 'Thêm Tour mới',
            'pageTitle' => 'Thêm Tour mới',
        ]);
    }

    public function editTour()
    {
        view('admin.edit-tour', [
            'title' => 'Chỉnh sửa Tour',
            'pageTitle' => 'Chỉnh sửa Tour',
        ]);
    }

    public function viewTour()
    {
        view('admin.view-tour', [
            'title' => 'Chi tiết Tour',
            'pageTitle' => 'Chi tiết Tour',
        ]);
    }
}
<?php

class GuideController
{
    public function schedule()
    {
        view('guide.schedule', [
            'title' => 'Lịch trình Tour',
            'pageTitle' => 'Lịch trình Tour của tôi',
        ]);
    }

    public function customers()
    {
        view('guide.customers', [
            'title' => 'Khách trong đoàn',
            'pageTitle' => 'Danh sách khách trong đoàn',
        ]);
    }

    public function diary()
    {
        view('guide.diary', [
            'title' => 'Nhật ký Tour',
            'pageTitle' => 'Nhật ký Tour',
        ]);
    }

    public function checkin()
    {
        view('guide.checkin', [
            'title' => 'Điểm danh',
            'pageTitle' => 'Điểm danh khách hàng',
        ]);
    }

    public function requirements()
    {
        view('guide.requirements', [
            'title' => 'Yêu cầu đặc biệt',
            'pageTitle' => 'Yêu cầu đặc biệt của khách',
        ]);
    }
}
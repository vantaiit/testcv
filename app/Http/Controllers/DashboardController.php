<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    // Hàm để hiển thị danh sách bản ghi từ API
    public function index()
    {
        // Gọi API của NASA
        $response = Http::get('https://api.nasa.gov/neo/rest/v1/feed', [
            'start_date' => '2015-09-07',
            'end_date' => '2015-09-08',
            'api_key' => 'DEMO_KEY',
        ]);

        // Chuyển dữ liệu từ API thành mảng
        $neoData = $response->json();

        // Truyền dữ liệu đến view
        return view('dashboard', ['neoData' => $neoData['near_earth_objects']]);
    }

    // Hàm để hiển thị chi tiết của từng bản ghi
    public function show($id)
    {
        // Gọi API của NASA để lấy thông tin chi tiết theo ID
        $response = Http::get("https://api.nasa.gov/neo/rest/v1/neo/{$id}", [
            'api_key' => 'DEMO_KEY',
        ]);

        // Chuyển dữ liệu từ API thành mảng
        $neoDetails = $response->json();

        // Truyền dữ liệu chi tiết đến view
        return view('neo_details', ['neoDetails' => $neoDetails]);
    }
}

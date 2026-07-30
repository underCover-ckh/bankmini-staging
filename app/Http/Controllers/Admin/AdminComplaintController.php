<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;

class AdminComplaintController extends Controller
{
    public function index()
    {
        // Gunakan paginate() untuk pagination
        $complaints = Complaint::paginate(10); // 10 item per halaman
        return view('admin.complaints', compact('complaints'));
    }
}
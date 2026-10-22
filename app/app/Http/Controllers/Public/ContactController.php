<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view("public.contact");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|max:150",
            "email" => "required|email|max:150",
            "subject" => "nullable|string|max:200",
            "message" => "required|string",
        ]);

        ContactMessage::create($data);

        return back()->with("success", "Pesan Anda berhasil dikirim. Terima kasih telah menghubungi kami.");
    }
}

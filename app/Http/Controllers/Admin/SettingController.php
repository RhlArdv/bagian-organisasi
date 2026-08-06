<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function contact()
    {
        // Get all contact and social media settings
        $settings = SiteSetting::whereIn('group', ['contact', 'social_media'])->pluck('value', 'key_name')->toArray();
        
        return view('admin.settings.contact', compact('settings'));
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'working_hours' => 'required|string|max:100',
            'google_maps_embed' => 'nullable|string',
            'sp4n_lapor_link' => 'nullable|url',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        $contactKeys = ['address', 'phone', 'email', 'working_hours', 'google_maps_embed', 'sp4n_lapor_link'];
        foreach ($contactKeys as $key) {
            SiteSetting::setValue($key, $request->input($key), 'contact');
        }

        $socialKeys = ['instagram', 'facebook', 'twitter', 'youtube'];
        foreach ($socialKeys as $key) {
            SiteSetting::setValue($key, $request->input($key), 'social_media');
        }

        return redirect()->route('settings.contact')->with('success', 'Pengaturan kontak, lokasi, dan sosial media berhasil diperbarui.');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $collection = Setting::all();

        $settings['settings'] = $collection->flatMap(function ($col) {
            return [$col->key => $col->value];
        });

        return $settings;
    }
    public function updateSettings(Request $request)
    {
        $data = $request->data;


        foreach ($data as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return response()->json([
            'status' => 201,
            'message' => "Settings Updated Successfully"
        ]);
    }
}

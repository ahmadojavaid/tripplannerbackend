<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\UpdateWorkVideo;
use App\Models\Setting;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
  public function index()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Settings"]
    ];

    $settings =  Setting::all();
    return view('pages.admin.setting.index', [
      'breadcrumbs' => $breadcrumbs,
      'settings' => $settings,
      'products' => []
    ]);
  }


  public function demoVideo()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => '/admin/settings', 'name' => "Settings"], ['name' => "How it Works"]
    ];

    $setting =  Setting::where('slug', 'how-it-work-video')->first();

    return view('pages.admin.setting.demo-video', [
      'breadcrumbs' => $breadcrumbs,
      'setting' => $setting,
      'products' => []
    ]);
  }


  public function uploadDemoVideo(UpdateWorkVideo $request)
  {
    $setting =  Setting::where('slug', 'how-it-work-video')->first();

    //remove video
    $tempPath = \FileHelper::generateImagePath('how-it-work-video', $setting->value, 'setting');
    \FileHelper::deleteFile($tempPath);

    //upload video
    $temp = \FileHelper::getImageName('how-it-work-video', $request->video->getClientOriginalExtension(), 0, 'setting');
    $setting->update([
      'value' => $temp['name']
    ]);
    \FileHelper::upload($temp['path'], File::get($request->video));
    return response()->json($setting->getHowItWorkVideo(), 201);
  }
}

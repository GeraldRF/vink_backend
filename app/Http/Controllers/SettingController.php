<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllSettings()
    {
        $settings = Cache::remember('all-settings', 1000000, function () {
            return Setting::all();
        });

        return response('fetch', 200);
        //return response($settings, 200);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function updateSetting(Request $request)
    {
        try {

            $slug = $request->get('slug');
            $value = $request->get('value');

            throw_if(empty($slug), new Exception('Slug param is empty', 400));
            throw_if(empty($value), new Exception('New value param is empty', 400));

            $isUpdated = Setting::where(['slug' => $slug])->update(['value' => $value]);

            if($isUpdated){
                return response('The settings have been successfully updated.', 200);
            }

        } catch(Exception $e){
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function deleteSetting()
    {
        //
    }
}

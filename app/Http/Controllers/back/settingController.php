<?php

namespace App\Http\Controllers\back;

use App\{
    Http\Controllers\Controller,
    Http\Requests\setting\createSettingRequest,
    Http\Requests\setting\updateSettingRequest,
    Models\setting,
};
use Illuminate\{
    Http\Request,
    Support\Facades\DB
    };
use Exception;

class settingController extends Controller
{
    public function index(){
        $setting = setting::get()->first();
        return view('back.setting.index', [
            'setting' => $setting ?? null
        ]);
    }

    public function store(createSettingRequest $request){
        $data = $request->validated();

        DB::beginTransaction();
        try {
            if ($request->hasFile('foto_perusahaan')) {
                $checkingFile            = $request->file('foto_perusahaan');
                $filename                = $checkingFile->getClientOriginalName();
                $path                    = $checkingFile->storeAs('public/back/logo',$filename);
                $data['foto_perusahaan'] = $filename;
            }

            setting::create($data);
            DB::commit();

            return redirect(route('setting.index'))->with('success', ' Setting has been update');
        } catch (Exception  $e) {
            info($e->getMessage());
            DB::rollBack();

            return response()->json([
                "code"    => 412,
                "status"  => "Error",
                "message" =>  $e->getLine() . ' ' . $e->getMessage()
            ]);

        }
    }

    public function update(updateSettingRequest $request, $id_setting){
        $data = $request->validated();

        DB::beginTransaction();
        
        try {
            if ($request->hasFile('foto_perusahaan')) {
                $checkingFile            = $request->file('foto_perusahaan');
                $filename                = $checkingFile->getClientOriginalName();
                $path                    = $checkingFile->storeAs('public/back/logo',$filename);
                $data['foto_perusahaan'] = $filename;
            }

            $setting = setting::find($id_setting);
            $setting->update($data);
            DB::commit();

            return redirect(route('setting.index'))->with('success', ' Setting has been update');
        } catch (Exception $e) {
            info($e->getMessage());
            DB::rollBack();

            return response()->json([
                "code"    => 412,
                "status"  => "Error",
                "message" =>  $e->getLine() . ' ' . $e->getMessage()
            ]);

        }

    }

}

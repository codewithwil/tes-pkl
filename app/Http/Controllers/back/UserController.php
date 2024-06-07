<?php

namespace App\Http\Controllers\back;

use App\{
    Http\Controllers\Controller,
    Http\Requests\user\updateRequest,
    Http\Requests\user\createRequest,
    Models\User
};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){
        $users = User::get();
        return view('back.user.index', [
            'users' => $users
        ]);
    }
    public function create(){
        return view('back.user.create');
    }

    public function store(createRequest $request) {
        $data = $request->validated();
     
        DB::beginTransaction();
        try {
            if ($request->hasFile('foto')) {
                $checkingFile = $request->file('foto');
                $filename = $checkingFile->getClientOriginalName();
                $path = $checkingFile->storeAs('public/back/foto-profile',$filename);
                $data['foto'] = $filename;
            }
    
            $data['password'] = bcrypt($data['password']);
            $user             = User::create($data);
            
            DB::commit();

            return redirect(route('users.index'))->with('success', ' User has been created');
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

    public function edit($id){
        return view('back.user.update', [
            'users'    => User::find($id)
        ]);
    }

    public function update(updateRequest $request, $id){
        $data = $request->validated();
     
        DB::beginTransaction();
        try {
            if ($request->hasFile('foto')) {
                $checkingFile = $request->file('foto');
                $filename = $checkingFile->getClientOriginalName();
                $path = $checkingFile->storeAs('public/back/foto-profile',$filename);
                $data['foto'] = $filename;
        
                $user = User::find($id);
                if ($user->foto) {
                    Storage::delete('public/back/foto-profile/' . $user->foto);
                }
            }
    
        if($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
            unset($data['password_confirmation']);
        }
            $user = User::find($id);
            $user->update($data);
            DB::commit();

            return redirect(route('users.index'))->with('success', ' User has been update');
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
    public function profile($id){
        return view('back.auth.profile',[
            'users' => User::find($id)
        ]);
    }
    public function updateProfile(updateRequest $request, $id){
            $data = $request->validated();
         
            DB::beginTransaction();
            try {
                if ($request->hasFile('foto')) {
                    $checkingFile = $request->file('foto');
                    $filename = $checkingFile->getClientOriginalName();
                    $path = $checkingFile->storeAs('public/back/foto-profile',$filename);
                    $data['foto'] = $filename;
            
                    $user = User::find($id);
                    if ($user->foto) {
                        Storage::delete('public/back/foto-profile/' . $user->foto);
                    }
                }
            if($request->filled('password')) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
                unset($data['password_confirmation']);
            }
                $user = User::find($id);
                $user->update($data);
                DB::commit();
    
                return redirect()->route('users.profile', ['id' => $user->id])->with('success', 'User has been updated');
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

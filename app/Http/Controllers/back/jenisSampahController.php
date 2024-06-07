<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\jenisSampah;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class jenisSampahController extends Controller
{
    public function index(){
        $jenis = jenisSampah::get();
        return view('back.jenis.index',[
            'jenis'  => $jenis
        ]);
    }

    public function create(){
        return view('back.jenis.create');
    }

    public function store( Request $request) {
        $data = $request->validate([
            'nama' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required',
            'harga' => 'required',
            'kategori_id' => 'required',
        ]);
     
        DB::beginTransaction();
        try {
            jenisSampah::create($data);
            DB::commit();

            return redirect(route('jenis.index'))->with('success', ' jenis sampah has been created');
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

    public function edit($id_jenis){
        return view('back.jenis.update', [
            'jenis'    => jenisSampah::find($id_jenis)
        ]);
    }

    public function update(Request $request, $id_jenis){
        $data = $request->validate([
            'nama' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required',
            'harga' => 'required',
            'kategori_id' => 'required',
        ]);
     
        DB::beginTransaction();
        try {

    
            $jenis = jenisSampah::find($id_jenis);
            $jenis->update($data);
            DB::commit();

            return redirect(route('jenis.index'))->with('success', ' Kategori has been update');
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

    public function delete(Request $request){
        $validated = $request->validate([
            'id_jenis' => 'required',
        ]);
    
        $data = jenisSampah::where('id_jenis', $validated['id_jenis'])->first();
        if ($data) {
            $data->delete();
            return response()->json(['message' => 'jenis sampah updated successfully'], 200);
        }
        return response()->json(['message' => 'jenis sampah not found'], 404);
    }
    
}

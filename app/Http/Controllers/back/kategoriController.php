<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\kategori;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kategoriController extends Controller
{
    public function index(){
        $kategori = kategori::get();
        return view('back.kategori.index',[
            'kategori'  => $kategori
        ]);
    }

    public function create(){
        return view('back.kategori.create');
    }

    public function store( Request $request) {
        $data = $request->validate([
            'nama_kategori' => 'required',
        ]);
     
        DB::beginTransaction();
        try {
            kategori::create($data);
            DB::commit();

            return redirect(route('kategori.index'))->with('success', ' kategori has been created');
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

    public function edit($id_kategori){
        return view('back.kategori.update', [
            'kategori'    => kategori::find($id_kategori)
        ]);
    }

    public function update(Request $request, $id_kategori){
        $data = $request->validate([
            'nama_kategori' => 'required'
        ]);
     
        DB::beginTransaction();
        try {

    
            $kategori = kategori::find($id_kategori);
            $kategori->update($data);
            DB::commit();

            return redirect(route('kategori.index'))->with('success', ' Kategori has been update');
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
            'id_kategori' => 'required',
        ]);
    
        $data = kategori::where('id_kategori', $validated['id_kategori'])->first();
        if ($data) {
            $data->delete();
            return response()->json(['message' => 'Kategori updated successfully'], 200);
        }
        return response()->json(['message' => 'Kategori not found'], 404);
    }
    
}

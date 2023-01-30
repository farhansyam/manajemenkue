<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Kue;
use App\Models\Cookie;
class KueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $kues = Kue::Where('id_user',Auth()->user()->id)->get();
        return view('mylist.index', compact('kues'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $kues = Cookie::all();
        return view('mylist.create', compact('kues'));
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'id_kue'   => 'unique:kue'
        // ]);

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/kues', $image->hashName());

        $kue = Kue::create([
            'jumlah_droping'     => $request->jumlah_droping,
            'id_kue'     => $request->id_kue,
            'id_user'     => Auth::user()->id
        ]);

        if($kue){
            //redirect dengan pesan sukses
            return redirect()->route('mylist.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('mylist.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    
    /**
     * edit
     *
     * @param  mixed $kue
     * @return void
     */
    public function edit($id)
    {   
        $cookie = Cookie::all();
        $kue = Kue::find($id);
        // dd($kue->cookie->id);
        return view('mylist.edit', compact('kue','cookie'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $kue
     * @return void
     */
    public function update(Request $request)
    {
        // $this->validate($request, [
        //     'content'   => 'required'
        // ]);

        //get data kue by ID
        $kue = Kue::findOrFail($request->id);

        // if($request->file('image') == "") {

            $kue->update([
                'id_kue'     => $request->id_kue,
                'jumlah_droping'   => $request->jumlah_droping
            ]);

        // } else {

        //     //hapus old image
        //     Storage::disk('local')->delete('public/kues/'.$kue->image);

        //     //upload new image
        //     $image = $request->file('image');
        //     $image->storeAs('public/kues', $image->hashName());

        //     $kue->update([
        //         'image'     => $image->hashName(),
        //         'title'     => $request->title,
        //         'content'   => $request->content
        //     ]);
            
        // }

        if($kue){
            //redirect dengan pesan sukses
            return redirect()->route('mylist.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('mylist.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $kue = Kue::findOrFail($id);
        $kue->delete();

        if($kue){
            //redirect dengan pesan sukses
            return redirect()->route('mylist.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('mylist.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

}

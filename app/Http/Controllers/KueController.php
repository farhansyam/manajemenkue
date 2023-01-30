<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Kue;
use App\Models\Kuedroping;
use App\Models\Cookie;
use App\Models\User;
use App\Models\History;
class KueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        if(Auth::user()->role == 99)
        {
            $kues = Kue::Where('id_user',auth()->user()->id)->get();
        }
        elseif(Auth::user()->role == 98)
        {
            $kues = Kuedroping::Where('id_user',auth()->user()->id)->where('status',2)->get();
        }
        else
        {
            $kues = Kuedroping::Where('id_user',auth()->user()->id)->where('status',2)->get();
        }
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

        $kueready = Kue::where('id_kue',$request->id_kue)->first();
        if($kueready)
        {
        // if($request->file('image') == "") {

            $kueready->update([
                'jumlah_droping'   => $kueready->jumlah_droping+$request->jumlah_droping,
                'stock'   => $kueready->stock + $request->jumlah_droping
            ]);

             $history = history::create([
            'jumlah_droping'     => $request->jumlah_droping,
            'stock'     => $request->jumlah_droping,
            'id_kue'     => $request->id_kue,
            'id_user'     => Auth::user()->id
        ]);


        }
        else{

            $kue = Kue::create([
                'jumlah_droping'     => $request->jumlah_droping,
                'stock'     => $request->jumlah_droping,
                'id_kue'     => $request->id_kue,
                'id_user'     => Auth::user()->id
            ]);
            $history = history::create([
                'jumlah_droping'     => $request->jumlah_droping,
                'stock'     => $request->jumlah_droping,
                'id_kue'     => $request->id_kue,
                'id_user'     => Auth::user()->id
            ]);
        }

            //redirect dengan pesan sukses
            return redirect()->route('mylist.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
                'jumlah_droping'   => $request->jumlah_droping,
                'stock'   => $request->stock
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

    public function tracking()
    {
        return view('tracking.search');
    }
    public function trackingkue()
    {
        return view('tracking.kue');
    }
    public function trackingagen()
    {
        return view('tracking.agen');
    }
    public function trackingkoor()
    {
        return view('tracking.koor');
    }
    public function trackingsales()
    {
        return view('tracking.sales');
    }

    public function trackingkueid(Request $request)
    {
        $search = $request->key;
        $cookie = Cookie::where('nama', 'LIKE', "%{$search}%")->first();
        if($cookie)
        {
            
        $cookieid = $cookie->id;

        $kues = Kuedroping::where('id_kue',$cookieid)->where('role',96)->get();

        return view('tracking.kueid',compact('kues','search'));
        }
        else
        {
            

        $kues = Kuedroping::where('id_kue',"AASD")->where('role',96)->get();

        return view('tracking.kueid',compact('kues','search'));
        }

    }
    public function trackingagenid(Request $request)
    {
        $user = User::where('kode_gudang_2',$request->key)->where('role',98)->first();

            if($user)
        {
            $jumlah_droping = $user->kuedroping->sum('jumlah_droping');
            $stock = $user->kuedroping->sum('stock');
             $terjual = $user->kuedroping->where('status',2)->sum('terjual');
            $pesanan = $user->kuedroping->where('status',2)->sum('pesanan');
            $return = $user->kuedroping->where('status',2)->sum('return');
            $tagihan = Kuedroping::where('status',2)->where('id_user',$user->id)->get();
            $setoran = $user->kuedroping->where('status',2)->sum('setoran');

            $piutang = $user->kuedroping->where('status',2)->sum('piutang');

            if($jumlah_droping == 0)
            {
                $total = 0;
                $total2 = 0;
                $total3 = 0;

            }
               else{
                for($i = 0 ; $i<$tagihan->count();$i++)
                            {
                                $bill[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->jumlah_droping;
                                $bill2[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->setoran;
                                $bill3[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->pesanan;
                            }
                            
                            $total = array_sum($bill);
                            $total2 = array_sum($bill2);
                            $total3 = array_sum($bill3);
            }

        return view('tracking.agenid',compact('user','jumlah_droping','stock','pesanan','terjual','return','total','total2','total3','setoran'));

        }
        else{
            return view('tracking.agen')->with('msg','Not Found');
        }

    }
    public function trackingkoorid(Request $request)
    {
        $user = User::where('kode_sales',$request->key)->where('role',97)->first();

        if(auth()->user()->role == 99)
        {
            if($user)
        {
            $jumlah_droping = $user->kuedroping->sum('jumlah_droping');
            $stock = $user->kuedroping->sum('stock');
             $terjual = $user->kuedroping->where('status',2)->sum('terjual');
            $pesanan = $user->kuedroping->where('status',2)->sum('pesanan');
            $return = $user->kuedroping->where('status',2)->sum('return');
            $tagihan = Kuedroping::where('status',2)->where('id_user',$user->id)->get();
            $setoran = $user->kuedroping->where('status',2)->sum('setoran');

            $piutang = $user->kuedroping->where('status',2)->sum('piutang');

            if($jumlah_droping == 0)
            {
                $total = 0;
                $total2 = 0;
                $total3 = 0;

            }
              else {
                for($i = 0 ; $i<$tagihan->count();$i++)
                            {
                                $bill[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->jumlah_droping;
                                $bill2[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->setoran;
                                $bill3[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->pesanan;
                            }
                            
                            $total = array_sum($bill);
                            $total2 = array_sum($bill2);
                            $total3 = array_sum($bill3);
            }

        return view('tracking.koorid',compact('user','jumlah_droping','stock','pesanan','terjual','return','total','total2','total3','setoran'));

        }
        else{
            return view('tracking.koor')->with('msg','Not Found');
        }
        }
        elseif(auth()->user()->role == 98)
        {
            $user = User::where('kode_gudang_2',auth()->user()->kode_gudang_2)->where('kode_sales',$request->key)->where('role',97)->first();
            if($user)
            {
            $jumlah_droping = $user->kuedroping->sum('jumlah_droping');
            $stock = $user->kuedroping->sum('stock');
             $terjual = $user->kuedroping->where('status',2)->sum('terjual');
            $pesanan = $user->kuedroping->where('status',2)->sum('pesanan');
            $return = $user->kuedroping->where('status',2)->sum('return');
            $tagihan = Kuedroping::where('status',2)->where('id_user',$user->id)->get();
            $setoran = $user->kuedroping->where('status',2)->sum('setoran');

            $piutang = $user->kuedroping->where('status',2)->sum('piutang');

            if($jumlah_droping == 0)
            {
                $total = 0;
                $total2 = 0;
                $total3 = 0;

            }
               else{
                for($i = 0 ; $i<$tagihan->count();$i++)
                            {
                                $bill[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->jumlah_droping;
                                $bill2[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->setoran;
                                $bill3[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->pesanan;
                            }
                            
                            $total = array_sum($bill);
                            $total2 = array_sum($bill2);
                            $total3 = array_sum($bill3);
            }

        return view('tracking.agenid',compact('user','jumlah_droping','stock','pesanan','terjual','return','total','total2','total3','setoran'));

        }
        else{
            return view('tracking.koor')->with('msg','Not Found');

        }            
        }

    }
    public function trackingsalesid(Request $request)
    {
        $user = User::where('kode_sales',$request->key)->where('role',96)->first();
        
        if(auth()->user()->role == 99)
        {
            if($user)
        {
            $jumlah_droping = $user->kuedroping->sum('jumlah_droping');
            $stock = $user->kuedroping->sum('stock');
             $terjual = $user->kuedroping->where('status',2)->sum('terjual');
            $pesanan = $user->kuedroping->where('status',2)->sum('pesanan');
            $return = $user->kuedroping->where('status',2)->sum('return');
            $tagihan = Kuedroping::where('status',2)->where('id_user',$user->id)->get();
            $setoran = $user->kuedroping->where('status',2)->sum('setoran');

            $piutang = $user->kuedroping->where('status',2)->sum('piutang');
            if($jumlah_droping == 0)
            {
                $total = 0;
                $total2 = 0;
                $total3 = 0;

            }
               else{
                for($i = 0 ; $i<$tagihan->count();$i++)
                            {
                                $bill[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->jumlah_droping;
                                $bill2[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->setoran;
                                $bill3[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->pesanan;
                            }
                            
                            $total = array_sum($bill);
                            $total2 = array_sum($bill2);
                            $total3 = array_sum($bill3);
            }

        return view('tracking.salesid',compact('user','jumlah_droping','stock','pesanan','terjual','return','total','total2','total3','setoran'));

        }
        else{
            return view('tracking.sales')->with('msg','Not Found');
        }
        }
        elseif(auth()->user()->role == 98)
        {
            $user = User::where('kode_gudang_2',auth()->user()->kode_gudang_2)->where('kode_sales',$request->key)->where('role',96)->first();
            if($user)
        {
            $jumlah_droping = $user->kuedroping->sum('jumlah_droping');
            $stock = $user->kuedroping->sum('stock');
             $terjual = $user->kuedroping->where('status',2)->sum('terjual');
            $pesanan = $user->kuedroping->where('status',2)->sum('pesanan');
            $return = $user->kuedroping->where('status',2)->sum('return');
            $tagihan = Kuedroping::where('status',2)->where('id_user',$user->id)->get();
            $setoran = $user->kuedroping->where('status',2)->sum('setoran');

            $piutang = $user->kuedroping->where('status',2)->sum('piutang');
            if($jumlah_droping == 0)
            {
                $total = 0;
                $total2 = 0;
                $total3 = 0;

            }
               else{
                for($i = 0 ; $i<$tagihan->count();$i++)
                            {
                                $bill[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->jumlah_droping;
                                $bill2[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->setoran;
                                $bill3[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->pesanan;
                            }
                            
                            $total = array_sum($bill);
                            $total2 = array_sum($bill2);
                            $total3 = array_sum($bill3);
            }

        return view('tracking.salesid',compact('user','jumlah_droping','stock','pesanan','terjual','return','total','total2','total3','setoran'));

        }
        else{
            return view('tracking.sales')->with('msg','Not Found');
        }
        }
        else
        {
            $user = User::where('kode_gudang_2',auth()->user()->kode_gudang_2)->where('kode_gudang_3',auth()->user()->kode_gudang_3)->where('kode_sales',$request->key)->where('role',96)->first();

            if($user)
        {
            $jumlah_droping = $user->kuedroping->sum('jumlah_droping');
            $stock = $user->kuedroping->sum('stock');
             $terjual = $user->kuedroping->where('status',2)->sum('terjual');
            $pesanan = $user->kuedroping->where('status',2)->sum('pesanan');
            $return = $user->kuedroping->where('status',2)->sum('return');
            $tagihan = Kuedroping::where('status',2)->where('id_user',$user->id)->get();
            $setoran = $user->kuedroping->where('status',2)->sum('setoran');

            $piutang = $user->kuedroping->where('status',2)->sum('piutang');
            if($jumlah_droping == 0)
            {
                $total = 0;
                $total2 = 0;
                $total3 = 0;

            }
               else{
                for($i = 0 ; $i<$tagihan->count();$i++)
                            {
                                $bill[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->jumlah_droping;
                                $bill2[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->setoran;
                                $bill3[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->pesanan;
                            }
                            
                            $total = array_sum($bill);
                            $total2 = array_sum($bill2);
                            $total3 = array_sum($bill3);
            }

        return view('tracking.salesid',compact('user','jumlah_droping','stock','pesanan','terjual','return','total','total2','total3','setoran'));

        }
        else{
            return view('tracking.sales')->with('msg','Not Found');
        }
        }
    }


    public function history()
    {
        $kues = History::all();
        return view('history',compact('kues'));
    }



}

<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kue;
use App\Models\Kuedroping;
class UsersController extends Controller
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
                $users = User::Where('role',98)->get();
        }
        elseif(Auth::user()->role == 98)
        {
            $users = User::Where('role',97)->where('kode_gudang_2',auth()->user()->kode_gudang_2)->get();
        }
        elseif(Auth::user()->role == 97)
        {
            $users = User::Where('role',96)->where('kode_gudang_2',auth()->user()->kode_gudang_2)->where('kode_gudang_3',auth()->user()->kode_gudang_3)->get();
        }
        return view('users.index', compact('users'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('users.create');
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
        //     'id_users'   => 'unique:users'
        // ]);

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/users', $image->hashName());
        if(Auth::user()->role == 99)
             $users = User::create([
            'name'     => $request->name,
            'email'     => $request->email,
            'password' => Hash::make($request->password),
            'no_tlpn' => $request->no_telepon,
            'kode_gudang_2' => $request->kode_gudang,  
            'role' => 98,  
        ]);

        elseif(Auth::user()->role == 98)
             $users = User::create([
            'name'     => $request->name,
            'email'     => $request->email,
            'password' => Hash::make($request->password),
            'no_tlpn' => $request->no_telepon,
            'kode_gudang_2' => Auth::user()->kode_gudang_2,  
            'kode_gudang_3' => $request->kode_gudang,  
            'kode_sales' => Auth::user()->kode_gudang_2.$request->kode_gudang,  
            'role' => 97,  
        ]);
        else
            $users = User::create([
                'name'     => $request->name,
                'email'     => $request->email,
                'password' => Hash::make($request->password),
                'no_tlpn' => $request->no_telepon,
                'kode_gudang_2' => Auth::user()->kode_gudang_2,  
                'kode_gudang_3' => Auth::user()->kode_gudang_3,  
                'kode_sales' => Auth::user()->kode_sales.$request->kode_gudang,  
                'role' => 96,  
            ]);

        if($users){
            //redirect dengan pesan sukses
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    
    /**
     * edit
     *
     * @param  mixed $users
     * @return void
     */
    public function edit($id)
    {   
        $user = User::find($id);
        // dd($users->cookie->id);
        return view('users.edit', compact('user'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $users
     * @return void
     */
    public function update(Request $request)
    {
        // $this->validate($request, [
        //     'content'   => 'required'
        // ]);

        //get data users by ID
        $users = User::findOrFail($request->id);

        // if($request->file('image') == "") {

            $users->update([
                'name'     => $request->name,
                'email'   => $request->email,
                'password' => Hash::make($request->password),

            ]);

            if(Auth::user()->role == 99)
                $users->update([
                'name'     => $request->name,
                'email'     => $request->email,
                'password' => Hash::make($request->password),
                'no_tlpn' => $request->no_telepon,
                'kode_gudang_2' => $request->kode_gudang,  
                'role' => 98,  
                ]);

            elseif(Auth::user()->role == 98)
                 $users->update([
                'name'     => $request->name,
                'email'     => $request->email,
                'password' => Hash::make($request->password),
                'no_tlpn' => $request->no_telepon,
                'kode_gudang_3' => $request->kode_gudang,  
                'role' => 97,  
            ]);

            else
                 $users->update([
                    'name'     => $request->name,
                    'email'     => $request->email,
                    'password' => Hash::make($request->password),
                    'no_tlpn' => $request->no_telepon,
                    'kode_sales' => $request->kode_gudang,  
                    'role' => 96,  
                ]);



        // } else {

        //     //hapus old image
        //     Storage::disk('local')->delete('public/users/'.$users->image);

        //     //upload new image
        //     $image = $request->file('image');
        //     $image->storeAs('public/users', $image->hashName());

        //     $users->update([
        //         'image'     => $image->hashName(),
        //         'title'     => $request->title,
        //         'content'   => $request->content
        //     ]);
            
        // }

        if($users){
            //redirect dengan pesan sukses
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $users = User::findOrFail($id);
        $users->delete();

        if($users){
            //redirect dengan pesan sukses
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    public function detail($id)
    {
        $gudang = User::find($id);
        if(Auth::user()->role == 99){
            $jumlah_droping = $gudang->kuedroping->sum('jumlah_droping');
            $stock = $gudang->kuedroping->sum('stock');
             $terjual = $gudang->kuedroping->sum('terjual');
            $pesanan = $gudang->kuedroping->sum('pesanan');
            $return = $gudang->kuedroping->sum('return');
            $tagihan = $gudang->kuedroping;
            $returnmasuk = $gudang->kuedroping->sum('return_masuk');

            $setoran = $gudang->kuedroping->sum('setoran');
            $piutang = $gudang->kuedroping->sum('piutang');
            $setoran2 = $gudang->kuedroping;
            if($jumlah_droping == 0)
            {
                $total = 0;
                $total2 = 0;
                $total3 = 0;
                $total4 = 0;

            }
            else
            {

                for($i = 0 ; $i<$setoran2->count();$i++)
                            {
                                $bill[] =  $setoran2[$i]->cookie->harga * $setoran2[$i]->jumlah_droping;
                                $bill2[] =  $setoran2[$i]->cookie->harga * $setoran2[$i]->setoran;
                                $bill3[] =  $setoran2[$i]->cookie->harga * $setoran2[$i]->pesanan;
                                $bill4[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->terjual;

                            }
                            
                            $total = array_sum($bill);
                            $total2 = array_sum($bill2);
                            $total4 = array_sum($bill4);
                            $total3 = array_sum($bill3);
                            
            }

        }
        elseif(Auth::user()->role == 98){
            $jumlah_droping = $gudang->kuedroping->sum('jumlah_droping');
            $stock = $gudang->kuedroping->sum('stock');
             $terjual = $gudang->kuedroping->where('status',2)->sum('terjual');
            $pesanan = $gudang->kuedroping->where('status',2)->sum('pesanan');
            $return = $gudang->kuedroping->where('status',2)->sum('return');
            $returnmasuk = $gudang->kuedroping->where('status',2)->sum('return_masuk');
            $tagihan = Kuedroping::where('status',2)->where('id_user',auth()->user()->id)->get();
            $setoran = $gudang->kuedroping->where('status',2)->sum('setoran');

            $piutang = $gudang->kuedroping->where('status',2)->sum('piutang');

            
            if($jumlah_droping == 0)
            {
                $total = 0;
                $total2 = 0;
                $total3 = 0;
                $total4 = 0;

            }
            else
            {
                for($i = 0 ; $i<$tagihan->count();$i++)
                            {
                                $bill[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->jumlah_droping;
                                $bill2[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->setoran;
                                $bill3[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->pesanan;
                                $bill4[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->terjual;
                            }
                            
                            $total = array_sum($bill);
                            $total2 = array_sum($bill2);
                            $total3 = array_sum($bill3);
                            $total4 = array_sum($bill4);
            }
        }
        else{
            $jumlah_droping = $gudang->kuedroping->where('status',2)->sum('jumlah_droping');
            $stock = $gudang->kuedroping->where('status',2)->sum('stock');
            $terjual = $gudang->kuedroping->where('status',2)->sum('terjual');
            $pesanan = $gudang->kuedroping->where('status',2)->sum('pesanan');
            $return = $gudang->kuedroping->where('status',2)->sum('return');
            $returnmasuk = $gudang->kuedroping->where('status',2)->sum('return_masuk');
            
            $tagihan = $gudang->kuedroping->where('status',2);
            $setoran = $gudang->kuedroping->where('status',2)->sum('setoran');
            $setoran2 = $gudang->kuedroping->where('status',2);


            if($jumlah_droping == 0)
            {
                $total = 0;
                $total2 = 0;
                $total3 = 0;
                $total4 = 0;

            }
            else
            {
                for($i = 0 ; $i<$setoran2->count();$i++)
                            {
                                $bill[] =  $setoran2[$i]->cookie->harga * ($setoran2[$i]->jumlah_droping - $setoran2[$i]->return);
                                $bill2[] =  $setoran2[$i]->cookie->harga * $setoran2[$i]->setoran;
                                $bill3[] =  $setoran2[$i]->cookie->harga * $setoran2[$i]->pesanan;
                                $bill4[] =  $tagihan[$i]->cookie->harga * $tagihan[$i]->terjual;

                            }
                            
                            $total = array_sum($bill);
                            $total2 = array_sum($bill2);
                            $total3 = array_sum($bill3);
                            $total4 = array_sum($bill4);

            }

          
        }
         if(Auth::user()->role == 99)
        {
            $kues = Kuedroping::Where('id_user',$gudang->id)->where('status',2)->get();
        }
        elseif(Auth::user()->role == 98)
        {
            $kues = Kuedroping::Where('id_user',auth()->user()->id)->where('status',2)->get();
        }
        else
        {
            $kues = Kuedroping::Where('id_user',auth()->user()->id)->where('status',2)->get();
        }
        $gudang = User::find($id);
            $jumlah_droping = $gudang->kuedroping->where('status',2)->sum('jumlah_droping');
            $stock = $gudang->kuedroping->where('status',2)->sum('stock');

        // $stok = $jumlah_droping - $terjual;
        return view('users.detail',compact('jumlah_droping','stock','gudang','kues','return','terjual','pesanan','returnmasuk','total','total2','total3','total4'));
    }
    // public function detailgudang($id)
    // {
    //     $gudang = User::find($id);
    //     if(Auth::user()->role == 99)
    //     {
    //             $users = User::Where('role',96)->where('kode_gudang_2',$gudang->kode_gudang_2)->get();
    //     }
    //     elseif(Auth::user()->role == 98)
    //     {
    //         $users = User::Where('role',97)->get();
    //     }
    //     elseif(Auth::user()->role == 97)
    //     {
    //         $users = User::Where('role',96)->get();
    //     }
    //         $jumlah_droping = $gudang->kuedroping->where('status',2)->sum('jumlah_droping');
    //         $stock = $gudang->kuedroping->where('status',2)->sum('stock');

    //     // $stok = $jumlah_droping - $terjual;
    //     return view('users.detail',compact('jumlah_droping','stock','gudang','users'));
    // }

    public function approval()
    {
        return view('approval');
    }

    public function approvin($id)
    {
        $user = User::find($id);
        $user->update(['approval' => 1]);

        return back();
    }
    public function unapprovin($id)
    {
        $user = User::find($id);
        $user->update(['approval' => 0]);

        return back();
    }

    public function signup(Request $request)
    {
        $c = User::find($request->c);
        $users = User::create([
                'name'     => $request->name,
                'email'     => $request->email,
                'password' => Hash::make($request->password),
                'no_tlpn' => $request->no_telepon,
                'kode_gudang_2' => $c->kode_gudang_2,  
                'kode_gudang_3' => $c->kode_gudang_3,  
                'kode_sales' => $c->kode_sales.$request->kode_gudang,  
                'role' => 96,  
            ]);

            return redirect('login');
    }

    public function daftar()
    {
        $use = User::where('role',97)->get();
        return view('auth.register',compact('use'));
    }
}

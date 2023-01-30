<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Redirect;
use Illuminate\Http\Request;
use App\Models\Cookie;
use App\Models\Order;
use App\Models\Kue;
use App\Models\Kuedroping;
use App\Models\Historydrop;
use App\Models\Historyorder;
use App\Models\User;
class OrderController extends Controller
{

   public function index()
    {
            $orders = Order::where('status',1)->Where('id_droper',auth()->user()->id)->get();
            return view('order.index',compact('orders'));
    }
   public function approval()
    {
        if(Auth::user()->role == 99){

            $orders = Order::Where('id_user',auth()->user()->id)->get();
        }
        elseif(Auth::user()->role == 98){

            $orders = Order::Where('id_user',auth()->user()->id)->get();
        }
        else
            $orders = Order::Where('id_user',auth()->user()->id)->get();

        return view('order.approval', compact('orders'));
    }

    public function approvin($id)
    {
        $order = Order::find($id);
        $kuedropings = Kuedroping::Where('id_user',$order->id_user)->orderBy('id_kue','ASC')->get();
        $historydroping = Historydrop::Where('id_droping',$order->id_droping)->orderBy('id_kue','ASC')->get();
        if($order->status == 3)
        {
            if(auth()->user()->role == 99)
            {
                $kuedropings = Kue::Where('id_user',$order->id_user)->orderBy('id_kue','ASC')->get();

        // $kuedropings = Kuedroping::all();
        if(count($kuedropings) > 0)
        {
            for($i=0;$i<$historydroping->count();$i++)
            {
                if($historydroping[$i]->id_kue == $kuedropings[$i]->id_kue)
                {
                    $kuedropings[$i]->update(['stock' => $kuedropings[$i]->stock + $historydroping[$i]->stock]);
                }
                else
                {
                    $datasave = [
                        'id_droping'     => $order->iddroping,
                        'jumlah_droping'     => $historydroping[$i]->jumlah_droping,
                        'stock'     => $historydroping[$i]->jumlah_droping,
                        'id_kue'     => $historydroping[$i]->id_kue,
                        'id_user'     => $historydroping[$i]->id_user,
                    ];
                    $Kuedroping =  DB::table('kue')->insert($datasave);
                    
                }
            }
        }
        else
        {
            for($i=0;$i<$historydroping->count();$i++)
            {
                $datasave = [
                    'id_droping'     => $order->iddroping,
                    'jumlah_droping'     => $historydroping[$i]->jumlah_droping,
                    'stock'     => $historydroping[$i]->jumlah_droping,
                    'id_kue'     => $historydroping[$i]->id_kue,
                    'id_user'     => $historydroping[$i]->id_user,
                    'status'     => 2,
                ];
                $Kuedroping =  DB::table('kue')->insert($datasave);

                }
           }
         
        $kuedroping = Kue::Where('id_droping',$order->id_droping)->update(['status' => 2]);



        
        $order->update([
            'status' => 2
        ]);

            }

            else
            {

        if(count($kuedropings) > 0)
        {
            for($i=0;$i<$kuedropings->count();$i++)
           {
                if($historydroping[$i]->id_kue == $kuedropings[$i]->id_kue)
                {
                    $kuedropings[$i]->update(['stock' => $kuedropings[$i]->stock + $historydroping[$i]->stock]);
                }
                else
                {
                    $datasave = [
                    'id_droping'     => $order->iddroping,
                    'jumlah_droping'     => $historydroping[$i]->jumlah_droping,
                    'stock'     => $historydroping[$i]->jumlah_droping,
                    'id_kue'     => $historydroping[$i]->id_kue,
                    'id_user'     => $historydroping[$i]->id_user,
                ];
                $Kuedroping =  DB::table('kuedropings')->insert($datasave);

                }
           }
        }
        else
        {
            for($i=0;$i<$historydroping->count();$i++)
            {
                $datasave = [
                    'id_droping'     => $order->iddroping,
                    'jumlah_droping'     => $historydroping[$i]->jumlah_droping,
                    'stock'     => $historydroping[$i]->jumlah_droping,
                    'id_kue'     => $historydroping[$i]->id_kue,
                    'id_user'     => $historydroping[$i]->id_user,
                    'status'     => 2,
                ];
                $Kuedroping =  DB::table('kuedropings')->insert($datasave);

                }
           }
         
        $kuedroping = Kuedroping::Where('id_droping',$order->id_droping)->update(['status' => 2]);



        
        $order->update([
            'status' => 2
        ]);     

            }
        }
        else
        {
        $historydroping = Historydrop::Where('id_droping',$order->id_droping)->orderBy('id_kue','ASC')->get();
        $kuedropings = Kuedroping::Where('id_user',$order->id_user)->orderBy('id_kue','DESC')->get();

        if($historydroping->count() > 0)
        {
            for($i=0;$i<$historydroping->count();$i++)
            {
              $kuedropingss = Kuedroping::Where('id_user',$order->id_user)->where('id_kue',$historydroping[$i] ->id_kue)->orderBy('id_kue','ASC')->first();
                if($kuedropingss)
                            {
                                $kuedropings[$i]->update(['stock' => $kuedropings[$i]->stock + $historydroping[$i]->stock]);
                                $kuedropings[$i]->update(['jumlah_droping' => $kuedropings[$i]->jumlah_droping + $historydroping[$i]->jumlah_droping]);
                                }
                                else
                                {
                                    $datasave = [
                                        'id_droping'     => $order->iddroping,
                                        'jumlah_droping'     => $historydroping[$i]->jumlah_droping,
                                        'stock'     => $historydroping[$i]->jumlah_droping,
                                        'id_kue'     => $historydroping[$i]->id_kue,
                                        'id_user'     => $historydroping[$i]->id_user,
                                        'status'     => 2,
                                    ];
                                    $Kuedroping =  DB::table('kuedropings')->insert($datasave);

                                }
              }   
              
        }
        else
        {
        $kuedropings = Kuedroping::Where('id_user',$order->id_user)->orderBy('id_kue','DESC')->get();

            for($i=0;$i<$historydroping->count();$i++)
            {
                $datasave = [
                    'id_droping'     => $order->iddroping,
                    'jumlah_droping'     => $historydroping[$i]->jumlah_droping,
                    'stock'     => $historydroping[$i]->jumlah_droping,
                    'id_kue'     => $historydroping[$i]->id_kue,
                    'id_user'     => $historydroping[$i]->id_user,
                    'status'     => 2,
                ];
                $Kuedroping =  DB::table('kuedropings')->insert($datasave);

                }
           }
         
        $kuedroping = Kuedroping::Where('id_droping',$order->id_droping)->update(['status' => 2]);



        
        $order->update([
            'status' => 2
        ]);

        }
        

        return redirect('approvaldrop');
    }
    
   public function show($id)
    {
        $order = Order::find($id);
        $kues = Historyorder::where('id_droping',$id)->get();

         for($i = 0 ; $i<$kues->count();$i++)
            {
                $bill[] =  $kues[$i]->cookie->harga * $kues[$i]->jumlah_droping;
            }

            $total = array_sum($bill);

        return view('order.show', compact('kues','order','total'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        // $kues = Cookie::where();

        $kues = Kuedroping::where('id_user',auth()->user()->id)->get();

        return view('order.create', compact('kues'));
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // multiple
        $iddroping = date('Ymdhms');
        $jumlah_droping = $request->jumlah_droping;
        $id_kue = $request->id_kue;
        $nama = $request->nama;
        $no_hp = $request->no_hp;
        $alamat = $request->alamat;
        $tanggal = $request->tanggal;
        $keterangan = $request->keterangan;
        $statusPaid = $request->statusPaid;
        $userlogin = auth()->user();
        $getKoorSales = User::where('kode_gudang_2',$userlogin->kode_gudang_2)->where('role','97')->first();
        $getAgen = User::where('kode_gudang_2',$userlogin->kode_gudang_2)->where('role','98')->first();
        $getDis = User::where('role','99')->first();
      
        
        $id_kue = $request->id_kue;
       
        for($i = 0; $i < count($id_kue); $i++){
              

              $kue = Kuedroping::where('id_kue',$request->id_kue[$i])->where('status',2)->where('id_user',auth()->user()->id)->first();
              $kue2 = Kuedroping::where('id_kue',$request->id_kue[$i])->where('status',2)->where('id_user',$getKoorSales->id)->first();
              $kue3 = Kuedroping::where('id_kue',$request->id_kue[$i])->where('status',2)->where('id_user',$getAgen->id)->first();
              $kue4 = Kue::where('id_kue',$request->id_kue[$i])->where('id_user',$getDis->id)->first();

            if($kue->stock < $jumlah_droping[$i]){

                return Redirect::back()->withErrors(['msg' => 'The Message']);
            }
          
          
               if($statusPaid == 'paid') //Pengecekan status payment
               {
                 $stockupdate = [
                    'stock' => $kue->stock - $jumlah_droping[$i],
                    'terjual' => $kue->terjual + $jumlah_droping[$i]
                        ];
                $kue->update($stockupdate);

                 $stockupdate2 = [
                    // 'stock' => $kue->stock - $jumlah_droping[$i],
                    'terjual' => $kue2->terjual + $jumlah_droping[$i]
                        ];
                $kue2->update($stockupdate2);

                 $stockupdate3 = [
                    // 'stock' => $kue->stock - $jumlah_droping[$i],
                    'terjual' => $kue3->terjual + $jumlah_droping[$i]
                        ];
                $kue3->update($stockupdate3);

                 $stockupdate4 = [
                    // 'stock' => $kue->stock - $jumlah_droping[$i],
                    'terjual' => $kue4->terjual + $jumlah_droping[$i]
                        ];
                $kue4->update($stockupdate4);
                

               }
               else
               {
                 $stockupdate = [
                    'stock' => $kue->stock - $jumlah_droping[$i],
                    'pesanan' => $kue->pesanan + $jumlah_droping[$i]
                        ];
                $kue->update($stockupdate);

                $stockupdate2 = [
                    // 'stock' => $kue->stock - $jumlah_droping[$i],
                     'pesanan' => $kue2->pesanan + $jumlah_droping[$i]
                        ];
                $kue2->update($stockupdate2);

                 $stockupdate3 = [
                    // 'stock' => $kue->stock - $jumlah_droping[$i],
                     'pesanan' => $kue3->pesanan + $jumlah_droping[$i]
                        ];
                $kue3->update($stockupdate3);

                 $stockupdate4 = [
                    // 'stock' => $kue->stock - $jumlah_droping[$i],
                     'pesanan' => $kue4->pesanan + $jumlah_droping[$i]
                        ];
                $kue4->update($stockupdate4);
               }

        $datasave = [
            'id_droping'     => $iddroping,
            'jumlah_droping'     => $jumlah_droping[$i],
            'stock'     => $jumlah_droping[$i],
            'id_kue'     => $id_kue[$i],
            'nama_konsumen'     => $nama
        ];   
        $history_drop_create = DB::table('historyorder')->insert($datasave);

                
          

        }
          $Order = Order::create([
                'id_droping'     => $iddroping,
                'id_droper'     => auth()->user()->id,
                'paid'     => $statusPaid,
                'nama_pembeli'     => $nama,
                'tgl'     => $tanggal,
                'no_hp'     => $no_hp,
                'alamat'     => $no_hp,
                'keterangan'     => $keterangan,

                ]); 

        // single
        // $kue = Kue::where('id_kue',$request->id_kue AND 'id_user',auth()->user()->id)->first();
        // $iddroping = date('Ymdhms');

  

        // $kue->update([
        //     'stock' => $kue->stock - $request->jumlah_droping
        // ]);
          
        //   $Order = Order::create([
        //     'id_droping'     => $iddroping,
        //     'id_user'     => $request->id_user,
        //     'id_droper'     => auth()->user()->id

        // ]);  
     
        // $Kuedroping = Kuedroping::create([
        //     'id_droping'     => $iddroping,
        //     'jumlah_droping'     => $request->jumlah_droping,
        //     'stock'     => $request->jumlah_droping,
        //     'id_kue'     => $request->id_kue,
        //     'id_user'     => $request->id_user
        // ]);
        
            
      
        if($Order){
            //redirect dengan pesan sukses
            return redirect()->route('order.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('order.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    
    /**
     * edit
     *
     * @param  mixed $Order
     * @return void
     */
    public function edit($id)
    {   
        $cookie = Cookie::all();
        $Order = Order::find($id);
        // dd($Order->cookie->id);
        return view('order.edit', compact('Order','cookie'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $Order
     * @return void
     */
    public function update(Request $request)
    {
        // $this->validate($request, [
        //     'content'   => 'required'
        // ]);

        //get data Order by ID
        $Order = Order::findOrFail($request->id);

        // if($request->file('image') == "") {

            $Order->update([
                'id_Droping'     => $request->id_Droping,
                'jumlah_droping'   => $request->jumlah_droping
            ]);

        // } else {

        //     //hapus old image
        //     Storage::disk('local')->delete('public/orders/'.$Order->image);

        //     //upload new image
        //     $image = $request->file('image');
        //     $image->storeAs('public/orders', $image->hashName());

        //     $Order->update([
        //         'image'     => $image->hashName(),
        //         'title'     => $request->title,
        //         'content'   => $request->content
        //     ]);
            
        // }

        if($Order){
            //redirect dengan pesan sukses
            return redirect()->route('order.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('order.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $Order = Order::findOrFail($id);
        $Order->delete();

        if($Order){
            //redirect dengan pesan sukses
            return redirect()->route('order.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('order.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    public function piutang()
    {
        $piutangs = Order::where('id_droper',auth()->user()->id)->where('paid','pesanan')->get();
        return view('order.piutang',compact('piutangs'));

    }

    public function move($id)
    {
        $order = Order::find($id);
        $userlogin = auth()->user();
        $getKoorSales = User::where('kode_gudang_2',$userlogin->kode_gudang_2)->where('role','97')->first();
        $getAgen = User::where('kode_gudang_2',$userlogin->kode_gudang_2)->where('role','98')->first();
        $getDis = User::where('role','99')->first();
      
        $kuedropings = Kuedroping::Where('id_user',$order->id_droper)->orderBy('id_kue','ASC')->get();
        $historyorder = Historyorder::where('id_droping',$id)->orderBy('id_kue','ASC')->get();
        for($i = 0 ; $i<$historyorder->count();$i++)
        {
              $kue2 = Kuedroping::where('id_kue',$kuedropings[$i]->id_kue)->where('status',2)->where('id_user',$getKoorSales->id)->first();
              $kue3 = Kuedroping::where('id_kue',$kuedropings[$i]->id_kue)->where('status',2)->where('id_user',$getAgen->id)->first();
              $kue4 = Kue::where('id_kue',$kuedropings[$i]->id_kue)->where('id_user',$getDis->id)->first();
             $kuedropings[$i]->update(['pesanan' => $kuedropings[$i]->pesanan - $historyorder[$i]->stock]);
             $kuedropings[$i]->update(['terjual' => $kuedropings[$i]->terjual + $historyorder[$i]->stock]);
             $kue2->update(['pesanan' => $kue2->pesanan - $historyorder[$i]->stock]);
             $kue2->update(['terjual' => $kue2->terjual + $historyorder[$i]->stock]);

             $kue3->update(['pesanan' => $kue3->pesanan - $historyorder[$i]->stock]);
             $kue3->update(['terjual' => $kue3->terjual + $historyorder[$i]->stock]);
             
             $kue4->update(['pesanan' => $kue4->pesanan - $historyorder[$i]->stock]);
             $kue4->update(['terjual' => $kue4->terjual + $historyorder[$i]->stock]);
        }

        $order->update(['paid' => 'paid']);

        return back();
    }

}

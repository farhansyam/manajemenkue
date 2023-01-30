<?php

namespace App\Http\Controllers;
use App\Models\Kue;
use App\Models\Kuedroping;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('approved');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        if(Auth::user()->role == 99){
            $jumlah_droping = Auth::user()->kue->sum('jumlah_droping');
            $stock = Auth::user()->kue->sum('stock');
             $terjual = Auth::user()->kue->sum('terjual');
            $pesanan = Auth::user()->kue->sum('pesanan');
            $return = Auth::user()->kue->sum('return');
            $tagihan = Auth::user()->kue;
            $returnmasuk = Auth::user()->kue->sum('return_masuk');

            $setoran = Auth::user()->kue->sum('setoran');
            $piutang = Auth::user()->kue->sum('piutang');
            $setoran2 = Auth::user()->kue;
            
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
            $jumlah_droping = Auth::user()->kuedroping->sum('jumlah_droping');
            $stock = Auth::user()->kuedroping->sum('stock');
             $terjual = Auth::user()->kuedroping->where('status',2)->sum('terjual');
            $pesanan = Auth::user()->kuedroping->where('status',2)->sum('pesanan');
            $return = Auth::user()->kuedroping->where('status',2)->sum('return');
            $returnmasuk = Auth::user()->kuedroping->where('status',2)->sum('return_masuk');
            $tagihan = Kuedroping::where('status',2)->where('id_user',auth()->user()->id)->get();
            $setoran = Auth::user()->kuedroping->where('status',2)->sum('setoran');

            $piutang = Auth::user()->kuedroping->where('status',2)->sum('piutang');

            
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
            $jumlah_droping = Auth::user()->kuedroping->where('status',2)->sum('jumlah_droping');
            $stock = Auth::user()->kuedroping->where('status',2)->sum('stock');
            $terjual = Auth::user()->kuedroping->where('status',2)->sum('terjual');
            $pesanan = Auth::user()->kuedroping->where('status',2)->sum('pesanan');
            $return = Auth::user()->kuedroping->where('status',2)->sum('return');
            $returnmasuk = Auth::user()->kuedroping->where('status',2)->sum('return_masuk');
            
            $tagihan = Auth::user()->kuedroping->where('status',2);
            $setoran = Auth::user()->kuedroping->where('status',2)->sum('setoran');
            $setoran2 = Auth::user()->kuedroping->where('status',2);


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


        // $stok = $jumlah_droping - $terjual;
        return view('home',compact('jumlah_droping','stock','pesanan','terjual','return','total','total2','total3','total4','setoran','returnmasuk'));
    }
}

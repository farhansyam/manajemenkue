<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Redirect;
use Illuminate\Http\Request;
use App\Models\Cookie;
use App\Models\Droping;
use App\Models\Setoran;
use App\Models\Kue;
use App\Models\Historydrop;
use App\Models\Historysetoran;
use App\Models\Historyorder;
use App\Models\Kuedroping;
use App\Models\User;
class SetoranController extends Controller
{
    public function approval()
    {
        if(Auth::user()->role == 99){

            $setorans = Setoran::Where('id_user',auth()->user()->id)->get();
        }
        elseif(Auth::user()->role == 98){

            $setorans = Setoran::Where('id_user',auth()->user()->id)->get();
        }
        else
            $setorans = Setoran::Where('id_user',auth()->user()->id)->get();

        return view('setoran.approval', compact('setorans'));
    }

    public function approvin($id)
    {
        $droping = Setoran::find($id);
        $kuedropings = Kuedroping::Where('id_user',$droping->id_user)->orderBy('id_kue','ASC')->get();
        $kuedropingsss = Kuedroping::Where('id_user',$droping->id_droper)->orderBy('id_kue','ASC')->get();
        $historydroping = Historysetoran::Where('id_droping',$droping->id_droping)->orderBy('id_kue','ASC')->get();
        if($droping->status == 3)
        {
            if(auth()->user()->role == 99)
            {
                $kuedropings = Kue::Where('id_user',$droping->id_user)->orderBy('id_kue','ASC')->get();

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
                        'id_droping'     => $droping->iddroping,
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
                    'id_droping'     => $droping->iddroping,
                    'jumlah_droping'     => $historydroping[$i]->jumlah_droping,
                    'stock'     => $historydroping[$i]->jumlah_droping,
                    'id_kue'     => $historydroping[$i]->id_kue,
                    'id_user'     => $historydroping[$i]->id_user,
                    'status'     => 2,
                ];
                $Kuedroping =  DB::table('kue')->insert($datasave);

                }
           }
         
        $kuedroping = Kue::Where('id_droping',$droping->id_droping)->update(['status' => 2]);



        
        $droping->update([
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
                    'id_droping'     => $droping->iddroping,
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
                    'id_droping'     => $droping->iddroping,
                    'jumlah_droping'     => $historydroping[$i]->jumlah_droping,
                    'stock'     => $historydroping[$i]->jumlah_droping,
                    'id_kue'     => $historydroping[$i]->id_kue,
                    'id_user'     => $historydroping[$i]->id_user,
                    'status'     => 2,
                ];
                $Kuedroping =  DB::table('kuedropings')->insert($datasave);

                }
           }
         
        $kuedroping = Kuedroping::Where('id_droping',$droping->id_droping)->update(['status' => 2]);



        
        $droping->update([
            'status' => 2
        ]);     

            }
        }
        else
        {
            
            $historydroping = Historysetoran::Where('id_droping',$droping->id_droping)->orderBy('id_kue','ASC')->get();
            $kuedropings = Kuedroping::Where('id_user',$droping->id_user)->orderBy('id_kue','DESC')->get();
            if(auth()->user()->role == 99)
            {
            $kuedropings = Kue::Where('id_user',$droping->id_user)->orderBy('id_kue','DESC')->get();
            }
            if($historydroping->count() > 0)
            {
                for($i=0;$i<$historydroping->count();$i++)
                {
                    $kuedropingss = Kuedroping::Where('id_user',$droping->id_user)->where('id_kue',$historydroping[$i] ->id_kue)->orderBy('id_kue','ASC')->first();
                       if(auth()->user()->role == 99)
            {
                    $kuedropingss = Kue::Where('id_user',$droping->id_user)->where('id_kue',$historydroping[$i] ->id_kue)->orderBy('id_kue','ASC')->first();
            }
                    if($kuedropingss)
                    {
                                $kuedropings[$i]->update(['stock' => $kuedropings[$i]->stock + $historydroping[$i]->stock]);
                                $kuedropings[$i]->update(['stock' => $kuedropings[$i]->stock + $historydroping[$i]->stock]);
                                $kuedropingsss[$i]->update(['setoran' => $kuedropingsss[$i]->setoran + $historydroping[$i]->jumlah_droping]);
                                }
                                else
                                {
                                    $datasave = [
                                        'id_droping'     => $droping->iddroping,
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
        $kuedropings = Kuedroping::Where('id_user',$droping->id_user)->orderBy('id_kue','DESC')->get();

            for($i=0;$i<$historydroping->count();$i++)
            {
                $datasave = [
                    'id_droping'     => $droping->iddroping,
                    'jumlah_droping'     => $historydroping[$i]->jumlah_droping,
                    'stock'     => $historydroping[$i]->jumlah_droping,
                    'id_kue'     => $historydroping[$i]->id_kue,
                    'id_user'     => $historydroping[$i]->id_user,
                    'status'     => 2,
                ];
                $Kuedroping =  DB::table('kuedropings')->insert($datasave);

                }
           }
         
        $kuedroping = Kuedroping::Where('id_droping',$droping->id_droping)->update(['status' => 2]);



        
        $droping->update([
            'status' => 2
        ]);

        }
        

        return redirect('approvalsetoran');
    }
    

   public function index()
    {
        if(Auth::user()->role == 99)
            $setorans = Setoran::Where('id_droper',auth()->user()->id)->where('status_2',4)->get();
        elseif(Auth::user()->role == 98)
            $setorans = Setoran::Where('id_droper',auth()->user()->id)->where('status_2',4)->get();
        else
            $setorans = Setoran::Where('id_droper',auth()->user()->id)->where('status_2',4)->get();

        return view('setoran.index', compact('setorans'));
    }
   
    
   public function show($id)
    {
        $Setoran = Setoran::find($id);
        $kues = Historysetoran::where('id_droping',$id)->get();

              for($i = 0 ; $i<$kues->count();$i++)
            {
                $bill[] =  $kues[$i]->cookie->harga * $kues[$i]->jumlah_droping;
            }

            $total = array_sum($bill);
        return view('setoran.show', compact('kues','Setoran','total'));
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
            if(Auth::user()->role == 99){
            $users = User::Where('role',100)->get();
            $kues = Kue::where('id_user',auth()->user()->id)->get();

        }
        elseif(Auth::user()->role == 98){
            $users = User::Where('role',99)->get();
            }
        elseif(Auth::user()->role ==  97){
            $users = User::Where('role',98)->where('kode_gudang_2',auth()->user()->kode_gudang_2)->get();
        }
        elseif(Auth::user()->role ==  96){
            $users = User::Where('role',97)->where('kode_gudang_3','LIKE','%'.auth()->user()->kode_gudang_3.'%')->get();
        }


        return view('setoran.create', compact('kues','users'));
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
        if($request->file('file')){
            $file = $request->file('file');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
      	        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'data_file';
		$file->move($tujuan_upload,$nama_file);
        }
		$nama_file = time()."_".$file->getClientOriginalName();

        $uid = $request->id_user;
        $iddroping = date('Ymdhms');
        $jumlah_droping = $request->jumlah_droping;
        $id_kue = $request->id_kue;
      

        
        $id_kue = $request->id_kue;
        for($i = 0; $i < count($id_kue); $i++){
            if(auth()->user()->role !=99){

              $kue = Kuedroping::where('id_kue',$request->id_kue[$i])->where('id_user',auth()->user()->id)->first();
            $totalll = $kue->terjual - $kue->setoran;
            if($totalll < $jumlah_droping[$i]){

                return Redirect::back()->withErrors(['msg' => 'The Message']);
            }
          
            }  
            else
            {
                 $kue = Kue::where('id_kue',$request->id_kue[$i])->where('id_user',auth()->user()->id)->first();
            $totalll = $kue->terjual - $kue->setoran;
            if($totalll < $jumlah_droping[$i]){

                return Redirect::back()->withErrors(['msg' => 'The Message']);
            }

                    $kue->update(['setoran' => $kue->setoran + $jumlah_droping[$i]]);
            
                         
            }
          
            
            //  $request->validate([
            //                 'jumlah_droping' => 'numeric|max:'.$kue[$i]->stock
            //             ]); 
            // dd($request->id_user);
          
            //         $datasave = [
            //         'id_droping'     => $iddroping,
            //         'jumlah_droping'     => $jumlah_droping[$i],
            //         'stock'     => $jumlah_droping[$i],
            //         'id_kue'     => $id_kue[$i],
            //         'id_user'     => $uid
            //     ];
            //    $Historysetoran =  DB::table('kuedropings')->insert($datasave);

                // $stockupdate = [
                //     'setoran' => $kue->setoran + $jumlah_droping[$i],
                //     // 'jumlah_droping' => $kue->stock - $jumlah_droping[$i],
                //     // 'return' => $kue->return + $jumlah_droping[$i]
                //         ];
                // $kue->update($stockupdate);

        $datasave = [
            'id_droping'     => $iddroping,
            'jumlah_droping'     => $jumlah_droping[$i],
            'stock'     => $jumlah_droping[$i],
            'id_kue'     => $id_kue[$i],
            'id_user'     => $uid
        ];   
        $history_drop_create = DB::table('historysetorans')->insert($datasave);

                
          

        }
        if(auth()->user()->role != 99)
        {
              $Setoran = Setoran::create([
                'id_droping'     => $iddroping,
                'id_user'     => $request->id_user,
                'id_droper'     => auth()->user()->id,
                'status'     => 4,
                'status_2'     => 4,
                'gambar' => $nama_file

                ]); 
        }
        else
        {
              $Setoran = Setoran::create([
                'id_droping'     => $iddroping,
                'id_user'     => $request->id_user,
                'id_droper'     => auth()->user()->id,
                'status'     => 2,
                'status_2'     => 4,
                'gambar' => $nama_file

                ]); 
        }

   
        if($Setoran){
            //redirect dengan pesan sukses
            return redirect()->route('setoran.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('setoran.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    
    /**
     * edit
     *
     * @param  mixed $Setoran
     * @return void
     */
    public function edit($id)
    {   
        $cookie = Cookie::all();
        $Setoran = Setoran::find($id);
        // dd($Setoran->cookie->id);
        return view('setoran.edit', compact('Setoran','cookie'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $Setoran
     * @return void
     */
    public function update(Request $request)
    {
        // $this->validate($request, [
        //     'content'   => 'required'
        // ]);

        //get data Setoran by ID
        $Setoran = Setoran::findOrFail($request->id);

        // if($request->file('image') == "") {

            $Setoran->update([
                'id_Droping'     => $request->id_Droping,
                // 'jumlah_droping'   => $request->jumlah_droping
            ]);

        // } else {

        //     //hapus old image
        //     Storage::disk('local')->delete('public/setorans/'.$Setoran->image);

        //     //upload new image
        //     $image = $request->file('image');
        //     $image->storeAs('public/setorans', $image->hashName());

        //     $Setoran->update([
        //         'image'     => $image->hashName(),
        //         'title'     => $request->title,
        //         'content'   => $request->content
        //     ]);
            
        // }

        if($Setoran){
            //redirect dengan pesan sukses
            return redirect()->route('setoran.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('setoran.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $Setoran = Setoran::findOrFail($id);
        $Setoran->delete();

        if($Setoran){
            //redirect dengan pesan sukses
            return redirect()->route('setoran.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('setoran.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

}

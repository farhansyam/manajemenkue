<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Redirect;
use Illuminate\Http\Request;
use App\Models\Cookie;
use App\Models\Droping;
use App\Models\Kue;
use App\Models\Historydrop;
use App\Models\Kuedroping;
use App\Models\User;
class ReturnController extends Controller
{

   public function index()
    {
        if(Auth::user()->role == 99)
            $returns = Droping::Where('id_droper',auth()->user()->id)->where('status_2',3)->get();
        elseif(Auth::user()->role == 98)
            $returns = Droping::Where('id_droper',auth()->user()->id)->where('status_2',3)->get();
        else
            $returns = Droping::Where('id_droper',auth()->user()->id)->where('status_2',3)->get();
        return view('return.index', compact('returns'));
    }
   
    
   public function show($id)
    {
        $droping = Droping::find($id);
        $kues = Historydrop::where('id_droping',$id)->get();
        return view('return.show', compact('kues','droping'));
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
            $users = User::Where('role',98)->get();
            $kues = Kue::where('id_user',auth()->user()->id)->get();

        }
        elseif(Auth::user()->role == 98){
            $users = User::Where('role',99)->get();
            }
        elseif(Auth::user()->role ==  97){
            $users = User::Where('role',98)->where('kode_gudang_2',auth()->user()->kode_gudang_2)->get();
        }
        elseif(Auth::user()->role ==  96){
            $users = User::Where('role',97)->where('kode_gudang_3',auth()->user()->kode_gudang_3)->where('kode_gudang_2',auth()->user()->kode_gudang_2)->get();
        }

        return view('return.create', compact('kues','users'));
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
        $uid = $request->id_user;
        $iddroping = date('Ymdhms');
        $jumlah_droping = $request->return;
        $id_kue = $request->id_kue;
      
if($request->file('file')){
            $file = $request->file('file');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
      	        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'data_file';
		$file->move($tujuan_upload,$nama_file);
        }
        else{

            $nama_file ="NULL";
        }

        
        $id_kue = $request->id_kue;
       
        for($i = 0; $i < count($id_kue); $i++){
            if(auth()->user()->role !=99){

              $kue = Kuedroping::where('id_kue',$request->id_kue[$i])->where('id_user',auth()->user()->id)->first();
            if($kue->stock < $jumlah_droping[$i]){

                return Redirect::back()->withErrors(['msg' => 'The Message']);
            }
          
            }  
            else
            {
            $kue = Kuedroping::where('id_kue',$request->id_kue[$i])->where('id_user',auth()->user()->id)->first();
            if($kue->stock < $jumlah_droping[$i]){

                return Redirect::back()->withErrors(['msg' => 'The Message']);
            }
                         
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
            //    $Kuedroping =  DB::table('kuedropings')->insert($datasave);

                $stockupdate = [
                    'stock' => $kue->stock - $jumlah_droping[$i],
                    'return' => $kue->return + $jumlah_droping[$i]
                        ];
                $kue->update($stockupdate);

        $datasave = [
            'id_droping'     => $iddroping,
            'jumlah_droping'     => $jumlah_droping[$i],
            'stock'     => $jumlah_droping[$i],
            'id_kue'     => $id_kue[$i],
            'id_user'     => $uid
        ];   
        $history_drop_create = DB::table('historydrops')->insert($datasave);

                
          

        }
          $Droping = Droping::create([
                'id_droping'     => $iddroping,
                'id_user'     => $request->id_user,
                'id_droper'     => auth()->user()->id,
                'status'     => 3,
                'status_2'     => 3,
                'gambar'     => $nama_file

                ]); 

        // single
        // $kue = Kue::where('id_kue',$request->id_kue AND 'id_user',auth()->user()->id)->first();
        // $iddroping = date('Ymdhms');

  

        // $kue->update([
        //     'stock' => $kue->stock - $request->jumlah_droping
        // ]);
          
        //   $Droping = Droping::create([
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
        
            
      
        if($Droping){
            //redirect dengan pesan sukses
            return redirect()->route('return.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('return.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    
    /**
     * edit
     *
     * @param  mixed $Droping
     * @return void
     */
    public function edit($id)
    {   
        $cookie = Cookie::all();
        $Droping = Droping::find($id);
        $histori = Historydrop::where('id_droping',$id)->get();
            $kues = Kuedroping::where('id_user',auth()->user()->id)->get();
        if(Auth::user()->role == 99){
            $users = User::Where('role',98)->get();
            $kues = Kue::where('id_user',auth()->user()->id)->get();

        }
        elseif(Auth::user()->role == 98){
            $users = User::Where('role',99)->get();
            }
        elseif(Auth::user()->role ==  97){
            $users = User::Where('role',98)->where('kode_gudang_2',auth()->user()->kode_gudang_2)->get();
        }
        elseif(Auth::user()->role ==  96){
            $users = User::Where('role',97)->where('kode_gudang_3',auth()->user()->kode_gudang_3)->where('kode_gudang_2',auth()->user()->kode_gudang_2)->get();
        }
        return view('return.edit', compact('Droping','cookie','kues','histori'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $Droping
     * @return void
     */
    public function update(Request $request)
    {
        if($request->file('file')){
            $file = $request->file('file');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
      	        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'data_file';
		$file->move($tujuan_upload,$nama_file);
        }
        else{

            $nama_file =  $request->namafile2;
        }

        // multiple
        $uid = $request->id_user;
        $iddroping = $request->id_droping;
        $jumlah_droping = $request->jumlah_droping;
        $id_kue = $request->id_kue;
        
        $id_kue = $request->id_kue;
        $historydropingss = Historydrop::where('id_droping',$iddroping)->get();

        $del = Historydrop::where('id_droping',$iddroping)->whereNotIn('id_kue',$id_kue)->get();
        $back = Historydrop::where('id_droping',$iddroping)->whereIn('id_kue',$id_kue)->get();
        $kuenya = Kue::whereNotIn('id_kue',$id_kue)->get();
        
        for($i = 0; $i < count($id_kue); $i++){
        
            if(auth()->user()->role !=99){
                
                $kue = Kuedroping::where('id_kue',$request->id_kue[$i])->where('id_user',auth()->user()->id)->first();
            if($kue->stock < $jumlah_droping[$i]){

                return Redirect::back()->withErrors(['msg' => 'The Message']);
            }
          
        }  
            else
            {
                $kue = Kue::where('id_kue',$request->id_kue[$i])->where('id_user',auth()->user()->id)->first();
            if($kue->stock < $jumlah_droping[$i]){

                return Redirect::back()->withErrors(['msg' => 'The Message']);
            }
            
        }
            

        $historydroping = Historydrop::where('id_droping',$iddroping)->where('id_kue',$id_kue[$i])->first();

            if($historydroping == [] )
            {
                $datasave = [
                            'id_droping'     => $iddroping,
                            'jumlah_droping'     => $jumlah_droping[$i],
                            'stock'     => $jumlah_droping[$i],
                            'id_kue'     => $id_kue[$i],
                            'id_user'     => $uid
                        ];   
                        $history_drop_create = DB::table('historydrops')->insert($datasave);
                        $stockupdate = [
                                            'stock' => $kue->stock - $jumlah_droping[$i]
                                                ];
                                        $kue->update($stockupdate);
            }
            else
            {
                       if($jumlah_droping[$i] > $historydroping->jumlah_droping)
                    {
                        $hasil =  $request->jumlah_droping[$i] - $historydroping->jumlah_droping;
                        $stockupdate = [
                                            'stock' => $kue->stock - $hasil,
                                            'return' => $kue->return + $hasil
                                                ];
                                        $kue->update($stockupdate);
                    }
                    else{
                        
                        $hasil =  $historydroping->jumlah_droping - $request->jumlah_droping[$i];
                        dd($hasil);
                        $stockupdate = [
                                            'stock' => $kue->stock + $hasil,
                                            'return' => $kue->return - $hasil
                                                ];
                                        $kue->update($stockupdate);

                    }
            $historydropingss = Historydrop::where('id_droping',$iddroping)->get();
            if($i > $historydropingss->count())
            {
                        $stockupdate = [
                                    'stock' => $kue->stock - $request->jumlah_droping[$i]
                                        ];
                                $kue->update($stockupdate);

                        $datasave = [
                            'id_droping'     => $iddroping,
                            'jumlah_droping'     => $jumlah_droping[$i],
                            'stock'     => $jumlah_droping[$i],
                            'id_kue'     => $id_kue[$i],
                            'id_user'     => $uid
                        ];   
                        $history_drop_create = DB::table('historydrops')->insert($datasave);
            }

            else{
                    // if( $i <= $historydropingss->count())
            // {
                 $historydroping->update([
                        'jumlah_droping' => $jumlah_droping[$i]
                    ]);
               
                
            // }
           

        }
            }        
            // Update stok edit
             


                
          
           
        }
        for($o = 0 ; $o < $del->count();$o++)
        {
             if(!$del->isEmpty())
                            {   
                                $kuenya = Kue::where('id_kue',$del[$o]->id_kue)->first();
                                $kuenya->update(['stock' => $kuenya->stock + $del[$o]->jumlah_droping]);
                                $del[$o]->delete();
                                // return back();
                            
                            }
                            else{
                                 dd("A");
                            }
        }

          $droping = Droping::where('id_droping',$iddroping)->first();
         $Droping = $droping->update([
                'id_droping'     => $iddroping,
                'id_user'     => $request->id_user,
                'id_droper'     => auth()->user()->id,
                'status'     => 3,
                'gambar'     => $nama_file,

                ]); 

      
        if($Droping){
            //redirect dengan pesan sukses
            return redirect()->route('return.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('return.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $historydroping = Historydrop::where('id_droping',$id)->get();
        for($i=0;$i<$historydroping->count();$i++)
        {
            if(auth()->user()->role !=99){
                
                $kue = Kuedroping::where('id_kue',$historydroping[$i]->id_kue)->where('id_user',auth()->user()->id)->first();
          
        }  
            else
            {
                $kue = Kue::where('id_kue',$historydroping[$i]->id_kue)->where('id_user',auth()->user()->id)->first();
            
        }
            $kue->update(['stock' => $kue->stock + $historydroping[$i]->jumlah_droping]);
            $kue->update(['return' => $kue->return - $historydroping[$i]->jumlah_droping]);
        }
        $Droping = Droping::findOrFail($id);
        $Droping->delete();

        if($Droping){
            //redirect dengan pesan sukses
            return redirect()->route('return.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('return.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    public function approvin($id)
    {
        $droping = Droping::find($id);
        $kuedropings = Kuedroping::Where('id_user',$droping->id_user)->orderBy('id_kue','ASC')->get();
        $historydroping = Historydrop::Where('id_droping',$droping->id_droping)->orderBy('id_kue','ASC')->get();
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
        $historydroping = Historydrop::Where('id_droping',$droping->id_droping)->orderBy('id_kue','ASC')->get();
        $kuedropings = Kuedroping::Where('id_user',$droping->id_user)->orderBy('id_kue','DESC')->get();

        if($historydroping->count() > 0)
        {
            for($i=0;$i<$historydroping->count();$i++)
            {
              $kuedropingss = Kuedroping::Where('id_user',$droping->id_user)->where('id_kue',$historydroping[$i] ->id_kue)->orderBy('id_kue','ASC')->first();
              if($kuedropingss == [])
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
                else
                {
                    
                                    
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
        

        return redirect('approvaldrop');
    }

}

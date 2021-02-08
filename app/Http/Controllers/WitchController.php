<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class WitchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::forget('result');
        return view('dashboard', [
            'title' => 'Kill the Witch'
        ]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    function prima_dinamis(){
       
        
        
        $umur=$_POST['umur'];
        $tahun=$_POST['tahun'];
 
        $rows=$_POST['rows'];
        $last=$_POST['last'];
   
        if ($umur < 0 or $tahun <0 or $umur > $tahun){
        //    $data['avg']=   ($avg + (-1))/$rows;
        //last record sebagai acuan avg
           $data['last']= -1;
           //untuk menampilkan ke table
            $data['detail'] ='
            <tr  >
            <td>'.$umur.' </td>
            <td>'.$tahun.' </td>
             <td> -1 </td>
             <td>'.$data['last'].'</td>
             </tr>';
             //simpan di temporary session 
              Session::push('result', $data);
              //panggil data array di session 
              $sess =Session::get('result');  
             
                 echo json_encode($sess);
               
          
        }else if ($tahun - $umur ==0){
               //last record sebagai acuan avg
            $data['last']= 0;
               //untuk menampilkan ke table
            $data['detail'] ='
            <tr  >
            <td>'.$umur.' </td>
            <td>'.$tahun.' </td>
             <td> 0 </td>
             <td>'.$data['last'].'</td>
             </tr>';
             //simpan di temporary session 
              Session::push('result', $data);
              //panggil data array di session 
              $sess =Session::get('result');  
             
                 echo json_encode($sess);

        }else{
           $year = $tahun-$umur;
            $hsl = $this->prima_hit($year);
            // $data['avg']= ($avg + $hsl )/$rows; 
            $data['last']= $hsl;
            $data['detail'] ='
            <tr  >
            <td>'.$umur.' </td>
            <td>'.$tahun.' </td>
             <td> '.$year.'</td>
             <td>'.$hsl.'</td>
             </tr>';
             //simpan di temporary session 
              Session::push('result', $data);
             //panggil data array di session 
              $sess =Session::get('result');  
              
                 echo json_encode($sess);
        }
      
  } 
   
  function prima_hit($n){
    
    $num = array();
         
        $angka=1;
        //jika 1 
        if ($n==1){
            return $n;
        }
        //lakukan sebanyak banyak bilangan di cari
    while (count($num) < $n-1) 
    {
        $prima = true;
       
        for($i=2; $i<$angka;$i++)
            {
                if($angka%$i == 0)
                    $prima = false;
            }
        if($prima)
        //masukan ke array
                array_push($num,$angka);
                $angka++;
                // echo "$angka";
               
    }
    //lanjut ke fungsi jumlah akan mati 
    $hasil=   $this->count_kill2($num);
      return $hasil[0];
    
} 

function count_kill2($k){
   
    
    $temp=0;
    foreach($k  as $vew){
        $hsl = array();
        if ($temp == 0){
            //jika iterasi =1 alias 2 
            $add = 1 + $vew; 
            $temp =$add;
             
        }else{
           // iterasi ke n 
                $add =  $temp +$vew;
                
                $temp =$add;
                 
               
           
        }
       //push array 
        array_push($hsl,$add);   
        // echo $vew;  echo "=" ; echo $add;
        // echo "<br>";
    }
    // exit();
    return $hsl;
     
}

// untuk menampilkan data saja sebagai acuan 
    function prima(){
        $n = 4000;
        $num = array();
        for($angka=1;$angka<=$n;$angka++)
        {
            $prima = true;
           
            for($i=2; $i<$angka;$i++)
                {
                    if($angka%$i == 0)
                        $prima = false;
                }
            if($prima)
                    array_push($num,$angka);
                    // echo "$angka "; 
                   
        }
     $hasil=   $this->count_kill($num);
     $datas=array();
     $y=1;
      
        $data['tahun']=$y;
        $data['kill']=$y.'  villager';
        array_push($datas,$data);
     
      foreach ($hasil as $vw ){
      
        $data['tahun']=$y+1;
        $data['kill']=$vw.' villager';
        
        array_push($datas,$data);
        $y++;

      }
      echo json_encode($datas);
        
  } 
   
  function count_kill($k){
        $jum = count($k);
        $hsl = array();
        $temp=0;
        for($i=0; $i<$jum;$i++){
           
            if ($temp == 0){
                $add = 1 + $k[$i]; 
                $temp =$add;
                array_push($hsl,$add);
            }else{
               
                    $add =  $temp +$k[$i];
                    
                    $temp =$add;
                     
                    array_push($hsl,$add);
               
            }
         
            
        }
         
        return $hsl;
         
  }
// end untuk menampilkan data saja sebagai acuan 
}

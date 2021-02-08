@csrf
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<h2 > target witcher in the next 552 years</h2>
 
<table id="data-table" class="display" style="width:100%">
    <thead>
    <tr> 
        <td> year of death  </td>
        <td>  Victims      </td>
    </tr>   
    </thead>
    {{-- <tbody>


    </tbody> --}}
   
</table>
 
    <div class="col-md-3">
        <label> Age of death  </label>
        <input type="number" id="umur"   >
    </div>
  <br>
      <div class="col-md-1">
        <label> Year of death =</label>
           <input type="number" id="tahun"    >
      </div>
      <div class="col-md-1" style=" position: absolute;
      left: 800px;">
       <label>Total Rows </label>
       <input type="text" id="rows"  value="0"  >
       <label>Last result </label>
           <input type="text" id="last"  value="0"  >
        <label>Average </label>
           <input type="text" id="avg"  value="0"  >
          
      </div>
      <br>
      <div class="col-md-2">
          <!-- <input id = "button" class="btn btn-primary" type = "button" value = " Add " onclick = "AddData()"> -->
           <button type="button" class="add_cart btn btn-primary waves-effect waves-light" >Process</button> 
      </div>
 
<br>

 
<table  class="display"  style="width:80%" id = "list" border='2'  align="center"> 
  <thead>
    <tr class="text-primary"  >
      
      <th>Age of death</th>
      <th>Year of death</th>
      <th>Year to</th>
      <th>TheTarget kills Villager</th>
 
    </tr>
  </thead>
  <tbody id="detail_cart">
   
  </tbody>
</table>
 

 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<script> 
var avg =0;
     $(document).ready(function() {
        //get data yang 552 

                $('#data-table').DataTable( {
                      "ajax": {
                          "url": '{{ route("getkill") }}',
                          "dataSrc": ""
                      },
                      "columns": [         
                                                  {"data": "tahun"}, 
                                                  {"data": "kill"},
                                                 
                      ]
                                    
                 
            
            
 
                  } );
       
          

     })
     $('.add_cart').click(function(){
      var umur    = $('#umur').val();
      var tahun = $('#tahun').val();
       
      var last = $('#last').val();
      var rows = parseInt($('#rows').val())+1;
         
      $.ajax({
                         url: '{{ route("findkill") }}',
                        method: 'post',
                        data: {tahun: tahun, umur:umur,rows:rows,last:last,_token:'{{  csrf_token() }}'},
                        dataType: 'JSON',
                        success: function (dataz) {
                            //di kosongkaan dulu table 
                            $('#detail_cart').html("");
                            var average= 0;
                            var rows = 0;
                            $.each(dataz, function(i, data) {
                                //dimasukan ke table hasil dari data temporary arrray
                                $('#detail_cart').append(data.detail);
                                 // alert( i + ": " + data );
                                //average
                                 average+=parseInt(data.last);
                                 //jumlah baris 
                                 rows=i+1;
                                 $('#rows').val(i+1);
                                 //hasil terakhir
                                 $('#last').val(data.last);
                            });
                            //hitung avg 
                            $('#avg').val(average/rows);
                           
                            
                        }
      });
    });
    
</script>

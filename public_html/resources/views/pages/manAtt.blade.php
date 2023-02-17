@extends('layouts.masterPage') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-12" style="margin-left: -15px;">
            <div  style="margin-top: 10px; " class="col-md-12">
                <form class="needs-validation was-validated" novalidate   method="POST" action="{{url('/manatt')}}">
                    <div class="card-header">Attendance</div>
                    <div style="margin-top: 10px">
                        
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Select Class</label>
                            <div class="col-md-6">
                              
                                <select id="class"  class="form-control" name="class">
                                    @foreach($cl as $cls)
                                    <option value="{{$cls->sl}}">{{$cls->class}}</option>
                                    @endforeach
                                    
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                
                                <button id="submit" name="submit"  value="submit" type="submit"  class="btn btn-primary btn-block">
                                Search
                                </button>
                                
                            </div>
                        </div>
                        
                        
                        
                        <table id="example" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th style="width: 60px;">Present</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    {{$ssl=0;}}
                                @endphp
                                
                                @foreach ($data as $key)
                                @php
                                    {{$ssl=$ssl+1;}}
                                @endphp
                                <tr>
                                    <td>{{$key->sl}}  <input value="{{$key->sl}}"  id="sl[{{$ssl}}]" type="hidden" class="form-control" name="sl[{{$ssl}}]"  ></td>
                                    <td>{{$key->name}}</td>
                                    <td> <input value="1"  id="p{{$ssl}}" type="Checkbox" class="form-control" name="p{{$ssl}}"  ></td>
                                   
                                    
                                    
                                </tr>
                                @endforeach
                                
                                
                            </tbody>
                            <tfoot>
                            <tr>
                               <th>ID</th>
                                    <th>Name</th>
                                    <th>Present</th>
                                
                            </tr>
                            </tfoot>

                        </table>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                
                                <button id="sv" name="sv"  value="sv" type="sv"  class="btn btn-primary btn-block">
                                Save
                                </button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
// Setup - add a text input to each footer cell
$('#example tfoot th').each( function () {
var title = $(this).text();
$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
} );
$('#example thead tr').clone(true).appendTo( '#example thead' );
$('#example thead tr:eq(1) th ').each( function (i) {
var title = $(this).text();
$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
$( 'input', this ).on( 'keyup change', function () {
if ( table.column(i).search() !== this.value ) {
table
.column(i)
.search( this.value )
.draw();
}
} );
} );
$('#example tfoot th').each( function (i) {
var title = $(this).text();
$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
$( 'input', this ).on( 'keyup change', function () {
if ( table.column(i).search() !== this.value ) {
table
.column(i)
.search( this.value )
.draw();
}
} );
} );
var table = $('#example').DataTable( {
orderCellsTop: true,
fixedHeader: true,
"scrollY": 400,
"scrollX": true,
"order": [[ 0, "desc" ]],
dom: 'Bfrtip',
lengthMenu: [
[ 1000, 25, 50, -1 ],
[ '1000 rows', '25 rows', '50 rows', 'Show all' ]
],
buttons: [
'pageLength',
{
extend: 'pdfHtml5',
exportOptions: {
columns: ':visible'
},
messageTop: function () {
return '';
},
download: 'open'
},
'copyHtml5',
'excelHtml5',
'csvHtml5',
{
extend: 'print',
exportOptions: {
columns: ':visible'
},
messageTop: function () {
return '';
},
autoPrint: false
},
{
extend: 'colvis',
collectionLayout: 'fixed three-column',
postfixButtons: [ 'colvisRestore' ]
}
]
} );
} );
$(document).ready(function() {
var table = $('#example').DataTable();
$('#example tbody').on( 'click', 'tr', function () {
$(this).toggleClass('selected');
} );
$('#button').click( function () {
alert( table.rows('.selected').data().length +' row(s) selected' );
} );

} );
</script>
@endsection
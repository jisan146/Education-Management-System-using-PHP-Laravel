@extends('layouts.masterPage')
@section('content')
<div style="margin-top: 10px; width: 1600px; overflow: scroll;">
    <div >
        <div >
            <div >
                <div class="card-header">{{ucwords($head)}}</div>
                <div  style="margin-top: 10px; width: 1600px; overflow: scroll; float: left;">
                    
                    
                    
                    
                    <table id="example" class="table table-bordered table-hover" style="float: left;">
                        <thead>
                            <tr>
                                
                                @foreach ($col0 as $col0)
                                <th>{{$col0->english}}</th>
                                    @endforeach
                                    
                                </tr>
                            </thead>
                            
                            <tfoot>
                            <tr>
                                
                                @foreach ($col1 as $col1)
                                <th>{{$col1->english}}</th>
                                    @endforeach
                                </tr>
                                </tfoot>
                            </table>
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<script type="text/javascript" language="javascript" class="init">
var dataSet1 = 
[
@foreach ($data as $data)[@foreach($row as $row1) @if($row1->column_name!='IMAGE') @php {{$Field=$row1->column_name;}} @endphp  @if ($row1->relation_with=='')@php if ($row1->link_with!=''){echo '"'; echo '<a href=\"'.url('report_print').'/'.strtolower(str_replace(' ', '_', $row1->link_with)).'/'.$data->$Field.'\"'.'target=\"_blank\"'.'><i class=\"fas fa-print\"></i></a> ';}else{echo '"';} {{   echo $data->$Field;}} @endphp  @else @php echo '"'; {{$list=DB::select('SELECT '.$row1->list_view.','.$row1->list_value.' FROM '.$row1->relation_with.' where client_id in (0,'.session('client_id').') and branch in (9,'.session('branch').')'); $list_view=$row1->list_view; $list_value=$row1->list_value; }} @endphp @foreach ($list as $list) @php {{ if ($list->$list_value==$data->$Field){ $search=$list->$list_view; echo $search; }}} @endphp @endforeach @endif @php {{echo '"';}} @endphp@php {{echo ',';}} @endphp @else @php {{ if(ucwords($head)=='Student Information') {$loc='studentImage';}else{ $loc='stuffImage';} }} @endphp "<img style=\"width:80px; height:100px\" src=\"{{url('/')}}/userFiles/{{session('client_id')}}/{{$loc}}/{{$data->IMAGE}}\"> ", @endif @endforeach @php {{echo  '],';}} @endphp@endforeach
];




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
    data: dataSet1,
orderCellsTop: true,
fixedHeader: true,
"scrollY": 400,
"scrollX": true,
"order": [[ 0, "desc" ]],


dom: 'Bfrtip',
lengthMenu: [
[ 10, 25, 50, -1 ],
[ '10 rows', '25 rows', '50 rows', 'Show all' ]
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
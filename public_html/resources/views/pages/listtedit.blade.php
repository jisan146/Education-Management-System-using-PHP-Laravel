@extends('layouts.masterPage')
@section('content')
<div style="margin-top: 10px; width: 1600px; overflow: scroll;">
    <div class="row justify-content-center" style="margin-left: 15px;">
        <div >
            <div >
                <div class="card-header">{{ucwords($head)}}</div>
                 <div  style="margin-top: 10px; width: 1600px; overflow: scroll;">
                    
                    <form  class="needs-validation was-validated" novalidate   method="POST" action="{{url('/listedit/')}}/{{$head}}/y">
                        {{csrf_field()}}
                    
                    
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
                            <button style="float: right;" class="btn btn-primary " type="submit" id="submit" name="submit"  value="submit">submit</button>
                            </form>
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<script type="text/javascript" language="javascript" class="init">
    function chk(a,b)
    {
        if (a<=b) {
 
                    }
                    else{
                        @php
    {{
        if (ucwords($head)=='Result') {echo "alert('please check input mark');";}
    }} @endphp
                        
                    }
    }
var dataSet1 = 
[
@php
    {{$uidg=0;$chkval='EM'.session('exam_no');$chkvalo="0";
    }}
    @endphp
@foreach ($data as $data)@php {{ $uidg=$uidg+1;}} @endphp[@foreach($row as $row1) @php {{$Field=$row1->column_name;}} @endphp   @if ($row1->relation_with=='')@php if ($row1->link_with!=''){echo '"';}else{echo '"';}  {{echo '<input type=\"hidden\" id=\"sl['.$uidg.']\" name=\"sl['.$uidg.']\" value=\"'.$uidg.'\">'; $type; if (strtolower($row1->input_type)=='file') {$type='text';}else{$type=$row1->input_type;} if(ucwords($head)=='Result' && ($Field=='uid' || $Field=='USER_ID'|| $Field=='EM'.session('exam_no')))   {$chkvalo=$data->$chkval; echo '<input style=\" width:100%\" type=\"hidden\" id=\"'.$Field.$uidg.'\" name=\"'.$Field.$uidg.'\" value=\"'.$data->$Field.'\"> <br> <font color=\"black\">';echo $data->$Field.'</font>';} else {echo '<input onchange=\"chk(this.value,'.$chkvalo.')\" style=\" width:100%\" type=\"'.$type.'\" id=\"'.$Field.$uidg.'\" name=\"'.$Field.$uidg.'\" value=\"'.$data->$Field.'\"> <br> <font color=\"white\">';echo $data->$Field.'</font>';}} } @endphp  @else " @php {{ $list=DB::select('SELECT '.$row1->list_view.','.$row1->list_value.' FROM '.$row1->relation_with.' where client_id in(0,'.session('client_id').') and branch in (9,'.session('branch').')'); $list_view=$row1->list_view; $list_value=$row1->list_value;}}@endphp @php {{echo '<select  id=\"'.$Field.$uidg.'\"   name=\"'.$Field.$uidg.'\"';  if ($row1->is_nullable=='NO') {echo 'required';} echo '>'; foreach ($list as $list){echo '<option  value=\"'.$list->$list_value.'\"';if ($list->$list_value==$data->$Field){echo 'selected ';}echo 'label=\"'.$list->$list_view.'\"></option>';if ($list->$list_value==$data->$Field){$search=$list->$list_view;} } echo('</select>'); echo '<br> <font color=\"white\">'.$search.'</font>';}} @endphp @endif @php {{echo '"';}} @endphp@php {{echo ',';}} @endphp @endforeach @php {{echo  '],';}} @endphp@endforeach
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
@if (session('result')=='1')
"order": [[ 0, "asc" ]],
@else
"order": [[ 0, "desc" ]],
@endif



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
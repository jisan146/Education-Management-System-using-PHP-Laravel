@extends('layouts.masterPage')
@section('content')
<div style="margin-top: 10px; width: 1600px; overflow: scroll;">
    <div class="row justify-content-center">
        <div >
            <div >
                <div class="card-header">{{session('h')}}'s Payment Information</div>
                <div  style="margin-top: 10px; width: 1600px; overflow: scroll;">
                    
                    
                    
                    
                    <table id="example" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>{{session('hs')}}</th>
                                 <th>Phone</th>
                                <th>Name</th>
                               
                                 <th>{{session('hd')}}</th>
                                @foreach ($data as $data)
                                <th>{{$data->DESCRIPTION}}</th>
                                <th>{{$data->DESCRIPTION}} Due</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                               
                                 @foreach ($row1 as $row2)

                                <tr>
                                    <td>{{$row2->STUDENT_ID}}</td> 
                                    <td>{{$row2->s_phone}}</td>
                                    <td>{{$row2->name}}</td> 
                                    <td>{{$row2->class}}</td>                                  
                                    @foreach ($data2 as $data6)
                                    @php
                                    {{$Field='a'.$data6->SL;}}
                                    {{$Field1='d'.$data6->SL;}}
                                    @endphp

                                    <td>
                                        {{$row2->$Field}}
                                       
                                    </td>
                                    <td>
                                        {{$row2->$Field1}}
                                       
                                    </td>
                                    @endforeach
                                    
                                </tr>
                                @endforeach
                                
                                
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{session('hs')}}</th>
                                <th>Phone</th>
                                <th>Name</th>

                                 <th>{{session('hd')}}</th>
                                @foreach ($data1 as $data1)
                                <th>{{$data1->DESCRIPTION}}</th>
                                <th>{{$data1->DESCRIPTION}} Due</th>
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
@extends('layouts.masterPage')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="margin-left: -15px;">
            <div class="card">
                <div class="card-header">{{ucwords($head)}}</div>
                <div  style="margin-top: 10px">
                    
                    
                    
                    
                    <table id="example" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                @foreach ($col0 as $col0)
                                <th>{{$col0->english}}</th>
                                    @endforeach
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $data)
                                <tr>
                                    @foreach ($row as $row1)
                                    @php
                                    {{$Field=$row1->column_name;}}
                                    @endphp
                                    <td>
                                        
                                        @if ($row1->link_with!='')
                                         <a href="{{url('report_print')}}/{{strtolower(str_replace(' ', '_', $row1->link_with))}}/{{$data->$Field}}" target="_blank"><i class="fas fa-print"></i></a>
                                        @endif
                                        @if ($row1->relation_with=='')
                                        {{$data->$Field}}
                                        @else
                                        @php
                                        {{
                                            $list=DB::select('SELECT '.$row1->list_view.','.$row1->list_value.' FROM '.$row1->relation_with.' where client_id in (0,'.session('client_id').') and branch in (9,'.session('branch').')');
                                            $list_view=$row1->list_view;
                                            $list_value=$row1->list_value;
                                        }}
                                        @endphp
                                        @foreach ($list as $list)
                                        @php
                                        {{
                                        if ($list->$list_value==$data->$Field){
                                            $search=$list->$list_view;
                                            echo $search;
                                        }
                                        
                                        }}
                                        @endphp
                                         @endforeach
                                        
                                        @endif
                                    </td>
                                    @endforeach
                                    
                                </tr>
                                @endforeach
                                
                                
                                
                            </tbody>
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
                    return 'test';
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
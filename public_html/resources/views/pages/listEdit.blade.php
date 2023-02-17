@extends('layouts.masterPage')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="margin-left: -15px;">
            <div class="card">
                <div class="card-header">{{ucwords($head)}}</div>
                <div style="margin-top: 10px">
                    <form  class="needs-validation was-validated" novalidate   method="POST" action="{{url('/listedit/')}}/{{$head}}/y">
                        {{csrf_field()}}
                        
                        
                        
                        <table id="example" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    @php
                                    {{$uidg=0;
                                    }}
                                    @endphp
                                    @foreach ($col0 as $col0)
                                    <th>{{$col0->english}}
                                        @endforeach</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                    @php
                                    {{ $uidg=$uidg+1;
                                    }}
                                    @endphp
                                    
                                    <tr>
                                        @foreach ($row as $row1)
                                        @php
                                        {{$Field=$row1->column_name;
                                        
                                        
                                        }}
                                        @endphp
                                        <td>
                                            <input type="hidden" id="sl[{{$uidg}}]" name="sl[{{$uidg}}]" value="{{$uidg}}">
                                            @if ($row1->relation_with=='')
                                            <input type="text" id="{{$Field}}{{$uidg}}" name="{{$Field}}{{$uidg}}" value="{{$data->$Field}}" >
                                            <br> <font color="white">{{$data->$Field}}</font>
                                            @else
                                            @php
                                            {{
                                            $list=DB::select('SELECT '.$row1->list_view.','.$row1->list_value.' FROM '.$row1->relation_with.' where client_id in(0,'.session('client_id').') and branch in (9,'.session('branch').')');
                                            $list_view=$row1->list_view;
                                            $list_value=$row1->list_value;
                                            }}
                                            @endphp
                                            <select  id="{{$Field}}{{$uidg}}"   name="{{$Field}}{{$uidg}}" @if ($row1->is_nullable=='NO') required @endif >
                                                @foreach ($list as $list)
                                                <option  value="{{$list->$list_value}}"
                                                    @if ($list->$list_value==$data->$Field)
                                                    selected
                                                    @endif

                                                    label="{{$list->$list_view}}"
                                                    >
                                                    
                                                    
                                                </option>
                                                @php
                                                {{
                                                if ($list->$list_value==$data->$Field){
                                                $search=$list->$list_view;}
                                                
                                                }}
                                                @endphp
                                                @endforeach
                                            </select>
                                            
                                            <br> <font color="white">{{$search}}</font>
                                            
                                            
                                            @endif
                                        </td>
                                        @endforeach
                                        
                                    </tr>
                                    @endforeach
                                    
                                    
                                    
                                </tbody>
                                <tfoot>
                                <tr>
                                    @foreach ($col1 as $col1)
                                    <th>{{$col1->english}}
                                        @endforeach</th>
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
        "order": [[ 0, "desc" ]]
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
@extends('layouts.masterPage')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10" style="margin-left: -15px;">
            <div class="card">
                <div class="card-header">{{ucwords($head)}}</div>
                <div style="margin-top: 10px">
                    <form class="needs-validation was-validated" novalidate method="POST" action="{{url('/register/')}}/{{$head}}" enctype="multipart/form-data">
                        @include('partial.error')
                        {{csrf_field()}}
                        
                        
                        @foreach ($data as $data)
                            @if ($data->column_key!='PRI'and $data->column_key!='UNI')
                                
                            
                             @if ($data->input_type!='hidden')
                            <div class="form-group row">     
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{$data->english}}</label>
                             @endif   
                                <div class="col-md-6">
                                    @if ($data->relation_with=='')
                                        
                                    
                                    <input id="{{$data->column_name}}" type="{{$data->input_type}}" class="form-control" name="{{$data->column_name}}"  autofocus @if ($data->is_nullable=='NO') required @endif
                                     @if ($data->value=='client_id') value ="{{session('client_id')}}" @elseif ($data->value=='branch') value ="{{session('branch')}}" @else value ="{{$data->value}}" @endif 
                                    
                                    >

                                    @else
                                    @php 
                                    {{
                                        $list=DB::select('SELECT '.$data->list_view.','.$data->list_value.' FROM '.$data->relation_with.' where client_id in (0,'.session('client_id').') and branch in (9,'.session('branch').')');
                                        $list_view=$data->list_view;
                                        $list_value=$data->list_value;
                                    }}
                                    @endphp
                                    <select  id="{{$data->column_name}}" class="form-control" name="{{$data->column_name}}" @if ($data->is_nullable=='NO') required @endif >
                                        @foreach ($list as $list)
                                            <option value="{{$list->$list_value}}">{{$list->$list_view}}</option>
                                        @endforeach    
                                    </select>
                                    @endif
                                </div>
                            @if ($data->input_type!='hidden')
                            </div>
                            @endif

                            @endif
                        @endforeach
                        
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                
                                <button id="submit" name="submit"  value="submit" type="submit" class="btn btn-primary btn-block">
                                Register
                                </button>
                                
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
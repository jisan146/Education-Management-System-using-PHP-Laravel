@extends('layouts.masterPage')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-left: -15px;">
            <div class="card" >
                <div class="card-header">Profile</div>
                <div style="margin-top: 10px">
                    <form  class="needs-validation was-validated" novalidate  method="POST" action="{{url('/active_branch')}}">
                        {{csrf_field()}}
                        
                        
                        @foreach ($data as $data)
                            {{-- expr --}}
                        @endforeach
                       
                            <img class="card-img-top" src="{{url('/')}}/userFiles/{{$data->CLIENT_ID}}/stuffImage/{{$data->IMAGE}}" alt="Card image" style="width:30%;">
                            <div class="card-body">
                                <h4 class="card-title">{{$data->NAME}}</h4>
                                
                                <select onchange="this.form.submit()" id="branch" class="form-control" name="branch" >
                                        @foreach ($data1 as $data1)
                                            <option @if ($data1->sl==(session('branch')))selected  @endif value="{{$data1->sl}}">{{$data1->branch}}</option>
                                        @endforeach    
                                    </select>
                            </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
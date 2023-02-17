@extends('layouts.masterPage')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-left: -15px;">
            <div class="card">
                <div class="card-header">Installation Status</div>
                <div style="margin-top: 10px">
                    <form method="POST" action="{{url('/login')}}">
                        {{csrf_field()}}
                        
                        
                        
                        @include('partial.error')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.masterPage')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-left: -15px;">
            <div class="card">
                <div class="card-header">Card Registration</div>
                <div style="margin-top: 10px">
                    <form class="needs-validation was-validated" novalidate   method="POST" action="{{url('/cardReg')}}">
                        {{csrf_field()}}
                        
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">User ID</label>
                            <div class="col-md-6">
                                <input id="user_id" type="text" class="form-control" name="user_id"  autofocus required="">
                                
                            </div>
                        </div>

                        
                        
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                
                                <button id="submit" name="submit"  value="submit" type="submit"  class="btn btn-primary btn-block">
                                Submit
                                </button>
                                
                            </div>
                        </div>
                        @include('partial.error')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
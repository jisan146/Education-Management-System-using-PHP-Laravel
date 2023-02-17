@extends('layouts.masterPage')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-left: -15px;">
            <div class="card">
                <div class="card-header">Change Password</div>
                <div style="margin-top: 10px">
                    <form onsubmit="return checkForm(this);" class="needs-validation was-validated" novalidate   method="POST" action="{{url('/chpw')}}">
                        {{csrf_field()}}
                        
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Current Password</label>
                            <div class="col-md-6">
                                <input id="username" type="password" class="form-control" name="username"  autofocus required="">
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">New Password</label>
                            <div class="col-md-6">
                                <input id="pwd1" type="password" class="form-control" name="pwd1"  autofocus required="">
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="pwd2" type="password" class="form-control" name="pwd2"  autofocus required="">
                                
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
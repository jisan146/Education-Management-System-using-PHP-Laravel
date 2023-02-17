@extends('layouts.masterPage')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-left: -15px;">
            <div class="card">
                <div class="card-header">Revenue Report Print</div>
                <div style="margin-top: 10px">
                    <form class="needs-validation was-validated" novalidate   method="POST" action="{{url('/revenuePrint')}}">
                        {{csrf_field()}}
                        
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Start Date
                            </label>
                            <div class="col-md-6">
                                <input id="sdate" type="date" class="form-control" name="sdate"  autofocus required=""
                                @if (session('dreset')!=0)
                                    value="{{session('dp2')}}" 
                                @endif
                                >
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">End Date</label>
                            <div class="col-md-6">
                                <input id="edate" type="date" class="form-control" name="edate"  autofocus required=""

                                @if (session('dreset')!=0)
                                    value="{{session('dp3')}}" 
                                @endif
                                >
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Print Type</label>
                            <div class="col-md-6">
                                <select  id="pt" class="form-control" name="pt"  required  >
                                    <option selected value="1">PDF</option>
                                    <option  value="2">RTF</option>
                                            
                                    </select>
                                
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
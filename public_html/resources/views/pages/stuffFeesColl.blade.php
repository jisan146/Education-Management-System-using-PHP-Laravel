@extends('layouts.masterPage')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10" style="margin-left: -15px;">
            <div class="card">
                <div class="card-header">Stuff's Fees Collection</div>
                <div style="margin-top: 10px">
                    <form class="needs-validation was-validated" novalidate   autocomplete="off" method="POST" action="{{url('/stdFeesColl')}}">
                        {{csrf_field()}}
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Stuff's ID</label>
                            <div class="col-md-4">
                                <input id="user_id" list="list" type="text" class="form-control" name="user_id"  autofocus required="" @if (session('std_fee_uid')!=0)
                                    value="{{session('std_fee_uid')}}" 
                                @endif>
                                <datalist id="list">
                                @foreach ($data as $data)
                                <option label="{{$data->data}}" value="{{$data->sl}}">
                                    @endforeach
                                    
                                    
                                    </datalist>
                                </div>
                                <div class="col-md-2">
                                    <button id="get_fee1"  name="get_fee1"  value="get_fee1" type="submit" class="btn btn-primary btn-block">
                                    Get Name
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Stuff Info</label>
                            <div class="col-md-6">
                                <input id="std"  type="Text" class="form-control" name="std"   
                                readonly="" value="{{session('stuff_info')}}" 
                                >
                                
                                </div>
                            </div>
                             @if (session('client_id')=='15')
                                {{-- expr --}}
                            
                            <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Transfer Date</label>
                            <div class="col-md-6">
                                <input id="tdate" list="list" type="date" class="form-control" name="tdate"   required="" @if (session('std_fee_tdate')!=0)
                                    value="{{session('std_fee_tdate')}}" 
                                @endif>
                                
                                </div>
                            </div>
                            @endif
                            <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">Total Fees (TK)</label>
                            <div class="col-md-2">
                                <input id="fees"   type="text"  readonly class="form-control" name="fees"   >
                                
                                </div>
                            
                            <label for="email" class="col-md-2 col-form-label text-md-right">Total Paid (TK)</label>
                            <div class="col-md-2">
                                <input id="total"   type="text"  readonly class="form-control" name="total"   >
                                
                                </div>

                                <label for="email" class="col-md-2 col-form-label text-md-right">Total Due (TK)</label>
                            <div class="col-md-2">
                                <input id="due"   type="text"  readonly class="form-control" name="due"   >
                                
                                </div>
                            </div>
                            <div style="height: 400px; overflow-y: scroll;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col" style="width: 350px;" >Select Salary</th>
                                            <th scope="col">Stuff Salary</th>
                                            <th scope="col">Paid Amount</th>
                                            <th scope="col">Due Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        {{$sl=0;}}
                                        @endphp
                                        @for ($i = 0; $i <20 ; $i++)
                                        @php
                                        {{$sl=$sl+1;}}
                                        @endphp
                                        <tr>
                                            <td>{{$sl}}<input id="sub_sl[{{$sl}}]"  type="hidden" class="form-control" name="sub_sl[{{$sl}}]"></td>
                                            <td>
                                                <select  id="sector{{$sl}}" class="form-control" name="sector{{$sl}}" >
                                                    <option ></option>
                                                    @foreach ($fees as $f)
                                                    
                                                    <option value="{{$f->sl}}">{{$f->description}}</option>
                                                    @endforeach
                                                </select>
                                                
                                            </td>

                                            <td ><input required value="0" onkeyup="totalTK()" onfocus="this.value=''" id="fees{{$sl}}"  type="number" class="form-control " name="fees{{$sl}}"></td>
                                            
                                            <td><input required value="0" onkeyup="totalTK(); due{{$sl}}.value=fees{{$sl}}.value-ammount{{$sl}}.value" onfocus="this.value=''" id="ammount{{$sl}}"  type="number" class="form-control" name="ammount{{$sl}}"></td>

                                            <td><input  value="0"   id="due{{$sl}}"  type="number" class="form-control-plaintext" name="due{{$sl}}"></td>
                                        </tr>
                                        @endfor
                                        
                                    </tbody>
                                </table>
                            </div>

                           
                            
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    
                                    <button id="submit" name="submit"  value="submit" type="submit" class="btn btn-primary btn-block">
                                    Submit
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
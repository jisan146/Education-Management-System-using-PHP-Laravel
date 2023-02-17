@extends('layouts.masterPage')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11" style="margin-left: -15px;">
            <div class="card">
                <div class="card-header">Account Entry</div>
                <div style="margin-top: 10px">
                    <form class="needs-validation was-validated" novalidate   autocomplete="off" method="POST" action="{{url('/accCollr')}}">
                        {{csrf_field()}}
                        
                        <div class="form-group row">
                            
                            <div class="col-md-6">
                                <input id="user_id" list="list" type="hidden" class="form-control" name="user_id"  autofocus >
                                <datalist id="list">
                                @foreach ($data as $data)
                                <option label="{{$data->data}}" value="{{$data->sl}}">
                                    @endforeach
                                    
                                    
                                    </datalist>
                                </div>
                            </div>
                             @if (session('client_id')=='15')
                                {{-- expr --}}
                            
                            <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Transfer Date</label>
                            <div class="col-md-6">
                                <input id="tdate" list="list" type="date" class="form-control" name="tdate"   required="">
                                
                                </div>
                            </div>
                            @endif
                            <div class="form-group row">
                           
                            
                            <label for="email" class="col-md-2 col-form-label text-md-right">Total Amount (TK)</label>
                            <div class="col-md-4">
                                <input id="total"   type="text"  readonly class="form-control" name="total"   >
                                
                                </div>

                               
                            </div>
                            <div style="height: 400px; overflow-y: scroll;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col" style="width: 250px;" >Select Sector</th>
                                            <th scope="col" style="width: 300px;" >Description</th>
                                           
                                            <th scope="col">Paid Amount</th>
                                          
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
                                                <select onchange="description{{$sl}}.required=true;" id="sector{{$sl}}" class="form-control" name="sector{{$sl}}" >
                                                    <option ></option>
                                                    @foreach ($fees as $f)
                                                    
                                                    <option value="{{$f->sl}}">{{$f->description}}</option>
                                                    @endforeach
                                                </select>
                                                
                                            </td>
                                            <td><input    id="description{{$sl}}"  type="text" class="form-control " name="description{{$sl}}"></td>

                                           
                                            
                                            <td><input required value="0" onkeyup="totalTK(); due{{$sl}}.value=fees{{$sl}}.value-ammount{{$sl}}.value" onfocus="this.value=''" id="ammount{{$sl}}"  type="number" class="form-control" name="ammount{{$sl}}">

                                                    <input required value="0" onkeyup="totalTK()" onfocus="this.value=''" id="fees{{$sl}}"  type="hidden" class="form-control " name="fees{{$sl}}">

                                                    <input  value="0"   id="due{{$sl}}"  type="hidden" class="form-control-plaintext" name="due{{$sl}}">

                                            </td>

                                          
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
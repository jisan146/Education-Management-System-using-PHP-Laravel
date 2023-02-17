@extends('layouts.masterPage')
@section('content') 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="margin-left: -15px;">
            <div class="card">
                <div class="card-header">Student's Fees Collection</div>
                <div style="margin-top: 10px">
                    <form  class="needs-validation was-validated" novalidate   autocomplete="off" method="POST" action="{{url('/stdFeesColl')}}">
                        {{csrf_field()}}
                        
                        <div class="form-group row">
                            <label  for="email" class="col-md-4 col-form-label text-md-right">Student's ID</label>
                            
                            <div class="col-md-4">
                                <input   id="user_id" list="list" type="text" class="form-control" name="user_id"  autofocus required=""

                                @if (session('std_fee_uid')!=0)
                                    value="{{session('std_fee_uid')}}" 
                                @endif
                                >
                                <datalist id="list">
                                @foreach ($data as $data)
                                <option label="{{$data->data}}" value="{{$data->sl}}">
                                    @endforeach
                                    
                                    
                                    </datalist>
                                </div>
                                 <div class="col-md-2">
                                    <button id="get_fee"  name="get_fee"  value="get_fee" type="submit" class="btn btn-primary btn-block">
                                    Set Fee
                                    </button>
                                </div>
                            </div>

                             <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Student Info</label>
                            <div class="col-md-6">
                                <input id="std"  type="Text" class="form-control" name="std"   
                                readonly="" value="{{session('std_info')}}" 
                                >
                                
                                </div>
                            </div>
                            @if (session('client_id')=='15')
                                {{-- expr --}}
                            
                            <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Transfer Date</label>
                            <div class="col-md-6">
                                <input id="tdate" list="list" type="date" class="form-control" name="tdate"   required=""
                                @if (session('std_fee_tdate')!=0)
                                    value="{{session('std_fee_tdate')}}" 
                                @endif
                                >
                                
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

@if (session('std_fee_tdate')!=0)
                            <div style="height: 200px; overflow-y: scroll;">
                                <table id="example" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>{{session('hs')}}</th>
                                <th>Name</th>
                                 <th>{{session('hd')}}</th>
                                @foreach ($datan as $data)
                                <th>{{$data->DESCRIPTION}}</th>
                                <th>{{$data->DESCRIPTION}} Due</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                               
                                 @foreach ($row1n as $row2)

                                <tr>
                                    <td>{{$row2->STUDENT_ID}}</td> 
                                    <td>{{$row2->name}}</td> 
                                    <td>{{$row2->class}}</td>                                  
                                    @foreach ($data2n as $data6)
                                    @php
                                    {{$Field='a'.$data6->SL;}}
                                    {{$Field1='d'.$data6->SL;}}
                                    @endphp

                                    <td>
                                        {{$row2->$Field}}
                                       
                                    </td>
                                    <td>
                                        {{$row2->$Field1}}
                                       
                                    </td>
                                    @endforeach
                                    
                                </tr>
                                @endforeach
                                
                                
                            </tbody>
 
                            </table>
                            </div>
                            @endif
                            <div style="height: 400px; overflow-y: scroll;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col" style="width: 220px;">Fee Type</th>
                                            <th scope="col" style="width: 300px;" >Select Fees</th>
                                            <th scope="col">Student Fees</th>
                                            <th scope="col">Paid Ammount</th>
                                            <th scope="col">Due Ammount</th>
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
                                                
                                                <select onchange="fees{{$sl}}.value=this.value;ammount{{$sl}}.value=this.value;totalTK();" id="tf{{$sl}}" class="form-control" name="tf{{$sl}}" >
                                                    <option ></option>
                                                    @foreach ($tfee as $tf)
                                                    
                                                    <option value="{{$tf->fees}}">{{$tf->description}}</option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td>
                                                <select  id="sector{{$sl}}" class="form-control" name="sector{{$sl}}" >
                                                    <option ></option>
                                                    @foreach ($fees as $f)
                                                    
                                                    <option value="{{$f->sl}}">{{$f->description}}</option>
                                                    @endforeach
                                                </select>
                                                
                                            </td>

                                            <td ><input required value="0" onkeyup="totalTK()"  id="fees{{$sl}}"  type="number" class="form-control " name="fees{{$sl}}"></td>
                                            
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
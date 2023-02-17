@extends('layouts.masterPage')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11" style="margin-left: -15px;">
            <div class="card">
                <div class="card-header">Result Entry</div>
                <div style="margin-top: 10px">
                    <form class="needs-validation was-validated" novalidate   method="POST" action="{{url('/resultEntry')}}">
                        {{csrf_field()}}


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Individual ID
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="id_" id="id_" required="" value="0" class="form-control">
                                
                            </div>
                            
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Select Class
                            </label>
                            <div class="col-md-4">
                                <select  id="class" class="form-control" name="class"  required  >
                                    @php
                                    {{
                                    $class=DB::select('select sl,class from class where client_id=? and branch=?',[session('client_id'),session('branch')]);}}
                                    @endphp
                                    @foreach ($class as $element)
                                    <option @if ($element->sl==session('class')) selected @endif value="{{$element->sl}}">{{$element->class}}</option>
                                    @endforeach
                                    
                                    
                                </select>
                                
                            </div>
                            <div class="col-md-2">
                                <button id="get" name="get"  value="get" type="submit" class="btn btn-primary btn-block">
                                Set
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subjectsubject" class="col-md-4 col-form-label text-md-right">Select Exam</label>
                            <div class="col-md-4">
                                <select  id="exam_name" class="form-control" name="exam_name"    >
                                    @php
                                    {{
                                    $class=DB::select('select exam_name subject,exam_no sl from exam_name where client_id=? and branch=? and class=?',[session('client_id'),session('branch'),session('class')]);}}
                                    @endphp
                                    @foreach ($class as $element)
                                    <option  value="{{$element->sl}}">{{$element->subject}}</option>
                                    @endforeach
                                    
                                    
                                </select>
                                
                            </div>
                            <div class="col-md-2">
                                <button id="admit" name="admit"  value="admit" type="submit" class="btn btn-primary btn-block">
                                Get Admit
                                </button>
                            </div>
                            
                        </div>
                        
                        <div class="form-group row">
                            <label for="subjectsubject" class="col-md-4 col-form-label text-md-right">Select Subject</label>
                            <div class="col-md-4">
                                <select  id="subject" class="form-control" name="subject"    >
                                    @php
                                    {{
                                    $class=DB::select('select subject,sl from subject where client_id=? and branch=? and class=?',[session('client_id'),session('branch'),session('class')]);}}
                                    @endphp
                                    @foreach ($class as $element)
                                    <option  value="{{$element->sl}}">{{$element->subject}}</option>
                                    @endforeach
                                    
                                    
                                </select>
                                
                            </div>
                            <div class="col-md-2">
                                <button id="entry" name="entry"  value="entry" type="submit" class="btn btn-primary btn-block">
                                Result Entry
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            
                            <label for="subjectsubject" class="col-md-4 col-form-label text-md-right">Year</label>
                            <div class="col-md-4">
                                <select  id="year" class="form-control" name="year"    >
                                    
                                    
                                    <option selected  value="20">2020</option>
                                    <option  value="19">2019</option>

                                   
                                    
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            
                            <label for="subjectsubject" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-4">
                                <button id="rsms" name="rsms"  value="rsms" type="submit" class="btn btn-primary btn-block">
                                Result SMS
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            
                            <label for="subjectsubject" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-4">
                                <button id="mlt" name="mlt"  value="mlt" type="submit" class="btn btn-primary btn-block">
                                Merit List Print
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="subjectsubject" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-4">
                                <button id="rcp" name="rcp"  value="rcp" type="submit" class="btn btn-primary btn-block">
                                Result Card Print
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
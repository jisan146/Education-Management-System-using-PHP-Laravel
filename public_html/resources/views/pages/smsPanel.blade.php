@extends('layouts.masterPage')
@section('content')
<script language="JavaScript">
function toggle(source) {
var checkboxes = document.querySelectorAll('input[type="checkbox"]');
for (var i = 0; i < checkboxes.length; i++) {
if (checkboxes[i] != source)
checkboxes[i].checked = source.checked;
}
}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-left: -15px;">
            <div class="card">
                <div class="card-header">Send SMS to Student</div>
                
                <div style="margin-top: 10px">
                    <form class="needs-validation was-validated" novalidate   method="POST" action="{{url('/smsPanel')}}/{{session('smstbl')}}">
                        {{csrf_field()}}
                        
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" onclick="toggle(this);" /> Select</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                {{$sl=0;
                                if (session('smstbl')=='student_information') {
                                $data=DB::Select('select sl,class from class where client_id=? and branch=? order by sl',[session('client_id'),session('branch')]);
                                
                                }else{
                                $data=DB::Select('select sl,designation class from designation where client_id=? and branch=? order by sl',[session('client_id'),session('branch')]);
                                }
                                
                                }}
                                @endphp
                                @foreach ($data as $element)
                                @php
                                {{$sl=$sl+1;}}
                                @endphp
                                
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label><input name="class[{{$sl}}]" id="class{{$sl}}" type="checkbox" value="{{$element->sl}}"> {{$element->class}}</label>
                                        </div>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
<div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">ID / Phone</label>
                            <div class="col-md-4">
                                 <input id="phone" type="text" class="form-control" name="phone"  autofocus >
                                
                                
                                
                            </div>
                            <div class="col-md-2">
                                
                                <button id="submit1" name="submit1"  value="submit1" type="submit"  class="btn btn-primary btn-block">
                                Send
                                </button>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Message</label>
                            <div class="col-md-6">
                                <textarea id="msg"  class="form-control" name="msg"  autofocus required rows="4" cols="50"></textarea>
                                
                                
                                
                            </div>
                        </div>
                        

                        
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                
                                <button id="submit" name="submit"  value="submit" type="submit"  class="btn btn-primary btn-block">
                                Send
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
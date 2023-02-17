@if ($errors->any())

    <div class="alert alert-danger">
    	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('login')=='0')
 <div class="alert alert-success">
    	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>
        	Login Success !!!
        </p>
    </div>
@elseif (session('login')=='n')
 <div class="alert alert-danger">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>
            Login Fail !!!!!
        </p>
    </div>

@endif

@if (session('install')=='y')
@php
    {{session()->forget('install');}}
@endphp
 <div class="alert alert-success">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>
            Total Created Columns {{session('meta')}} | Successfully Interface Generated for {{session('data')}}
        </p>
    </div>
@endif 

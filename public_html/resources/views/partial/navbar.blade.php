<nav class="navbar navbar-expand-xl bg-success navbar-dark fixed-top">
  <a class="navbar-brand" href="{{url('/home')}}">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button> 


  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ">
      
      @if (session('login')=='y')
        <li class="nav-item nav-item active">
        <a class="nav-link" href="{{url('/')}}">My Profile</a>
      </li>
      @endif
      
      @php
      {{
      $mainMenu=DB::select('select distinct m.menu menu,p.menu id from application_menu_pages p,application_menu m,application_pages ap where p.menu=m.id and ap.id=p.submenu and role=?',[session('page_role')]);
      }}
      @endphp
      @foreach ($mainMenu as $element)
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{$element->menu}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @php
          {{
          $subMenu=DB::select('select m.menu menu,p.menu id,ap.submenu submenu,url from application_menu_pages p,application_menu m,application_pages ap where p.menu=m.id and ap.id=p.submenu and role=? and p.menu=?',[session('page_role'),$element->id]);
          }}
          @endphp
          @foreach ($subMenu as $element)
          <a class="dropdown-item" href="{{url('/')}}{{$element->url}}">{{$element->submenu}}</a>
           @endforeach
          
        </div>
      </li>
      @endforeach
      @if (session('login')=='y')
       
      @if (session('user')=='99')
      <li class="nav-item dropdown active">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Update Software
        </a>
        <div class="dropdown-menu pre-scrollable" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="http://jismbd.com/listedit/application_item_lebel/y">Update Software</a>
           <a class="dropdown-item" href="http://jismbd.com/report_update/-1">Update Report</a>
        </div>
      </li>
      
       <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          My Clients
        </a>
        <div class="dropdown-menu pre-scrollable" aria-labelledby="navbarDropdown">
          
          @php
          {{
          $ccl=DB::select('select CLIENT_ID,INSTITUTE from client_information order by CLIENT_ID');
          }}
          @endphp
          
          @foreach ($ccl as $element)
            <a class="dropdown-item" href="{{url('/lc')}}/{{$element->CLIENT_ID}}">{{$element->CLIENT_ID}}&nbsp;&nbsp;{{$element->INSTITUTE}}</a>
          @endforeach
          
          
          
        </div>
      </li>

   

    <li class="nav-item dropdown active">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          File Server
        </a>
        <div class="dropdown-menu pre-scrollable" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="{{url('/ftp')}}">Upload</a>
           <a class="dropdown-item" href="{{url('/')}}/list/ftp">Download</a>
        </div>
      </li>


      @endif
      <li class="nav-item nav-item active">
        <a class="nav-link" href="{{url('/login')}}">Log Out</a>
      </li>
      @else
      <li class="nav-item nav-item active">
        <a class="nav-link" href="{{url('/login')}}">Login</a>
      </li>

      
      @endif

      
      
      
    </ul>
  </div>
</nav>







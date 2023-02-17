<!DOCTYPE html>
<html>
<head>
@include('links.stylesheet')
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;

}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
@font-face {
    font-family: myFirstFont;
    src: url(/assets/kalpurush.ttf);
  font-weight: 500;
}




h4 {
    font-family:myFirstFont;

}

h3 {
    font-family:myFirstFont;

}

h6 {
    font-family:myFirstFont;

}

h5 {
    font-family:myFirstFont;

}


p {
    font-family:myFirstFont;
  
}

a {
    font-family:myFirstFont;
  
}

li{
    font-family:myFirstFont;
  
} 
</style>


</head>
<body>
@foreach ($data as $key)
 

<h2 style="text-align:center">{{$s}}</h2>

<div class="card">
  <img src="{{url('/')}}/userFiles/{{$key->client_id}}/{{$i}}/{{$key->image}}" alt="{{$key->name}}" style="width:100%;">
  <h4>{{$key->name}}</h4>
  <p class="title">{{$key->tittle}}</p>
  <h5>{{$key->institute}}</h5>
  <p class="title">Website : <a href="http://{{$key->domain}}">{{$key->domain}}</a></p>
  <div style="margin: 24px 0;">
    <a href="#"><i class="fab fa-dribbble"></i></a> 
    <a href="#"><i class="fab fa-twitter"></i></a>  
    <a href="#"><i class="fab fa-linkedin"></i></a>  
    <a href="#"><i class="fab fa-facebook"></i></a> 
  </div>
  <p><button>Contact</button></p>
</div>
@endforeach
</body>
</html>

<!DOCTYPE html>
<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>{{session('institute')}}</title>
		<link rel="icon" href="{{url('/')}}/userFiles/{{session('client_id')}}/webFile/logo.jpg" type="image/gif" sizes="32x32">
		
		
		
		@include('links.stylesheet')
	</head>
	<body background="{{asset('assets/backGround.jpg')}}">
		@include('partial.navbar')
		
		
		<div class="margin-top-20" style="overflow: hidden;">
			@if (session('login')=='y')
			{{-- expr --}}
			<!--<marquee><h2 ><font style="font-family:myFirstFont;color:blue;">সু-খবর ! সু-খবর ! দেশব্যাপী সফটওয়্যার ডিলার নিয়োগ চলছে !!!</font><font style="font-family:myFirstFont;color:red;"> জানুয়ারি মাসের বিল পরিশোধ করার জন্য অনুরোধ করা যাচ্ছে।</font><font style="font-family:myFirstFont;color:green;"> কিস্তিতে নিয়ে নিন আপনার মাদ্রাসার জন্য অত্যাধুনিক তার বিহীন ফিঙ্গার প্রিন্ট এটেন্ডেন্স ডিভাইস।</font></h2></marquee>-->
			@endif
			<div class="row" style="margin-left: 5px;">
				
				
				@yield('content')
			</div>

			@if (session('login')=='y')
			{{-- expr --}}
			<!--<marquee><h2 ><font style="font-family:myFirstFont;color:green;"> কিস্তিতে নিয়ে নিন আপনার মাদ্রাসার জন্য অত্যাধুনিক তার বিহীন ফিঙ্গার প্রিন্ট এটেন্ডেন্স ডিভাইস।</font><font style="font-family:myFirstFont;color:red;"> জানুয়ারি মাসের বিল পরিশোধ করার জন্য অনুরোধ করা যাচ্ছে।</font><font style="font-family:myFirstFont;color:blue;">সু-খবর ! সু-খবর ! দেশব্যাপী সফটওয়্যার ডিলার নিয়োগ চলছে !!!</font></h2></marquee>-->
			@endif
		</div>
		<!-- Footer -->
		<footer class="page-footer font-small stylish-color-dark pt-4">
			<!--
			
			<div class="container text-center text-md-left">
					
					<div class="row">
							
							<div class="col-md-4 mx-auto">
									
									<h5 class="font-weight-bold text-uppercase mt-3 mb-4">Footer Content</h5>
									<p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
											consectetur
									adipisicing elit.</p>
							</div>
							
							<hr class="clearfix w-100 d-md-none">
							
							<div class="col-md-2 mx-auto">
									
									<h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>
									<ul class="list-unstyled">
											<li>
													<a href="#!">Link 1</a>
											</li>
											<li>
													<a href="#!">Link 2</a>
											</li>
											<li>
													<a href="#!">Link 3</a>
											</li>
											<li>
													<a href="#!">Link 4</a>
											</li>
									</ul>
							</div>
							
							<hr class="clearfix w-100 d-md-none">
							
							<div class="col-md-2 mx-auto">
									
									<h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>
									<ul class="list-unstyled">
											<li>
													<a href="#!">Link 1</a>
											</li>
											<li>
													<a href="#!">Link 2</a>
											</li>
											<li>
													<a href="#!">Link 3</a>
											</li>
											<li>
													<a href="#!">Link 4</a>
											</li>
									</ul>
							</div>
							
							<hr class="clearfix w-100 d-md-none">
							
							<div class="col-md-2 mx-auto">
									
									<h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>
									<ul class="list-unstyled">
											<li>
													<a href="#!">Link 1</a>
											</li>
											<li>
													<a href="#!">Link 2</a>
											</li>
											<li>
													<a href="#!">Link 3</a>
											</li>
											<li>
													<a href="#!">Link 4</a>
											</li>
									</ul>
							</div>
							
					</div>
					
			</div>
			
			<hr>
			<ul class="list-unstyled list-inline text-center py-2">
					<li class="list-inline-item">
							<h5 class="mb-1">About Developer</h5>
					</li>
					<li class="list-inline-item">
							<a href="#!" class="btn btn-danger btn-rounded">View !</a>
					</li>
			</ul>
			<hr>
			<ul class="list-unstyled list-inline text-center">
					<li class="list-inline-item">
							<a class="btn-floating btn-fb mx-1">
									<i class="fab fa-facebook-f"> </i>
							</a>
					</li>
					<li class="list-inline-item">
							<a class="btn-floating btn-tw mx-1">
									<i class="fab fa-twitter"> </i>
							</a>
					</li>
					<li class="list-inline-item">
							<a class="btn-floating btn-gplus mx-1">
									<i class="fab fa-google-plus-g"> </i>
							</a>
					</li>
					<li class="list-inline-item">
							<a class="btn-floating btn-li mx-1">
									<i class="fab fa-linkedin-in"> </i>
							</a>
					</li>
					<li class="list-inline-item">
							<a class="btn-floating btn-dribbble mx-1">
									<i class="fab fa-dribbble"> </i>
							</a>
					</li>
			</ul>
			-->
			<!-- Copyright -->
			<hr>
			<div class="footer-copyright text-center py-3">
				<h6>Powered By
				<a href="https://paybuybd.com/" target="_blank">PaybuyBD</a></h6>
			</div>
			<!-- Copyright -->
		</footer>
		<!-- Footer -->
		
		@include('links.scripts')
		<script>
		function totalTK() {
		//var x = document.getElementById("total");
		var tk = 0;
		var fees = 0;
		
		
		for (i = 1; i <= 20; i++) {
			var n="ammount"+i;
			var f="fees"+i;
		tk=tk+Number(document.getElementById(n).value);
		fees=fees+Number(document.getElementById(f).value);
		}
		document.getElementById("total").value = tk;
		document.getElementById("fees").value = fees;
		document.getElementById("due").value = fees-tk;
		
		
		
		}
		</script>
		<script >
		
		$('li.dropdown').hover(function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(0).fadeIn(0);
		}, function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(0).fadeOut(200);
		});


		function checkForm(form)
  {
    if(form.username.value == "") {
      //alert("Error: Username cannot be blank!");
      form.username.focus();
      return true;
    }
    re = /^\w+$/;
    if(!re.test(form.username.value)) {
      //alert("Error: Username must contain only letters, numbers and underscores!");
      form.username.focus();
      return true;
    }

    if(form.pwd1.value != "" && form.pwd1.value == form.pwd2.value) {
      if(form.pwd1.value.length < 6) {
        alert("Error: Password must contain at least six characters!");
        form.pwd1.focus();
        return false;
      }
      if(form.pwd1.value == form.username.value) {
        alert("Error: Password must be different from Current Password!");
        form.pwd1.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(form.pwd1.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        form.pwd1.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(form.pwd1.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        form.pwd1.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(form.pwd1.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        form.pwd1.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form.pwd1.focus();
      return false;
    }

   // alert("You entered a valid password: " + form.pwd1.value);
    return true;
  }
		</script>
	</body>
</html>
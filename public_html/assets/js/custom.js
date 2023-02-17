





function fin()
{
	if (document.getElementById("fs").value=="Self") 
	{
document.getElementById("fs").required = false;
document.getElementById("fs_file1").required = false;
document.getElementById("fs_file2").required = false;
document.getElementById("fs_name").required = false;
document.getElementById("fs_address").required = false;
document.getElementById("fs_ammount").required = false;
	}else{
		document.getElementById("fs").required = true;
document.getElementById("fs_file1").required = true;
document.getElementById("fs_file2").required = true;
document.getElementById("fs_name").required = true;
document.getElementById("fs_address").required = true;
document.getElementById("fs_ammount").required = true;

	}
}

function eap()
{
	document.getElementById("id").style.visibility = "visible";
	document.getElementById("snhl").style.visibility = "visible";
	document.getElementById("snh").style.visibility = "hidden";
	document.getElementById("sp").style.visibility = "visible";
	document.getElementById("sn").style.visibility = "hidden";
}

function myFunction22()
{
	if(document.getElementById("institute_before").checked==true)
	{
		document.getElementById("institute_before1").checked=false;
		document.getElementById("institute_before").value=1;
		document.getElementById("institute_before1").required = false;

		document.getElementById("marksheet").required = true;
		document.getElementById("marksheet").style.visibility = "visible";
		document.getElementById("gp").required = true;
		document.getElementById("gp").style.visibility = "visible";
		document.getElementById("course_complete").required = true;
		document.getElementById("course_complete").style.visibility = "visible";
		document.getElementById("institute_before_name").required = true;
		document.getElementById("institute_before_name").style.visibility = "visible";

	    document.getElementById("marksheet1").required = true;
		document.getElementById("marksheet1").style.visibility = "visible";
		document.getElementById("gp1").required = true;
		document.getElementById("gp1").style.visibility = "visible";
		document.getElementById("course_complete1").required = true;
		document.getElementById("course_complete1").style.visibility = "visible";
		document.getElementById("institute_before_name1").required = true;
		document.getElementById("institute_before_name1").style.visibility = "visible";
		document.getElementById("marksheet2").style.visibility = "visible";
	}
	else
	{
		document.getElementById("institute_before1").required = true;
		document.getElementById("institute_before").required = true;
	}
}
function myFunction33()
{
	if(document.getElementById("institute_before1").checked==true)
	{
		document.getElementById("institute_before").checked=false;
		document.getElementById("institute_before").value=0;
		document.getElementById("institute_before").required = false;

		document.getElementById("marksheet").required = false;
		document.getElementById("marksheet").style.visibility = "hidden";
		document.getElementById("gp").required = false;
		document.getElementById("gp").style.visibility = "hidden";
		document.getElementById("course_complete").required = false;
		document.getElementById("course_complete").style.visibility = "hidden";
		document.getElementById("institute_before_name").required = false;
		document.getElementById("institute_before_name").style.visibility = "hidden";

		document.getElementById("marksheet1").required = false;
		document.getElementById("marksheet1").style.visibility = "hidden";
		document.getElementById("gp1").required = false;
		document.getElementById("gp1").style.visibility = "hidden";
		document.getElementById("course_complete1").required = false;
		document.getElementById("course_complete1").style.visibility = "hidden";
		document.getElementById("institute_before_name1").required = false;
		document.getElementById("institute_before_name1").style.visibility = "hidden";
		document.getElementById("marksheet2").style.visibility = "hidden";

		
		document.getElementById("gp").value = "";
		document.getElementById("course_complete").value = "";
		document.getElementById("institute_before_name").value = "";
		document.getElementById("marksheet").value = "";





	}
	else
	{
		document.getElementById("institute_before").required = true;
		document.getElementById("institute_before1").required = true;
	}
}



function myFunction2()
{
	if(document.getElementById("bangladeshi").checked==true)
	{
		document.getElementById("bangladeshi1").checked=false;
		document.getElementById("bangladeshi").value=1;
		document.getElementById("bangladeshi1").required = false;
	}
	else
	{
		document.getElementById("bangladeshi1").required = true;
		document.getElementById("bangladeshi").required = true;
	}
}
function myFunction3()
{
	if(document.getElementById("bangladeshi1").checked==true)
	{
		document.getElementById("bangladeshi").checked=false;
		document.getElementById("bangladeshi").value=0;
		document.getElementById("bangladeshi").required = false;
	}
	else
	{
		document.getElementById("bangladeshi").required = true;
		document.getElementById("bangladeshi1").required = true;
	}
}


function myFunction() {
	document.getElementById("house1").value = document.getElementById("house").value;
	document.getElementById("city1").value = document.getElementById("city").value;
	document.getElementById("state1").value = document.getElementById("state").value;
	document.getElementById("country1").value = document.getElementById("country").value;
	document.getElementById("post1").value = document.getElementById("post").value;
}




(function() {
	'use strict';
	window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
	form.addEventListener('submit', function(event) {
		if (form.checkValidity() === false) {
			event.preventDefault();
			event.stopPropagation();
		}
		form.classList.add('was-validated');
	}, false);
});
}, false);
})();




function ValidateSize(file) {
        var FileSize = file.files[0].size / 1024 ;
        
        // in MB
        if (FileSize > 900) {
        
           document.getElementById("image").value = "";
           document.getElementById("image").required = true;
           // $(file).val(''); //for clearing with Jquery
        } else {
        ValidateSingleInput(file);

        }
    }

var _validFileExtensions = [".jpg", ".jpeg", ];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
               document.getElementById("image").value = "";
               document.getElementById("image").required = true;
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}


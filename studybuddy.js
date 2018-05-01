function submitCreateAccount() 
{
	// Incomplete Form validation that checks create account form
	var username = document.getElementById("username");
	var pass = document.getElementById("password");
	var email = document.getElementById("email");
	var firstname = document.getElementById("firstname");
	var lastname = document.getElementById("lastname");
	
	var numOfErrors = 0;
		
	var checkUsernameAndPassword = new RegExp(/^[a-zA-Z0-9]{8,20}$/); // input can only have, uppercase letters, lowercase letters, digits, and 8-20 characters 
	var checkFirstAndLastName = new RegExp(/^[a-zA-Z]+$/); // input can only have, uppercase letters and lowercase letters 	
	// reg ex to check if an email is valid
	var checkEmail = new RegExp
	(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/); 

	
	if (checkUsernameAndPassword.test(username.value) == false)
	{	
		document.getElementById("usernamelabel").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i> Must contain at least 8 characters with letters or digits only ".fontcolor("red");
		numOfErrors++;
	}
	else
		document.getElementById("usernamelabel").innerHTML = "";
	
	if (checkUsernameAndPassword.test(pass.value) == false)
	{			
		document.getElementById("passwordlabel").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i> Must contain at least 8 characters with letters or digits only ".fontcolor("red");
		numOfErrors++;
	}
	else
		document.getElementById("passwordlabel").innerHTML = "";
	
	
	if (checkEmail.test(email.value) == false)
	{
		document.getElementById("emaillabel").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i> There is some invalid input in your email. Example email \"example123@email.com\"".fontcolor("red");
		numOfErrors++;
	}
	else
		document.getElementById("emaillabel").innerHTML = "";
	
	if (checkFirstAndLastName.test(firstname.value) == false)
	{
		document.getElementById("firstnamelabel").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i> Must contain letters only".fontcolor("red");
		numOfErrors++;
	}
	else
		document.getElementById("firstnamelabel").innerHTML = "";
	
	
	if (checkFirstAndLastName.test(lastname.value) == false)
	{
		document.getElementById("lastnamelabel").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i> Must contain letters only".fontcolor("red");
		numOfErrors++;
	}
	else
		document.getElementById("lastnamelabel").innerHTML = "";
	
	
	if(numOfErrors == 0)
		document.createaccountform.submit();
			
	
}



function submitEditProfileForm() 
{
	
	// Form validation that checks edit profile form
	var firstname = document.getElementById("firstname");
	var lastname = document.getElementById("lastname");
	var email = document.getElementById("email");
	var empleID = document.getElementById("empleID");
	var major = document.getElementById("major");
	
	
	var numOfErrors = 0;
		
	var checkFirstAndLastName = new RegExp(/^[a-zA-Z]{1,25}$/); // input can only have, uppercase letters and lowercase letters and atleast 1-25 length	
	var checkMajor = new RegExp(/^[a-z A-Z]{0,25}$/);
	var checkEmpleID = new RegExp(/^[0-9]{0,8}$/);
	// reg ex to check if an email is valid
	var checkEmail = new RegExp
	(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/); 

		
	if (checkEmail.test(email.value) == false)
	{	
		document.getElementById("emaillabel").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i> There is some invalid input in your email. Example email 'example123@email.com'".fontcolor("red");	
		numOfErrors++;	
	}
	else
		document.getElementById("emaillabel").innerHTML = "";
	
	
	if (checkFirstAndLastName.test(firstname.value) == false)
	{
		document.getElementById("firstnamelabel").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i> Must contain letters only".fontcolor("red");
		numOfErrors++;
	}
	else
		document.getElementById("firstnamelabel").innerHTML = "";
	
	
	if (checkFirstAndLastName.test(lastname.value) == false)
	{
		document.getElementById("lastnamelabel").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i> Must contain letters only".fontcolor("red");
		numOfErrors++;
	}
	else
		document.getElementById("lastnamelabel").innerHTML = "";
	
	
	if (checkEmpleID.test(empleID.value) == false)
	{
		document.getElementById("emplelabel").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i> Must contain digits only".fontcolor("red");
		numOfErrors++;
	}
	else
		document.getElementById("emplelabel").innerHTML = "";
	
	
	if (checkMajor.test(major.value) == false)
	{
		document.getElementById("majorlabel").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i> Must contain letters only".fontcolor("red");
		numOfErrors++;
	}
	else
		document.getElementById("majorlabel").innerHTML = "";
	
	
	if(numOfErrors == 0)
		document.editprofileform.submit();
	
	
}
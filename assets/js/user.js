$(function(){

	$("#loginForm").on('submit' , function(e){
		e.preventDefault();

		const email = document.getElementById('loginemail').value.trim();
		const psw = document.getElementById('loginpsw').value.trim();

		if(uname != '' && psw !=''){
			const val = 1;
		}

		if(val = 1){

			$.ajax({
				type: 'post',
				url: "assets/php/login.php",
				data: {'email':email ,'psw':psw},
				success: function (res) {
					if(res == -1){
						alert("Incorrect Details. Please CHECK!");
					}
					else {

						alert("Logged in succesfully");
						location.reload();
					}
				}
			  });

		}

	});
	$(".cancelbtn2").on("click",function(e){
		const email = document.getElementById('loginemail');
		const password = document.getElementById('loginpsw');

		email.value="";
		password.value="";
		document.getElementById('loginModal').style.display='none'

});







	$("#signupForm").on('submit',function(e){
			e.preventDefault();
			
			const username = document.getElementById('uname');
			const email = document.getElementById('email');
			const password = document.getElementById('psw');
			const password2 = document.getElementById('psw-repeat');
			const mobile = document.getElementById('mobileNo');
			const country = document.getElementById('country');
			const state = document.getElementById('state');
			const city = document.getElementById('city');
			const langPref = document.getElementById('language');
			const signupBtn = document.getElementById('signupSubmit');
			

			const usernameValue = username.value.trim();
			const emailValue = email.value.trim();
			const passwordValue = password.value.trim();
			const password2Value = password2.value.trim();
			const mobileValue = mobile.value.trim();
			const countryValue = country.value.trim();
			const stateValue = state.value.trim();
			const cityValue = city.value.trim();
			const langValue = langPref.value.trim();
			var correct=1;
	
			if(usernameValue === '') {
				setErrorFor(username, 'Username cannot be blank');
				correct=0;
			}else if(usernameValue.length < 8) {
				setErrorFor(username, 'Minimum length is 8 characters')
				correct = 0;
			} else {
				setSuccessFor(username);
			}
	
			if(emailValue === '') {
				setErrorFor(email, 'Email cannot be blank');
				correct=0;
			} else if (!isEmail(emailValue)) {
				setErrorFor(email, 'Not a valid email');
				correct=0;
			} else {
				setSuccessFor(email);
			}

			if(mobileValue === '') {
				setErrorFor(mobile, 'Mobile number cannot be blank');
				correct=0;
			}else if(mobileValue.length < 10) {
				setErrorFor(mobile, 'Minimum length is 10 numbers')
				correct = 0;
			} else {
				setSuccessFor(mobile);
			}

			if(countryValue === '') {
				setErrorFor(country, 'Country cannot be blank');
				correct=0;
			} else {
				setSuccessFor(country);
			}

			if(stateValue === '') {
				setErrorFor(state, 'State cannot be blank');
				correct=0;
			} else {
				setSuccessFor(state);
			}

			if(cityValue === '') {
				setErrorFor(city, 'City cannot be blank');
				correct=0;
			} else {
				setSuccessFor(city);
			}

			if(langValue === '') {
				setErrorFor(langPref, 'Language Preference cannot be blank');
				correct=0;
			} else {
				setSuccessFor(langPref);
			}

			
			if(passwordValue === '') {
				setErrorFor(password, 'Password cannot be blank');
				correct=0;
			} else {
				setSuccessFor(password);
			}
	
			if(password2Value === '') {
				setErrorFor(password2, 'Password2 cannot be blank');
				correct=0;
			} else if(passwordValue !== password2Value) {
				setErrorFor(password2, 'Passwords does not match');
				correct=0;
			} else{
				setSuccessFor(password2);
			}

			

			function setErrorFor(input, message) {
				const formControl = input.parentElement;
				const small = formControl.querySelector('small');
				formControl.className = 'modalcontainer1 error';
				small.innerText = message;
				
			}
			
			function setSuccessFor(input) {
				const formControl = input.parentElement;
				formControl.className = 'modalcontainer1 success';
			}
				
			function isEmail(email) {
				return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
			}


			if(correct == 1){
				$.ajax({
					type: 'post',
					url: "assets/php/signup.php",
					data: {'uname':usernameValue,'email':emailValue,'psw':passwordValue, 'mob':mobileValue, 'country':countryValue, 'state': stateValue, 'city':cityValue , 'langPref':langValue},
					success: function (res) {

						//alert(res);
						
						if(res == 1){
							$(".cancelbtn1").click();
							alert("Signed up successfully");

						}
						else if(res == -1){
							alert("User Email / Username /Mobile number already REGISTERED!");
						}
					}
				  });
	
			}
	});

	

	$(".cancelbtn1").on("click",function(e){
			const username = document.getElementById('uname');
			const email = document.getElementById('email');
			const password = document.getElementById('psw');
			const password2 = document.getElementById('psw-repeat');
			const mobile = document.getElementById('mobileNo');
			const country = document.getElementById('country');
			const state = document.getElementById('state');
			const city = document.getElementById('city');
			const langPref = document.getElementById('language');
			
			username.value="";
			email.value="";
			password.value="";
			password2.value="";
			mobile.value = "";
			country.value = "";
			state.value = "";
			city.value = "";
			langPref.value = "";
			$(".modalcontainer1").removeClass("error");
			$(".modalcontainer1").removeClass("success");

			document.getElementsByClassName('modalcontainer1').className='modalcontainer1';
			document.getElementById('signupModal').style.display='none';
			

	});

	$("#logout").on("click",function(e){

		$.ajax({
			type: 'post',
			url: "assets/php/logout.php",
			data: {},
			success: function (res) {
				alert(res);
				location.reload();
			}        
		});
		
	})
	



  });
















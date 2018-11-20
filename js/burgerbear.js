function chkcardNumber(event) {
  var cardNum = event.currentTarget;
  var pos = cardNum.value.search(/^[\d]{16}$/);

  if (pos != 0) {
    alert("The card number you entered (" + cardNum.value+
      ") is not in the correct form. \n" +
      "The correct field should contains 16 digits without space.");
    cardNum.focus();
    cardNum.select();
  return false;
  }
}

function chkcardExpiry(event) {
  var cardNum = event.currentTarget;
  var pos = cardNum.value.search(/^[\d]{2}\/[\d]{2}$/);

  if (pos != 0) {
    alert("The card expiry date you entered (" + cardNum.value+
      ") is not in the correct form. \n" +
      "The correct field should be: MM/YY");
    cardNum.focus();
    cardNum.select();
  return false;
  }
}


function chkCVC(event) {
  var cardNum = event.currentTarget;
  var pos = cardNum.value.search(/^[\d]{3}$/);

  if (pos != 0) {
    alert("The card CVC you entered (" + cardNum.value+
      ") is not in the correct form. \n" +
      "The correct field should be exactly 3 digits.");
    cardNum.focus();
    cardNum.select();
  return false;
  }
}


function chkcardName(event) {
  var cardNum = event.currentTarget;
  var pos = cardNum.value.search(/^[A-Z]+$/);

  if (pos != 0) {
    alert("The card number you entered (" + cardNum.value+
      ") is not in the correct form. \n" +
      "The correct field should be all UPPER CASE LETTERS.");
    cardNum.focus();
    cardNum.select();
  return false;
  }
}







function chkemail(event) {
  var emailname = event.currentTarget;
  var pos = emailname.value.search(/^(.+)+@(.+\.)*[A-Za-z]{2,6}$/);

  if (pos != 0) {
    alert("The email you entered (" + emailname.value+
      ") is not in the correct form. \n" +
      "The correct email field should contains a user name following by '@' " +
      " and a domain name part. \n" +
      "The domain name can contains many address extensions seperated by a period" +
      " with the last extension be 2-6 letters.");
    emailname.focus();
    emailname.select();
  return false;
  }
}



function chkpassword(event) {
  var password = event.currentTarget;
  var pos = password.value.search(/^(?=.*[A-Z])(?=.*\d)(.){8,20}$/);

  if (pos != 0) {
    alert("The password you entered (" + password.value+
      ") is not in the correct form. \n" +
      "Password must be 8-20 characters with at least 1 upper case letter and 1 numeric digit.");
    password.focus();
    password.select();
  return false;
  }
}



function chkphone(event) {
  var phonenum = event.currentTarget;
  var pos = phonenum.value.search(/^[\d]{8}$/);

  if (pos != 0) {
    alert("The mobile number you entered (" + phonenum.value+
      ") is not in the correct form. \n" +
      "The correct form should be 8 digits only.");
    phonenum.focus();
    phonenum.select();
  return false;
  }
}




function chkboth() {
  var firstemail = document.getElementsByName("email");
  var secondemail = document.getElementsByName("email2");
  var firstpass = document.getElementsByName("password");
  var secondpass = document.getElementsByName("password2");
  if (firstemail.value == "") {
    alert("You did not enter a email \n" +
          "Please enter one now");
    firstemail.focus();
    return false;
  }

  if (firstpass.value == "") {
    alert("You did not enter a email \n" +
          "Please enter one now");
    firstpass.focus();
    return false;
  }

  if (firstemail.value != secondemail.value) {
    alert("The two emails you entered are not the same \n" +
          "Please re-enter both.\n Thanks you very much.");
    init.focus();
    init.select();
    return false;
  } 

  else if (firstpass.value != secondemail.value) {
    alert("The two passwords you entered are not the same \n" +
          "Please re-enter both.\n Thanks you very much.");
    init.focus();
    init.select();
    return false;
  } else
    return true;
}






function updateMenuColor(){

	var url = window.location.href;
 	var result =gup('category',url);

 	if(result==null){
 		return;
 	}

 	document.getElementById("menu_"+result).style.color = "#e71b23";
}

function gup( name, url ) {
    if (!url) url = location.href;
    name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    var regexS = "[\\?&]"+name+"=([^&#]*)";
    var regex = new RegExp( regexS );
    var results = regex.exec( url );
    return results == null ? null : results[1];
}
    
// Next/previous controls
function nextSlide() {
  showSlides(slideIndex += 1);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; 
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block"; 
  dots[slideIndex-1].className += " active";
}

function showOverlay(name,self){
document.getElementById(name).style.opacity = '0.5';
document.getElementById(name).style.zIndex  = '1000';
}

function closeOverlay(name){
document.getElementById(name).style.opacity = '0';
document.getElementById(name).style.zIndex  = '0';
}








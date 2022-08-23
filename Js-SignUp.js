const imgDiv = document.querySelector('.profile-pic-div');
const img = document.querySelector('#photo');
const file = document.querySelector('#file');
const email = document.querySelector('#email');
const btn = document.querySelector('.btn');
const fname = document.querySelector('#fname');
const lname = document.querySelector('#lname');
const phone = document.querySelector('#phone');
const pass = document.querySelector('#pass');
const gender = document.querySelector('#gender');
const submitbtn = document.querySelector('.btnsubmit');
file.addEventListener('change', function(){
    const choosedFile = this.files[0];

    if (choosedFile) {

        const reader = new FileReader(); 

        reader.addEventListener('load', function(){
            img.setAttribute('src', reader.result);
        });

        reader.readAsDataURL(choosedFile);

    }
});



function validateInput(){
   
    var passLength = pass.value;
    var phoneLength = phone.value;
    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)))
    {
  
     errorMSG("emailError","You have entered an invalid email address!");
     
    }
    if ((/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)))
    {
  
     errorMSG("emailError","");
     
    }
    
    if(!(/[a-zA-Z]/.test(pass.value)))
    {
      errorMSG("passError","Password must contain at least one letter and it must be of length 8!");
      
    }
    if((/[a-zA-Z]/.test(pass.value)))
    {
      errorMSG("passError","");
      
    }
    if((passLength.length<8))
    {
      errorMSG("passError","Password must contain at least one letter and it must be of length 8!");
       
    }
      if(!(passLength.length<8))
    {
      errorMSG("passError","");
       
    }
  
    if(!(phoneLength.length<10))
    {
     errorMSG("PhoneError","");
       
    }
     if(!(/^[0-9]*$/.test(phone.value)))
    {
     errorMSG("PhoneError","Phone number must contain digits only and must be of length 10!");
    
    }
     if((/^[0-9]*$/.test(phone.value)))
    {
     errorMSG("PhoneError","");
    
    }
    if((phoneLength.length<10))
    {
     errorMSG("PhoneError","Phone number must contain digits only and must be of length 10!");
    }
    if(!(/^[a-zA-Z]*$/.test(fname.value)))
    {
      errorMSG("fnameError","First Name must contain letters only!");
    
    }
    if((/^[a-zA-Z]*$/.test(fname.value)))
    {
      errorMSG("fnameError","");
    
    }
    if(!(/^[a-zA-Z]*$/.test(lname.value)))
    {
       errorMSG("lnameError","Last Name must contain letters only!");
       
    }
    if((/^[a-zA-Z]*$/.test(lname.value)))
    {
       errorMSG("lnameError","");
       
    }
     if((!(/^[a-zA-Z]*$/.test(lname.value))) || (!(/^[a-zA-Z]*$/.test(fname.value))) || (!(/^[0-9]*$/.test(phone.value))) || ((phoneLength.length<10)) || ((passLength.length<8)) || (!(/[a-zA-Z]/.test(pass.value))) || (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))))
    return false;
 
}
function errorMSG(id,value){
  document.getElementById(id).innerText=value;


}
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#pass');

togglePassword.addEventListener('click', function (e) {
  // toggle the type attribute
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);
  // toggle the eye slash icon
  this.classList.toggle('fa-eye-slash');
});
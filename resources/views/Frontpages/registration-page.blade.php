@include('layout.app')
    <div class="container">
      <form method="POST" class="form" action="/user-registration" enctype="multipart/form-data" >
        @csrf
        <h2>Register Form!</h2>
        <div class="form-control">
          <label for="email">Email</label>
          <input id="email" type="text" name="email" placeholder="Enter email" />
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="firstName">FirstName</label>
          <input id="firstName" type="text" name="firstName" placeholder="Enter FirstName" />
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="lastName">lastName</label>
          <input id="lastName" type="text" name="lastName" placeholder="Enter LastName" />
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="mobile">Mobile</label>
          <input id="mobile" type="text" name="mobile" placeholder="Enter Mobile" />
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <input id="password" type="password" name="password" placeholder="Enter password" />
          <small>Error message</small>
        </div>
        <button type="submit">Submit</button> 
      </form>
    </div>

{{-- <script>
 async function onRegistration() {
  let email=document.getElementById('email').value;
  let firstName=document.getElementById('firstName').value;
  let lastName=document.getElementById('lastName').value;
  let mobile=document.getElementById('mobile').value;
  let password=document.getElementById('password').value;

  if(email.length===0){
    errorToast('Email is Required')
  }
  else if(firstName.length===0){
    errorToast('FirstName is Required')
  }
  else if(lastName.length===0){
    errorToast('LastName is Required')
  }
  else if(mobile.length===0){
    errorToast('Mobile is Required')
  }
  else if(password.length===0){
    errorToast('Password is Required')
  }
  else{
    let res=await axios.post('/user-registration',{
      email:email,
      firstName:firstName,
      lastName:lastName,
      mobile:mobile,
      password:password
    })
    if(res.status===200 && res.data['status']==='Success'){
      successToast(res.data['message']);
      setTimeout(function(){
        window.location.href='/userLogin'
      },2000)

     else {
      errorToast('Register is Success')
     }

    }
  }
}


</script> --}}
 


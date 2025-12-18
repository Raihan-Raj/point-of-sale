@include('layout.app')
      <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg border-0" style="max-width: 420px; width: 100%;">
        <div class="card-body p-4">

            <!-- Header -->
            <div class="text-center mb-4">
                <h3 class="fw-bold">Create Account</h3>
                <p class="text-muted mb-0">Register to continue</p>
            </div>

            <!-- Form -->
            <form>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input
                        id="email"
                        type="email"
                        class="form-control"
                        placeholder="Enter email"
                    />
                </div>

                <!-- First Name -->
                <br>
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input
                        id="firstName"
                        type="text"
                        class="form-control"
                        placeholder="Enter first name"
                    />
                </div>

                <!-- Last Name -->
                <br>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input
                        id="lastName"
                        type="text"
                        class="form-control"
                        placeholder="Enter last name"
                    />
                </div>

                <!-- Mobile -->
                <br>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile Number</label>
                    <input
                        id="mobile"
                        type="text"
                        class="form-control"
                        placeholder="01XXXXXXXXX"
                    />
                </div>

                <!-- Password -->
                <br>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input
                        id="password"
                        type="password"
                        class="form-control"
                        placeholder="Enter password"
                    />
                </div>

                <!-- Submit Button -->
                <br>
                <div class="d-grid">
                    <button
                        type="button"
                        onclick="onRegistration()"
                        class="btn btn-primary btn-lg"
                    >
                        Register
                    </button>
                </div>

                <!-- Footer -->

                <div class="text-center mt-3">
                    <small class="text-muted">
                        Already have an account?
                        <a href="/userLogin" class="text-decoration-none fw-semibold">
                            Login
                        </a>
                    </small>
                </div>

            </form>
        </div>
    </div>
</div>

  

<script>
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
    if(res.status===200 && res.data['status']==='success'){
      successToast(res.data['message']);
      setTimeout(function(){
      },2000)
    }
     else {
      successToast('Register is Success')
      window.location.href='/userLogin'
     }
  }
}


</script>
 


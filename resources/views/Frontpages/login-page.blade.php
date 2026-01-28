@extends('layout.app')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 420px;">
        
        <!-- Header -->
        <div class="text-center mb-4">
            <h2>Company <span class="text-primary">Name</span></h2>
            <p class="text-muted">company slogan</p>
        </div>
        <!-- Form -->
        <form>
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    id="email"
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                    autofocus
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <br>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    id="password"
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
<br>
            <!-- Submit -->
            <div class="d-grid mb-3">
                <button type="button" onclick="submitLogin()" class="btn btn-primary">
                    Login
                </button>
            </div>

            <!-- Links -->
            <div class="text-center mb-2">
                <a href="/sendOtp" class="text-decoration-none">
                    Forgot Your Password?
                </a>
            </div>

            <div class="text-center">
                Don’t have an account?
                <a href="/userRegistration" class="fw-semibold text-decoration-none">
                    Sign Up Now
                </a>
            </div>

        </form>
    </div>
</div>

<script>
      async function submitLogin(){
        let email=document.getElementById('email').value;
         let password=document.getElementById('password').value;
        if(email.length===0){
            errorToast("Email is required");
        }else if(password.length===0){
            errorToast("password is required")
        }else{
       let res=await axios.post("/user-login",{email:email, password:password});
      if(res.status===200 && res.data['status']==='success'){
      window.location.href="/dashboard";
    }else{
     errorToast(res.data['message']);
   }
     }
  }
</script>
   


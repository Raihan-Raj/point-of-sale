@include('layout.app')
    <div class="logcover">
        <div class="login-card">
            <div class="login-card-content">
                <div class="header">
                    <div class="logo">
                    </div>
                    <h2>Company<span class="highlight">Name</span></h2>
                    <h3>company slogan</h3>
                </div>
                <form method="POST" action="/user-login" enctype="multipart/form-data">
                    @csrf
                    <div class="form-field email">
                        <div class="icon">
                            <i class="far fa-user"></i>
                        </div>
                        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    <br>
                    <div class="form-field password">
                        <div class="icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input id="password" type="password" placeholder="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary logbtn">
                        {{ __('Login') }}
                    </button>
            </div>
            <div>      
                <a class="btn btn-link" href="forget/password">
                    Forgot Your Password? 
                </a>  
            </div>
            <div>
                Don't have an account? <a href="/register">Sign Up Now</a>
            </div>
            </form>
        </div>

    </div>

    <script>
      async function submitLogin(){
        let email=document.getElementById('email'),value;
         let password=document.getElementById('password'),value;
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
   


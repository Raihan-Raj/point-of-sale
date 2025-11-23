@include('layout.app')
    <div class="container">
                <div class="header">
                    <div class="logo">
                    </div>
                    <h2>Company<span class="highlight">Name</span></h2>
                    <h3>company slogan</h3>
                </div>
                <form method="POST" class="form" action="/user-login" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control email">
                        <div class="icon">
                            <i class="far fa-user"></i>
                        </div>
                        <input id="email" type="email" placeholder="Email" class="@error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    <br>
                    <div class="form-control password">
                        <div class="icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input id="password" type="password" placeholder="password"
                            class="@error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                    </div>
                    <br>
                 <button type="submit">Submit</button>    
            <div>      
                <a class="btn btn-link" href="/send-otp">
                    Forgot Your Password? 
                </a>  
            </div>
            <div>
                Don't have an account? <a href="/userRegistration">Sign Up Now</a>
            </div>
            </form>
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
   


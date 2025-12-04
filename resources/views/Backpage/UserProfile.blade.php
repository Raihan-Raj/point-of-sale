@include('layout.app')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card animated fadeIn w-100 p-4">
                <div class="card-body">
                    <h4> User Profile Update </h4>
                    <br>
                    <label>Email</label>
                    <input id="email" readonly type="text" name="email" placeholder="Enter email" />
                     <br>
                     <label>FirstName</label>
                    <input id="firstName" type="text" name="firstName" placeholder="Enter FirstName" />
                     <br>
                     <label>lastName</label>
                    <input id="lastName" type="text" name="lastName" placeholder="Enter LastName" />
                     <br>
                     <label>Mobile</label>
                    <input id="mobile" type="text" name="mobile" placeholder="Enter Mobile" />
                     <br>
                     <label>Password</label>
                    <input id="password" type="password" name="password" placeholder="Enter password" />
                     <br>
                     <button onclick="onUpdate()" class="btn w-100 btn-primary">Update</button>
                </div>
           </div>
        </div>
    </div>
</div>

{{-- start get profile --}}
<script>
getProfile();
async function getProfile(){
    let res=await axios.get('/user-profile')
    if(res.status===200 && res.data['status']==='success'){
        let data=res.data['data'];
        document.getElementById('email').value=data['email'];
        document.getElementById('firstName').value=data['firstName'];
        document.getElementById('lastName').value=data['lastName'];
        document.getElementById('mobile').value=data['mobile'];
        document.getElementById('password').value=data['password'];
    }
    else{
        errorToast(res.data['message']);
    }

}

</script>
{{-- end get profile --}}


 <script>
 async function onUpdate() {
  let firstName=document.getElementById('firstName').value;
  let lastName=document.getElementById('lastName').value;
  let mobile=document.getElementById('mobile').value;
  let password=document.getElementById('password').value;

   if(firstName.length===0){
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
    let res=await axios.post('/user-update',{
      firstName:firstName,
      lastName:lastName,
      mobile:mobile,
      password:password
    })
    if(res.status===200 && res.data['status']==='success'){
      successToast(res.data['message']);
     await getProfile();
    }
     else {
      errorToast(res.data['message']);
     }

    }
  }

</script>  
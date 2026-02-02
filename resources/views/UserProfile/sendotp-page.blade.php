@include('layout.app')
<div class="">
	<div class="container__item">
		<card class="form__field">
			<input id="email" placeholder="Your E-Mail Address" type="email" />
			<button onclick="VerifyEmail()" class="btn btn--primary btn--inside uppercase">Send</button>
		</card>
	</div>
<br>
	<div class="container__item container__item--bottom">
		<p>Inspired by <a href="" target="_blank">Mohammad R@JU</a>.</p>
	</div>
</div>

<script>
   async function VerifyEmail(){
        let email = document.getElementById('email').value;
        if(email.length === 0){
            errorToast('please enter your email Address')
        }
        else{
           let res = await axios.post('/send-otp', {email:email});
           if(res.status === 200 && res.data['status']==='success'){
            successToast(res.data['message'])
           sessionStorage.setItem('email',email);
            setTimeout(function(){
                window.location.href = '/verifyOtp';
            }, 1000)
           }
           else{
            errorToast(res.data['message']) 
           }
        }
    }
</script>
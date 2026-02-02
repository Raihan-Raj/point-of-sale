
@include('layout.app')
<div class="">
	<div class="container__item">
		<card class="form__field">
			<input id="otp" placeholder="Code" type="text" />
			<button onclick="VerifyOtp()" class="btn btn--primary btn--inside uppercase">Send</button>
		</card>
	</div>
<br>
	<div class="container__item container__item--bottom">
		<p>Inspired by <a href="" target="_blank">Mohammad R@JU</a>.</p>
	</div>
</div>

<script>
	async function VerifyOtp(){
		let otp = document.getElementById('otp').value;
		if(otp.length !== 4){
			errorToast('Invalid Otp')
		}
		else{
			let res=await axios.post('/verify-otp', {
				otp:otp,
				email:sessionStorage.getItem('email')
			})
			if(res.status===200 && res.data['status']==='success'){
				successToast(res.data['message'])
				sessionStorage.clear();
				setTimeout(() => {
					window.location.href='/resetPassword'
				}, 1000);
			}
			else{
				errorToast(res.data['message'])
			}
		}

	}
</script>
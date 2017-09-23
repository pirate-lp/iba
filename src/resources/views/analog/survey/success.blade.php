@extends('iba::page.base')

@section('content')
<div class="pure-g">
<div class="{{ $mainStandard }}">
	<header>
		<h2>Thanks!</h2>
		<span>Thank you for taking part in our survey</span>
	</header>
	<article class="shadow">
		<h3>Follow Up</h3>
		<p>If you are interested to know the right answers to the questions in our survey, add your email address below and we will sent up an follow up email when the information are available on our website ...</p>
		<form class="pure-form">
			<input type="email" id="email" placeholder="EMAIL">
			<button id="followup" class="pure-button pure-button-primary">Follow Up</button>
		</form>
	</article>
	<p><a href="/humane-internet/inquiry/survey/new/">Back to survey</a></p>
</div>
</div>

<script>
$('#followup').click(function(){

    var email = $('#email').val();
    var csrf_token = "{{ csrf_token() }}";
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-Token': csrf_token
	    }
	});
    $.ajax
    ({ 
        url: '/contact/email-list',
        data: {
	        "email": email,
	        "point": "humane-internet.survey"
        },
        type: 'post',
        success: function(result)
        {
            alert('we will inform you');
        }
    });
});
</script>


@endsection
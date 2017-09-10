@extends('iba::page.base')

@section('content')
<div class="pure-g">
<div class="{{ $mainStandard }}">
	<header>
		<h2>Survey on consumer perception</h2>
		<h3>on how their privacy is respected or disrespected in today's world</h3>
	</header>
	<article class="shadow">
	<form class="pure-form pure-form-stacked" action="/humane-internet/inquiry/survey/success" method="post">
		{{ csrf_field() }}
	    <fieldset>
	        <legend>General personal information</legend>
		    <label for="location">Location/Citizenship</label>
		    <span><small>Where you have a background about how consumer rights is respect on the Internet</small></span>
			<select id="location" name="location" required>
			 <option value="" checked style="display: none;"></option>
			    <option value="Switzerland">Switzerland</option>
			    <option value="EU">European Union</option>
			    <option value="Rest of Europe">Rest of EU and Russia</option>
			    <options value="UK">US, Canada, UK</options>
			    <option value="Middle East">Middle East</option>
			    <option value="Africa">Africa</option>
			    <option value="China">China</option>
			    <option value="Other">Other</option>
			</select>
		    <label for="age">Age</label>
			<select id="age" name="age" required>
			 <option value="" checked style="display: hidden;"></option>
			    <option value="0">Younger than 16</option>
			    <option value="1">16 - 25</option>
			    <option value="2">26 - 35</option>
			    <option value="3">36 - 50</option>
			    <option value="4">51 - 70</option>
			    <option value="6">Older than 71</option>
			</select>
	        <p>Gender: </p>
	        <label for="gender0" class="pure-radio">
			    <input id="gender0" type="radio" name="gender" value="0" required>
			    Male
			</label>
			<label for="gender1" class="pure-radio">
			 <input id="gender1" type="radio" name="gender" value="1" required>
			 Female
			</label>
	    </fieldset>
	    <p><br></p>
	    <fieldset>
	        <legend>Questions</legend>
	        <p>Based on your background information do you think the following statements to be real or they are in contradiction of your perception about how our society functions today?<br><span><small>Details are only given to help you remember the news, not to test you about their truth!</small></span></p>
	        <ol>
	        @foreach ( $questions as $question)
				<li class="pure-u-1">
					<p>{!! $question->value !!}<p>
	                <label for="option-two" class="pure-radio">
				        <input id="option-two" type="radio" name="questions[{{ $question->id }}]" value="1" required>
				        Real
	                </label>
					<label>
				        <input id="option-two" type="radio" name="questions[{{ $question->id }}]" value="0" required>
				        Fake
				    </label>
	            </li>
	        @endforeach
	        </ol>
	        <p><button type="submit" class="pure-button pure-button-primary">Submit</button></p>
	    </fieldset>
	</form>
</article>
</div>
</div>

@endsection
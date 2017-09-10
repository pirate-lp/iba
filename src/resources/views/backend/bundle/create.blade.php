@extends('iba::backend.base')

@section('main')

<article class="shadw">
<h2>New Bundle</h2>

<form class="pure-form pure-form-stacked" action="/backend/bundles/" method="post">
{{ csrf_field() }}
<div class="pure-g">

    <fieldset class="pure-group pure-u-1 pure-u-md-5-8">
	    <legend>Main parts</legend>
        <input name="title" type="text" class="pure-input-3-4" placeholder="A title">
        <input name="slug" class="pure-input-3-4" type="text" placeholder="a slug">
        <input name="description" class="pure-input-3-4" type="text" placeholder="Description">
        <input name="type" class="pure-input-3-4" type="text" placeholder="Type">
<!--         <textarea class="pure-input-3-4" placeholder="Textareas work too" name="content"></textarea> -->
    </fieldset>
</div>
    <button type="submit" class="pure-button pure-input-1-2 pure-button-primary">Create</button>
</form>
</article>

@endsection
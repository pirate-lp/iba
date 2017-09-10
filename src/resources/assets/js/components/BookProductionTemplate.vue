<template>
<form class="" enctype="multipart/form-data" v-on:submit.prevent="onSubmit">	
	<header>
		<span>New {{ type }}</span>
		<button type="submit" class="pure-button pure-input-1-2 pure-button-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
	</header>
	<div class="alert alert-danger">
<!-- -->
	</div>
	<div class="pure-g">
		<div class="pure-u-1-1 pure-u-md-5-8">
			<fieldset>
				<div class="field">
					<label class="label is-small">Title</label>
					<input name="title" class="input pure-input-1" type="text" placeholder="Title" v-model="form.title">
				</div>
				<div class="field">
					<label class="label is-small">Slug</label>
					<input name="slug" class="input pure-input-1" type="text" placeholder="slug-for-the-perma-link" v-model="form.slug">
				</div>
				<div class="field" v-if="form.hasOwnProperty('subtitle')">
					<label class="label is-small">Subtitle</label>
					<input name="subtitle" class="input pure-input-1" type="text" placeholder="Secondary Title" v-model="form.subtitle">
				</div>
				<div class="field" v-if="form.hasOwnProperty('description')">
					<label class="label is-small">Description</label>
					<textarea name="description" class="textarea input pure-input-1" type="text" placeholder="Description" v-model="form.description" ></textarea>
				</div>
				<div class="field">
					<label class="label is-small">Content</label>
					<textarea class="textarea input pure-input-1" placeholder="Textareas work too" name="content" v-model="form.content"></textarea>
				</div>
			</fieldset>
				
			<fieldset style="padding: 1rem;">	
				<legend>People related data</legend>
				<div class="field is-horizontal" v-for="role in roles">
					<div class="field-label is-normal is-small">
								<label>{{ role | capitalize }}</label>
							</div>
							<div class="field-body">
							<multiselect
						v-model="form.people[role]"
						:options="people"
						:id="role"
						track-by="id"
						label="name"
						:multiple="true"
						:taggable="true"
						@tag="addPeople"
						class="input-multiselect"
						selectLabel=""
						deselect-label=""
						:placeholder="role"
						:key="role">
					</multiselect>
					</div>
				</div>
			</fieldset>
			
		</div>
		<div class="pure-u-1-1 pure-u-md-3-8">
			<fieldset v-if="form.hasOwnProperty('thumbnail')">
				<legend>Thumbnail</legend>
				Send this file: <input name="thumbnail" type="file"/>
				<input class="input" placeholder="folders/to/reach/the/file" type="text" v-model="form.thumbnail.path">
				<input class="input" placeholder="file_name.extension" type="text" v-model="form.thumbnail.name">
				<input class="input" placeholder="Photographer" type="text" v-model="form.thumbnail.photographer">
				<input class="input" placeholder="http://find-photographer.here" type="text" v-model="form.thumbnail.link">
			</fieldset>
			
			<fieldset>	
				<legend></legend>
				<label>Keywords</label>
				<multiselect
					v-model="form.keywords"
					:options="keywords"
					id="id"
					track-by="id"
					label="word"
					:multiple="true"
					:taggable="true"
					@tag="addKeyword"
					class="input-multiselect"
					selectLabel=""
					deselect-label="">
				</multiselect>
			</fieldset>
			
			<fieldset>
				<legend>Bundles</legend>
				<div class="field is-horizontal" v-for="(values, bundle) in bundles">
					<div class="field-label is-normal is-small">
						<label>{{ bundle | capitalize }}</label>
					</div>
					<div class="field-body">
						<div class="control">
							<multiselect
								v-model="form.bundles[bundle]"
								:options="values"
								:id="bundle"
								track-by="id"
								:custom-label="bundleLabel"
								:multiple="false"
								:taggable="false"
								
								class="input-multiselect"
								selectLabel=""
								deselect-label=""
								:key="bundle">
							</multiselect>
						</div>
					</div>
				</div>
			</fieldset>
			
			<fieldset>
				<legend>Dates</legend>
				<div v-for="(value, kind) in form.timestamp" class="field is-horizontal">
					<div class="field-label is-small ">
						{{ kind | capitalize }}
					</div>
					<div class="field-body control has-icons-left">
						<span class="icon is-small is-left"><i class="fa fa-calendar"></i></span>
						<flat-pickr v-model="form.timestamp[kind]"></flat-pickr>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
</form>	
</template>

<script>

import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import app from '../configs/app.js'

var Form = require('../components/Form')
var Book = require('../components/Book')

var AbstractBook = require('../configs/abstractBook')

import Multiselect from 'vue-multiselect';
// import axios from 'axios';
export default {
	props: ['type'],
	components: {
		Multiselect,
		flatPickr,
	},
	data () {
		return {
			form: {},
			keywords: [],
			roles: {},
			bundles: [],
			draft: ["hi", "lovr"],
			people: [],
// 			option1: []
			book: {},
			abstractBook: new AbstractBook,
			}
		},
		methods: {
			onSubmit() {
				var self = this;
				if ( this.$route.params.id ) {
					let uri = '/api/backend/' + self.type + '/' + self.$route.params.id;
					self.form.patch(self, uri).then(console.log(response.data));
				} else {
					let uri = '/api/backend/' + self.type + '/';
					self.form.post(self, uri).then(console.log(response.data));
				}
			},
			addKeyword (newKeyword) {
				const keyword = {word: newKeyword,}
				this.keywords.push(keyword)
				this.form.keywords.push(keyword)
			},
			addPeople (newPerson, role) {
			console.log(role);
			console.log(newPerson)
				const person = {
					name: newPerson,
				}
				this.people.push(person)
				this.form.people[role].push(person)
			},
		
			initializeBook(book) {
				this.book = new Book(book, this.abstractBook);
				this.form = new Form(this.book);
			},
		
			initialize() {
				console.log(this.abstractBook.timestamp)
				if ( this.$route.params.id ) {
					var uri = '/api/backend/' + this.type + '/' + this.$route.params.id + '/edit';
				} else {
					var uri = '/api/backend/' + this.type + '/create';
				}
				let self = this;
				this.$http.get(uri)
					.then(function (response) {
						self.initializeBook(response.data.book)
						self.bundles = response.data.bundles
						self.roles = response.data.roles
					});
				
				this.$http.get( app.host + '/api/keywords/')
					.then(response => this.keywords = response.data);
					
				this.$http.get(app.host + '/api/people/')
					.then(response => this.people = response.data);
					
				console.log(this.form)
			},
		
			bundleLabel(item)
			{
				return item.title.value;
			},
		},
		created() {
			console.log(this.form);
			this.initialize();
			console.log(this.form)
		},
		watch: {
			$route: function () {
				this.type = this.$route.params.type;
				this.initialize();
			},
		},
		filters: {
		capitalize: function(text) {
			return text[0].toUpperCase() + text.slice(1);
		}
	},
}

</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
form {
	
	border-top: none;
}
form > * {
	margin: 0.5rem;
}
form > header {
	margin: 0px;
	padding-left: 0.5rem;
	overflow: auto;
/* 	background-color: #5c5c5c; */
	border-bottom: 3px solid #5c5c5c;
}
form > header > span {
	display: inline-block;
	padding: 0.5rem 0.8rem;
}
form > header > button {
	float: right;
	margin: 0px;
}
form fieldset {
	border: none;
	margin-bottom: 0.75rem;
	padding: 0px 0.4rem;
}
form fieldset > legend {
	margin: 0rem;
}
form fieldset > legend {
/*
	width: auto;
	padding: 0px 0.5rem;
	background-color: rgba(255, 255, 255, 0.5);
*/
}

.field-label {
/* 	font-size: 0.8em; */
}
/*
form label {
	font-size: 0.8em;
}
.input-inline-label {
	display: block;
	overflow: auto;
	margin: 0.5em 0px;
}
.input-inline-label > label {
	display: block;
	float: left;
	margin: 0px;
	padding: 0.3rem 0.5rem;
		border: 1px solid #c2c2c2;
		border-right: none;
		font-size: 1em;
}
.input-inline-label > input {
	display: block;
	float: left;
	margin: 0px;
}
*/
</style>

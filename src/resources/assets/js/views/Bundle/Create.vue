<template>
<form class="" v-on:submit.prevent="onSubmit">	
	<header>
		<span>Bundle</span>
		<button type="submit" class="pure-button pure-input-1-2 pure-button-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
	</header>
	<div class="alert alert-danger">
<!--  -->
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
				<div class="field">
					<label class="label is-small">Type</label>
					<input name="subtitle" class="input pure-input-1" type="text" placeholder="Secondary Title" v-model="form.type">
				</div>
				<div class="field" v-if="form.hasOwnProperty('description')">
					<label class="label is-small">Description</label>
					<textarea name="description" class="textarea input pure-input-1" type="text" placeholder="Description" v-model="form.description" ></textarea>
				</div>
			</fieldset>
		</div>
	</div>
</form>	
</template>

<script>

import app from '../../configs/app.js'
var Book = require('../../components/Book')
var AbstractBundle = require('../../configs/abstractBundle')
var Form = require('../../components/Form')

export default {
	data () {
		return {
			type: 'bundle',
			book: {},
			form: {},
			bundle: new AbstractBundle,
		};
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
		initializeBook(book) {
			this.book = new Book(book, this.bundle);
			this.book.type = book.type;
			this.form = new Form(this.book);
			this.form.type = book.type;
		},
		initialize() {
			console.log("initializing");
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
		},
	},
	created() {
		console.log(this.form);
		this.initialize();
		console.log(this.form)
	},
	watch: {
		$route: function () {
// 			this.type = this.$route.params.type;
			this.initialize();
		},
	},
	mounted() {
// 		this.initialize();
	},
	filters: {
		capitalize: function(text) {
			return text[0].toUpperCase() + text.slice(1);
		}
	},
}
</script>

</style>
</style>
<template>
<div>
	<h2>Manage {{ $route.params.type + 's' | capitalize }}</h2>
	<div>
		<iba-table :books="items" :abstract-dimensions="abstractDimensions" :abstract="abstract" :type="type">
		</iba-table>
	</div>
</div>
</template>

<script>

var _ = require('underscore')
import IbaTable from '../../../components/IBATable'

export default {
	name: 'Manage',
	data () {
		return {
			underscore: _,
			items: [],
			type: this.$route.params.type,
			abstract: [],
			abstractDimensions: {
				title: '',
				timestamp: {
					draft: '',
					publish: '',
					amend: '',
				},
				subtitle: '',
				slug: '',
				description: '',
// 				content: '',
				thumbnail: {
					name: '',
					path: '',
					photographer: '',
					link: '',
				},
			},
		}
	},
	components: {
		IbaTable,
	},
	methods: {
	    initialize () {
		    console.log(this.$http.headers)
		    let uri = '/api/backend/' + this.$route.params.type;
		    let self = this;
// 			console.log(this.$http.defaults)
		    this.$http.get(uri)
				.then(function(response) {
					self.items = response.data.items;
					self.abstract = response.data.abstract;
				});
	    },
	    value: function(object, field) {
			let self = this
			if (object) {
				if (object.value) {
					return object.value;
				} else if (!_.isEmpty(object)) {
					let r = {};
					console.log(self.abstractDimensions[field]);
					for (let attribute in self.abstractDimensions[field]) {
						console.log(attribute)
						if (object[attribute]) {
							r[attribute] = object[attribute];
						}
					}
					return JSON.stringify(r);
				} else {
					return null;
				}
			} else {
				return null;
			}
			
		},
		sortby(field, attribute = null) {
			this.items = _.sortBy(this.items,
				function(item) {
					var tableLowerCase = function(value) {
						if ( typeof(value) == "string") {
							return value.toLowerCase()
						} else {
							return value
						}
					};
					if (item[field]) {
						if ((attribute)) {
							if ( item[field][attribute] ) {
								return tableLowerCase(item[field][attribute])
							} else {
								return ''
							}
						} else if ( (item[field].value) ) {
							return tableLowerCase(item[field].value)
						} else {
							return tableLowerCase(item[field])
						}
					} else {
						return ''
					}
				});
		},
	},
	mounted() {
		this.initialize();
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
		},
		
	},
}
</script>

<style scoped>
i {
	font-size: 0.7em;
}
</style>

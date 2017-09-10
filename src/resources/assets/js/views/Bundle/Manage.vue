<template>
<div>
	<h2>Manage Bundles</h2>
	<div>
		<table class="pure-table pure-table-bordered">
		    <thead>
		        <tr>
		            <th>#</th>
		            <th>Type</th>
		            <th v-for="(v, field) in abstractDimensions" :colspan="underscore.keys(v).length"  v-if="underscore.contains(abstract.dimensions, field)">
			            {{ field | capitalize }}
			            <template v-if="underscore.keys(abstractDimensions[field]).length > 1">
			            	<small><span v-for="(value, attribute) in abstractDimensions[field]">| {{ attribute }} </span>|</small>
			            </template>
			        </th>
		        </tr>
		    </thead>
		    <tbody>
		        <tr v-for="item in items">
		            <td ><router-link :to="url(item.id)">{{ item.id }}</router-link></td>
		            <td>{{ item.type }}</td>
		            <template v-for="(v, field) in abstractDimensions" v-if="underscore.contains(abstract.dimensions, field)" >
			            <template v-if="(typeof(abstractDimensions[field]) === 'object' && item[field] != null)">
				        	<td v-for="(value, attribute) in abstractDimensions[field]" v-if="item[field].hasOwnProperty(attribute)">{{ item[field][attribute] }}</td>
				        	
			            </template>
			            <td v-else-if="typeof(abstractDimensions[field]) === 'object' " :colspan="underscore.keys(abstractDimensions[field]).length" class="empty">
			            </td>
			            <td v-else>
			            	{{ value(item[field], field) }}
			            </td>
			        </template>
		        </tr>
		    </tbody>
		</table>
	</div>
</div>
</template>

<script>

const _ = require('underscore')
// var axios = require('../../../configs/axios.js')

export default {
	name: 'BundleManage',
	data () {
		return {
			underscore: _,
			items: [],
			type: 'bundle',
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
			}
		}
	},
	components: {
// 		Create
	},
	methods: {
		url: function (value) {
		    return '/bundle/' + value + '/edit/'
	    },
	    initialize () {
		    let uri = '/api/backend/bundle';
		    let self = this;
			console.log(this.$http.defaults)
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
	},
	mounted() {
		this.initialize();
    },
    watch: {
	},
    filters: {
		capitalize: function(text) {
			return text[0].toUpperCase() + text.slice(1);
		},
		
	},
}
</script>

</style>
</style>

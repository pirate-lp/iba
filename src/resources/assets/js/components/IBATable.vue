<template>
<div class="iba-responsive-table">
<table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th v-on:click="sortby('id')"># <i class="fa fa-sort" aria-hidden="true"></i></th>
            <th v-for="(v, field) in abstractDimensions" :colspan="underscore.keys(v).length"  v-if="underscore.contains(abstract.dimensions, field)"  v-on:click="sortby(field)">
	            {{ field | capitalize }}
	            <template v-if="underscore.keys(abstractDimensions[field]).length > 1" >
	            	<small><span v-for="(value, attribute) in abstractDimensions[field]" v-on:click="sortby(field, attribute)">| {{ attribute }} <i class="fa fa-sort" aria-hidden="true"></i></span>|</small>
	            </template>
	            <i v-if="underscore.keys(abstractDimensions[field]).length <= 1" class="fa fa-sort" aria-hidden="true"></i>
	        </th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="item in items" v-on:click="$router.push({  path: `/${type}/${item.id}/edit` })">
            <td>{{ item.id }}</td>
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
</template>

<script>
var _ = require('underscore')

export default {
	name: 'IBATable',
	props: ['books', 'abstractDimensions', 'abstract', 'type'],
	data () {
		return {
			underscore: _,
			items: this.books,
		}
	},
	methods: {
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
				}
			);
		},
	},
	filters: {
		capitalize: function(text) {
			return text[0].toUpperCase() + text.slice(1);
		},
	},
	watch: {
		books(value) {
			this.items = value;
		}
	}
}
</script>

<style scoped>
i {
	font-size: 0.7em;
}
div.iba-responsive-table {
	overflow: auto;
	
}
div.iba-responsive-table table {
	table-layout: fixed;
}
div.iba-responsive-table td, div.iba-responsive-table th {
	max-width: 80rem;
	word-wrap: break-word;
}
div.iba-responsive-table td:first-child {
	position: sticky;
	left: 0px;
	min-width: 4rem;
	box-sizing: border-box;
	table-layout: fixed;
	word-wrap: break-word;
	background-color: white;
}
div.iba-responsive-table th:first-child {
	position: sticky;
	left: 0px;
	min-width: 4rem;
	box-sizing: border-box;
	table-layout: fixed;
	word-wrap: break-word;
	background-color: gray;
}
div.iba-responsive-table td:nth-child(2) {
	position: sticky;
	left: 4rem;
	background-color: white;
}
div.iba-responsive-table th:nth-child(2) {
	position: sticky;
	left: 4rem;
	background-color: gray;
}
div.iba-responsive-table tr:hover {
	background-color: rgba(4, 107, 64, 0.1);
}
</style>

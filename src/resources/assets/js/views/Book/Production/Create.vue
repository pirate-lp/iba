<template>
<div>
<!-- 	<h2>{{ $route.params.type }}: create one</h2> -->
	<new-book :type="type"></new-book>
</div>
</template>

<script>

import NewBook from '../../../components/BookProductionTemplate.vue'

export default {
	data () {
		return {
			book: {},
			template: {},
			response: {},
			type: this.$route.params.type
		}
	},
	components: {
		NewBook
	},
	methods: {
	},
	mounted() {
    },
    filters: {
	    capitalize: function (value) {
	      if (!value) return ''
	      value = value.toString()
	      return value.charAt(0).toUpperCase() + value.slice(1)
	    }
	}
}
</script>

</style>
</style>

class abstractBook {
	constructor() {
		this.title = ''
		this.subtitle = ''
		this.slug = ''
		this.thumbnail = {
				name: '',
				path: '',
				photographer: '',
				link: '',
			};
		this.description = ''
		this.content = ''
		this.timestamp = {
				draft: '',
				publish: '',
				amend: '',
			};
	}
}

module.exports = abstractBook;
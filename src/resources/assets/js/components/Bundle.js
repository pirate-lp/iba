require('underscore')


class Bundle {
	
	constructor(book) {
		var 
		for (let field in abstractBundle) {
			if (book.includes(field)) {
				if (book.hasOwnProperty(field) && book[field] != null ) {
					
					if (book[field].hasOwnProperty('value')) {
						this[field] = book[field].value;
					} else if ( book[field] != null ) {
						this[field] = {};
						for ( let item in abstractDimensions[field])
						{
							if (book[field][item]) {
								this[field][item] = book[field][item];
							} else {
								this[field][item] = "";
							}
						}
						
					}
				}  else {
					this[field] = abstractDimensions[field];
				}
			}
        }
	}
}

module.exports = Bundle;
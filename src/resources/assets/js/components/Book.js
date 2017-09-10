require('underscore')
class Book {
	
	constructor(book, abstractDimensions) {
// 		console.log(abstractDimensions)
		this.constructAbstract(book.dimensions, book.groupings, book, abstractDimensions)
		
	}
	
	constructAbstract(dimensions, groupings, book, abstractDimensions) {
// 		var abstractDimensions = new abstractBook();
		console.log("bundel");
		console.log(abstractDimensions)
		for (let field in abstractDimensions) {
			if (dimensions.includes(field)) {
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

		let abstractGroupings = {
			keywords: [],
			bundles: {},
			people: {},
		}
		
		for (let field in abstractGroupings) {
			if (groupings.includes(field)) {
				if (book.hasOwnProperty(field) && book[field] != null ) {
					this[field] = book[field];
/*
					switch(field) {
						case "keywords": 
							this[field] = Object.values(book[field]);
							break;
						case "bundles":
							this[field] = _.groupBy(Object.values(book[field]), function(item){ return item.type; });
							break;
						case "people":
							this[field] = _.groupBy(Object.values(book[field]), function(item){ console.log(item); return item.role; });
					}
*/
					
					
				} else {
					this[field] = abstractGroupings[field];
				}
				
				
			}
        }
	}
	

	
}

module.exports = Book;
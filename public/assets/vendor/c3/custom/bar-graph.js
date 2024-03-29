var chart6 = c3.generate({
	bindto: '#barGraph',
	padding: {
		top: 0,
		left: 30,
		right: 20,
	},		
	data: {
		columns: [
			['data1', 15, 58, 62, 87, 32, 58, 55, 21, 20, 30, 98, 10, 22, 98, 99, 105, 82, 57, 121, 78],
			['data2', 21, 26, 30, 38, 11, 24, 36, 53, 58, 62, 65, 61, 64, 32, 45, 71, 38, 23, 65, 11],
		],
		type: 'bar',
		names: {
			data1: 'Income',
			data2: 'Expense'
		},
		colors: {
			data1: '#007ae1',
			data2: '#e5e8f2'
		},
	},
});
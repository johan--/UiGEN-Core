/* Create dynamic JS table to serialize dala */

function uigen_createNode( node_data ){

	var output = '<';
	output += node_data['node'];
	if( node_data['type'] 	!= '' ){ output += ' type="'	 + node_data['type'] 	+ '"'; }
	if( node_data['name'] 	!= '' ){ output += ' name="'	 + node_data['name'] 	+ '"'; }
	if( node_data['class'] 	!= '' ){ output += ' class="'	 + node_data['class'] 	+ '"'; }
	output += '>';

	// select exception
	if(node_data['node'] == 'select'){
		jQuery.each(node_data['group'], function(index, value) {
			output += '<option value="'+value['value']+'">'+value['label']+'</option>'
		});
		output += '</select>';
	}
	return output;
}

function uigen_grid_fill_last_row ( fill_row , grid_data , outputNode ){
	for ( var i_cols = 0; i_cols < grid_data['grid']['cols']; i_cols++ ) {
		//alert(fill_row[i_cols]['name']);
		var output = uigen_createNode( fill_row[i_cols] );
		jQuery( outputNode +' '+grid_data['prop']['canvas'] + ' ' + grid_data['prop']['rows'] + ':last-child').children('td').eq(i_cols).append(output);
	
	}	
}

function uigen_createGrid( grid_data , fill_data  ,outputNode ){
	var output = '<' + grid_data['prop']['canvas'] + ' class="' + grid_data['class']['canvas'] + '" >';
	// start row
	for ( var i_row = 0; i_row < grid_data['grid']['rows']; i_row++ ) {		
		output += '<tr class="' + grid_data['class']['rows'] + '" >';
		// start column
		for ( var i_cols = 0; i_cols < grid_data['grid']['cols']; i_cols++ ) {
			output += '<' + grid_data['prop']['cols'] + ' class="' + grid_data['class']['cols'] + '" >';
			output += '</' + grid_data['grid']['cols'] + '>';
		}
		// end column
		output += '</'+ grid_data['grid']['rows'] +'>';
		uigen_grid_fill_last_row ( fill_data , grid_data , outputNode );
	}
	// end row
	output += '</' + grid_data['prop']['canvas'] + '>';
	jQuery( outputNode ).append( output );
}

/*
arguments:
grid_data = grid properties object - example:
			var grid_data = {
				'prop':{'canvas':'table','header':'th','rows':'tr','cols':'td'},
				'class':{'canvas':'grid_table','header':'','rows':'','cols':''},
				'grid':{'rows':3,'cols':3},
			};
outputNode = resoult node - example:
			#output_div
callbackFnk - argument is not important - realize callback script or methods - example:
			function(){ alert('hello world'); }
*/
function uigen_grid_add_row( grid_data , outputNode , callbackFnk = ''){
	var output = '<' + grid_data['prop']['rows'] + ' class="' + grid_data['class']['rows'] + '" >';
	// start column
	for ( var i_cols = 0; i_cols < grid_data['grid']['cols']; i_cols++ ) {
		output += '<' + grid_data['prop']['cols'] + ' class="' + grid_data['class']['cols'] + '" ></' + grid_data['grid']['cols'] + '>';
	}
	// end column
	output += '</' + grid_data['prop']['rows'] + '>';
	jQuery( outputNode + ' ' + grid_data['prop']['canvas'] ).append( output );

	if(callbackFnk != ''){
		if(typeof callbackFnk == 'function'){
	    	callbackFnk.call(this);
	    }
	}
}

function uigen_grid_clone_row ( grid_data , outputNode ){
	jQuery( outputNode ).append( output );
}

function uigen_grid_remove_row ( grid_data , outputNode , removeNode = '' , min = '' ){
	jQuery( grid_data['prop']['canvas'] + ' ' + grid_data['prop']['rows'] + ':last-child' ).remove();
}

/*
	arguments:
	fill_row = {
		'grid1':[
			{ 'node':'input' , 'type':'text' , 'name':'test1' , 'class':'test_class' },
			{ 'node':'select' , 'type':'text' , 'name':'test2' , 'class':'test_class', 'group':[{'label':'Jeden','value':'1'},{'label':'Dwa','value':'2'}] },
			{ 'node':'input' , 'type':'text' , 'name':'test3' , 'class':'test_class' },
		]
	};
	grid_data ^^ check 

*/




/*  Json builder */

// arguments:
// data 	- output data array
// grid 	- gridID
// fill_row - object to parse

// build simple json array like
// var group = {"group":[{'element1':{},'element2'},{},{},....]};

function uigen_create_json_from_grid( data , grid , fill_row ){



}
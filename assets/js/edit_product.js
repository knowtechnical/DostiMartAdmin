range = 0;
function onAddRange(){
	range = $('#total_range_value').val();
	weight_range = $('#weight_range').val();

	var span = '<span class="weight_range_box" id = "weight_range_box'+range+'">';
	span = span + '<input type="hidden" name="range'+range+'" value='+weight_range+' />';
	span = span + weight_range + '<span onclick="removeRange('+range+')" class="close_button">X</span>';
	span = span + '</span>';
	
	$('#range_box').append(span);
	range++;
	
	$('#total_range_value').val(range);
}

function removeRange(id) {
	$('#weight_range_box'+id).remove();
}

function deleteRow(id, increment_id ,delete_url){
	 //alert(id);
	var deleteid = 'range_id';
	var tdeletecolumn = 'p_delete';     
	var tablename = 'product_weight_range';      
	$.ajax({
		type: "post",
		url: delete_url,
		data: {id:id,deleteid:deleteid,tablename:tablename,tdeletecolumn:tdeletecolumn},
		datatype: "text",
		success: function(data){  
			//alert(data);
			if(data == 'success'){  
			  removeRange(increment_id);
			}        
		}
	});
}

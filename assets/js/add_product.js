range = 0;
function onAddRange(){
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
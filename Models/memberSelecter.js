$(document).ready(function () {     
	$('#FilterSelect').change(function(){
		var memberName = $(this).val();
		//making it place the selected person in the box next
		if ($('#Time1').val() === "") {
			//stopping the same name from being input more than once
			if ($('#Time2').val() === memberName || $('#Time3').val() === memberName || $('#Time4').val() === memberName || $('#Time5').val() === memberName) {
				//do nothing
			}
			else {
				$('#Time1').val(memberName);
			}
		}
		else if ($('#Time2').val() === "") {
			if ($('#Time1').val() === memberName || $('#Time3').val() === memberName || $('#Time4').val() === memberName || $('#Time5').val() === memberName) {
				//do nothing
			}
			else {
				$('#Time2').val(memberName);
			}
		}
		else if ($('#Time3').val() === "") {
			if ($('#Time2').val() === memberName || $('#Time1').val() === memberName || $('#Time4').val() === memberName || $('#Time5').val() === memberName) {
				//do nothing
			}
			else {
				$('#Time3').val(memberName);
			}
		}
		else if ($('#Time4').val() === "") {
			if ($('#Time2').val() === memberName || $('#Time3').val() === memberName || $('#Time1').val() === memberName || $('#Time5').val() === memberName) {
				//do nothing
			}
			else {
				$('#Time4').val(memberName);
			}
		}
		else if ($('#Time5').val() === "") {
			if ($('#Time2').val() === memberName || $('#Time3').val() === memberName || $('#Time4').val() === memberName || $('#Time1').val() === memberName) {
				//do nothing
			}
			else {
				$('#Time5').val(memberName);
			}
		}
	})
});
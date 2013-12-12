$(".pictureColumn").hide();

$("input[type='checkbox']")
	.change(function(){
		if($(this).is(":checked"))
			$(".pictureColumn").show();
		else
			$(".pictureColumn").hide();
	});
	

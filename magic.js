$(".pictureColumn").hide();

$("input[name=image]")
        .change(function(){
                if($(this).is(":checked"))
                        $(".pictureColumn").show();
                else
                        $(".pictureColumn").hide();
        });
		
$(".parts").hide();

$("input[name=parts]")
        .change(function(){
                if($(this).is(":checked"))
                        $(".parts").show();
                else
                        $(".parts").hide();
        });

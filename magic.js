
// Visa/göm bilderna beroende på om checkboxen är iklickad
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
		
//Visa hjälpkommentarerna när användaren hovrar över frågetecknet
$(function() {
        $( document ).tooltip();
});

//bildbyte för frågetecknet i huvudsökningen
$("#question").on({
 "mouseover" : function() {
    this.src = 'pictures/Questionmark3_hover.png';
        },
  "mouseout" : function() {
    this.src = 'pictures/Questionmark3.png';
    }
});

//bildbyte för frågetecknet i den avancerade sökningen
$("#questionAdv").on({
 "mouseover" : function() {
    this.src = 'pictures/Questionmark_adv_hover.png';
    },
  "mouseout" : function() {
    this.src = 'pictures/Questionmark_adv.png';
    }
});

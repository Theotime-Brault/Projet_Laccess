$(document).ready(funtion(){
  if($("#btnEn").is(':checked')){
    $("#imgEn").css("border", "solid red 2px");
    $("#imgFr").css("border", "solid black 2px");
  };

  if($("#btnEn").is(':checked')){
    $("#imgFr").css("border", "solid red 2px");
    $("#imgEn").css("border", "solid black 2px");
  };

  $("#imgFr").click(function(){
    $("#btnFr").attr('checked');
    $("#btnEn").removeAttr('checked');
  });

  $("#imgEn").click(function(){
    $("#btnEn").attr('checked');
    $("#btnFr").removeAttr('checked');
  });
})

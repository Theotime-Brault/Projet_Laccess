$(document).ready(function(){
  $("#imgFr").click(function(){
    $("#btnEn").removeAttr("checked");
    $("#btnFr").attr("checked", true);
  });

  $("#imgEn").click(function(){
    $("#btnFr").removeAttr("checked");
    $("#btnEn").attr("checked", true);
  });

  if($("#btnEn").is(":checked")){
    $("#imgEn").css({"border": "solid red 2px !important"});
    $("#imgFr").css({"border": "solid black 2px !important"});
  };

  if($("#btnEn").is(":checked")){
    $("#imgFr").css('border', 'solid red 2px !important');
    $("#imgEn").css('border', 'solid black 2px !important');
  };
});

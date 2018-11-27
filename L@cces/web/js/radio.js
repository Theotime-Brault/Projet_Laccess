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
    $("#imgEn").attr("class","red");
    $("#imgEn").css("border", "solid red 2px");
    $("#imgFr").css("border", "solid black 2px");
  };

  if($("#btnEn").is(":checked")){
    $("#imgFr").css("border", "solid red 2px");
    $("#imgEn").css("border", "solid black 2px");
  };
});

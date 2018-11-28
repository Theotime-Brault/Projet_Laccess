$(document).ready(function(){
  checked();
  $("#imgFr").click(function(){
    $("#btnEn").removeAttr("checked");
    $("#btnFr").attr("checked", true);
    checked();
  });

  $("#imgEn").click(function(){
    $("#btnFr").removeAttr("checked");
    $("#btnEn").attr("checked", true);
    checked();
  });

  function checked(){
    if($("#btnEn").is(":checked")){
      $("#imgEn").css("border-color", "red");
      $("#imgFr").css("border-color", "black");
    };

    if($("#btnFr").is(":checked")){
      $("#imgFr").css("border-color", "red");
      $("#imgEn").css("border-color", "black");
    };
  }
});

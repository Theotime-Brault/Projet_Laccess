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

  $("#imgFlagEn").click(function(){
    checked();
  });

  $("#imgFlagFr").click(function(){
    checked();
  });

  function checked(){
    if($("#btnEn").is(":checked")){
      $("#imgEn").css("border-color", "#f4a733");
      $("#imgFr").css("border-color", "white");
    };

    if($("#btnFr").is(":checked")){
      $("#imgFr").css("border-color", "#f4a733");
      $("#imgEn").css("border-color", "white");
    };
  }
});

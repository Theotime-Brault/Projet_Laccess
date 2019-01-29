$(document).ready(function(){
  checked();
  $("#imgFr").click(function(){
    $("#btnEn").removeAttr("checked");
    $("#btnFr").attr("checked", true);
    checked();
    $('#result').html("");
  });

  $("#imgEn").click(function(){
    $("#btnFr").removeAttr("checked");
    $("#btnEn").attr("checked", true);
    checked();
    $('#result').html("");
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

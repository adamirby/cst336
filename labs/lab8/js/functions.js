
$(".petlink").click(function(){
   
   $('#petInfoModal').modal("show");
   $('#petInfo').html("<img src='img/loading.gif'>");
   
   $.ajax({
       type:"GET",
       url: "api/getPetInfo.php",
       dataType: "json",
       data: {"id":$(this).attr('id')},
       success: function(data, status){
           
           console.log(data);
           $("#petInfo").html(" <img src='img/" + data.pictureURL + "'><br>" +
                              " Age: " + data.age + "<br>" +
                              " Breed: " + data.breed+ "<br>" +
                              data.description);
       },
       complete: function(data,status){
           console.log("3");
           //optional, used for debugging purposes
       }
   });
}); 


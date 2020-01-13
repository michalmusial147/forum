
function func(param){	
   window.location.href = "thread.php" + "?ID=" + param;
}

let navigator = {
   name : "0",

   navigator(param){
      name = param;
   }
}
function submitForm(param) {
   // Get the first form with the name
   var frm = document.getElementsByName(param)[0];
   frm.submit(); // Submit
   frm.reset();  // Reset
   return false; // Prevent page refresh
}

function deletePost(postID)
{
      $.ajax({
         url: 'deletePost.php',
         type: 'POST',
         data:{'postID':postID},
         success: function(result) {
            alert(result);
         },
         error: function(result){
            alert("Error");
         }
      });
      location.reload(true);
}

function deleteCategory(catID)
{
      $.ajax({
         url: 'deleteCategory.php',
         type: 'POST',
         data:{'categoryID':catID},
         success: function(result) {
            alert(result);
         },
         error: function(result){
            alert("Error");
         }
      });
      location.reload(true);
}

function deleteThread(threadID)
{
      $.ajax({
         url: 'deleteThread.php',
         type: 'POST',
         data:{'threadID':threadID},
         success: function(result) {
            alert(result);
            if(result=="Usunięto wątek")
               window.location.href = "mainpage.php";

         },
         error: function(result){
            alert("Error");
         }
      });
     
}

$(document).ready(function(){
   $("form.new_thread").submit(function(e) {
      e.preventDefault(); // avoid to execute the actual submit of the form.

      var url = 'newThread.php';
      var data = $(this).serializeArray();
     
      var catid = $(this).attr("cid");
    
      //data.push({name :'CategoryID', value : String(catid)});
      data[data.length] = { name: "CategoryID", value: String(catid) };
      $.ajax({
             type: "POST",
             url: url,
             data: data, // serializes the form's elements.
             success: function(result)
             {
                 alert(result); // show response from the php script.
                 location.reload(true);
             },
             error: function(result){
               alert("Error");
            }
           });
      
  });

  $("form.add_post").submit(function(e) {
      e.preventDefault(); // avoid to execute the actual submit of the form.
         //to do +++++
      var url = 'addPost.php';
      var data = $(this).serializeArray();

      var thrid = $(this).attr("thrid");

      //data.push({name :'CategoryID', value : String(catid)});
      data[data.length] = { name: "ThreadID", value: String(thrid) };
      $.ajax({
            type: "POST",
            url: url,
            data: data, // serializes the form's elements.
            success: function(result)
            {
               alert(result); // show response from the php script.
               location.reload(true);
            },
            error: function(result){
               alert("Error");
            }
         });
   });


  $("form.add_category").submit(function(e) {
   e.preventDefault(); // avoid to execute the actual submit of the form.
   //to do +++++
   var url = 'addCategory.php';
   var data = $(this).serializeArray();
   $.ajax({
   type: "POST",
   url: url,
   data: data, // serializes the form's elements.
   success: function(result)
   {
   alert(result); // show response from the php script.
   location.reload(true);
   },
   error: function(result){
   alert("Error");
   }
   });
   });


   $("form.deleteCategory").submit(function(e) {
      e.preventDefault(); 
      var url = 'deleteCategory.php';
      var data = $(this).serializeArray();
      $.ajax({
         type: "POST",
         url: url,
         data: data, // serializes the form's elements.
         success: function(result)
         {
            alert(result); // show response from the php script.
            location.reload(true);
         },
         error: function(result){
            alert("Error");
         }
      });
   });
   
   $("form.banUser").submit(function(e) {
      e.preventDefault(); 
      var url = 'banUser.php';
      var data = $(this).serializeArray();
      alert("banuje");
      $.ajax({
         type: "POST",
         url: url,
         data: data, // serializes the form's elements.
         success: function(result)
         {
            alert(result); // show response from the php script.
            location.reload(true);
         },
         error: function(result){
            alert("Error");
         }
      });
   });
   
});


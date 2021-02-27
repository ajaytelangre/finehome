
        
            // function sidebar_display(){
            //     $("sidebar").hide();
            // }
            $(document).ready(function(){
                $('#closeside').click(function(){
                    $("#sidebar").hide();
                });
    
                $('#showsidebar').click(function(){
                    $("#sidebar").show();
                })
    
            });
    // 	function sidebar_close() {
    //   			document.getElementById("sidebar").style.display = "none";
    //    }
    
       function sidebar_display() {
                  document.getElementById("sidebar").style.display = "block";
       }
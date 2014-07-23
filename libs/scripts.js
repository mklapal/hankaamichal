//document load function

	function IsEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}

$( document ).ready(function() {
    
    
    $( "h2" ).click(function(event) {
    	event.stopPropagation();

    	$("h2").removeClass("pink");

    	$(this).addClass("pink");

    	$(".text").slideUp();

    	$(this).next('.text').slideToggle(
		   function()
		   {
		      $(this).next('.text').animate({
		      height: "auto",
		      padding:"20px 0",
		      backgroundColor:'#000000',
		      opacity:.8
			  }, 500);
		   },
		   function()
		   {
		   	  $(this).next('.text').animate({
		      height: "0",
		      padding:"0px 0",
		      opacity:.2
		      }, 500);
		   });
    	
	});

	$(".front").click(function(event) {
		event.stopPropagation();
		
		console.log("click front");

		$(this).slideUp();

	});

	$(".back").click(function(event) {
		event.stopPropagation();

		console.log("click back");
		
		$(this).prev(".front").slideDown();

	});
	

	$( ".js-darovat" ).click(function(event) {
		event.stopPropagation();
		
		console.log("click darovat");

		$(this).closest('.box').next(".popup" ).css("display", "block");
		
	});


	//closes a popup
	$(".popup").click(function(event){
		event.stopPropagation();
		$( ".popup" ).css("display", "none");
	});

	$(".popup div").click(function(event){
		event.stopPropagation();
		//$( ".popup" ).css("display", "none");
	});


	$(".js-submit").click(function(event){
		event.stopPropagation();

		$this = $(this).parent().parent();

		var dar = $this.find(".js-dar").val();
		var email = $this.find(".js-input").val();

		if (IsEmail(email)){

	        $this.find(".js-form").css("display", "none");
	        $this.find(".js-hint").css("display", "none");
	        $this.find(".js-loading").css("display", "block");

	        $.ajax({
	            type: "POST",
	            //url: "http://localhost/hankaamichal/content/function-email.php",
	            url: "http://hankaamichal.sivensport.cz/content/function-email.php",

	            data: {"dar": dar, "email": email}, // serializes the form's elements.
	            success: function(data)
	            {
	                console.log(data); // show response from the php script.
	                if (data === "true"){
	                	$this.find(".js-loading").css("display", "none");
	                    $this.find('.js-confirm').css("display", "block");

	                	$('.js-dar-'+dar).empty().append('Zamluveno');
	                } else {
	                	$this.find(".js-loading").css("display", "none");
	                    $this.find('.js-error').css("display", "block");
	                }
	            }
	        });

    	} else {
    		$this.find(".js-hint").css("display", "block");
    	}

        //return false; // avoid to execute the actual submit of the form.   

	});


});
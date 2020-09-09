$(function(){
	//action status product
	$("#list-pro a.btn-status").on('click',function(event){
		event.preventDefault();
		active = $(this).attr('rel');
		// for actions of attribute: active, hightlight 
		action = $(this).attr('data-action');
		$("#loading-mask").show();
		
		ms = $(this);
		$.ajax({
		    'type' : 'POST',
		    'url'  : ms.attr('href'),
		    'data' : {
		    	'active' : active, 
		    	'action' : action
		    },
		    success: function(data){
		        result = JSON.parse(data);
		        if (result.success) {
		        	ms.hasClass('glyphicon-ok') ? ms.removeClass('glyphicon-ok') : ms.removeClass('glyphicon-remove');
		        	// change status and assign value
		        	ms.addClass(result.data.class_icon).attr('rel', result.data.num);
		        	ms.attr('rel', result.data.num);
		        } else {
		        	alert(result.messages);
		        }

		        $("#loading-mask").hide();
		    }
		});
	});

    //action delete product
	$("#list-pro").on('click','.btn-del',function(){
        check_del = confirm('Bạn muốn xóa dòng này');
        if (check_del == true)
        {
        	window.location.href = $(this).attr(href);
        }
        else
        {
            return false;
        }
	});

	$('#check_all').on('click', function(){
		var checklist = document.getElementsByName('checklist');
	  	if ($('#check_all').is(':checked')){

	  		for (var i=0; i<checklist.length; i++) {
	    		checklist[i].checked = true;
	   		}
	  	}
	  	else
	  	{
	  		for (var i=0; i<checklist.length; i++) {
	  			checklist[i].checked = false;
	  		}
	  	}

	});


	$("#list-pro table thead th a").on('click', function(e){

		e.preventDefault();
		_this = $(this);
		$("#loading-mask").show();
		$.ajax({
			type : 'POST',
			url  : _this.attr('href'),
			success : function(){
				
				$("#loading-mask").hide();
				location.reload();
			}

		});
	});
	
   
    $('#del-all').on('click', function(event){
    	event.preventDefault();
    	
		var checklist = document.getElementsByName('checklist');
		  // loop over them all
		  var list_id = '';
		  var del_all = $(this);
		  for (var i=0; i<checklist.length; i++) {
		       if (checklist[i].checked == true)
		       {
                   list_id = list_id + ((list_id == '') ? (checklist[i].value) : (','+checklist[i].value));
		       }
		  }
		  	
		if (list_id == '')
		{
			alert('Vui lòng chọn những bài viết cần xóa');
		}else{ 
             check_del = confirm('Bạn muốn xóa dòng này');
	        if (check_del == true)
	        {
			    $.ajax({
			    	type : 'POST',
			    	url  : del_all.attr('href'),
			    	data : {'list_id' : list_id},
			    	success: function(data){
			    		result = JSON.parse(data);
			    		if (result.result)
			    		{
			    			window.location.href = result.result;
			    		}
			    		else
			    		{
			    			alert(result.error);
			    		}
			    	}
			    });
			}
			else{
				return false;
			}
		}


	});



});
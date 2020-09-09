$(document).ready(function () {
	Cufon.replace('.logo .title');	
			
	InitGraphs ();
		
	InitMenuEffects ();
	
	InitNotifications ();
	
	InitContentBoxes ();
	
	InitTables ();	
	
	InitFancybox ();
	        
        InitQuickEdit ();
});


/* *********************************************************************
 * Main Menu
 * *********************************************************************/
function InitMenuEffects () {
	/* Sliding submenus */
	$('.sidebar .menu ul ul').hide();
	$('.sidebar .menu ul li.active ul').show();
	
	$('.sidebar .menu ul li').click(function () {
		submenu = $(this).find('ul');
		if (submenu.is(':visible'))
			submenu.slideUp(150);					
		else
			submenu.slideDown(200);									
		//return false;
	});
	
	/* Hover effect on links */
	$('.sidebar .menu li a').hover(
		function () { $(this).stop().animate({'paddingLeft': '18px'}, 200); },
		function () { $(this).stop().animate({'paddingLeft': '12px'}, 200); }
	)
}

/* *********************************************************************
 * Content Boxes
 * *********************************************************************/
function InitContentBoxes () {
	/* Checkboxes */
	$('.content-box .select-all').click(function () {
		if ($(this).is(':checked'))
			$(this).parent().parent().parent().parent().find(':checkbox').attr('checked', true);
		else
			$(this).parent().parent().parent().parent().find(':checkbox').attr('checked', false); 
	});
	
	/* Tabs */
	$('.content-box .tabs').idTabs();
}

/* *********************************************************************
 * Notifications
 * *********************************************************************/
function InitNotifications () {
	$('.notification .close').click(function () {
		$(this).parent().fadeOut(1000, function() {
			$(this).find('p').fixClearType ();
		});		
		return false;
	});
}

/* *********************************************************************
 * Data Tables
 * *********************************************************************/
function InitTables () {
	$('.datatable').dataTable({
		'bLengthChange': true,
		'bPaginate': true,
		'sPaginationType': 'full_numbers',
		'iDisplayLength': 15,
		'bInfo': false,
		'oLanguage': 
		{
			'sSearch': 'Search all columns:',
			'oPaginate': 
			{
				'sNext': '&gt;',
				'sLast': '&gt;&gt;',
				'sFirst': '&lt;&lt;',
				'sPrevious': '&lt;'
			}
		},		
		'aoColumns': [ 
			{ "bSortable": false },
			null,
			null,
			null,
			null,
			null,
			null
		]	
	});
}

/* *********************************************************************
 * Graphs
 * *********************************************************************/
function InitGraphs () {
	$('.visualize1').visualize({
			'type': 'pie',
			'width': '250px',
			'height': '250px'
	});

	$('.visualize2').visualize({
			'type': 'bar',
			'width': '250px',
			'height': '250px'
	});

	$('.visualize3').visualize({
			'type': 'line',
			'width': '250px',
			'height': '250px'
	});
	
	$('.visualize4').visualize({
			'type': 'area',
			'width': '250px',
			'height': '250px'
	});
}

/* *********************************************************************
 * Fancybox
 * *********************************************************************/
function InitFancybox () {
	$('.modal-link').fancybox({
		'modal' 				: false,
		'hideOnOverlayClick' 	: 'true',
		'hideOnContentClick' 	: 'true',
		'enableEscapeButton' 	: true,
		'showCloseButton' 		: true		
	});
	
	$("a[href$='gif']").fancybox();
	$("a[href$='jpg']").fancybox();
	$("a[href$='png']").fancybox(); 	
}
/* *********************************************************************
 * Quick Edit
 * *********************************************************************/
function InitQuickEdit () {
	$.editable.addInputType('datepicker', {
                element : function(settings, original) {
                    var input = $('<input>');
                    if (settings.width  != 'none') { input.width(settings.width);  }
                    if (settings.height != 'none') { input.height(settings.height); }
                    input.attr('autocomplete','off');
                    $(this).append(input);
                    return(input);
                },
                plugin : function(settings, original) {
                    var form = this;
                    settings.onblur = 'ignore';
                    $(this).find('input').datepicker({
                        firstDay: 1,
                        dateFormat: 'dd/mm/yy',
                        closeText: 'X',
                        onSelect: function(dateText) { 
                                $(this).hide(); 
                                $(form).trigger('submit'); 
                        },
                        onClose: function(dateText) {
                                original.reset.apply(form, [settings, original]);
                                $(original).addClass(settings.cssdecoration);
                                $(this).hide(); 
                                $(form).trigger('submit'); 
                        }
                    });
                }
        });


		
        $('.quick_edit').click(function () {
                $(this).parent().parent().find('td.edit-field').click();
                return false;
        });
        
        $('.edit-textfield').editable('http://www.google.com/', {
                'type': 'text'
        });

        $('.edit-date').editable('date.html', {
             'type' : 'datepicker'
        });
       
        $('.edit-textarea').editable('http://www.google.com/', {
                'type': 'textarea'
        });
        
        $('.edit-select').editable('http://www.google.com/', {
                'data': "{'true': 'Active', 'false': 'Inactive'}",
                'type': 'select'
        });        
}

jQuery.fn.fixClearType = function(){
    return this.each(function(){
        if( !!(typeof this.style.filter  && this.style.removeAttribute))
            this.style.removeAttribute("filter");
    })

} 

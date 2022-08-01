<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="ngaspari">
        
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>List of contacts</title>
        
        <link href="{{ asset('css/contacts.css') }}" media="screen" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/redmond/jquery-ui.min.css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.13.2/css/ui.jqgrid.min.css">
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.13.2/js/jquery.jqgrid.src.js"></script>
        
        <script>
        $(document).ready(function() {
        	$(".main").show(500);

        	var csrfHeader=$('meta[name="csrf-token"]').attr('content');
        	$.ajaxSetup({
        	    headers : {
        	        'X-CSRF-Token' : csrfHeader
        	    }
        	});

        	$("#grid").jqGrid({
        		url: '/api/contacts',
        		datatype: "json",
        	   	mtype: "GET",
        	   	colNames:[			
        			"#",
        			"Ime",
        			"Prezime",
        			"Email",
        			"Telefon",
        			"Detalji"
        	   	],
        	   	colModel:[	   		
        	   		{name:'id', index:'id', hidden: true},
        	   		{name:'firstName',align:"firstName", width: 200, align:"left", editable: true },
        	   		{name:'lastName',align:"lastName", width: 200, align:"left", editable: true },
        	   		{name:'email',align:"email", width: 200, align:"center", editable: true },
        	   		{name:'phoneNumber',align:"phoneNumber", width: 200, align:"center", editable: true },
        	   		{name:'details', width:100,'editable':false, align:'center',
    		  	   		formatter:function(cellvalue, options, rowObject)
    	   		    	{
    		  	   		return '<button onclick="showContactDetails('+rowObject['id']+')"> ... </button>';
    	   		    	}
			  	   	},
        		],
        		pager: "#pager",
        		autowidth: true,
        		shrinkToFit: false,
        	   	rowNum: 20,
        	   	rowList: [5, 20, 50, 100],
        	   	viewrecords: true,
        	   	sortname: "id",
        	   	sortorder: "asc",
        	    iconSet: "fontAwesome",
        	    loadComplete: function ( data ) {
                    if ("error" in data ) {
                    	alert(data.error);
        			}
        	    },
        	    multiselect : false
        	}).navGrid("#pager",{add: true, edit:true, view:false, del:true, search: false},
        			/** edit **/
        			{
        				url: '/api/contacts',
        				mtype: "PUT",
        				delData: {
        					id: function(){
        						selRowId = $("#grid").jqGrid ('getGridParam', 'selrow'),
        						rowData = $("#grid").getRowData(rowId);
                                return rowData['id'];
        					}
        				},
        				modal: true,
        				afterSubmit : function(response, postdata){
        					var success = true;
        					var message = "";
        					var responseObj = $.parseJSON(response['responseText']);
        					if("success" in responseObj){
        						success = true;
        					}else if ("error" in responseObj){
        						success = false;
        						message = responseObj['error'];
        					}
        					return [success, message];
        				},
        				closeAfterAdd:true,
        				closeAfterEdit:true,
        				reloadAfterSubmit:true
                    },
        			/** add **/
        			{
                    	url: '/api/contacts',
        				mtype: "POST",
        				modal: true,
        				afterSubmit : function(response, postdata){
        					var success = true;
        					var message = "";
        					var responseObj = $.parseJSON(response['responseText']);
        					if("success" in responseObj){
        						success = true;
        					}else if ("error" in responseObj){
        						success = false;
        						message = responseObj['error'];
        					}
        					return [success, message];
        				},
        				closeAfterAdd:true,
        				closeAfterEdit:true,
        				reloadAfterSubmit:true
                    },
        			/** delete **/
        			{
        				url: '/api/contacts',
        				mtype: "DELETE",
        				delData: {
        					id: function(){
        						selRowId = $("#grid").jqGrid ('getGridParam', 'selrow'),
        						rowData = $("#grid").getRowData(rowId);
                                return rowData['id'];
        					}
        				},
        				modal: true,
        				afterSubmit : function(response, postdata){
        					var success = true;
        					var message = "";
        					var responseObj = $.parseJSON(response['responseText']);
        					if("success" in responseObj){
        						success = true;
        					}else if ("error" in responseObj){
        						success = false;
        						message = responseObj['error'];
        					}
        					return [success, message];
        				},
        				reloadAfterSubmit:true
        			},
                    {sopt:['cn','nc','eq','ne'], multipleSearch : false})
        	.filterToolbar({searchOperators: true, searchOnEnter: true, enableClear: false, defaultSearch : "cn", ignoreCase: true, stringResult: true })
        	.navButtonAdd("#pager",{
        		caption:"",
        		   title: "Click",
        		   buttonicon:"fa-file-excel-o",
        		   onClickButton: function(){
        			   alert('click!');
        		   },
        		   position:"last"
        	});
        });

        function showContactDetails( id ) {
            var baseUrl = "{{ url('/contacts/details') }}";
            $(location).attr('href', baseUrl + '/' + id);
        }
        </script>
        
    </head>
    <body>
        <div class="main" style='display: none;'>
            <h1>List of contacts</h1>
            
            <div>
                <table id="grid"></table>
                <div id="pager"></div>
            </div>            
        </div>
        
        <a href="{{ url('/') }}">Home</a> 
    </body>
</html>

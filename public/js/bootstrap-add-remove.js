/*$(window).load(function(){
$(function() {
	var scntDiv = $('.tel');
	var i = $('.tel p').size() + 1;
	
	$('#add-tel').live('click', function() {
		$('<p class="add-less-icon remove-pad">\
            <select class="selectpicker show-tick select-menu textfield-25">\
              <option value="0" selected>Select Mobile / Landline / Fax:</option>\
              <option value="Mobile">Mobile</option>\
              <option value="Work">Work</option>\
              <option value="Residence">Residence</option>\
              <option value="Fax">Fax</option>\
            </select> &nbsp; &nbsp; \
            <input type="tel" name="" class="mobile-number textfield-telcode textfield-30" placeholder="Enter Number:"><a href="javascript:void(0);" id="rem-tel"><span class="glyphicon glyphicon-trash"></span></a>\
          </p>').appendTo(scntDiv);
		  $(".mobile-number").intlTelInput();
		  $(".selectpicker").selectpicker();
		i++;
		return false;
	});
	
	$('#rem-tel').live('click', function() { 
		if( i > 2 ) {
				$(this).parents('p').remove();
				i--;
		}
		return false;
	});
});
	
$(function() {
	var scntDiv = $('#emails');
	var i = $('#emails p').size() + 1;
	
	$('#add-emails').live('click', function() {
		$('<p class="add-less-icon">\
		     <input type="email" name="" class="textfield textfield-60" placeholder="Email Id:"><a href="javascript:void(0);" id="rem-emails"><span class="glyphicon glyphicon-trash"></span></a>\
		   </p>').appendTo(scntDiv);
		i++;
		return false;
	});
	
	$('#rem-emails').live('click', function() { 
		if( i > 2 ) {
				$(this).parents('p').remove();
				i--;
		}
		return false;
	});
});

$(function() {
	var scntDiv = $('#meeting-agenda');
	var i = $('#meeting-agenda p').size() + 1;
	
	$('#add-meeting-agenda').live('click', function() {
		$('<p class="add-less-icon">\
		     <span class="add-less-text">3. Discussion on the new project.</span><a href="javascript:void(0);" id="rem-meeting-agenda"><span class="glyphicon glyphicon-trash"></span></a>\
		   </p>').appendTo(scntDiv);
		i++;
		return false;
	});
	
	$('#rem-meeting-agenda').live('click', function() { 
		if( i > 2 ) {
				$(this).parents('p').remove();
				i--;
		}
		return false;
	});
});

$(function() {
	var scntDiv = $('.document-attachment');
	var i = $('.document-attachment p').size() + 1;
	
	$('#add-document-attachment').live('click', function() {
		$('<p class="add-less-icon remove-pad">\
            <input type="file" name="" id="" data-buttonText="&nbsp;&nbsp;Attachments" class="filestyle filefield"> &nbsp; \
            <span class="remove-ddff">\
              <select class="selectpicker show-tick multiselect-menu textfield-35" multiple data-selected-text-format="count>3">\
                <option value="Technical Specifications">Technical Specifications</option>\
                <option value="Rate Card">Rate Card</option>\
                <option value="Product / Service Photos">Product / Service Photos</option>\
                <option value="Presentation">Presentation</option>\
                <option value="Brochure">Brochure</option>\
                <option value="Other">Other</option>\
              </select>\
            </span><a href="javascript:void(0);" id="rem-document-attachment"><span class="glyphicon glyphicon-trash"></span></a>\
          </p>').appendTo(scntDiv);
		  $(".filestyle").filestyle();
		  $(".multiselect-menu").selectpicker();
		i++;
		return false;
	});
	
	$('#rem-document-attachment').live('click', function() { 
		if( i > 2 ) {
				$(this).parents('p').remove();
				i--;
		}
		return false;
	});
});

$(function() {
	var scntDiv = $('.qapproval');
	var i = $('.qapproval p').size() + 1;
	
	$('#add-qapproval').live('click', function() {
		$('<p class="add-less-icon remove-pad">\
                <input type="text" name="location" id="name-b" class="textfield textfield-50" onKeyPress="return isCharKey(event);" placeholder="Type to select the people who would approve quotation:"> &nbsp; \
                <select class="selectpicker show-tick select-menu textfield-30">\
                  <option selected>Select:</option>\
                  <option value="Edit &amp; Approve">Edit &amp; Approve</option>\
                  <option value="Approve">Approve</option>\
                </select><a href="javascript:void(0);" id="rem-qapproval"><span class="glyphicon glyphicon-trash"></span></a>\
              </p>').appendTo(scntDiv);
		  $(".selectpicker").selectpicker();
		i++;
		return false;
	});
	
	$('#rem-qapproval').live('click', function() { 
		if( i > 2 ) {
				$(this).parents('p').remove();
				i--;
		}
		return false;
	});
});

$(function() {
	var scntDiv = $('.cdocuments');
	var i = $('.cdocuments p').size() + 1;
	
	$('#add-cdocuments').live('click', function() {
		$('<p class="add-less-icon remove-pad">\
            <select class="selectpicker show-tick select-menu textfield-30">\
              <option value="0" selected>Attach Company Documents:</option>\
              <option value="Registration Documents">Registration Documents</option>\
              <option value="PAN Number">PAN Number</option>\
            </select> &nbsp; &nbsp; \
            <input type="file" name="" id="" data-buttonText="&nbsp;&nbsp;Attachments" class="filestyle filefield"><a href="javascript:void(0);" id="rem-cdocuments"><span class="glyphicon glyphicon-trash"></span></a>\
          </p>').appendTo(scntDiv);
		  $(".selectpicker").selectpicker();
		  $(".filestyle").filestyle();
		i++;
		return false;
	});
	
	$('#rem-cdocuments').live('click', function() { 
		if( i > 2 ) {
				$(this).parents('p').remove();
				i--;
		}
		return false;
	});
});

$(function() {
	var scntDiv = $('.cdetails');
	var i = $('.cdetails p').size() + 1;
	
	$('#add-cdetails').live('click', function() {
		$('<p class="add-less-icon remove-pad">\
            <select class="selectpicker show-tick select-menu textfield-30">\
              <option value="0" selected>Client Company Details:</option>\
              <option value="Registration Documents">Service Tax No.</option>\
              <option value="PAN Number">PAN No.</option>\
              <option value="CST Number">CST No.</option>\
              <option value="VAT Number">VAT No.</option>\
              <option value="TIN Number">TIN No.</option>\
            </select> &nbsp; &nbsp; \
            <input type="text" name="" id="to" class="textfield textfield-30" placeholder="Registration Number Details:"><a href="javascript:void(0);" id="rem-cdetails"><span class="glyphicon glyphicon-trash"></span></a>\
          </p>').appendTo(scntDiv);
		  $(".selectpicker").selectpicker();
		i++;
		return false;
	});
	
	$('#rem-cdetails').live('click', function() { 
		if( i > 2 ) {
				$(this).parents('p').remove();
				i--;
		}
		return false;
	});
});
});*/
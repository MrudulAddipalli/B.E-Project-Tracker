/*==================== Youtube Video in pop up ====================*/


autoPlayYouTubeModal();

 //FUNCTION TO GET AND AUTO PLAY YOUTUBE VIDEO FROM DATATAG
 function autoPlayYouTubeModal() {
     var trigger = $("body").find('[data-toggle="modal"]');
     trigger.click(function () {
         var theModal = $(this).data("target"),
             videoSRC = $(this).attr("data-theVideo"),
             videoSRCauto = videoSRC + "?autoplay=1";
         $(theModal + ' iframe').attr('src', videoSRCauto);
         $(theModal + ' button.close').click(function () {
             $(theModal + ' iframe').attr('src', videoSRC);
         });
         $('.modal').click(function () {
             $(theModal + ' iframe').attr('src', videoSRC);
         });
     });
 }

/*==================== Collapse Link Hide Start ====================*/
$(window).load(function(){
	$('.link-to-hide').bind('click .......... ', function(e) {
		$(this).addClass('link-hide');
	});
});
/*==================== Collapse Link Hide End ====================*/

/*==================== Notification Panel Start ====================*/
$(window).load(function(){
$(document).ready(function()
{
    var slider_width = $('.notification-slider').width();//get width automaticly
  $('#notification-slider-link').click(function() {
    if($(this).css("margin-right") == slider_width+"px" && !$(this).is(':animated'))
    {
        $('.notification-slider,#notification-slider-link').animate({"margin-right": '-='+slider_width});
    }
    else
    {
        if(!$(this).is(':animated'))//perevent double click to double margin
        {
            $('.notification-slider,#notification-slider-link').animate({"margin-right": '+='+slider_width});
        }
    }
  });
 });     
});
/*==================== Notification Panel End ====================*/

/*==================== Popover Start ====================*/
$("[data-toggle=popover]")
.popover()
/*==================== Popover End ====================*/

/*==================== List Settings Dropdown Start ====================*/
$(document).ready(function(){
	$('.open-dropdown').hide();
	
	$(document).on('click', ".show-hide", function(e){
    	e.stopPropagation();
		$('.open-dropdown').not($(this).parent("td").find('.open-dropdown')).slideUp();		//hide other "open-dropdown" div's except the current clicked.		
		$(this).parent("td").find('.open-dropdown').slideToggle();							//display the "open-dropdown" div of the setting icon clicked.    	
	  $(".mk-nicescroll").getNiceScroll().resize();
    
  });
	
	$(window).click(function(){		
      $('.open-dropdown').slideUp();
    	

      
	});
	
	//avoid hiding of dropdown when clicked inside the div.
/*	$('.open-dropdown').click(function(e){
		e.stopPropagation();
		return true;
	});*/
});
/*==================== List Settings Dropdown End ====================*/

/*==================== Search & Support Collapse Start ====================*/
$('#search-slider-link').click(function(e){
  var search_div=$('.search-open');
  console.log(search_div);
  if($(search_div).children().length==0){
    $(search_div).load("../../includes/"+search_dir+"/inc-search.php",function(){

        //initialize plugins for form
        $(".selectpicker").selectpicker();
        $(".js-example-basic-multiple").select2({
          placeholder: "Select something"
        });
        $(".js-example-basic-single").select2({
          placeholder: "Select any one"
        });
        $( '.select-calendar-datepicker' ).pickadate({
            selectYears: true,
            selectMonths: true
        });
    });
    
    
  }
});
/*==================== Search & Support Collapse End ====================*/

/*==================== Reports Dynamic Load Start ====================*/
$(window).load(function(){
    $('.reports-tab-show').click(function(e){
      var reports_div=$('.reports-div');

      if($(reports_div).children().length==0){
        $(reports_div).load("includes/inc-reports.php",function(){

          $.getScript( "js/rgraph.js", function() {
            $.getScript( "js/jPushMenu.js", function() {
              $('.toggle-menu').jPushMenu();
              $.getScript( "js/chartist/chartist.js", function() {
                  $.getScript( "js/chartist/chartist-plugin-legend.js", function() {
                      $.getScript( "js/jquery.velocity.min.js", function() {
                        $.getScript( "js/DataTables/datatables.js", function() {
                            $.getScript( "js/datepicker.js", function() {
                                $.getScript( "js/mtree.js", function() {
                                /*var mtree = $('ul.mtree');

                                s.find('button:first').addClass('active');
                                s.find('.csl').on('click.mtree-close-same-level', function(){
                                  $(this).toggleClass('active');
                                });*/
                                //Script That was on the main page but wasn't in use
                                });
                            });
                        });
                      });
                  });
              });
            });
          });
        });
      }
    });
});
/*==================== Reports Dynamic Load Collapse End ====================*/

/*==================== Table Row BG Hover & Selected Start ====================*/
$(window).load(function(){
$(document).ready(function () {
    $('#leads tr').click(function () {
        $('#leads tr').removeClass("active");
        $(this).addClass("active");
    });
});
});
/*==================== Table Row BG Hover & Selected End ====================*/

/*==================== User Permissions Fix Button Wrap Start ====================*/
$(window).load(function(){
  $(document).scroll(function () {
    var y = $(this).scrollTop();
    if (y > 200) {
        $('.up-btn-wrap').fadeIn();
    } else {
        $('.up-btn-wrap').fadeOut();
    }

  });
});
/*==================== User Permissions Fix Button Wrap End ====================*/

/*==================== Autocomplete Start ====================*/
$(function() {
var availableTags = [
"Data Systems",
"Extensive Enterprise",
"General Services Corporation",
"Globex Corporation",
"Incom Corporation",
"Industrial Automation",
"Mainway Toys",
"QWERTY Logistics",
"Smith and Co.",
"Western Gas & Electric"
];
$( "#company" ).autocomplete({
source: availableTags
});
});

$(function() {
var availableTags = [
"Mumbai, Maharashtra, India",
"Surat, Gujarat, India",
"Jaipur, Rajasthan, India",
"Pune, Maharashtra, India",
"Amritsar, Punjab, India",
"Madhya Pradesh, India",
"Andhra Pradesh, India",
"Maharashtra, India"
];
$( "#tags" ).autocomplete({
source: availableTags
});
});

$(function() {
var availableTags = [
"Arnold Jobin",
"C K Fernandes",
"Daniel Dsouza",
"John Smith",
"Kapil Sharma",
"Mark Tailor",
"Michael Jo",
"Rahul Vector",
"Raj Malhotra",
"Rajiv Garia"
];
$( "#name" ).autocomplete({
source: availableTags
});
});

$(function() {
var availableTags = [
"CM's",
"Meter",
"Feet",
"Kilo",
"Litre",
"Dozen",
"Pieces"
];
$( "#uom" ).autocomplete({
source: availableTags
});
});

$(function() {
var availableTags = [
"Arnold Jobin",
"C K Fernandes",
"Daniel Dsouza",
"John Smith",
"Kapil Sharma",
"Mark Tailor",
"Michael Jo",
"Rahul Vector",
"Raj Malhotra",
"Rajiv Garia"
];
$( "#name-a" ).autocomplete({
source: availableTags
});
});

$(function() {
var availableTags = [
"Arnold Jobin",
"C K Fernandes",
"Daniel Dsouza",
"John Smith",
"Kapil Sharma",
"Mark Tailor",
"Michael Jo",
"Rahul Vector",
"Raj Malhotra",
"Rajiv Garia"
];
$( "#name-b" ).autocomplete({
source: availableTags
});
});

$(function() {
var availableTags = [
"Product 1 (Pro-1010)",
"Product 2",
"Product 3 (Pro-1011)",
"Product 4",
"Product 5 (Pro-1012)",
"Service 1",
"Service 2",
"Service 3",
"Service 4",
"Service 5"
];
$( "#products-services" ).autocomplete({
source: availableTags
});
});

$(function() {
var availableTags = [
"Abhishek Naik",
"Anand Korti",
"Gaurav Patki",
"Pritam Khubdikar",
"Rahul Saxena",
"Ramesh Agnihotri",
"Sagar Malvi",
"Sagar Sudku",
"Sharon Fernandes",
"Shweta Shetty"
];
$( "#user-name" ).autocomplete({
source: availableTags
});
});
/*==================== Autocomplete End ====================*/

/*==================== On / Off Start ====================*/
$(function(){
$(function(){
    $("ul li").click(function(){
        $("ul li").removeClass("on");
        $(this).addClass("on");
    });
});
});//]]>
/*==================== On / Off End ====================*/

/*==================== Radio Button Tab Start ====================*/
$("#tbl-2").hide(0);
$(".step-2").change(function(e){
	$(".list-tbl").hide(0);
	var div=$(this).attr("show-div");
	$("#"+div).show();
});
/*==================== Radio Button Tab End ====================*/

/*==================== Icon Menu Change Start ====================*/
// Read a page's GET URL variables and return them as an associative array.
function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

var currentMod="";
//check if query string exists
if($.trim(window.location.search)!="") {
	currentMod=getUrlVars()["currentMod"];		//get the currentMod value
}

$(document).ready(function() {
	//apply query string to all icons
    $(".section-icons").each(function(){
        console.log(".section-icons"+currentMod);
        if(currentMod!=undefined && currentMod!=''){
            var newHref = $(this).find("a").attr("href");
            newHref += "?currentMod="+currentMod;
            console.log("section"+newHref);
            $(this).find("a").attr("href", newHref);
        }
    });

	//apply query string to all breadcrumb links except dashboard link (using slice)
	$(".breadcrumb li").slice(1).each(function(e){
        console.log(".breadcrumb li"+currentMod);
        if(currentMod!=undefined && currentMod!=''){
            //console.log($(this).find("a").attr("href"));
            if($(this).find("a").attr("href")){
                var newHref = $(this).find("a").attr("href");
                newHref += "?currentMod=" + currentMod;
                console.log("breadcrumbs-li" + newHref);
                $(this).find("a").attr("href", newHref);
            }
        }
	});
});
/*==================== Icon Menu Change End ====================*/

function validateJSON (str){
    try{
        JSON.parse(str);
        return true;
    }
    catch(err){
        //return err;
        console.log(err);
        return false;
    }
}
function isAlphaNumeric(str)
{
    //return /((^[0-9]+[a-z]+)|(^[a-z]+[0-9]+))+[0-9a-z]+$/i.test(str);
    return /^(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%&?*"])[a-zA-Z0-9!@#$%&?*]{8,15}$/.test(str);

}
function IsValidEmail(email)
{
    var IsEmail=true;
    if(email==""){
        IsEmail=false;
    }else{
        var eml= new  String(email);
        var atpos=eml.indexOf("@");
        var dotpos=eml.lastIndexOf(".");
        if((atpos==-1) || (dotpos==-1) || atpos< 1 || dotpos<atpos+2 || dotpos+2>=email.length){
            IsEmail=false;
        }
    }
    return IsEmail;
}
function populateSelectElement(select_element_id,option_arr)
{
    //TODO issue is figuring out property names of option_arr (like value.id,value.data_name will be different in every case)
}
function getPSTags(dir_path,select_element_id) //CAUTION : THESE ARE PRODUCT TYPE TAGS! NOT ACTUAL PRODUCTS/SERVICES
{
    var product_tag_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        data:{
            action:'get_ps_tag'
        },
        type:'POST',
        async:false,
        success:function(data){
            if(data!='err')
            {
                product_tag_arr=JSON.parse(data);
                if(select_element_id!='')
                {
                    $.each(product_tag_arr,function(index,value){
                        $('#'+select_element_id).append($('<option>', {
                            value: value.id,
                            text: value.tag_name
                        }));
                    });
                }
                //$("#"+select_element_id).selectpicker("refresh"); commented as there maybe other plugin apart from selectpicker, tobehandled in individual page
            }
        }
    });
    return product_tag_arr;
}
function getProductsServices(dir_path,select_element_id)
{
    var product_services_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        data:{
            action:'get_product_service_listing'
        },
        type:'POST',
        async:false,
        success:function(data){
            if(data!='err')
            {
                product_services_arr=JSON.parse(data);
                if(select_element_id!='')
                {
                    $.each(product_services_arr,function(index,value){
                        $('#'+select_element_id).append($('<option>', {
                            value: value.ps_id,
                            text: value.ps_name
                        }));
                    });
                }
                //$("#"+select_element_id).selectpicker("refresh"); commented as there maybe other plugin apart from selectpicker, tobehandled in individual page
            }
        }
    });
    return product_services_arr;
}
function getPhoneType(dir_path,select_element_id)
{
    var phone_type_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        type:'POST',
        data: {
            action: 'get_phone_type_listing'
        },
        async:false,
        success:function(data){
            if(data!="err")
            {
                phone_type_arr=JSON.parse(data);
                if(select_element_id!="")
                {
                    $.each(phone_type_arr,function(index,value){

                        $("#"+select_element_id).append($('<option>', {
                            value: value.id,
                            text: value.phone_type_name
                        }));
                    });
                }
                //$("#"+select_element_id).selectpicker("refresh"); commented as there maybe other plugin apart from selectpicker, tobehandled in individual page
            }
        }
    });
    return phone_type_arr;
}
function getEmailType(dir_path,select_element_id)
{
    var email_type_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        type:'POST',
        data: {
            action: 'get_email_type_listing'
        },
        async:false,
        success:function(data){
            if(data!="err")
            {
                email_type_arr=JSON.parse(data);
                $.each(email_type_arr,function(index,value){
                    $("#"+select_element_id).append($('<option>', {
                        value: value.id,
                        text: value.email_type_name
                    }));
                });
                //$("#"+select_element_id).selectpicker("refresh");
            }

        }
    });
}
function getCommunicationPreference(dir_path,select_element_id)
{
    var comm_pref_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        type:'POST',
        data: {
            action: 'get_comm_pref_listing'
        },
        async:false,
        success:function(data){
            if(data!="err")
            {
                comm_pref_arr=JSON.parse(data);
                $.each(comm_pref_arr,function(index,value){
                    $("#"+select_element_id).append($('<option>', {
                        value: value.id,
                        text: value.communication_preference_name
                    }));
                });
                //$("#"+select_element_id).selectpicker("refresh"); commented as there maybe other plugin apart from selectpicker, tobehandled in individual page
            }

        }
    });
}
function getLeadTags(dir_path)
{
    var data_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        type:'POST',
        data: {
            action: 'get_lead_tag'
        },
        async:false,
        success:function(data){
            if(data!="")
            {
                data_arr=JSON.parse(data);

            }
        },
        error:function(data){
            data_arr= "err";
        }
    });
    return data_arr;
}
function getFormFields(dir_path)
{
    var data_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        type:'POST',
        data:{
            action:'get_bas_field'
        },
        async:false,
        success:function(data){
            if(data!="err")
            {
                data_arr=JSON.parse(data);
            }
        },
        error:function(data){
            data_arr= "err";
        }
    });
    return data_arr;
}

//------------------written by bhupinder-----------------
function getUsername(dir_path,select_element_id)
{
    var product_services_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        data:{
            action:'get_users'
        },
        type:'POST',
        async:false,
        success:function(data){
            if(data!='err')
            {
                users_arr=JSON.parse(data);
                if(select_element_id!='')
                {
                    $.each(users_arr,function(index,value){
                        $('#'+select_element_id).append($('<option>', {
                            value: value.contact_id,
                            text: value.user
                        }));
                    });
                }
                //$("#"+select_element_id).selectpicker("refresh"); commented as there maybe other plugin apart from selectpicker, tobehandled in individual page
            }
        }
    });
    return users_arr;
}

function getUsernameWithPhone(dir_path,select_element_id)
{
    var product_services_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        data:{
            action:'get_users_with_phone'
        },
        type:'POST',
        async:false,
        success:function(data){
            if(data!='err')
            {
                users_arr=JSON.parse(data);
                if(select_element_id!='')
                {
                    $.each(users_arr,function(index,value){
                        $('#'+select_element_id).append($('<option>', {
                            value: value.contact_id,
                            text: value.user
                        }));
                    });
                }
                //$("#"+select_element_id).selectpicker("refresh"); commented as there maybe other plugin apart from selectpicker, tobehandled in individual page
            }
        }
    });
    return users_arr;
}


function getUsernameEmail(dir_path,select_element_id)
{
    var product_services_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        data:{
            action:'get_users-email'
        },
        type:'POST',
        async:false,
        success:function(data){
            if(data!='err')
            {
                users_arr=JSON.parse(data);
                if(select_element_id!='')
                {
                    $.each(users_arr,function(index,value){
                        $('#'+select_element_id).append($('<option>', {
                            value: value.mix_id,
                            //value: value.contact_id,
                            text: value.user_emailadd
                        }));
                    });
                }
                //$("#"+select_element_id).selectpicker("refresh"); commented as there maybe other plugin apart from selectpicker, tobehandled in individual page
            }
        }
    });
    return users_arr;
}


// For assigning a person

function getAssign(dir_path,select_element_id)
{
    var product_services_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        data:{
            action:'get_assign'
        },
        type:'POST',
        async:false,
        success:function(data){
            if(data!='err')
            {
                assign_arr=JSON.parse(data);
                if(select_element_id!='')
                {
                    $.each(assign_arr,function(index,value){
                        $('#'+select_element_id).append($('<option>', {
                            value: value.contact_id,
                            text: value.user
                        }));
                    });
                }
                //$("#"+select_element_id).selectpicker("refresh"); commented as there maybe other plugin apart from selectpicker, tobehandled in individual page
            }
        }
    });
    return assign_arr;
}
function getMeetTags(dir_path)
{
    var data_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        type:'POST',
        data: {
            action: 'get_meet_tag'
        },
        async:false,
        success:function(data){
            if(data!="")
            {
                data_arr=JSON.parse(data);

            }
        },
        error:function(data){
            data_arr= "err";
        }
    });
    return data_arr;
}

function getLead1Tags(dir_path)
{
    var data_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        type:'POST',
        data: {
            action: 'get_sms_tag'
        },
        async:false,
        success:function(data){
            if(data!="")
            {
                data_arr=JSON.parse(data);

            }
        },
        error:function(data){
            data_arr= "err";
        }
    });
    return data_arr;
}
function getUserTags(dir_path)
{
    var data_arr='';
    $.ajax({
        url:dir_path+'controllers/ajax-ctrlr.php',
        type:'POST',
        data: {
            action: 'get_user_tag'
        },
        async:false,
        success:function(data){
            if(data!="")
            {
                data_arr=JSON.parse(data);

            }
        },
        error:function(data){
            data_arr= "err";
        }
    });
    return data_arr;
}
/*==================== Select2, Nicescroll & Common DataTables Initilization Start ====================*/
$(document).ready(function() {
 $(".mk-nicescroll").niceScroll();
 $('.data_table_modal').DataTable({
     "ordering": false,
     responsive : true,
     "searching": false,
     "info"     : false,
     "sDom"     : '<"top"><"title">t<"bottom">',
     "language": {
     "paginate": {
     "previous": "Prev"
    }
    }
    });
});
/*==================== Select2, Nicescroll & Common DataTables Initilization End ====================*/
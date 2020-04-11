$(document).ready(function(){ 
   

   $.fn.uncheckableRadio = function() {

        return this.each(function() {
            $(this).mousedown(function() {
                $(this).data('wasChecked', this.checked);
            });

            $(this).click(function() {
                if ($(this).data('wasChecked'))
                    this.checked = false;
            });
        });

  };
  //$('input[type=radio]').uncheckableRadio();

	// $("textarea,#lead-m-enter-company,#enter-company,#lead-m-company-client,#lead-m-company-name2,#email_subject").not('input.lowercase[type=\'text\'],#ps_codeno').keyup(function() {

 //    // store current positions in variables
 //    var start = this.selectionStart,
 //        end = this.selectionEnd;
	//   $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1));
 //    this.setSelectionRange(start, end);
	// });

 //  $("input[type=\'text\']").not('input.lowercase[type=\'text\'],#ps_codeno,#lead-m-enter-company,#enter-company,#lead-m-company-client,#lead-m-company-name2,#email_subject').keyup(function() {
 //    // store current positions in variables
 //    var start = this.selectionStart
 //    end = this.selectionEnd;
 //    $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1).toLowerCase());
 //     this.setSelectionRange(start, end);
 //  });
 //  
 //  change function
 $("#first-name,#middle-name,#last-name,#lead-m-firstname,#lead-m-middlename,#lead-m-lastname").change(function() {
    $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1).toLowerCase());
  });

  $("input[type=\'text\'],textarea").not('input.lowercase[type=\'text\'],#first-name,#middle-name,#last-name,#lead-m-firstname,#lead-m-middlename,#lead-m-lastname').change(function() {
      $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1));
  });

//  keyup function
 $("#first-name,#middle-name,#last-name,#lead-m-firstname,#lead-m-middlename,#lead-m-lastname").keyup(function() {
    // store current positions in variables
    var start = this.selectionStart
    end = this.selectionEnd;
    $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1).toLowerCase());
     this.setSelectionRange(start, end);
  });

  $("input[type=\'text\'],textarea").not('input.lowercase[type=\'text\'],#first-name,#middle-name,#last-name,#lead-m-firstname,#lead-m-middlename,#lead-m-lastname').keyup(function() {
         // store current positions in variables
      var start = this.selectionStart,
          end = this.selectionEnd;
      $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1));
      this.setSelectionRange(start, end);
  });

   $("input.lowercase[type=\'text\']").keyup(function() {
    // store current positions in variables
    var start = this.selectionStart
    end = this.selectionEnd;
    $(this).val().toLowerCase();
     this.setSelectionRange(start, end);
  });

    $('.lowercase').css('text-transform', 'lowercase');

    $('.lowercase').keyup(function(){
    var start = this.selectionStart,
          end = this.selectionEnd;
      $(this).val($(this).val().toLowerCase());
      this.setSelectionRange(start, end);
  });
   
    $("#resetform").click(function(){          /* Single line Reset function executes on click of Reset Button */
     $('#errors').html("");
     $('#errors').hide();
     $(".ResetClass").find("input[type=text],textarea").val('').end();
     $(".ResetClass").find("select").not('#assign-to,#assign_to').val('').trigger('change').end();
     $(".ResetClass").find("input[type=tel]").val('').trigger('change').end();
     $(".ResetClass").find("input[type=checkbox], input[type=radio]").prop("checked", false).end();
     $(".datepicker").flatpickr({
                    altInput: true,
                    altFormat: "d M Y",
                    dateFormat: "d M Y",
                    defaultDate: 'today',
      });
     console.log("123");
     disableelement();
    });
    
function disableelement(){
   var disableCompanyReset =  ['#comp-landline-1','#comp-landline-2','#comp-email-1','#comp-email-2','#comp-mobile-1','#comp-mobile-2','#comp-fax-1','#comp-fax-2', '#comp-country', '#comp-state', '#comp-city', '#comp-pincode', '#comp-address-line-1', '#comp-address-line-2', '#comp-address-line-3'];
     for (var i = 0; i < disableCompanyReset.length; i++) {
                var element = disableCompanyReset[i];
                $(element).prop('disabled', true);
      }
}
  //use to work select 2 under modal
  $.fn.modal.Constructor.prototype.enforceFocus = function() {};
  //to show flag with country mobile code
  $(".mobile-number").intlTelInput();

  $("#dateTo, #dateFrom").flatpickr({
        altInput: true,
        altFormat: "d M Y",
        dateFormat: "d M Y",
        defaultDate: "",
    });

  $(".select2_class").select2();              //Use select2 Class
 
  $('#search_top').click( function(){         //search icon toggle
    $('#search_fields').slideToggle();
  });

  $('.close_search').click( function(){
    $('#search_fields').slideUp();
  });

  $("#users").select2({                       //load search assigned users on type to text
            minimumInputLength:3,
            ajax: {
              url:'/load-users-search',
              dataType: 'json',
              delay : 1000, 
              data: function (params) {

                return {
                q: params.term // search term
                };
              },
              processResults: function (data) {
                return {
                results: data
                };
              },
              cache: true
            }
  });

  $("#companies").select2({                  //load search company on type to text
            minimumInputLength:3,
            ajax: {
              url:'/load-companies',
              dataType: 'json',
              delay : 1000, 
              data: function (params) {

                return {
                q: params.term // search term
                };
              },
              processResults: function (data) {
                return {
                results: data
                };
              },
              cache: true
            }
  });
      
  $("#country").select2({                     //load search country on type to text
        minimumInputLength:3,
        ajax: {
          url:'/load-countries',
          dataType: 'json',
          delay : 1000, 
          data: function (params) {

            return {
            q: params.term // search term
            };
          },
          processResults: function (data) {
            return {
            results: data
            };
          },
          cache: true
        }
  });
    
  $('#country').on('change', function(e){      //load states according to country
            $.ajax({
               type:'GET',
               url:'/load-states',
	       global: false,
               data:{
                      'country_id' : $(this).val()
                    },
               success:function(data){
                  $('#state').html('<option></option>');
                  $('#state').select2({data : data});
               }
            });
  });

  $('#state').on('change', function(e){        //load city according to state
            $.ajax({
               type:'GET',
               url:'/load-city',
	             global: false,
               data:{
                      'state_id' : $(this).val()
                    },
               success:function(data){
                  
                  $('#city').html('<option></option>');
                  $('#city').select2({data : data});
               }
            });
  });
   
  $("#sku").select2({                           //load SKU on select
        minimumInputLength:3,
        ajax: {
          url:'/load-products',
          dataType: 'json',
          delay : 1000, 
          data: function (params) {

            return {
            q: params.term // search term
            };
          },
          processResults: function (data) {
            return {
            results: data
            };
          },
          cache: true
        }
  });

  $("#product").select2({                       //load products on type to select
        minimumInputLength:3,
        ajax: {
          url:'/load-products',
          dataType: 'json',
          delay : 1000, 
          data: function (params) {

            return {
            q: params.term // search term
            };
          },
          processResults: function (data) {
            return {
            results: data
            };
          },
          cache: true
        }
  });

 $("#productcode").select2({           //load products service code on type to select
      minimumInputLength:3,
      allowClear: true,
      placeholder: '',
      ajax: {
        url:'/load-products-code',
        dataType: 'json',
        delay : 1000, 
        data: function (params) {

          return {
          q: params.term // search term
          };
        },
        processResults: function (data) {
          return {
          results: data
          };
        },
        cache: true
      }
   });
  
  $("#hsncode").select2({           //load products service hsn code on type to select

      minimumInputLength:3,
      allowClear: true,
      placeholder: '',
      ajax: {
        url:'/load-products-hsncode',
        dataType: 'json',
        delay : 1000, 
        data: function (params) {

          return {
          q: params.term // search term
          };
        },
        processResults: function (data) {
          return {
          results: data
          };
        },
        cache: true
      }
  });
   
$("#country1").select2({                     //load search country on type to text
        minimumInputLength:3,
        ajax: {
          url:'/load-countries',
          dataType: 'json',
          delay : 1000, 
          data: function (params) {

            return {
            q: params.term // search term
            };
          },
          processResults: function (data) {
            return {
            results: data
            };
          },
          cache: true
        }
  });
    
  $('#country1').on('change', function(e){      //load states according to country
            $.ajax({
               type:'GET',
               url:'/load-states',
	             global: false,	
               data:{
                      'country_id' : $(this).val()
                    },
               success:function(data){
                  $('#state1').html('<option></option>');
                  $('#state1').select2({data : data});
               }
            });
  });

  $('#state1').on('change', function(e){        //load city according to state
            $.ajax({
               type:'GET',
               url:'/load-city',
	             global: false,
               data:{
                      'state_id' : $(this).val()
                    },
               success:function(data){
                  
                  $('#city1').html('<option></option>');
                  $('#city1').select2({data : data});
               }
            });
  });


  //Modify Javascript code by Lochan//
  //clear modal data on dismiss

  $('html').on('hidden.bs.modal', '#modifydetail', function() { 
     $(this).find("input[type=text],textarea").val('').end();
     $(this).find("input[type=tel]").val('').trigger('change').end();
     $(this).find("select").val('').trigger('change').end();
     $(this).find("input[type=checkbox], input[type=radio]").prop("checked", false).end();
     $("#lead-m-sharelead").html("");
     $('#errorsModify').css('display', 'none');
     $('.notices').css('display', 'none');
     // $(".data_table").DataTable().ajax.reload();

    for (var i = 0; i < disableCompanyFields.length; i++) {
                var element = disableCompanyFields[i];
                $(element).prop('disabled', true);
                $(element).val('').trigger('change');
    }
  });


  $("#lead-m-company-name").on("change", function(e){

    for (var i = 0; i < disableCompanyFields.length; i++) {
                var element = disableCompanyFields[i];
                $(element).prop('disabled', false);
        }
    $.ajax({
               type:'GET',
               url:'/get_company_details',
		           global: false,
               dataType : 'json',
               data:{
                company_id : $(this).val(),
               },
               success:function(data){

                 $("#lead-m-comp-landline1").intlTelInput("setNumber" , data['comp_landline_1']);
                 $("#lead-m-comp-landline2").intlTelInput("setNumber" , data['comp_landline_2']);
                 $("#lead-m-comp-mobile1").intlTelInput("setNumber" , data['comp_mobile_1']);
                 $("#lead-m-comp-mobile2").intlTelInput("setNumber" , data['comp_mobile_2']);
                 $("#lead-m-comp-fax1").intlTelInput("setNumber" , data['comp_fax_1']);
                 $("#lead-m-comp-fax2").intlTelInput("setNumber" , data['comp_fax_2']);
               
              
                $('#lead-m-comp-email1').val(data['comp_email_1']);
                $('#lead-m-comp-email2').val(data['comp_email_2']);
                

                if(data['comp_country_details']){
                  $('#lead-m-comp-country').html('<option value="'+data['comp_country_details']['id']+'">'+data['comp_country_details']['text']+'</option>');//put option 
                  $('#lead-m-comp-country').select();
                }

                if(data['comp_state_details']){
                  $('#lead-m-comp-state').html('<option value="'+data['comp_state_details']['id']+'">'+data['comp_state_details']['text']+'</option>').select();//put option
                }

                if(data['comp_city_details']){
                    $('#lead-m-comp-city').html('<option value="'+data['comp_city_details']['id']+'">'+data['comp_city_details']['text']+'</option>').select();//put option
                }
                $('#lead-m-comp-pincode').val(data['comp_pincode']);
                $('#lead-m-comp-address-line-1').val(data['comp_address_line_1']);
                $('#lead-m-comp-address-line-2').val(data['comp_address_line_2']);
                $('#lead-m-comp-address-line-3').val(data['comp_address_line_3']);
                
               }
            });
});

 //company names ->
      $("#lead-m-company-name").select2({
        minimumInputLength:3,
        ajax: {
          url:'/get_companies',
          dataType: 'json',
          delay : 1000, 
          data: function (params) {
            return {
            q: params.term // search term
            };
          },
          processResults: function (data) {
            return {
            results: data
            };
          },
          cache: true
        }
    });

  $("#lead-m-cont-country,#lead-m-comp-country").select2({                     //load search country on type to text
        minimumInputLength:3,
        allowClear: true,
        placeholder: '',
        ajax: {
          url:'/load-countries',
          dataType: 'json',
          delay : 1000, 
          data: function (params) {

            return {
            q: params.term // search term
            };
          },
          processResults: function (data) {
            return {
            results: data
            };
          },
          cache: true
        }
  });

      //load states according to country
  $("#lead-m-cont-country").on("change", function(e){
            $.ajax({
               type:'GET',
               url:'/load-states',
	             global: false,
               data:{
                      'country_id' : $(this).val()
                    },
               success:function(data){
                  $('#lead-m-cont-state').html('<option></option>');
                  $('#lead-m-cont-state').select2({data : data});
               }
            });
  });

 $("#lead-m-cont-state").on("change", function(e){     //load city according to state
            $.ajax({
               type:'GET',
               url:'/load-city',
	             global: false,
               data:{
                      'state_id' : $(this).val()
                    },
               success:function(data){
                  
                  $('#lead-m-cont-city').html('<option></option>');
                  $('#lead-m-cont-city').select2({data : data});
               }
            });
  });

 $("#lead-m-comp-country").on("change", function(e){   //load states according to country
            $.ajax({
               type:'GET',
               url:'/load-states',
                global: false,
               data:{
                      'country_id' : $(this).val()
                    },
               success:function(data){
                  $('#lead-m-comp-state').html('<option></option>');
                  $('#lead-m-comp-state').select2({data : data});
               }
            });
  });

$("#lead-m-comp-state").on("change", function(e){     //load city according to state
            $.ajax({
               type:'GET',
               url:'/load-city',
	             global: false,
               data:{
                      'state_id' : $(this).val()
                    },
               success:function(data){
                  
                  $('#lead-m-comp-city').html('<option></option>');
                  $('#lead-m-comp-city').select2({data : data});
               }
            });
  });


  $("#lead-m-product").select2({                       //load products on type to select
        minimumInputLength:3,
        ajax: {
          url:'/load-products',
          dataType: 'json',
          delay : 1000, 
          data: function (params) {

            return {
            q: params.term // search term
            };
          },
          processResults: function (data) {
            return {
            results: data
            };
          },
          cache: true
        }
  });

   $("#lead-m-assignlead,#lead-m-sharelead, #users, #load_below_users,#assign_to").select2({                       //load search assigned users on type to text
            minimumInputLength:3,
            ajax: {
              url:'/load-users',
              dataType: 'json',
              delay : 1000, 
              data: function (params) {

                return {
                q: params.term // search term
                };
              },
              processResults: function (data) {
                return {
                results: data
                };
              },
              cache: true
            }
  });

$("#lead-m-company-client").on("change", function(e){

     for (var i = 0; i < disableCompanyFields.length; i++) {
                var element = disableCompanyFields[i];
                $(element).prop('disabled', false);
      }

              $.ajax({
               type:'GET',
               url:'/get_company_details',
	             global: false,
               dataType : 'json',
               data:{
                company_id : $(this).val(),
               },
               success:function(data){

                 $("#lead-m-comp-landline1").intlTelInput("setNumber" , data['comp_landline_1']);
                 $("#lead-m-comp-landline2").intlTelInput("setNumber" , data['comp_landline_2']);
                 $("#lead-m-comp-mobile1").intlTelInput("setNumber" , data['comp_mobile_1']);
                 $("#lead-m-comp-mobile2").intlTelInput("setNumber" , data['comp_mobile_2']);
                 $("#lead-m-comp-fax1").intlTelInput("setNumber" , data['comp_fax_1']);
                 $("#lead-m-comp-fax2").intlTelInput("setNumber" , data['comp_fax_2']);
               
                
                $('#lead-m-comp-email1').val(data['comp_email_1']);
                $('#lead-m-comp-email2').val(data['comp_email_2']);
                

                if(data['comp_country_details']){
                  $('#lead-m-comp-country').html('<option value="'+data['comp_country_details']['id']+'">'+data['comp_country_details']['text']+'</option>');//put option 
                  $('#lead-m-comp-country').select();
                }

                if(data['comp_state_details']){
                  $('#lead-m-comp-state').html('<option value="'+data['comp_state_details']['id']+'">'+data['comp_state_details']['text']+'</option>').select();//put option
                }

                if(data['comp_city_details']){
                    $('#lead-m-comp-city').html('<option value="'+data['comp_city_details']['id']+'">'+data['comp_city_details']['text']+'</option>').select();//put option
                }
                $('#lead-m-comp-pincode').val(data['comp_pincode']);
                $('#lead-m-comp-address-line-1').val(data['comp_address_line_1']);
                $('#lead-m-comp-address-line-2').val(data['comp_address_line_2']);
                $('#lead-m-comp-address-line-3').val(data['comp_address_line_3']);
                
               }
            });
});

 //company names ->
      $("#lead-m-company-client").select2({
        minimumInputLength:3,
        ajax: {
          url:'/get_companiesclient',
          dataType: 'json',
          delay : 1000, 
          data: function (params) {
            return {
            q: params.term // search term
            };
          },
          processResults: function (data) {
            return {
            results: data
            };
          },
          cache: true
        }
    });
// $("#lead-m-company-name2").on("focus", function(e){
// if($("#lead-m-company-name2").val()==''){
//          $("#lead-m-company-name").val('').trigger('change');
//  	       $("#lead-m-comp-country").val('').trigger('change');
// 	       $("#lead-m-comp-state").val('').trigger('change');
// }
// });

 var disableCompanyFields =  ['#lead-m-comp-landline1','#lead-m-comp-landline2',
                              '#lead-m-comp-email1','#lead-m-comp-email2',
                              '#lead-m-comp-mobile1','#lead-m-comp-mobile2',
                              '#lead-m-comp-fax1','#lead-m-comp-fax2',
                              '#lead-m-comp-country', '#lead-m-comp-state', '#lead-m-comp-city',
                              '#lead-m-comp-pincode', '#lead-m-comp-address-line-1',
                              '#lead-m-comp-address-line-2', '#lead-m-comp-address-line-3'];

if(!$('#lead-m-company-name').val()){
 for (var i = 0; i < disableCompanyFields.length; i++) {
                var element = disableCompanyFields[i];
                $(element).prop('disabled', true);
                $(element).val('').trigger('change');
              }
}


$('#lead-m-company-name2').on('input', function(e){

            if($(this).val()){
              $("#lead-m-company-name").val('').trigger('change');
              for (var i = 0; i < disableCompanyFields.length; i++) {
                var element = disableCompanyFields[i];
                $(element).prop('disabled', false);
              }
            }else{
              $("#lead-m-company-name").val('').trigger('change');
              for (var i = 0; i < disableCompanyFields.length; i++) {
                var element = disableCompanyFields[i];
                $(element).prop('disabled', true);
                $(element).val('').trigger('change');
              }
            }

            
            
});


//for clients

$('#lead-m-enter-company').on('input', function(e){

            if($(this).val()){
              $("#lead-m-company-client").val('').trigger('change');
              for (var i = 0; i < disableCompanyFields.length; i++) {
                var element = disableCompanyFields[i];
                $(element).prop('disabled', false);
              }
            }else{
              $("#lead-m-company-client").val('').trigger('change');
              for (var i = 0; i < disableCompanyFields.length; i++) {
                var element = disableCompanyFields[i];
                $(element).prop('disabled', true);
                $(element).val('').trigger('change');
              }
            }

            
            
});


//Modify Javasript code ends
});

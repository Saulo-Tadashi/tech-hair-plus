jQuery(document).ready(function() {
    jQuery("form#dashboard_form").hide();
    jQuery("form#ReportVisual_form").hide();
    jQuery("form#Tile_form").hide();
    jQuery("form#qa_form").hide();

    jQuery('select[name="res_type"]').change(function() {
        var restype = jQuery('#res_type_dropdown').val();
        if (restype == "Report") {
            jQuery("div#res_form_output").show()
            jQuery("form#dashboard_form").hide();
            jQuery("form#Tile_form").hide();
            jQuery("form#report_form").show();
            jQuery("form#qa_form").hide();
            jQuery("form#ReportVisual_form").hide();
            jQuery("a#deletebtn").show();
        }
        else if(restype == "Dashboard"){
            jQuery("form#report_form").hide();
            jQuery("div#res_form_output").hide();
            jQuery("form#Tile_form").hide();
            jQuery("form#dashboard_form").show();
            jQuery("form#qa_form").hide();
            jQuery("form#ReportVisual_form").hide();
            jQuery("a#deletebtn").hide();
        }
        else if (restype == "Tile"){
            jQuery("form#Tile_form").show();
            jQuery("form#report_form").hide();
            jQuery("div#res_form_output").hide();
            jQuery("form#dashboard_form").hide();
            jQuery("form#qa_form").hide();
            jQuery("form#ReportVisual_form").hide();
            jQuery("a#deletebtn").hide();
        } 
        else if (restype == "Q&A"){
            jQuery("form#qa_form").show();
            jQuery("form#Tile_form").hide();
            jQuery("form#report_form").hide();
            jQuery("div#res_form_output").hide();
            jQuery("form#dashboard_form").hide();
            jQuery("form#ReportVisual_form").hide();
            jQuery("a#deletebtn").hide();
        } 
        else if (restype == "ReportVisual"){
            jQuery("form#ReportVisual_form").show();
            jQuery("form#report_form").hide();
            jQuery("div#res_form_output").hide();
            jQuery("form#dashboard_form").hide();
            jQuery("form#Tile_form").hide();
            jQuery("form#qa_form").hide();
            jQuery("a#deletebtn").hide();
        }
        else{
            jQuery("form#ReportVisual_form").hide();
            jQuery("form#report_form").hide();
            jQuery("div#res_form_output").hide();
            jQuery("form#dashboard_form").hide();
            jQuery("form#Tile_form").hide();
            jQuery("form#qa_form").hide();
            jQuery("a#deletebtn").hide();
        }

    });
    jQuery("form#report_form").submit(() => {
        jQuery("div#res_form_output").show()
    })
});

function copyshortcode(id) {
    var copyText = document.getElementById("ShortcodeInput"+id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    var tooltip = document.getElementById("custom-copy-shrtcd-tooltip"+id);
    tooltip.innerHTML = "Copied"; 

  }

  function copyshortcode_msg(id) {
    var tooltip = document.getElementById("custom-copy-shrtcd-tooltip"+id);
    tooltip.innerText = "Copy to Clipboard"; 

  }

  function validate_pbi_report_form(){
    var heightval = document.getElementById("resource_height").value;
    var resheight = document.getElementById("resource_height");
    var widthval = document.getElementById("resource_width").value;
    var reswidth = document.getElementById("resource_width");
    var re = /^([1-9][0-9]*(em|px|%|rem|vh|vw|))$/;

    if(!re.test(heightval)){
        resheight.style.border = "red solid 1px";
        return false;
    }else{resheight.style = "width:60%;";resheight.style.border = "#8a8886 solid 1px";}
    if(!re.test(widthval)){
        reswidth.style.border = "red solid 1px";
        return false;
    }else{reswidth.style = "width:60%;";reswidth.style.border = "#8a8886 solid 1px";}
    if (re.test(heightval) && re.test(widthval)) {
        return true;
    }
    return true;
  }

  function focusonshortcode(){
    var elmntToView = document.getElementById("res_form_output");
    elmntToView.scrollIntoView(); 
  }

  
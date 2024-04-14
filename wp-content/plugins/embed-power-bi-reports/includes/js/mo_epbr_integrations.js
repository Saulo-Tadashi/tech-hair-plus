jQuery(document).ready(function() {
    jQuery("div#wordpress_integration").hide();
});

function all_categories(){
    jQuery("div#wordpress_integration").hide();
    jQuery("div#wordpress_integrations").fadeOut();
    jQuery("div#azure_integrations").fadeOut();
    jQuery("div#azure_integrations").fadeIn();
    jQuery("div#wordpress_integrations").fadeIn();
    jQuery("div#azure_integrations").css({"margin-top":""});
    document.querySelectorAll(".mo-ms-tab-content-button").forEach((btn)=>{
        btn.classList.remove("active")
    })
    document.querySelector("#AllCategoryButton").classList.add("active")
}
function azure_categories(){
    jQuery("div#wordpress_integration").hide();
    jQuery("div#wordpress_integrations").fadeOut();
    jQuery("div#azure_integrations").fadeOut();
    jQuery("div#azure_integrations").fadeIn();
    jQuery("div#azure_integrations").css({"margin-top":"3rem"});
    document.querySelectorAll(".mo-ms-tab-content-button").forEach((btn)=>{
        btn.classList.remove("active")
    })
    document.querySelector("#AzureCategoryButton").classList.add("active")
}
function wordpress_categories(){
    jQuery("div#azure_integrations").fadeOut();
    jQuery("div#wordpress_integrations").fadeOut();
    jQuery("div#wordpress_integration").fadeIn();
    document.querySelectorAll(".mo-ms-tab-content-button").forEach((btn)=>{
        btn.classList.remove("active")
    })
    document.querySelector("#WordpressCategoryButton").classList.add("active")
}

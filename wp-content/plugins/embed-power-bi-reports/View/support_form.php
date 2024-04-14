<?php

function mo_epbr_display_support_form(){
    ?>
        <style>

            .support_container{ 
                display:flex;
                justify-content:flex-start;
                align-items:center;
                flex-direction:column;
                width:32em;
                margin:-1px 12px;
                background-color:#BBDEFB;
                box-shadow: rgb(207,213,222) 1px 2px 4px;
                border: 1px solid rgb(216,216,216);
            }

            .support__telphone{
                width:27em;
            }

            .support_header{
                width: 100%;
                height: 240px;
                background-image: url(<?php echo plugin_dir_url(__FILE__).'../images/support-header2.jpg';?>);
                background-color: #fff;
                background-size: cover;
            }

          

            @media only screen and (width: 1396.36px) {
               
                .support_container{
                width:29em;
                }
            }
            
            @media only screen and (width: 1228.80px) {
               
               .support_container{
               width:23.5em;
               }
           }
            @media only screen and (max-width: 1229px) {
               
                .support__telphone{
                width:19.5em;
                }
            }

        </style>


        <div>
            <form method="post" action="">
                <input type="hidden" name="option" value="mo_epbr_contact_us_query_option" />
                <div class="support_container" id="contact-us">
                    <div class="support_header">
                    </div>

			        <?php  wp_nonce_field('mo_epbr_contact_us_query_option'); ?>
                    <div style="display:flex;justify-content:flex-start;align-items:center;width:90%;margin-top:8px;font-size:14px;font-weight:500;">Email:</div>
                    <input style="width:91%;border:none;margin-top:4px;background-color:#fff" type="email" required name="mo_epbr_contact_us_email" value="<?php echo ( get_option( 'mo_epbr_admin_email' ) == '' ) ? get_option( 'admin_email' ) : get_option( 'mo_epbr_admin_email' ); ?>" placeholder="Email">
                    <div style="display:flex;justify-content:flex-start;align-items:center;width:90%;margin-top:8px;font-size:14px;font-weight:500;">Contact No.:</div>
                    <input id="contact_us_phone" class="support__telphone" type="tel" style="border:none;margin:5px 22px;background-color:#fff;"  pattern="[\+]?[0-9]{1,4}[\s]?([0-9]{4,12})*" name="mo_epbr_contact_us_phone" value="<?php echo get_option( 'mo_epbr_admin_phone' ); ?>" placeholder="Enter your phone">
                 
                    <div style="display:flex;justify-content:flex-start;align-items:center;width:90%;margin-top:5px;font-size:14px;font-weight:500;">How can we help you?</div>
                    <textarea id="textarea-contact-us" style="padding:10px 10px;width:91%;border:none;margin-top:5px;background-color:#fff" onkeypress="mo_epbr_valid_query(this)" onkeyup="mo_epbr_valid_query(this)" onblur="mo_epbr_valid_query(this)" required name="mo_epbr_contact_us_query" rows="3" style="resize: vertical;" placeholder="You will get reply via email"></textarea>

                    <div style="text-align:center;">
                        <input type="submit" name="submit" style=" width:120px;margin:8px;" class="button button-primary button-large"/>
                    </div>
                </div>
            </form>
        </div>

        <script>
            function mo_epbr_valid_query(f) {
            !(/^[a-zA-Z?,.\(\)\/@ 0-9]*$/).test(f.value) ? f.value = f.value.replace(
                /[^a-zA-Z?,.\(\)\/@ 0-9]/, '') : null;
            }

            jQuery("#contact_us_phone").intlTelInput();

            jQuery( function() {
            jQuery("#js-timezone").select2();

            jQuery("#js-timezone").click(function() {
                var name = $('#name').val();
                var email = $('#email').val();
                var message = $('#message').val();
                jQuery.ajax ({
                    type: "POST",
                    url: "form_submit.php",
                    data: { "name": name, "email": email, "message": message },
                    success: function (data) {
                        jQuery('.result').html(data);
                        jQuery('#contactform')[0].reset();
                    }
                });
            });

            jQuery("#datepicker").datepicker("setDate", +1);
            jQuery('#timepicker').timepicker('option', 'minTime', '00:00');

            jQuery("#mo_epbr_setup_call").click(function() {
                if(jQuery(this).is(":checked")) {
                    document.getElementById("js-timezone").required = true;
                    document.getElementById("js-timezone").removeAttribute("disabled");
                    document.getElementById("datepicker").required = true;
                    document.getElementById("datepicker").removeAttribute("disabled");
                    document.getElementById("timepicker").required = true;
                    document.getElementById("timepicker").removeAttribute("disabled");
                    document.getElementById("mo_mo_epbr_query").required = false;
                } else {
                    document.getElementById("timepicker").required = false;
                    document.getElementById("timepicker").disabled = true;
                    document.getElementById("datepicker").required = false;
                    document.getElementById("datepicker").disabled = true;
                    document.getElementById("js-timezone").required = false;
                    document.getElementById("js-timezone").disabled = true;
                    document.getElementById("mo_mo_epbr_query").required = true;
                }
            });

                jQuery( "#datepicker" ).datepicker({
                minDate: +1,
                dateFormat: 'M dd, yy'
                });
            });

            jQuery('#timepicker').timepicker({
                timeFormat: 'HH:mm',
                interval: 30,
                minTime: new Date(),
                disableTextInput: true,
                dynamic: false,
                dropdown: true,
                scrollbar: true,
                forceRoundTime: true
            });

        </script>
    <?php
    }
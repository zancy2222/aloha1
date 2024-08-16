
<?php
if (isset($_POST['submit'])) {
    // Check if the checkbox is checked
    if (!isset($_POST['condition']) || $_POST['condition'] !== 'checkbox') {
        echo "<script>alert('Please agree to the Terms and Conditions before confirming.');</script>";
    } else {
        // Form fields are valid, proceed with form processing
        $arival   = $_SESSION['from'];
        $departure = $_SESSION['to'];
        $ROOMID = $_SESSION['ROOMID'];

 $_SESSION['name']   		= $_POST['name'];
 $_SESSION['last']   		= $_POST['last'];
 $_SESSION['age']   		= $_POST['age'];
 $_SESSION['email']   		= $_POST['email'];
 $_SESSION['dbirth']   		= $_POST['dbirth'];
 $_SESSION['nationality']   = $_POST['nationality'];
 $_SESSION['province_text'] = $_POST['province_text'];
 $_SESSION['city_text']   	= $_POST['city_text'];
 $_SESSION['barangay_text'] = $_POST['barangay_text'];
 $_SESSION['company']  		= $_POST['company'];
 $_SESSION['zip']   		= $_POST['zip'];
 $_SESSION['phone']   		= $_POST['phone'];
 $_SESSION['username']		= $_POST['username'];
 $_SESSION['pass']  		= $_POST['pass'];
 $_SESSION['pending']  		= 'pending';


  redirect('index.php?view=payment');

	}
}

?>

 
                 <?php //include'navigator.php';?>


			 
					<?php
					if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
							echo '<ul class="err">';
							foreach($_SESSION['ERRMSG_ARR'] as $msg) {
								echo '<li>',$msg,'</li>'; 
							}
							echo '</ul>';
							unset($_SESSION['ERRMSG_ARR']);
						}
					?>
   
         		<form class="form-horizontal" action="index.php?view=logininfo" method="post"  name="personal" >
					 <h2>Personal Details</h2> 

					 
					 <div class="form-group">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "username">USERNAME:*</label>

			              <div class="col-md-8">
			                <input name="username" type="text" class="form-control input-sm" id="username"  required/>
			              </div>
			            </div>
			       		 </div>
			  <!--     
			          <div class="form-group">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "cemail">CONFRIM E-MAIL:</label>

			              <div class="col-md-8">
			                <input name="cemail" type="text" class="form-control input-sm" id="cemail" />
			              </div>
			            </div>
			          </div> -->
			          <div class="form-group">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "password">PASSWORD:*</label>

			              <div class="col-md-8">
			                <input name="pass" type="password" class="form-control input-sm" id="password" required/>
			              </div>
			            </div>
			          </div>


					

					  <div class="form-group">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "name">FIRST NAME:*</label>

			              <div class="col-md-8">
			              	<input name="" type="hidden" value="">
			                <input name="name" type="text" class="form-control input-sm" id="name" required/>
			              </div>
			            </div>
			          </div> 

					  <div class="form-group">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "name">MIDDLE NAME:</label>

			              <div class="col-md-8">
			              	<input name="" type="hidden" value="">
			                <input name="" type="text" class="form-control input-sm" id="" />
			              </div>
			            </div>
			          </div> 

			            <div class="form-group">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "last">LAST NAME:*</label>

			              <div class="col-md-8">
			                <input name="last" type="text" class="form-control input-sm" id="last" required/>
			              </div>
			            </div>
			          </div>


					  <div class="form-group">
    <div class="col-md-8">
        <label class="col-md-4 control-label" for="age">AGE:*</label>
        <div class="col-md-8">
            <input name="age" type="text" class="form-control input-sm" id="age" required/>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-8">
        <label class="col-md-4 control-label" for="email">EMAIL:*</label>
        <div class="col-md-8">
            <input name="email" type="email" class="form-control input-sm" id="email" required/>
        </div>
    </div>
</div>

			      
					  <div class="form-group">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "city">REGION:*</label>

			              <div class="col-md-8">
			              <select name="region" class="form-control form-control-md" id="region" required></select>
            <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" required>
			              </div>
			            </div>
			          </div>

					  <div class="form-group">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "caddress">PROVINCE:*</label>

			              <div class="col-md-8">
						  <select name="province" class="form-control form-control-md" id="province" required></select>
            <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" required>
			              </div>
			            </div>
			          </div>



			           <div class="form-group">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "city">CITY:*</label>

			              <div class="col-md-8">
						  <select name="city" class="form-control form-control-md" id="city" required></select>
            <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
			              </div>
			            </div>
			          </div>
			           <div class="form-group">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "address">BARANGAY:*</label>

			              <div class="col-md-8">
						  <select name="barangay" class="form-control form-control-md" id="barangay" required></select>
            <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" required>
			              </div>
			            </div>
			          </div> 

					

			            <div class="form-group  ">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "dbirth">DATE OF BIRTH:*</label>

			              <div class="col-md-8 input-group">
			                 <input type="text" data-date="" data-date-format="yyyy-mm-dd" data-link-field="any" 
			                       data-link-format="yyyy-mm-dd"
			                       name="dbirth" id="dbirth" 
			                       value="" 
			                        readonly="true" class="dbirth form-control  input-sm" required>
			                <span class="input-group-btn">
			                    <i class="fa  fa-calendar" ></i> 
			                </span> 
			              </div>
			            </div>
			          </div>

			           <div class="form-group">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "phone">PHONE:*</label>

			              <div class="col-md-8">
			                <input name="phone" type="text" class="form-control input-sm" id="phone" required/>
			              </div>
			            </div>
			           </div>

			           <div class="form-group">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "nationality">NATIONALITY:*</label>

			              <div class="col-md-8">
			                <input name="nationality" type="text" class="form-control input-sm" id="nationality" required/>
			              </div>
			            </div>
			          </div>
			         
			            
			    
			         


			          <div class="form-group">
			            <div class="col-md-8">
			              <label class="col-md-4 control-label" for=
			              "zip">ZIP CODE:*</label>

			              <div class="col-md-8">
			                <input name="zip" type="text" class="form-control input-sm" id="zip" required />
			              </div>
			            </div>
			          </div>
 
					 &nbsp; &nbsp;
				 <div class="form-group">
			        <div class="col-md-6">
					<p>
				I <input type="checkbox" name="condition" value="checkbox" />
					 <small>Agree the <a class="toggle-modal"  onclick="OpenPopupCenter('terms_condition.php','Terms And Codition','600','600')" ><b>TERMS AND CONDITION</b></a> of this Hotel</small>
			
					 <br />
						<!-- <img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><a href='javascript: refreshCaptcha();'><img src="<?php echo WEB_ROOT;?>images/refresh.png" alt="refresh" border="0" style="margin-top:5px; margin-left:5px;" /></a>
						<br /><small>If you are a Human Enter the code above here :</small><input id="6_letters_code" name="6_letters_code" type="text" class="form-control input-sm" width="20"></p><br/>
					 -->	<div class="col-md-4">
					    	<input name="submit" type="submit" value="Confirm"  class="btn btn-primary" onclick="return personalInfo();"/>
					    </div>
						</div>
					NOTE: 
					We recommend that your password should be at least 6 characters long and should be different from your username.
					Your e-mail address must be valid. We use e-mail for communication purposes (order notifications, etc). Therefore, it is essential to provide a valid e-mail address to be able to use our services correctly.
					All your private data is confidential. We will never sell, exchange or market it in any way. For further information on the responsibilities of both parties, you may refer to us.
			    </div>

			</form>   

			
<script>
	var my_handlers = {
    // fill province
    fill_provinces: function() {
        //selected region
        var region_code = $(this).val();

        // set selected text to input
        var region_text = $(this).find("option:selected").text();
        let region_input = $('#region-text');
        region_input.val(region_text);
        //clear province & city & barangay input
        $('#province-text').val('');
        $('#city-text').val('');
        $('#barangay-text').val('');

        //province
        let dropdown = $('#province');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose State/Province</option>');
        dropdown.prop('selectedIndex', 0);

        //city
        let city = $('#city');
        city.empty();
        city.append('<option selected="true" disabled></option>');
        city.prop('selectedIndex', 0);

        //barangay
        let barangay = $('#barangay');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');
        barangay.prop('selectedIndex', 0);

        // filter & fill
        var url = 'ph-json/province.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.region_code == region_code;
            });

            result.sort(function(a, b) {
                return a.province_name.localeCompare(b.province_name);
            });

            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
            })

        });
    },
    // fill city
    fill_cities: function() {
        //selected province
        var province_code = $(this).val();

        // set selected text to input
        var province_text = $(this).find("option:selected").text();
        let province_input = $('#province-text');
        province_input.val(province_text);
        //clear city & barangay input
        $('#city-text').val('');
        $('#barangay-text').val('');

        //city
        let dropdown = $('#city');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose city/municipality</option>');
        dropdown.prop('selectedIndex', 0);

        //barangay
        let barangay = $('#barangay');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');
        barangay.prop('selectedIndex', 0);

        // filter & fill
        var url = 'ph-json/city.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.province_code == province_code;
            });

            result.sort(function(a, b) {
                return a.city_name.localeCompare(b.city_name);
            });

            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
            })

        });
    },
    // fill barangay
    fill_barangays: function() {
        // selected barangay
        var city_code = $(this).val();

        // set selected text to input
        var city_text = $(this).find("option:selected").text();
        let city_input = $('#city-text');
        city_input.val(city_text);
        //clear barangay input
        $('#barangay-text').val('');

        // barangay
        let dropdown = $('#barangay');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose barangay</option>');
        dropdown.prop('selectedIndex', 0);

        // filter & Fill
        var url = 'ph-json/barangay.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.city_code == city_code;
            });

            result.sort(function(a, b) {
                return a.brgy_name.localeCompare(b.brgy_name);
            });

            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
            })

        });
    },

    onchange_barangay: function() {
        // set selected text to input
        var barangay_text = $(this).find("option:selected").text();
        let barangay_input = $('#barangay-text');
        barangay_input.val(barangay_text);
    },

};


$(function() {
    // events
    $('#region').on('change', my_handlers.fill_provinces);
    $('#province').on('change', my_handlers.fill_cities);
    $('#city').on('change', my_handlers.fill_barangays);
    $('#barangay').on('change', my_handlers.onchange_barangay);

    // load region
    let dropdown = $('#region');
    dropdown.empty();
    dropdown.append('<option selected="true" disabled>Choose Region</option>');
    dropdown.prop('selectedIndex', 0);
    const url = 'ph-json/region.json';
    // Populate dropdown with list of regions
    $.getJSON(url, function(data) {
        $.each(data, function(key, entry) {
            dropdown.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
        })
    });

});
</script>
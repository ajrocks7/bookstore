// ################################################################### //
//                          Method re-write                           //
// ################################################################### //

// email
    // jQuery.validator.methods.email = function( value, element ) {
    //     return this.optional( element ) || /[a-z]+@[a-z]+\.[a-z]+/.test( value );
    // }

// ################################################################### //
//                          Add new method                             //
// ################################################################### //

// 10 digits mobile number validation
    jQuery.validator.addMethod("mobile",function(value,element){
        var digits = /^\d{10}$/;
        return value.match(digits);
    },"Please enter 10 digit number");

// 10 digits mobile number validation optional
    jQuery.validator.addMethod('optional_mobile',function (value, element) {
        if (value != element.defaultValue){ 
                var digits = /^\d{10}$/;
                return value.match(digits);
        }
        return true;
    },"Please enter 10 digit number");

// image validate
    jQuery.validator.addMethod('imagefile',function(value, element){
        var ret = false;
        if(value != ''){
            var Extension = value.split('.').pop().toLowerCase();
            if (Extension == "png" || Extension == "jpeg" || Extension == "jpg"){
                ret = true;
            }
        }
        return ret;
    },"Accepted file types are png,jpeg,jpg");

// image validate
    jQuery.validator.addMethod('optional_imagefile',function(value, element){
        var ret = true;
        if (value != element.defaultValue){
            var Extension = value.split('.').pop().toLowerCase();
            if (Extension == "png" || Extension == "jpeg" || Extension == "jpg"){
                ret = true;
            }else{
                ret = false;
            }
        }
        return ret;
    },"Accepted file types are png,jpeg,jpg");

//Decimal validate
    jQuery.validator.addMethod("decimal",function(value,element){
        var ret = false;
        var decimal = Number(value);
            if(/^-?\d+(?:\.\d+)?$/.test(decimal)){
                ret = true;
            }
        return ret;
    },"Enter valid decimal");

    // The latitude must be a number between -90 and 90 and the longitude between -180 and 180.
    // https://playcode.io/
    // https://stackoverflow.com/questions/25053605/regex-to-allow-only-a-single-dot-in-a-textbox

        jQuery.validator.addMethod("latitude",function(value,element){
            var ret = false;
            var latitude = Number(value);
                if(latitude <= 90 && latitude >= -90 && /^-?\d+(?:\.\d+)?$/.test(latitude)){
                    ret = true;
                }
            return ret;
        },"Enter valid latitude");

        jQuery.validator.addMethod("longitude",function(value,element){
            var ret = false;
                var longitude = Number(value);
                if(longitude <= 180 && longitude >= -180 && /^-?\d+(?:\.\d+)?$/.test(longitude)){
                    ret = true;
                }
            return ret;
        },"Enter valid longitude");


// ################################################################### //
//                          Add new addClassRules                      //
// ################################################################### //
    // decimal
    jQuery.validator.addClassRules("decimal",{
        required : true,
        decimal : true
    });

    // longitude field validation
    jQuery.validator.addClassRules("longitude",{
            required : true,
            longitude : true
    });

    // longitude field validation
    jQuery.validator.addClassRules("latitude",{
            required : true,
            latitude : true
    });
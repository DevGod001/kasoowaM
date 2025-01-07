<?php
include_once 'connect.php';

function get_states($country){
switch($country){ 
                        case "nigeria":
                        $label="Select State";    
                    $states='<option value="" selected disabled>--- Click to select state ---</option>
                <option value="Abia">Abia</option>
                <option value="Abuja">Abuja</option>
<option value="Adamawa">Adamawa</option>
<option value="Akwa Ibom">Akwa Ibom</option>
<option value="Anambra">Anambra</option>
<option value="Bauchi">Bauchi</option>
<option value="Bayelsa">Bayelsa</option>
<option value="Benue">Benue</option>
<option value="Borno">Borno</option>
<option value="Cross River">Cross River</option>
<option value="Delta">Delta</option>
<option value="Ebonyi">Ebonyi</option>
<option value="Edo">Edo</option>
<option value="Ekiti">Ekiti</option>
<option value="Enugu">Enugu</option>
<option value="Gombe">Gombe</option>
<option value="Imo">Imo</option>
<option value="Jigawa">Jigawa</option>
<option value="Kaduna">Kaduna</option>
<option value="Kano">Kano</option>
<option value="Katsina">Katsina</option>
<option value="Kebbi">Kebbi</option>
<option value="Kogi">Kogi</option>
<option value="Kwara">Kwara</option>
<option value="Lagos">Lagos</option>
<option value="Nasarawa">Nasarawa</option>
<option value="Niger">Niger</option>
<option value="Ogun">Ogun</option>
<option value="Ondo">Ondo</option>
<option value="Osun">Osun</option>
<option value="Oyo">Oyo</option>
<option value="Plateau">Plateau</option>
<option value="Rivers">Rivers</option>
<option value="Sokoto">Sokoto</option>
<option value="Taraba">Taraba</option>
<option value="Yobe">Yobe</option>
<option value="Zamfara">Zamfara</option>';
                 break;   
                    case "united_states":
        $label="Select State";
        $states='<option value="" selected disabled>--- Click to select state ---</option>
<option value="Alabama">Alabama</option>
<option value="Alaska">Alaska</option>
<option value="Arizona">Arizona</option>
<option value="Arkansas">Arkansas</option>
<option value="California">California</option>
<option value="Colorado">Colorado</option>
<option value="Connecticut">Connecticut</option>
<option value="Delaware">Delaware</option>
<option value="Florida">Florida</option>
<option value="Georgia">Georgia</option>
<option value="Hawaii">Hawaii</option>
<option value="Idaho">Idaho</option>
<option value="Illinois">Illinois</option>
<option value="Indiana">Indiana</option>
<option value="Iowa">Iowa</option>
<option value="Kansas">Kansas</option>
<option value="Kentucky">Kentucky</option>
<option value="Louisiana">Louisiana</option>
<option value="Maine">Maine</option>
<option value="Maryland">Maryland</option>
<option value="Massachusetts">Massachusetts</option>
<option value="Michigan">Michigan</option>
<option value="Minnesota">Minnesota</option>
<option value="Mississippi">Mississippi</option>
<option value="Missouri">Missouri</option>
<option value="Montana">Montana</option>
<option value="Nebraska">Nebraska</option>
<option value="Nevada">Nevada</option>
<option value="New Hampshire">New Hampshire</option>
<option value="New Jersey">New Jersey</option>
<option value="New Mexico">New Mexico</option>
<option value="New York">New York</option>
<option value="North Carolina">North Carolina</option>
<option value="North Dakota">North Dakota</option>
<option value="Ohio">Ohio</option>
<option value="Oklahoma">Oklahoma</option>
<option value="Oregon">Oregon</option>
<option value="Pennsylvania">Pennsylvania</option>
<option value="Rhode Island">Rhode Island</option>
<option value="South Carolina">South Carolina</option>
<option value="South Dakota">South Dakota</option>
<option value="Tennessee">Tennessee</option>
<option value="Texas">Texas</option>
<option value="Utah">Utah</option>
<option value="Vermont">Vermont</option>
<option value="Virginia">Virginia</option>
<option value="Washington">Washington</option>
<option value="West Virginia">West Virginia</option>
<option value="Wisconsin">Wisconsin</option>
<option value="Wyoming">Wyoming</option>';
break; 
        case "ghana":
          $label="Select Region";
          $states='<option selected disabled>--- Click to select region ---</option>
<option value="Ahafo">Ahafo</option>
<option value="Ashanti">Ashanti</option>
<option value="Bono">Bono</option>
<option value="Bono East">Bono East</option>
<option value="Central">Central</option>
<option value="Eastern">Eastern</option>
<option value="Greater Accra">Greater Accra</option>
<option value="Northern">Northern</option>
<option value="Oti">Oti</option>
<option value="Savannah">Savannah</option>
<option value="Western">Western</option>
<option value="Western North">Western North</option>
<option value="Upper East">Upper East</option>
<option value="Upper West">Upper West</option>
<option value="Volta">Volta</option>
<option value="North East">North East</option>';
           break;
            case "cameroon":
         $label="Select Region";
         $states='<option selected disabled>--- Click to select region ---</option>
<option value="Adamawa">Adamawa</option>
<option value="Central">Central</option>
<option value="East">East</option>
<option value="Far North">Far North</option>
<option value="Littoral">Littoral</option>
<option value="North">North</option>
<option value="North West">North West</option>
<option value="South">South</option>
<option value="South West">South West</option>
<option value="West">West</option>';
           break;
           case "canada":
           $label="Select Province/territory";
           $states='<option selected disabled>--- Click to select province/territory ---</option>
<option value="Alberta">Alberta</option>
<option value="British Columbia">British Columbia</option>
<option value="Manitoba">Manitoba</option>
<option value="New Brunswick">New Brunswick</option>
<option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
<option value="Nova Scotia">Nova Scotia</option>
<option value="Ontario">Ontario</option>
<option value="Prince Edward Island">Prince Edward Island</option>
<option value="Quebec">Quebec</option>
<option value="Saskatchewan">Saskatchewan</option>
<option value="Northwest Territories">Northwest Territories</option>
<option value="Nunavut">Nunavut</option>
<option value="Yukon">Yukon</option>';
            break;
            case "united_kingdom":
           $label="Select Country";
          $states='<option selected disabled>--- Click to select country ---</option>
<option value="England">England</option>
<option value="Scotland">Scotland</option>
<option value="Wales">Wales</option>
<option value="Northern Ireland">Northern Ireland</option>';
        break;
                    } 
$return=[
    'label' => $label,
    'states' => $states
    ];
return json_encode($return,true);
}


?>
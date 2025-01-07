
    let address_span=document.getElementsByClassName("address_span");
    let coordinates_status=document.querySelector(".coordinates_status");
    let hidden_address_input=document.querySelectorAll(".address_input");
   
  
    let hidden_product_input=document.querySelectorAll(".hidden_product_input");
    let category_null=document.querySelector("#category_null");
    function welcome_user(mess){
        let msg="Welcome back," + mess;
        let msg_h2=document.getElementById("welcome");
        for(let i=0;i < msg.length;i++){
        setTimeout(function(){
            msg_h2.innerText += msg[i];
            },100*i)
        }
    
    }
    let submits=document.querySelectorAll("button[type=submit]");
    let address_div=document.getElementsByClassName("address_div");
    for(let t=0;t < submits.length;t++){
        submits[t].addEventListener("click",function(event){
            let address_inp=document.querySelectorAll(".address_input"); 
            if(address_inp[t].value==""){
                event.preventDefault();
                address_div[t].classList.add("vibrate");
                address_div[t].addEventListener("animationend",function(){
                    address_div[t].classList.remove("vibrate");
                })
            }
        })
        
    }
        let account_type=document.getElementsByClassName("type");
        let buttons=document.getElementById("buttons");
        let seller=document.getElementById("seller_form");
        let buyer=document.getElementById("buyer_form");
        let loading=document.getElementById("loading");
        function show_loading(){
            loading.style.display="flex";
        }
        for(let a=0;a<account_type.length;a++){
            account_type[a].addEventListener("click",function(){
              buttons.classList.add('hide');
            })
        }
         account_type[0].addEventListener("click",function(){
              buyer.classList.add('show');
              
            })
          account_type[1].addEventListener("click",function(){
              seller.classList.add('show');
            })
    
    
     
        let image=document.getElementById("image_file");
        let prof=document.getElementById("seller_pic");
         
        image.addEventListener("change",function(){
            let seld=this.files[0];
            if(seld){
                let reader=new FileReader();
                reader.onload=function(){
                prof.style.backgroundImage ="url('"+ this.result + "')";
               
                }
                reader.readAsDataURL(seld);
            }
        })
    
    
        let buy_input=document.getElementById("buyer_profile_picture");
        let buyer_pic=document.getElementById("buyer_pic");
        buy_input.addEventListener("change",function(){
            let buy_file=this.files[0];
            if(buy_file){
                let frb=new FileReader();
                frb.onload=function(){
                    buyer_pic.style.backgroundImage="url('"+this.result+"')";
                }
                frb.readAsDataURL(buy_file);
            }
        })
    
   
   
  const selectBox = document.querySelector('.select-box');
  const selectOptions = document.querySelector('.select-options');

  // Toggle dropdown visibility
  function toggleDropdown() {
    selectOptions.classList.toggle('hidden');
  }

  // Function to apply the selected options
  function applySelection() {
    const selectedOptions = [];
    document.querySelectorAll('.select-options input[type="checkbox"]:checked').forEach(option => {
      selectedOptions.push(option.value);
    });

    // Do nothing with the selected options in the UI. We just track them silently.
    console.log('Selected options:', selectedOptions);

    // Close the dropdown after the "Done" button is clicked
    selectOptions.classList.add('hidden');
  }

  // Close dropdown when clicking outside
  window.addEventListener('click', function(e) {
    if (!selectBox.contains(e.target) && !selectOptions.contains(e.target)) {
      selectOptions.classList.add('hidden');
    }
  });


let checks=document.querySelectorAll(".categories_checks");
let seller_checks=document.querySelectorAll(".seller_checks");
 let seller_what=document.querySelector(".seller_what");
 let buyer_what=document.querySelector(".buyer_what");
        let select_section = document.getElementsByClassName("select_section");
let product_list = document.getElementsByClassName("product_list");
let done_button=document.querySelectorAll(".done_button");
let checkboxes = document.querySelectorAll(".categories input");
 let categories_0=document.querySelector("#category_0");
 let seller_selected=[];
 let new_selected="";
for(let s=0;s < seller_checks.length;s++){
    seller_checks[s].addEventListener("click",function(){
        if(seller_checks[s].checked){
            seller_selected.push(seller_checks[s].value);
             new_selected=seller_selected.join();
             hidden_product_input[1].value=new_selected;
            seller_what.innerText=new_selected;
            seller_what.style.fontSize="0.6rem";
        }
         else{
             seller_selected=seller_selected.filter(function(value){
                 return value != seller_checks[s].value;
             }.bind(seller_checks[s].value));
           new_selected=seller_selected.join();
           hidden_product_input[1].value=new_selected;
            seller_what.innerText=new_selected;
            seller_what.style.fontSize="0.6rem";
         }
    })
} 
 
select_section[0].addEventListener("click", function() {
    if (product_list[0].style.display == "flex") {
        product_list[0].style.display = "none";
    } else {
        product_list[0].style.display = "flex";
    }
});
for(let d=0;d < done_button.length;d++){
    
    done_button[d].addEventListener("click",function(){
        product_list[d].style.display="none";
    })
    
   let all_sel="";
   let arr=[];
    categories_0.addEventListener("click",function(){
        if(categories_0.checked){
        for(let e=0;e < checks.length;e++){
            
            checks[e].checked=true;
            arr.push(checks[e].value);
            all_sel=arr.join();
            buyer_what.innerText=all_sel;
            buyer_what.style.fontSize="0.6rem";
            category_null.checked=false;
            
        }
          
        }
          else{
               for(e=0;e < checks.length;e++){
                   checks[e].checked=false;
              all_sel="";
              arr=[];
            buyer_what.innerText="Rather not say";
            buyer_what.style.fontSize="0.6rem";
            hidden_product_input[0].value="null";
            category_null.checked=true;
               }
          }
    })
}
// function to access coordinates status value
function access_coordinates(){
  
  if(coordinates_status.value !== "success"){
        for(let i=0;i < address_span.length;i++){
            address_span[i].innerText=coordinates_status.value;
        }
   }
}
// function to get coordinates
function get_coordinates(para){
    let map_section=document.createElement("section");
    map_section.classList.add("map_section");
    map_section.innerHTML=`<div class="alert_div">
            <span>
                Verifying your location,please wait....
            </span>
        </div>
    <iframe src="map.php?address=` + encodeURIComponent(para + country) + `" class="iframe">

</iframe>`;
map_section.querySelector("iframe").classList.add("bottom");
    document.body.appendChild(map_section);
    window.addEventListener("message",function(event){
       if(event.data.includes("success")){
          document.body.removeChild(map_section);
          coordinates_status.value=event.data;
         
       }
        else{
            alert(event.data);
            document.body.removeChild(map_section);
            coordinates_status.value=event.data;
             for(let i=0;i < address_span.length;i++){
            address_span[i].innerText=coordinates_status.value;
            hidden_address_input[i].value="";
        }
        }
    });
}


category_null.addEventListener("click",function(){
    let null_value="";
    if(category_null.checked){
        for(let n=0;n < checks.length;n++){
            checks[n].checked=false;
            categories_0.checked=false;
            buyer_what.innerText="Rather not say";
            buyer_what.style.fontSize="0.6rem";
        }
    } 
    else{
          buyer_what.innerText="Select preferred products";
            buyer_what.style.fontSize="0.9rem";
    }
     
})
for(let f=0;f < checks.length;f++){
    checks[f].addEventListener("click",function(){
     if(checks[f].checked){
         category_null.checked=false;
     }
      else{
          categories_0.checked=false;
      }
 })
}
// function to fill get selected categories for buyers
function get_categories(){
    let buyer_selected=[];
    let all_selected="";
   for(let g=0;g < checks.length;g++){
       checks[g].addEventListener("click",function(){
          if(checks[g].checked){
           buyer_selected.push(checks[g].value); 
           all_selected=buyer_selected.join();
            hidden_product_input[0].value=all_selected;
            buyer_what.innerText=all_selected;
            buyer_what.style.fontSize="0.6rem";
       }
        else{
            buyer_selected = buyer_selected.filter(function(value){
                return value != checks[g].value;
            }.bind(checks[g].value))
            all_selected=buyer_selected.join();
            hidden_product_input[0].value=all_selected;
            if(all_selected==""){
                buyer_what.innerText="Select prefered products";
                 buyer_what.style.fontSize="0.9rem";
            }
            else{
            buyer_what.innerText=all_selected;
            buyer_what.style.fontSize="0.6rem";
            }
        }
       })
       
   }
   
}
get_categories();
document.addEventListener("click", function(event) {
    if (!select_section[0].contains(event.target)) {
        product_list[0].style.display = "none";
    }
});

let c = 0;


while (c < checkboxes.length) {
    checkboxes[c].addEventListener("change", function() {
        let checked_value = "";
        let v = 0;

        while (v < checkboxes.length) {
            if (checkboxes[v].checked) {
                if (checked_value) {
                    checked_value += ",";  // Add a comma if there's already a value
                }
                checked_value += checkboxes[v].value;  // Append the value
            }
            v++;
        }
        
        document.getElementById("hidden").value=checked_value;
         
    });
    c++;
    product_list[0].addEventListener("click",function(){
        event.stopPropagation();
    })
    
}



select_section[1].addEventListener("click", function() {
    if (product_list[1].style.display == "flex") {
        product_list[1].style.display = "none";
    } else {
        product_list[1].style.display = "flex";
    }
});

document.addEventListener("click", function(event) {
    if (!select_section[1].contains(event.target)) {
        product_list[1].style.display = "none";
    }
});

let d= 0;


while (d < checkboxes.length) {
    checkboxes[d].addEventListener("change", function() {
        let check_value = "";
        let w = 0;

        while (w < checkboxes.length) {
            if (checkboxes[w].checked) {
               
                if (check_value) {
                    check_value += ",";  // Add a comma if there's already a value
                }
                check_value += checkboxes[w].value;  // Append the value
            }
            v++;
        }
        
        document.getElementById("hide").value=check_value;
       
    });
    d++;
    product_list[1].addEventListener("click",function(){
        event.stopPropagation();
    })
    
}

    
    
     
     let update_button=document.getElementsByClassName("update_button");
     let add_parent=document.getElementsByClassName("add_parent");
     let add_child=document.getElementsByClassName("add_child");
     let add_form=document.getElementsByClassName("add_form");
     let update_address=document.querySelectorAll(".update_address");
    
     let address_input=document.getElementsByClassName("address_input");
    let country=document.querySelector(".hidden_country").value;
   
     // function to add address
     function add_address(){
         let address='';
         
         for(let a=0;a < add_form.length;a++){
              
                update_address[a].addEventListener("click",function(event){
                   event.preventDefault(); 
                    address=''; 
                    let cont_input=add_form[a].getElementsByClassName("cont_input");
                    let cont=add_form[a].getElementsByClassName("cont");
                    for(let e=0;e < cont.length;e++){
                        if(cont_input[e].value=="" && e != 1){
                  cont[e].style.borderColor="red";
                  return;
                  
               }
               cont_input[e].addEventListener("input",function(){
                   if(cont[e].style.borderColor=="red"){
                       cont[e].style.borderColor="silver";
                   }
               })
                    }
            for(let c=0;c < cont_input.length;c++){
               
                let curr_input=cont_input[c].value + ', ';
                if(c == 1){
                    if(cont_input[c].value==""){
                      curr_input=cont_input[c].value;  
                    }
                     else{
                        curr_input=cont_input[c].value + ', '; 
                     }
                }
                if(c == cont_input.length - 1){
                    if(country=='nigeria'){
                   curr_input=cont_input[c].value + ' state.'; 
                    }
                     else{
                        curr_input=cont_input[c].value + '.' ;
                     }
                }
                  address += curr_input;
                 
                  address_span[a].innerText=address;
                  address_input[a].value=address;
                  add_parent[a].style.display="none";
                  
                }
                //alert("test")
               get_coordinates(address);
               //access_coordinates();
               
                })
          
         }
         
     }
     
     // funtion to show add parent
     function show_add_parent(){
       for(let u=0;u < update_button.length;u++){
           update_button[u].addEventListener("click",function(event){
               event.preventDefault();
               add_parent[u].style.display='flex';
           })
           add_parent[u].addEventListener("click",function(){
               add_parent[u].style.display="none";
               
           })
           add_child[u].addEventListener("click",function(event){
              event.stopPropagation();
           })
       } 
     }
     
     seller.addEventListener("submit",function(){
         show_loading();
            if(hidden_product_input[1].value==""){
                event.preventDefault();
                select_section[1].classList.add("vibrate");
                select_section[1].addEventListener("animationend",function(){
                     select_section[1].classList.remove("vibrate");
               
                })
            }
        })
        buyer.addEventListener("submit",function(){
         show_loading();
            if(hidden_product_input[0].value==""){
                event.preventDefault();
                select_section[0].classList.add("vibrate");
                select_section[0].addEventListener("animationend",function(){
                     select_section[0].classList.remove("vibrate");
               
                })
            }
        })
        
        
       
      
     show_add_parent();
     add_address();
    
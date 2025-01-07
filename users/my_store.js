//variables
let parent=document.querySelector(".parent");
let action=document.querySelector(".action");
let child=document.querySelector(".child");
let add_form=document.querySelector(".add_form");


// function to update address
async function update_address(){
    try{
      add_form.addEventListener("submit",async function(event){
          event.preventDefault();
          loading.style.display="flex";
   let cont_input=document.querySelectorAll(".add_form .cont_input");
  let address="";
  let address_span=document.querySelector(".address_span");
  for(let i=0;i < cont_input.length;i++){
      let loop_address=cont_input[i].value + ", ";
      if(i == cont_input.length - 1){
          loop_address=cont_input[i].value + " state";
      }
      if(cont_input[i].value == ""){
          loop_address="";
      }
      address += loop_address;
      
  }
 
 let response=await fetch('my_store_process.php?update_address=true&address=' + encodeURIComponent(address));
 if(response.ok){
    let received=await response.text();
    if(received == "error"){
        loading.style.display="none";
        alert("invalid address, please enure you are following the correct address format without spelling errors and try again, thank you.");
        return;
    }
     else{
         if(received == "success"){
            address_span.innerText=address;
            loading.style.display="none";
             parent.style.display="none";
         }
     }
   
 }
  else{
      alert(response.status);
  }
})  
    }
     catch(error){
         if(error){
             alert(error);
         }
     }
}


// function to toggle parent
function toggle_parent(){
    action.addEventListener("click",function(){
        parent.style.display="flex";
    });
    parent.addEventListener("click",function(){
        parent.style.display="none";
    });
    child.addEventListener("click",function(event){
        event.stopPropagation();
    })
}

        let copy_button=document.querySelector(".store_link_house button");
        let copy_span=document.querySelector(".store_link_house span")
        copy_button.addEventListener("click",function(){
              if(navigator.clipboard.writeText(copy_span.innerText)){
              copy_button.innerText="copied";
             copy_span.classList.add("highlight");  
             setTimeout(function(){
               copy_span.classList.remove("highlight");
               copy_button.innerText="copy";
             },1000);
            }
        })
    
  
      let toggle=document.getElementById("menu");
       let menu=document.getElementById("navigate");
       let device_width=window.innerWidth;
      toggle.addEventListener("click",function(){
          
         
             if (menu.style.width === "0px" || menu.style.width === "") {
            menu.style.width = "300px"; // Open the menu
        } else {
            menu.style.width = "0px"; // Close the menu
        }
          
      })
      let notifications=document.getElementById("notifications");
      let notice=document.getElementById("notice");
      notifications.addEventListener("click",function(event){
          if(notice.style.display=="none"){
          notice.style.display="block";
          }
           else{
                notice.style.display="none";
           }
           event.stopPropagation();
      })
      document.addEventListener("click",function(){
         notice.style.display="none";
      })
      notice.addEventListener("click",function(event){
          event.stopPropagation();
      })
   
  
      let nav_a=document.querySelectorAll("#navigate a");
      for(let n=0;n < nav_a.length;n++){
          nav_a[n].addEventListener("click",function(){
              nav_a[n].style.background="#4caf50";
          })
      }
  
    
       let cart_container=document.getElementsByClassName("cart_container");
       let cart=document.querySelectorAll(".cart_container .material-icons");
      let cart_section=document.querySelector(".cart_section");
      let cart_hide=document.querySelector(".cart_hide");
      let cart_remove=document.getElementsByClassName("cart_remove");
      let curr_cart_id=document.querySelectorAll(".curr_cart_id");
      let cart_product=document.querySelectorAll(".cart_product");
      let total_items=document.querySelector(".total_items");
      let cart_quantity=document.querySelectorAll(".cart_quantity");
      let cart_cost=document.querySelectorAll(".cart_cost");
      let hidden_cart_cost=document.querySelectorAll(".hidden_cart_cost");
      let sub_cost=document.querySelector(".sub_cost");
      let hidden_sub_cost=document.querySelector("#hidden_sub_cost");
     let cart_actions=document.querySelector(".cart_actions");
     let mobile_cart_number=document.getElementById("mobile_cart_number");
      
      sub_cost.innerText=parseInt(sub_cost.innerText).toLocaleString();
       for(let t=0;t < cart_container.length;t++){
         cart_container[t].addEventListener("click",function(){
             let device_width=window.innerWidth;
             if(device_width > 799){
                 cart_section.style.left="70%";
             }
              else{
            cart_section.style.left="10%" ;
              }
         })
     }
     cart_hide.addEventListener("click",function(){
         cart_section.style.left="100%";
     })
     for(let r=0;r < cart_remove.length;r++){
         cart_cost[r].innerText=parseInt(cart_cost[r].innerText).toLocaleString();
         cart_remove[r].addEventListener("click",function(){
             loading.style.display="flex";
             let remove_form=new FormData();
             remove_form.append("id",curr_cart_id[r].value);
             remove_form.append("remove_cart","cart");
             let xhv=new XMLHttpRequest();
             xhv.open("POST","general.php",true);
             xhv.onreadystatechange=function(){
                 if(xhv.readyState==4 && xhv.status==200){
                      loading.style.display="none";
                    cart_product[r].style.display="none";
                    total_items.innerText=parseInt(total_items.innerText) - parseInt(cart_quantity[r].innerText);
                    
                    let next_cost=parseInt(hidden_sub_cost.value) - (parseInt(hidden_cart_cost[r].value) * parseInt(cart_quantity[r].innerText));
                    next_cost=next_cost - (5 * parseInt(hidden_cart_cost[r].value))/100;
                    hidden_sub_cost.value=next_cost;
                    next_cost=next_cost.toLocaleString();
                    sub_cost.innerText=next_cost;
                    mobile_cart_number.innerText=parseInt(mobile_cart_number.innerText) - parseInt(cart_quantity[r].innerText);
                    if(total_items.innerText<=0){
                         total_items.innerText=0;
                         sub_cost.innerText=0;
                         cart_actions.style.display="none";
                    }
                 }
             }
             
             xhv.send(remove_form);
         })
     }
     function load(){
         loading.style.display="flex";
     }
   
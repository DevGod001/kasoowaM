 
        const map_section=document.querySelector(".map_section");
    const close=document.querySelector(".close"); 
    const show_map=document.querySelector(".show_map") ;
     
        function slide_in(){
            show_map.addEventListener("click",function(){
                map_section.classList.add("in")
            })
            
            close.addEventListener("click",function(){
                map_section.classList.remove("in");
            })
        }
        slide_in();
    
   
   let index=0;
   let slider_icons=document.querySelectorAll(".image_container .material-icons");
   let slider=document.querySelector(".slider");
           let images=document.getElementsByClassName("images");
           let price=document.getElementsByClassName("price");
           let description=document.getElementById("description");
            let hidden_description=document.getElementById("hidden_description");
           
            let product_cost=document.getElementsByClassName("product_cost");
            let product_title=document.getElementsByClassName("product_title");
            let product_card=document.getElementsByClassName("products_card");
            let sizes_select=document.querySelector('.sizes');
            let sizes_toggle=document.querySelector(".select_size_section");
            let sizes_option=document.getElementsByClassName("sizes_option");
            let mass=document.getElementsByClassName("mass");
            let weight=document.getElementsByClassName("weight");
            let heading=document.getElementsByClassName("heading");
            let curr=document.getElementsByClassName("curr");
            let size_price=document.getElementsByClassName("price");
            let size_prices=document.getElementsByClassName("prices");
            let det=document.getElementsByClassName("per_details");
            let add_to_cart_button=document.querySelector(".add_to_cart");
            let product_id_input=document.querySelector(".product_id_input");
            let product_title_span=document.querySelector(".product_title_span"); 
            let product_photo_span=document.querySelector(".product_photo_span");
            let product_price=document.querySelector(".product_price");
            let quantity=document.querySelector(".amount");
            let unit=document.querySelector(".unit");
            let product_weight=document.querySelector(".product_weight");
            const curr_price=size_prices[0].innerHTML;
            let cart_number=document.getElementById("cart_number");
            let mobile_cart_number=document.getElementById("mobile_cart_number");
            let add_to_cart_div=document.querySelector(".add_to_cart");
            let cart_container=document.getElementsByClassName("cart_container");
       let cart=document.querySelectorAll(".cart_container .material-icons");
      let cart_section=document.querySelector(".cart_section");
      let cart_hide=document.querySelector(".cart_hide");
      let cart_remove=document.getElementsByClassName("cart_remove");
      let curr_cart_id=document.querySelectorAll(".curr_cart_id");
      let cart_product=document.querySelectorAll(".cart_product");
      let cart_products=document.querySelector(".cart_products");
      let total_items=document.querySelector(".total_items");
      let cart_quantity=document.querySelectorAll(".cart_quantity");
      let cart_cost=document.querySelectorAll(".cart_cost");
      let hidden_cart_cost=document.querySelectorAll(".hidden_cart_cost");
      let sub_cost=document.querySelector(".sub_cost");
      let hidden_sub_cost=document.querySelector("#hidden_sub_cost");
     let cart_actions=document.querySelector(".cart_actions");
      let loading=document.getElementById("loading");   
      let shop_now=document.getElementById("shop_now");
      let miles=document.querySelector(".miles");
      let hidden_pid=document.querySelector(".hidden_pid");
      let stock=document.querySelector(".stock");
      //alert(miles.value)
      // function to get in stock
      async function get_in_stock(){
          try{
             let response=await fetch('product_process.php?get_in_stock=true&pid=' + encodeURIComponent(hidden_pid.value));
             if(response.ok){
                 let data=await response.text();
                 stock.innerText=data;
             }
              else{
                  alert(response.status)
              }
          }
           catch(error){
               if(error){
                   alert(error);
               }
           }
      }
      shop_now.addEventListener("click",function(event){
          event.preventDefault();
          let xht=new XMLHttpRequest();
          xht.open("GET","details_process.php",true);
          xht.onreadystatechange=function(){
              if(xht.status==200 && xht.readyState==4){
              window.location.href=shop_now.href;
          }
          }
          xht.send();
      })
      // function to send api to get remaining and maximum items in cart
      async function get_max(){
          loading.style.display="flex";
          try{
             let response=await fetch('product_process.php?get_max=true&pid=' + encodeURIComponent(hidden_pid.value));
             if(response.ok){
                 let data=await response.json();
                return data['status'];
             }
              else{
                  alert(response.status);
              }
          }
           catch(error){
               if(error){
                   alert(error);
               }
           }
      }
      
           // function to avoid going below 1 
           quantity.addEventListener("input",async function(){
               
               if(quantity.value <= -1){
                   quantity.value=0;
               }
                else{
                   
                } 
             
                      
           
                
                
           })
            function remove_cart(){
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
                     get_in_stock();
                     loading.style.display="none";
                    cart_product[r].style.display="none";
                    total_items.innerText=parseInt(total_items.innerText) - parseInt(cart_quantity[r].innerText);
                    
                    let next_cost=parseInt(hidden_sub_cost.value) - (parseInt(hidden_cart_cost[r].value) * parseInt(cart_quantity[r].innerText));
                    next_cost=next_cost - (5 * parseInt(hidden_cart_cost[r].value))/100;
                    hidden_sub_cost.value=next_cost;
                    next_cost=next_cost.toLocaleString();
                    sub_cost.innerText=next_cost;
                    mobile_cart_number.innerText=parseInt(mobile_cart_number.innerText) - parseInt(cart_quantity[r].innerText);
                    
                     cart_number.innerText=parseInt(cart_number.innerText) - parseInt(cart_quantity[r].innerText);
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
     }
     // function to add to cart
            function add_to_cart(){
                add_to_cart_button.addEventListener("click",function(){
                    
                    if(product_price.value=="" || unit.value=="" || product_weight.value==""){
                        sizes_toggle.classList.add("vibrate");
                        sizes_toggle.style.borderColor="red";
                        sizes_toggle.addEventListener("animationend",function(){
                            sizes_toggle.classList.remove("vibrate");
                        })
                       return; 
                    }
                    if(quantity.value=="" || quantity.value=="0"){
                           add_to_cart_div.classList.add("vibrate");
                           add_to_cart_div.addEventListener("animationend",function(){
                               add_to_cart_div.classList.remove("vibrate");
                           })
                           return;
                        }
                        sizes_toggle.style.borderColor="silver";
                        let user_logged_in=false;
                        let user_id_cookie=document.cookie.split(";");
                        for(let k=0;k < user_id_cookie.length;k++){
                           if(user_id_cookie[k].trim().startsWith("user_id=")){
                               user_logged_in=true;
                           }
                        }
                        if(!user_logged_in){
                            window.location.href="login";
                            return;
                        }
                    add_to_cart_button.innerHTML=`<span class="material-icons spin">autorenew</span>
Adding to Cart`;
let cart_form=new FormData();
const curr_product_cost=product_price.value;
const curr_quantity=quantity.value;
cart_form.append("currency",curr[0].innerText);
cart_form.append("product_id",product_id_input.value);
cart_form.append("product_title",product_title_span.innerText);
cart_form.append("product_photo",product_photo_span.value);
cart_form.append("product_cost",product_price.value);
cart_form.append("quantity",quantity.value);
cart_form.append("unit",unit.value);
cart_form.append("size",product_weight.value);
cart_form.append("miles",miles.value);
let xhc=new XMLHttpRequest();
xhc.open("POST","product_process.php",true);
xhc.onreadystatechange=function(){
    if(xhc.status==200 && xhc.readyState==4){
        if(xhc.responseText.includes('error')){
            alert(xhc.responseText);
             add_to_cart_button.innerHTML=`<span class="material-icons">shopping_cart</span>
Add to Cart`;
heading[0].innerText="Select size";
 size_prices[0].innerHTML=curr_price;
 quantity.value="1";
 product_price.value="";
 unit.value="";
 product_weight.value="";
            return;
        }
        get_in_stock();
   add_to_cart_button.innerHTML=`<span class="material-icons">shopping_cart</span>
Add to Cart`;
heading[0].innerText="Select size";
 size_prices[0].innerHTML=curr_price;
 quantity.value="1";
 product_price.value="";
 unit.value="";
 product_weight.value="";
 let cart_number_value=parseInt(cart_number.innerText);
 cart_number.innerText=cart_number_value + parseInt(xhc.responseText);
 let mobile_cart_number_value=parseInt(mobile_cart_number.innerText);
 mobile_cart_number.innerText=mobile_cart_number_value + parseInt(xhc.responseText);
 total_items.innerText=parseInt(total_items.innerText) + parseInt(xhc.responseText);
 let new_sub_cost=parseInt(hidden_sub_cost.value) + parseInt(curr_product_cost * curr_quantity) + (5 * parseInt(curr_product_cost * curr_quantity)/100); 
 hidden_sub_cost.value=new_sub_cost;
sub_cost.innerText=new_sub_cost.toLocaleString(); 
 let xhu=new XMLHttpRequest();
 xhu.open("GET","general.php?update_cart_items=true",true);
 xhu.onreadystatechange=function(){
     if(xhu.readyState==4 && xhu.status==200){
         cart_products.innerHTML=xhu.responseText; 
          
               cart_actions.style.display="flex";
                         
          
     }
 }
 xhu.send();
}
}
xhc.send(cart_form);
                })
            }
            
            //function to select size
            function select_size(){
                for(let o=0;o < sizes_option.length;o++){
                   sizes_option[o].addEventListener("click",function(){
                       let constructing=weight[o].innerText + mass[o].innerText + " - " + curr[o].innerText + size_price[o].innerText;
                      heading[0].innerText=constructing; 
                      size_prices[0].innerHTML=curr[o].innerText + size_price[o].innerText + ` <span class="per_details" style="color:#708090;font-size:0.8rem">per ` + weight[o].innerText + mass[o].innerText + `</span>`;
                      product_price.value=size_price[o].innerText;
                      unit.value=mass[o].innerText;
                      product_weight.value=weight[o].innerText;
                    })
                }
            }
            sizes_select.style.display="none";
            
            // function to show sizes
            function show_sizes(){
                sizes_toggle.addEventListener("click",function(){
                     sizes_toggle.style.borderColor="silver";
                    if(sizes_select.style.display == "none"){
                        sizes_select.style.display="flex";
                    }
                     else{
                          sizes_select.style.display="none";
                     }
                })
            }
            
     // function to slide images
       function slide(direction){
           index += direction;
          
           
           if(index <= 0){
               slider_icons[0].style.display="none";
           }
           else{
               slider_icons[0].style.display="flex";
           }
           if(index >= images.length-1){
               slider_icons[1].style.display="none";
           }
           else{
               slider_icons[1].style.display="flex";
           }
          slider.style.transform=`translateX(-${index*100}%)`;
       }
       //function to show icons
       function show_icons(){
          if(index <= 0){
               slider_icons[0].style.display="none";
           }
           else{
               slider_icons[0].style.display="flex";
           }
           if(index >= images.length-1){
               slider_icons[1].style.display="none";
           }
           else{
               slider_icons[1].style.display="flex";
           }  
       }
       //function to format text
       function format_text(){
          let cur_price=parseInt(price[0].innerText);
          let second_price=parseInt(price[1].innerText);
          price[0].innerText=cur_price.toLocaleString();
           price[1].innerText=second_price.toLocaleString();
       }
       //function to truncate description
       function truncate_description(){
           let current_description=description.innerText;
           let max_length=100;
           let truncated_description=current_description.substring(0,max_length)+"....see more";
           if(description.innerText.length >= max_length){
           description.innerText=truncated_description;
           description.style.cursor="pointer";
           }
           description.addEventListener("click",function(){
        if(description.innerText.length <= max_length + 12 ){
          description.innerText=hidden_description.value; 
        }
         else{
             description.innerText=truncated_description;
         }
             })
       }
      
       // function to format price
       function format_price(){
      for(let f=0;f < product_cost.length;f++){
          let new_number=parseInt(product_cost[f].innerText);
          
          product_cost[f].innerText=new_number.toLocaleString();
      }
  }
  // function to fit text
  function fit_title(){
         for(let p=0;p < product_card.length;p++){
             let max_width=product_card[p].offsetWidth  - 10;
             
             if(product_title[p].scrollWidth > max_width){
                 let inner_text=product_title[p].innerText;
                 while(product_title[p].scrollWidth > max_width && inner_text.length > 0){
                     inner_text=inner_text.slice(0,-1);
                    product_title[p].innerText=inner_text + "....";
                     
                 }
             }
         }
     }
     add_to_cart();
       format_text();
       show_icons();
       truncate_description();
       format_price();
       fit_title();
     show_sizes();
     select_size();
   
   
       
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
     remove_cart(); 
    
    
        let search_input=document.querySelector(".search_input");
        let search_suggest=document.querySelector(".search_suggest");
        
           search_input.addEventListener("input",function(){
               if(search_input.value==""){
                   search_suggest.style.display="none";
                   return;
               }
           let xhl=new XMLHttpRequest();
           xhl.open("GET","general.php?search_store=true&search="+encodeURIComponent(search_input.value),true);
           xhl.onreadystatechange=function(){
               if(xhl.readyState==4 && xhl.status==200){
                   search_suggest.style.display="flex";
                   if(xhl.responseText.trim()==""){
                       search_suggest.innerHTML=`<a><span>No results found.....</span></a>`;
                       return;
                   }
                   search_suggest.innerHTML=xhl.responseText;
               }
           }
           xhl.send();
           });
           
    
     
        let i;
        let times=document.querySelector(".times");
        
        
        let d_parent=document.querySelector(".parent");
        let discount_span=document.querySelector(".discount_span");
        function entice_shown(store_get){
        function show_discount(){
        times.addEventListener("click",function(){
            let xht=new XMLHttpRequest();
          xht.open("GET","details_process.php",true);
          xht.onreadystatechange=function(){
              if(xht.status==200 && xht.readyState==4){
             d_parent.classList.remove("go");
          }
          }
          xht.send();
            
        });
        setTimeout(function(){
            d_parent.classList.add("go")
        },1000)
        }
        
        if(store_get === ""){
            show_discount();
        }
        }
    
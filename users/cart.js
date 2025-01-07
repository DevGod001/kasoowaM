// variables
     let cart_number=document.getElementById("cart_number");
     let mobile_cart_number=document.getElementById("mobile_cart_number");
     let loading=document.getElementById("loading");  
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
    let delete_icon=document.querySelectorAll(".delete");
   let cart_container=document.getElementsByClassName("cart_container");
      let hidden_cart_id=document.querySelectorAll(".hidden_cart_id");
      let hidden_product_id=document.querySelectorAll(".hidden_product_id");
        let search_input=document.querySelector(".search_input");
        let cart_loop=document.querySelectorAll(".cart_loop");
        let search_suggest=document.querySelector(".search_suggest");
        let progress_child=document.querySelectorAll(".progress_child");
        let counter_div=document.querySelectorAll(".counter_div");
        let price_group=document.querySelectorAll(".price_group");
        let total_span=document.querySelectorAll(".total_span");
        let remain=document.querySelectorAll(".required");
       
        let pickup_dropdown=document.querySelector(".pickup_dropdown");
let options_dropdown=document.querySelector(".options_dropdown");
let icon=document.querySelectorAll(".select_delivery_icon");
let pickup_group=document.querySelectorAll(".pickup_group");
let pickup_radio=document.querySelectorAll(".pickup_group input[type=radio]");
let pickup_label=document.querySelectorAll(".pickup_label");
let selected_pickup=document.querySelector(".selected_pickup");
let view_drop=document.querySelectorAll(".view_drop");
let view=document.querySelectorAll(".view");
let view_icon=document.querySelectorAll(".view_icon");
let view_ul=document.querySelectorAll(".inner_drop ul");
let breakdown_div=document.querySelector(".toggle_breakdown");
let breakdown=document.querySelector(".breakdown");
let breakdown_icon=document.querySelector(".breakdown_icon");
let toggle_address=document.querySelector(".toggle_address");
let address_entity=document.querySelector(".address_entity");
let update_section=document.querySelector(".update_section");
let update_address_button=document.querySelector(".update_address_button");
let cont_input=document.querySelectorAll(".cont_input");
let cont=document.querySelectorAll(".cont");
let send_update_status=document.querySelector(".send_update_status");
let address_desc=document.querySelector(".address_desc");
let deliver_to_doorstep=document.querySelectorAll(".deliver_to_doorstep");
let deliver_fee=document.querySelectorAll(".deliver_fee");
let service_fee=document.querySelector(".service_fee");
let total=document.querySelector(".total");
let all_total=document.querySelector(".all_total");
let vip_fee=document.querySelectorAll(".vip_fee");
 let store_loop=document.querySelectorAll(".store_loop");
 let forever_span=document.querySelectorAll(".forever_span");
 let checkout_button=document.querySelector(".checkout_button");
let limit_parent=document.querySelector(".limit_parent");
let single_checkout=document.querySelectorAll(".single_checkout");
        
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
           
           
          
      sub_cost.innerText=parseInt(sub_cost.innerText).toLocaleString();
       // function to create patrent
      async function create_checkout_parent(para){
          try{
              let section=document.createElement("section");
              section.classList.add("checkout_parent");
              section.innerHTML=para;
              document.body.appendChild(section);
              let close=section.querySelector(".close");
              close.addEventListener("click",function(){
                  section.remove();
              });
             
          }
           catch(error){
               if(error){
                   alert(error)
               }
           }
      }
     
      // function for store checkout
      async function store_checkout_details(sid){
          loading.style.display="flex";
          let response=await fetch('cart_process.php?store_checkout=true&sid=' + encodeURIComponent(sid));
          if(response.ok){
              let data=await response.text();
              if(data.startsWith("error")){
                   loading.style.display="none";
                  alert(data);
                  return;
              }
              create_checkout_parent(data);
              loading.style.display="none";
          }
           else{
               alert(response.status)
           }
      }
      // function for sttore checkout
      async function store_checkout(url){
          try{
             window.location.href=url;
          }
           catch(error){
               if(error){
                   alert(error);
               }
           }
      }
     
      // function for stores details
      async function store_details(){
          try{
              let store_show=document.querySelectorAll(".store_show");
              let hidden_sid=document.querySelectorAll(".hidden_sid");
            
              for(let i=0;i < store_show.length;i++){
                  
                  let response=await fetch('cart_process.php?store_details=store_details=true&sid=' + encodeURIComponent(hidden_sid[i].value));
                  if(response.ok){
                      let data=await response.text();
                      store_show[i].innerHTML=data;
                  }
                   else{
                       alert(response.status);
                   }
              }
          }
           catch(error){
               if(error){
                   alert(error);
               }
           }
      }
      // function for single checkout
      async function loop_checkout(url){
          try{
            for(let i=0;i < single_checkout.length;i++){
                single_checkout[i].addEventListener("click",async function(){
                    loading.style.display="flex";
                  let response=await fetch('cart_process.php?single_checkout=true&id=' + encodeURIComponent(hidden_cart_id[i].value));
                  if(response.ok){
                      
                      let data=await response.text();
                      if(data == "success"){
                         let rand=Math.random().toString(36).substring(2);
                         let verify=await fetch('cart_process.php?verify_option=true');
                         if(verify.ok){
                            let verified=await verify.text();
                            if(verified == "set"){
                                loading.style.display="none";
                                 window.location.href=url + "?single=true&id=" + encodeURIComponent(hidden_cart_id[i].value) + "&key=" + rand;
                            }
                             else{
                                 loading.style.display="none";
                                 alert("please select delivery option");
                             }
                         }
                          else{
                              loading.style.display="none";
                              alert(verify.status);
                          }
                         
                                
                      }
                       else{
                          loading.style.display="none"; 
                     let ul=document.querySelector(".limit_child ul");
                     let limit_parent=document.querySelector(".limit_parent");
                     ul.innerHTML=data;
                     limit_parent.style.display="flex";
                  }
                  }
                   else{
                       loading.style.display="none";
                       alert(response.status);
                   }
                })
            }  
          }
           catch(error){
               if(error){
                   alert(error);
               }
           }
      }
      // function to hide confirm
      async function hide_confirm(){
          try{
              let section=document.querySelector(".confirm_reset_section");
              section.style.display="none";
          }
           catch(error){
               if(error){
                   alert(error);
               }
           }
      }
      // function to show confirm
      async function show_confirm(){
          try{
              let section=document.querySelector(".confirm_reset_section");
              section.style.display="flex";
          }
           catch(error){
               if(error){
                   alert(error);
               }
           }
      }
      // funnction to reset cart
      async function reset_cart(){
          try{
              loading.style.display="flex";
              let response=await fetch('cart_process.php?reset_cart=true');
              if(response.ok){
                   let data=await response.text();
                   if(data == 'success'){
                       window.location.href="products";
                   }
                    else{
                     alert(data);
                    }
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
      // function to hide limit parent 
      async function hide_limit_parent(){
            try{
                let limit_buttons=document.querySelectorAll(".limit_button_div button");
                for(let i=0;i < limit_buttons.length;i++){
                    limit_buttons[i].addEventListener("click",function(){
                        limit_parent.style.display="none";
                    })
                }
            }
             catch(error){
                 alert(error);
             }
        }
        
       // function to checkout
       async function checkout(url){
           try{
               checkout_button.addEventListener("click",async function(){
                   try{
                       loading.style.display="flex";
                         let response=await fetch('cart_process.php?checkout=true');
                         if(response.ok){
                             let data=await response.text();
                             if(data == ""){
                                 let verify=await fetch('cart_process.php?verify_option=true');
                                 let verified=await verify.text();
                                 if(verified == 'set'){
                                 loading.style.display="none";
                                 let rand=Math.random().toString(36).substring(2);
                                 window.location.href=url + "?key=" + rand;
                             }
                              else{
                                  loading.style.display="none";
                                  alert("please select delivery option");
                                  return;
                              }
                             }
                              else{
                                  loading.style.display="none";
                            let ul=document.querySelector(".limit_child ul");
                            ul.innerHTML=data;
                            limit_parent.style.display="flex";
                         }
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
                 
               
           }) 
           }
            catch(error){
                if(error){
                    alert("error: " + error);
                }
            }
          
       }
      
      // function to hide delivery option dropdown on choose
     async function hide_delivery_dropdown(){
         try{
             options_dropdown.classList.remove("slide_down");
        icon[0].classList.remove("drop_icon");
         }
          catch(error){
              if(error){
                  alert("error:" + error);
              }
          }
     }
      // function to send api to verify total items in cart
      async function verify_items(){
          try{
             let response=await fetch('cart_process.php?check_rows=true') ;
             if(response.ok){
                 let data=await response.text();
                 if(data == 0){
                   window.location.href="products";
                   
                 }
                 
             }
             
          }
           catch(error){
               if(error){
                   alert("error: " + error);
               }
           }
      }
      verify_items();
      // function to send api to get cart totals
      function get_cart_totals(callback){
          let xhr=new XMLHttpRequest();
          xhr.open("GET","cart_process.php?cart_totals=true",true);
          xhr.onreadystatechange=function(){
              if(xhr.readyState==4 && xhr.status==200){
                 callback(xhr.responseText); 
              }
          }
          xhr.send();
      }
     
      
      // function to get all products in store loop
      async function get_product_list(i){
         
          try{
               let store_ids=store_loop[i].querySelector(".store_ids");
               let form_data=new FormData();
               form_data.append("sid",store_ids.value);
               form_data.append("list","true");
               let response=await fetch('cart_process.php',{
                   method:'POST',
                   body:form_data
               });
               if(response.ok){
                   let data=await response.json();
                   let ind_fee=store_loop[i].querySelector(".ind_fee");
                   let ind_miles=store_loop[i].querySelector(".ind_miles");
                   let ind_ul=store_loop[i].querySelector(".ind_ul");
                   let ind_view=store_loop[i].querySelector(".ind_view");
                   ind_miles.innerText=data['miles'] + " miles away";
                   ind_fee.innerText=data['fee'];
                   ind_ul.innerHTML=data['list'];
                   ind_view.innerText="view " + data['row'] + " items";
                   
               }
          }
           catch(error){
               alert("error:" + error);
           }
         
      }
     // function to get delivery breakdown
     async function delivery_breakdown(){
         let store_loop=document.querySelectorAll(".store_loop");
         
        for(let i=0;i < store_loop.length;i++){
            let store_ids=store_loop[i].querySelector(".store_ids");
          
            let form_data=new FormData();
            form_data.append("id",store_ids.value);
            form_data.append("exists","true");
            try{
             let response=await fetch('cart_process.php',{
                 method: 'POST',
                 body: form_data
             });
             if(response.ok){
                 let data=await response.text();
                if(data == 'empty'){
                    store_loop[i].remove();
                    
                }
                 else{
                     get_product_list(i);
                 }
             }
              else{
                  alert("error:" + response.status);
              }
            }
             catch(error){
                 alert("error:" + error);
             }
        }
         
         
     }
     
      // function to show doortep delivery
      function toogle_doorstep(para){
          for(let i=0;i < deliver_to_doorstep.length;i++){
              deliver_to_doorstep[i].style.display=para;
          }
      }
      // function to send api get gat
      function get_address(){
          let xhr=new XMLHttpRequest();
         
      }
      // function to send api and set session for delivery option
      function set_delivery_option_session(selected,callback){
         let xhr=new XMLHttpRequest();
         xhr.open("GET","cart_process.php?option=" + encodeURIComponent(selected),true);
         xhr.onreadystatechange=function(){
             if(xhr.readyState == 4 && xhr.status == 200){
                 callback(xhr.responseText);
             }
         }
         xhr.send();
      }
      
      // function to send api to update address
      function send_update(add,country,callback){
          send_update_status.value="";
          let r_form=new FormData();
          r_form.append("update_address",add);
          r_form.append("country",country)
          let xhr=new XMLHttpRequest();
          xhr.open("POST","here.php",true);
          xhr.onreadystatechange=function(){
              if(xhr.readyState==4 && xhr.status==200){
                 
                 callback(xhr.responseText);
              }
          };
          xhr.send(r_form);
          //alert(send_update_status.value);
      }
      // function to update address
      function update_address(country){
          
          update_address_button.addEventListener("click",function(){
              
              let address='';
              let nation=country;
             
              for(let i=0;i < cont_input.length;i++){
                  if(cont_input[i].value=="" && i !== 1){
                      cont[i].classList.add("shake");
                      cont[i].addEventListener("animationend",function(){
                          cont[i].classList.remove("shake");
                      });
                      
                      return;
                  }
                   else{
                       let t=cont_input.length - 1;
                       if(cont_input[t].value !== ""){
                            loading.style.display="flex";
                       }
                       
                      
                       let create_val=cont_input[i].value + ", ";
                       if(i == (cont_input.length) - 1 ){
                          create_val=cont_input[i].value + " state"; 
                       }
                       if(i==1 && cont_input[i].value == ""){
                           create_val="";
                       }
                       
                       address += create_val;
                   }
                   
              }
              //alert(address);
              send_update(address,nation,function(callback){
                if(callback == "success"){
                    
                    address_desc.innerText=address + ", " + nation;
                    loading.style.display="none";
                    get_cart_totals(function(callback){
                        if(callback){
                            let response=JSON.parse(callback);
                            let delivery_fee=response['delivery fee'];
                            
                            for(let i=0;i < deliver_fee.length;i++){
                                deliver_fee[i].innerText=delivery_fee;
                            }
                            
                            service_fee.innerText=response['service fee'];
                            total.innerText=response['subtotal'];
                            all_total.innerText=response['grand total'];
                            delivery_breakdown();
                        }
                    });
                    verify_items();
                }
                 else{
                    loading.style.display="none";
                    alert(callback);
                 }
              });
             
               
          });
      }
      
      // sliding cart section
       for(let t=0;t < cart_container.length;t++){
         cart_container[t].addEventListener("click",function(){
            window.location.reload();
         });
     }
     cart_hide.addEventListener("click",function(){
         cart_section.style.left="100%";
     });
     // function to get total items in cart
     function get_total(){
         let xht=new XMLHttpRequest();
         xht.open("GET","cart_process.php?total=true");
         xht.onreadystatechange=function(){
             if(xht.status==200 && xht.readyState==4){
                 mobile_cart_number.innerText=xht.responseText;
                 cart_number.innerText=xht.responseText;
                 total_items.innerText=xht.responseText;
             }
             
         };
         xht.send();
     }
     // function to get subtotal in cart
    function get_subtotal(){
         let xhs=new XMLHttpRequest();
         xhs.open("GET","cart_process.php?subtotal=true",true);
         xhs.onreadystatechange=function(){
             if(xhs.readyState==4 && xhs.status== 200){
                 let response=JSON.parse(xhs.responseText);
                sub_cost.innerText=response.subtotal;
             }
             
         };
         xhs.send(); 
     }
     // function to update get store houses progress bar 
    async function update_progress(){
      
     }
     // function to toggle delivery
     function toggle_delivery_address(){
toggle_address.addEventListener("click",function(){
    if(update_section.classList.contains("down")){
        address_entity.classList.remove("turn");
        update_section.classList.remove("down");
    }
     else{
        address_entity.classList.add("turn");
        update_section.classList.add("down");
     }

})
}

    // function to get cart detais
    async function get_cart_details(){
        try{
            let response=await fetch('cart_process.php?cart_totals=true');
            if(response.ok){
                let data=await response.json();
               
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
     // function to for counter
  async function counter(){
    try{
       for(let i=0;i < counter_div.length;i ++){
           
           let buttons=counter_div[i].querySelectorAll("button");
           let declared_cart_id=hidden_cart_id[i].value;
          let action="";
          let counter_span=counter_div[i].querySelector("span");
          let ever_span=forever_span[i];
          
          for(let b=0;b < buttons.length;b++){
           buttons[b].addEventListener("click",async function(){
               loading.style.display="flex";
               try{
                   if(b == 0){
                       action="minus";
                   }
                    else{
                        action="plus";
                    }
                let response=await fetch('cart_process.php?increase=true&cart_id=' + encodeURIComponent(declared_cart_id) + "&action=" + action);
                if(response.ok){
                    let data=await response.json();
                    let state=data['state'];
                    if(state == "success"){
                         loading.style.display="none";
                      counter_span.innerText=data['quantity'];  
                      ever_span.innerText=data['total'];
                      get_total();
                      update_progress(); 
                       get_cart_details();
                        store_details();
                    }
                     else{
                          loading.style.display="none";
                        let mess=data['message'];
                        alert(mess);
                     }
                    
                    
                   
                   // alert(data);
                    
                }
                 else{
                     alert("Error:" + response.status)
                 }
               }
                catch(error){
                    alert(error + error.stack);
                }
               
           });
          }
       } 
    }
     catch(error){
         alert("error:" + error);
     }
  }

     //progress_width();
     // function to delete loop cart
     function delete_loop(icon){
           let stores=document.querySelectorAll(".stores");
        for(let i=0;i < icon.length;i++){
          
          
            
            
            icon[i].addEventListener("click",function(){
              
                loading.style.display="flex";
                let i_form=new FormData();
               i_form.append("id",hidden_cart_id[i].value);
               i_form.append("delete_loop","true");
               let xhi=new XMLHttpRequest();
               xhi.open("POST","cart_process.php",true);
               xhi.onreadystatechange=function(){
                   if(xhi.status==200 && xhi.readyState==4){
                       loading.style.display="none";
                       if(xhi.responseText.includes("success")){
                          
                               window.location.reload();
                             
                              
                       cart_loop[i].remove();
                       cart_product[i].remove();
                        get_total();
                         get_subtotal();
                          update_progress();
                             store_details();
                       }
                        else{
                            alert(xhi.responseText);
                        }
                   }
               }
               xhi.send(i_form);
            })
        }
     }
     for(let i=0;i < view_ul.length;i++){
    view_ul[i].style.display="none";
}
// function to toggle breakdown
function toggle_breakdown(){
    breakdown_div.addEventListener("click",function(){
        if(breakdown.classList.contains("max")){
            breakdown.classList.remove("max");
            breakdown_icon.classList.remove("rotate");
            
           }
            else{
            breakdown.classList.add("max");
            breakdown_icon.classList.add("rotate");
        }
    });
}
// function to view items
function view_items(){
    for(let i=0;i < view_drop.length;i++){
       
        view[i].addEventListener("click",function(){
            if(view_ul[i].style.display=="none"){
                view_icon[i].classList.add("rotate");
                view_ul[i].style.display="flex";
            } 
              else{
                view_icon[i].classList.remove("rotate");
                view_ul[i].style.display="none";
              }

        });
    }
}
// function to select delivery 
function select_delivery(){
for(let i=0;i < pickup_group.length;i++){
    let entice_section=document.querySelector(".entice_section");
pickup_radio[i].addEventListener("click",function(){
    if(pickup_radio[i].checked){
        if(i == 0){
            entice_section.style.display="";
        }
         else{
             entice_section.style.display="none";
         }
        loading.style.display="flex";
        for(let j=0;j < pickup_radio.length;j++){
            pickup_group[j].style.background="";
        }
        pickup_group[i].style.background="rgba(0,255,0,0.3)";
        set_delivery_option_session(pickup_label[i].innerText,function(callback){
            if(callback == 'success'){
                get_cart_totals(function(callback){
                        if(callback){
                            hide_delivery_dropdown();
                            let response=JSON.parse(callback);
                            let delivery_fee=response['delivery fee'];
                            
                            for(let i=0;i < deliver_fee.length;i++){
                                deliver_fee[i].innerText=delivery_fee;
                            }
                            
                            if(delivery_fee == 0){
                                for(let i=0;i < vip_fee.length;i++){
                                   vip_fee[i].innerText=response['vip fee'];  
                                }
                               
                                
                            }
                            service_fee.innerText=response['service fee'];
                            total.innerText=response['subtotal'];
                            all_total.innerText=response['grand total'];
                        }
                    });
               selected_pickup.innerText=pickup_label[i].innerText; 
                loading.style.display="none";
            }
        });
        
        
    }
    if(i == 0){
        toogle_doorstep("none");
    }
     else{
         toogle_doorstep("flex");
     }
    
    
})
}
}
// function for delivery dropdown
function delivery_dropdown(){
pickup_dropdown.addEventListener("click",function(){
    if(options_dropdown.classList.contains("slide_down")){
        options_dropdown.classList.remove("slide_down");
        icon[0].classList.remove("drop_icon");
    }
     else{
        options_dropdown.classList.add("slide_down");
        icon[0].classList.add("drop_icon");
     }

});
}
    
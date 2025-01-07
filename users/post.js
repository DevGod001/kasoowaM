try{
        let notify_parent=document.getElementsByClassName("notify_parent");
        let notify_child=document.getElementsByClassName("notify_child");
        for(let y=0;y < notify_parent.length;y++){
            notify_parent[y].addEventListener("click",function(){
                notify_parent[y].style.display="none";
            })
            notify_child[y].addEventListener("click",function(){
                event.stopPropagation();
            })
        }
   
  
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
 
  
  let add_more=document.getElementById("add_more");
  let add_guide=document.getElementById("add_guide");
        let price=document.getElementById("price");
         let spans=document.getElementById("spans");
        let custom_select=document.getElementsByClassName("custom_select");
        let units=document.getElementsByClassName("units");
      let loading=document.getElementById("loading");
      let options=document.getElementsByClassName("options");
      let s_category=document.getElementById("selected_category");
      let dropdown=document.getElementsByClassName("dropdown");
      let drop_down=document.getElementById("dropdown");
      let category=document.getElementById("category")
      let category_id=document.getElementsByClassName("hidden_cat_id");
      let select_heading=document.getElementById("select_heading");
      let selected_subcategory=document.getElementById("selected_subcategory");
      let sale_form = document.getElementById("form");
       let measurement= document.getElementById("measurement");
  let warn=document.getElementsByClassName("warn");
  let stock_guide=document.getElementsByClassName("stock_guide");
  let stock_span=document.getElementById("stock_guide");
  let stock_cont=document.getElementById("stock_cont");
  let title=document.getElementById("title");
  let submit_buttons=document.querySelectorAll("button[type='submit']");
    
   
    
   
        let product_photos=document.getElementById("product_photos");
        let files_section=document.getElementById("files_section");
        product_photos.addEventListener("change",function(){
           
            while(files_section.children.length > 2){
                files_section.removeChild( files_section.lastChild);
            }
        for(let p=0;p < product_photos.files.length;p++){
            let file=product_photos.files[p];
          if(file){
              warn[0].innerText="";
              let read=new FileReader();
              read.onload=function(){
                  let div=document.createElement("div");
                  div.className="photos";
                 div.style.backgroundImage="url('" + read.result +"')";
                 files_section.appendChild(div);
                 }
              read.readAsDataURL(file);
        }
    }
});

let counting=document.getElementById("count");
let tot=document.getElementById("total");
let test=document.getElementById("text");
let test_cont=document.getElementById("text_cont");
let text_guide=document.getElementById("text_guide");
let submit_product=document.getElementById("submit");
test.addEventListener("input",function(){
    counting.innerText=test.value.length;
    if(test.value.length > tot.innerText){
        test_cont.style.borderColor="red";
        text_guide.style.color="red";
        text_guide.classList.add("shake");
        submit_product.disabled=true;
        submit_product.style.background="#a4d3a2";
    }
    else{
        test_cont.style.borderColor="#4caf50";
         text_guide.style.color="";
          text_guide.classList.remove("shake");
          submit_product.disabled=false;
          submit_product.style.background="";
    }
})
   
    
    
    // function to get stock label
    function get_stock_label(){
        title.addEventListener("input",function(){
            stock_guide[1].innerText=title.value;
            if(title.value==""){
                stock_span.style.display="none";
                stock_cont.style.display="none";
            }
             else{
                 stock_span.style.display="";
                
                stock_cont.style.display="";
             }
        })
    }
    get_stock_label();
</script>

    
    
   
        let currency_from=document.getElementsByClassName("currency_from");
         let currency_to=document.getElementsByClassName("currency_to");
         let promo_amount=document.getElementsByClassName("promo_amount");
         let show_amount=document.getElementsByClassName("show_amount");
         let labels=document.getElementsByClassName("labels");
         let radios=document.querySelectorAll(".labels input[type=radio]");
         let selection=document.getElementsByClassName("radios");
         
         for(let l=0;l < labels.length;l++){
             radios[l].addEventListener("change",function(){
                for (let j = 0; j < labels.length; j++) {
            labels[j].style.borderColor = "silver";
        }
                 if(radios[l].checked==true){
                     labels[l].style.borderColor="#4caf50";
                 }
                 else{
                     labels[l].style.borderColor="";
                 }
             })
         }
         for(let m=1;m < radios.length;m++){
             radios[m].addEventListener("change",function(){
                 if(radios[m].checked){
                    
                     let xhm=new XMLHttpRequest();
                     xhm.open("GET","post_process.php?cost=" + encodeURIComponent(radios[m].value),true);
                     xhm.onreadystatechange=function(){
                         if(xhm.status==200 && xhm.readyState==4){
                             
                         if(xhm.responseText.includes("insufficient")){
                         notify_parent[0].style.display="flex";
                           
                           
                         }
                         
                         }
                     }
                     xhm.send();
                
                 }
             })
         }
         function add_duration(){
             let duration=document.getElementById("duration");
             let validity=document.querySelectorAll("input[name=validity]");
           for(let v=0;v < radios.length;v++){
               radios[v].addEventListener("change",function(){
                   if(radios[v].checked){
                      duration.value=validity[v].value;
                     
                   }
               })
           }
         }
         add_duration();
   
    
    
    
        let currency=document.getElementById("currency");
        
        price.addEventListener("click",function(){
            currency.style.display="flex";
        })
   
    <script src="functions.js"></script>
    
 
    //variables
    let selects=document.getElementsByClassName("selects");
    let selects_options=document.getElementsByClassName("selects_options");
    let selects_heading=document.getElementsByClassName("selects_heading");
    let categories_label=document.querySelectorAll("label[data-key='categories']");
    let category_name=document.getElementsByClassName("category_name");
     let hidden_category_id=document.querySelectorAll("input[data-key='category_id']");
      let selected_category_id=document.getElementById("category_id");
      let selected_subcategory_id=document.getElementById("subcategory_id");
      let mass_unit=document.getElementById('mass-units');
      for (let iv = 0; iv < selects_options.length; iv++) {
        selects_options[iv].style.display = "none";
    }
      //function to show categories
      function show_categories(){
        for(let g=0;g < selects.length;g++){
            selects[g].addEventListener("click",function(){
               selects[g].style.borderColor="silver";
                if(selects_options[g].style.display=="none"){
                selects_options[g].style.display="flex";
                }
                else{
                    selects_options[g].style.display="none";
                }
            })
            
        } 
        for(let h=0;h < category_name.length;h++){
        categories_label[h].addEventListener("click",function(){
            loading.style.display="flex";
            selects_heading[1].innerText="Select subcategory";
           selected_category_id.value=hidden_category_id[h].value;
             selects_heading[0].innerText=category_name[h].innerText;
             selected_subcategory_id.value="";
             let sub_form=new FormData();
             sub_form.append("category",selected_category_id.value);
             let xhh=new XMLHttpRequest();
             xhh.open("POST","categories.php",true);
             xhh.onreadystatechange=function(){
                 if(xhh.status==200 && xhh.readyState==4){
                      loading.style.display="none";
                      selects[1].style.display="flex";
                      selects_options[1].innerHTML=xhh.responseText;
                     if(selects_options[1].querySelectorAll(".subs")){
                         let subs_data=document.querySelectorAll(".subs");
                          let subs_name=document.querySelectorAll(".sub_name");
                          let subs_id=document.querySelectorAll(".hidden_subcat_id");
                         for(let j=0;j < subs_data.length;j++){
                           
                            subs_data[j].addEventListener("click",function(){
                                selects_heading[1].innerText=subs_name[j].innerText;
                               selected_subcategory_id.value=subs_id[j].value;
                               units[0].style.display="flex";
                               units[0].innerText="Fetching units,please wait....";
                               let xhu=new XMLHttpRequest();
                      
                      xhu.open("GET","post_process.php?unit=true&sub_id=" + encodeURIComponent(selected_subcategory_id.value),true);
                        xhu.onreadystatechange=function(){
                            if(xhu.status==200 && xhu.readyState==4){
                                if(xhu.responseText.includes("error")){
                                    units[0].innerText="No unit available for this category";
                                    return;
                                }
                                let select_element=document.createElement("select");
                                select_element.id="unit";
                                select_element.name="unit";
                                select_element.required=true;
                                select_element.innerHTML=`<option value="" disabled selected>
                        please select unit of measurement
                    </option>` + xhu.responseText;
                               units[0].innerHTML='';
                               units[0].appendChild(select_element);
                     select_element.addEventListener("change",function(){
                         stock_guide[0].innerText="in " + select_element.value;
                         if(select_element.value=="kilogram" || select_element.value=="kilograms"){
                             mass_unit.value="kg";
                         }
                         else{
                          if(select_element.value=="gram" || select_element.value=="grams"){
                             mass_unit.value="g";
                         }
                         else{
                             mass_unit.value="";
                         }
                         }
                         add_guide.style.display="flex";
                         units[1].style.display="flex";
                         add_more.style.display='flex';
                        measurement.placeholder="Enter weight (e.g 2)";
                        measurement.addEventListener("input",function(){
                            let main_label=document.getElementById("main_label");
                            
                        main_label.innerText="Enter price per " + measurement.value +mass_unit.value; 
                        
                        });
                        mass_unit.addEventListener("input",function(){
                            let main_label=document.getElementById("main_label"); 
                            
                        main_label.innerText="Enter price per " + measurement.value +mass_unit.value; 
                        
                        })
                     })
                            }
                        }
                      xhu.send();
          
                            })
                         }
                     }
                 }
             }
             xhh.send(sub_form);
            })   
        }
      }
     // function to submit form
    function submit_form(){
        for(let m=0;m < submit_buttons.length;m++){
            submit_buttons[m].addEventListener("click",function(){
                selects[0].classList.remove("shake");
                if(selected_category_id.value == ""){
                    selects[0].style.borderColor="red";
                    selects[0].classList.add("shake");
                }
                else{
                    if(selected_subcategory_id.value == ""){
                    selects[1].style.borderColor="red";
                    selects[1].classList.add("shake");
                } 
                }
            })
            sale_form.addEventListener("submit",function(){
                loading.style.display="flex";
            })
            
        }
        
    }
    // function to add more
    function add_more_sizes(){
        add_more.addEventListener("click",function(){
            let create_house=document.createElement("div");
            create_house.classList.add("units_house");
            
            
            create_house.innerHTML=`<section class="units" style="display:flex;border-radius:100px"><select style="width:67%" class="mass-units" required name="mass_unit[]">
                   <option value="">Select size</option>
    <option value="kg">Kilogram (kg)</option>
    <option value="g">Gram (g)</option>
    <option value="mg">Milligram (mg)</option>
    <option value="µg">Microgram (µg)</option>
    <option value="t">Metric Ton (t)</option>
    <option value="lb">Pound (lb)</option>
    <option value="oz">Ounce (oz)</option>
    <option value="st">Stone (st)</option>
    <option value="ct">Carat (ct)</option>
    <option value="tonne">Tonne (tonne)</option>
</select><input class="measurement" step="0.000000000000001" required name="measurement[]" type="number" placeholder="Enter product weight (eg. 50)kg"></section> <span class="remove">&times</span>
`;
add_more.parentNode.insertBefore(create_house,add_more);
let selected_masses=create_house.querySelector(".mass-units");
let measures=create_house.querySelector(".measurement");
selected_masses.addEventListener("change",function(){
    measures.placeholder="Enter product weight (eg. 50)"+selected_masses.value;
});
let create_cont=document.createElement("div"); 
   create_cont.classList.add("input-container");
   
   create_cont.innerHTML=`<input name="price[]"   type="number" class="input-field" placeholder=" " required>
    <label class="label">price('test')</label>`;
          let spans=document.getElementById("spans");
         spans.parentNode.insertBefore(create_cont,spans); 
create_house.querySelector(".remove").addEventListener("click", function() {
            create_house.remove();
            create_cont.remove();
        });
        measures.addEventListener("input",function(){
          create_cont.querySelector(".label").innerText="Enter price per "+measures.value+selected_masses.value;
        });
        selected_masses.addEventListener("input",function(){
          create_cont.querySelector(".label").innerText="Enter price per "+measures.value+selected_masses.value;
        });
        });
        
    }

 
     show_categories();
     submit_form();
     add_more_sizes();

 
   

    for(let r=0;r < currency_from.length;r++){
        convertCurrency(currency_from[r].value,currency_to[r].value,promo_amount[r].value)
        .then(function(result){
            if(result){
                show_amount[r].innerText=result;
                selection[r].value=result;
            }
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
}
 catch(error){
     if(error){
         alert(error)
     }
 }
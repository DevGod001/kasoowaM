let order_button=document.querySelectorAll(".order_button");
let hidden_id=document.querySelectorAll(".hidden_id");
let order_status=document.querySelectorAll(".order_status");
let action=document.querySelectorAll(".action");
let parent=document.querySelectorAll(".parent");
let child=document.querySelectorAll(".child");
let no=document.querySelectorAll(".no");

// function to show parent
async function show_parent(){
    try{
        for(let i=0;i < action.length;i++){
            action[i].addEventListener("click",async function(){
                parent[i].style.display="flex";
            });
             parent[i].addEventListener("click",async function(){
            parent[i].style.display="none";
        });
        child[i].addEventListener("click",async function(event){
            event.stopPropagation();
        });
        no[i].addEventListener("click",async function(){
            parent[i].style.display="none";
        });
        
        }
       
    }
     catch(error){
         if(error){
             alert("error:" + error);
         }
     }
}
// function to change status
async function change_status(){
    let loading=document.querySelector(".loading");
    try{
        for(let i=0;i < order_button.length;i++){
          try{
              order_button[i].addEventListener("click",async function(){
                  loading.style.display="flex";
                let response=await fetch('orders_process.php?received=true&id=' + encodeURIComponent(hidden_id[i].value));
                if(response.ok){
                    
                let data=await response.text();
                if(data == "success"){
                    loading.style.display="none";
                    order_status[i].innerText="delivered";
                    order_status[i].style.color="#10b981";
                    action[i].disabled=true;
                    action[i].style.background="silver";
                    action[i].innerText="order received";
                    parent[i].style.display="none";
                }
                 else{
                     loading.style.display="none";
                     alert(data);
                 }
                }
                 else{
                     loading.style.display="none";
                     alert("error :" + response.status);
                 }
              });
          }
          catch(error){
           alert("error: " + error);
        }
        }
    }
     catch(error){
         if(error){
             alert("error :" + error);
         }
     }
}
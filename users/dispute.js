let loading=document.getElementById("loading");
function reason(select){
    
    let sec=document.querySelector(".create");
    if(select.value == 'other'){
        let element=document.createElement("div");
        element.classList.add("cont");
        element.innerHTML=`<input required name="custom" placeholder="" class="cont_input">
    <label class="float">Enter reason here</label>`;
   
    sec.appendChild(element);
    }
     else{
sec.innerHTML="";
     }
}
function preview(val){
    try{
        
        let file=val.files;
    let photo_section=document.querySelector(".photo_section");
   
        let val_childs=photo_section.children;
       while(val_childs.length > 1){
         val_childs[1].remove();
       }
    
        if(file){

            for(let i=0;i < file.length;i++){
            let reader=new FileReader();
            reader.onload=function(event){
                let div=document.createElement("div");
                div.classList.add("preview");
                div.style.backgroundImage="url(\"" + event.target.result + "\")";
                photo_section.appendChild(div);
            }
            reader.readAsDataURL(file[i]);
            }
        }
    }
     catch(error){
        if(error){
            alert(error);
        }
     }
    
}
// function to submit dispute
function lodge_dispute(){
    try{
        
        
        loading.style.display="flex";
    }
     catch(error){
        if(error){
            alert(error);
        }
     }
}

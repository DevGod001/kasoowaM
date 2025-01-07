<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page title</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
</head>
<style>
    body{
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        height:100vh;
        
        
    }
    .select_section{
        height:40px;
        width:90%;
        border:1px solid silver;
        border-radius:5px;
        display:flex;
        align-items:center;    
        justify-content:space-between;
        position: relative;
    }
    .product_list{
        width:100%;
        background:white;
        border:1px solid silver;
      
        position: absolute;
        top:100%;
        left:0;
        margin-top:5px;
        display:none;
        flex-direction:column;
        align-items:center;
        justify-content:flex-start;
        max-height:200px;
        overflow: scroll;
        overflow-x:hidden;
        border-radius:5px;
    }
  
    .categories{
        width:100%;
        display:flex;
       flex-direction:row;
       align-items:center;
      padding:1%;
      
    }
    .categories label{
        flex:1;
      
    }
.categories:hover{
    background:#4caf50;
}
.select_section:hover{
        border-color:#4caf50;
    }
    .product_list::-webkit-scrollbar{
        background:silver;
    }
    .product_list::-webkit-scrollbar-thumb{
        background:#4caf50;
        border-radius:100px;
    }
</style>
<body>
    <section class="select_section" >
        <span>Select preferred products </span>
        <i class="material-icons">arrow_drop_down</i>
        <div class="product_list">
             <div class="categories">
              <input id="category_0"type ="checkbox">
              <label for="category_0">All Categories</label>
              
          </div>
          <div class="categories">
              <input value="beverages" id="category_1"type ="checkbox">
              <label for="category_1">Beverages</label>
              
          </div>
          <div class="categories">
              <input value="raw_foods" id="category_2"type ="checkbox">
              <label for="category_2">Raw Foods</label>
              
          </div>
          <div class="categories">
              <input value="snacks" id="category_3"type ="checkbox">
              <label for="category_3">Snacks</label>
              
          </div>
          <div class="categories">
              <input value="preapared_meals" id="category_4"type ="checkbox">
              <label for="category_4">Prepared Meals</label>
              
          </div>
          <div class="categories">
              <input value="vegetables" id="category_5"type ="checkbox">
              <label for="category_5">Vegetables</label>
              
          </div>
          <div class="categories">
              <input value="fruits" id="category_6"type ="checkbox">
              <label for="category_6">Fruits</label>
              
          </div>
           <div class="categories">
              <input id="category_null"type ="checkbox">
              <label for="category_null">Rather not say</label>
              
          </div>
        </div>
    </section>
    <input type ="hidden" id="hidden" >
    
    
    <script>
        let select_section = document.getElementsByClassName("select_section");
let product_list = document.getElementsByClassName("product_list");
select_section[0].addEventListener("click", function() {
    if (product_list[0].style.display == "flex") {
        product_list[0].style.display = "none";
    } else {
        product_list[0].style.display = "flex";
    }
});

document.addEventListener("click", function(event) {
    if (!select_section[0].contains(event.target)) {
        product_list[0].style.display = "none";
    }
});

let checkboxes = document.querySelectorAll(".categories input");
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
    </script>
</body>
</html>
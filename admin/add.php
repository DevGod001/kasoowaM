<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page title</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Teachers">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <style>
        *{
            outline:none;
        }
        .section2{
            width:90vw;
            box-shadow:0px 4px 8px rgba(0,0,0,0.2);
            padding:10px;
            border-radius:5px;
            margin:50px 0;
        }
        .section2 form{
            display:flex;
            flex-direction:column;
            align-items:center;
            width:100%;
            margin:20px 0;
            gap:10px;
        }
        .cont{
            width:100%;
            border:1px solid silver;
            height:40px;
            border-radius:5px;
            position:relative;
            
        }
        .cont_input{
            height:90%;
            border:none;
            border-radius:5px;
            width:95%;
           font-family:teachers;
        }
        .float{
            position:absolute;
            top:25%;
            left:5%;
            pointer-events:none;
            font-family:teachers;
            background:white;
            padding:0 5px;
            transition-duration:0.5s;
        }
        .cont:hover{
            border-color:#4caf50;
        }
        .cont_input:focus +.float,.cont_input:not(:placeholder-shown) + .float{
            top:-25%;
            color:#4caf50;
        }
        .generate_cont{
             width:100%;
            border:0.1px solid silver;
            height:40px;
            border-radius:5px;
            display:grid;
            overflow:hidden;
            grid-template-columns:2fr 1fr ;
            
        }
        .generate_cont input{
            height:100%;
           width:100%;
           border:none;
            font-family:teachers;
        }
        .generate_cont button{
            height:100%;
            width:100%;
            border:none;
            background:linear-gradient(to right,green,lightgreen);
            color:white;
            font-weight:bold;
            font-family:teachers;
        }
        button[type=submit]{
            margin-right:auto;
            border:none;
            height:40px;
             padding:0 30px;
             display:flex;
             align-items:center;
             gap:10px;
             background:linear-gradient(to right,green,lightgreen);
             color:white;
             font-family:teachers;
        }
        .table_section{
           width:100%;
           overflow:auto;
           
        }
        thead th{
            white-space:nowrap;
           padding:10px;
            color:white;
            border-left:0.1px solid silver;
            min-width:100px;
            font-family:poppins;
        }
        thead{
            background:#4caf50;
        }
        table{
            border-collapse:collapse;
           
        }
        tbody td{
            font-family:teachers;
            padding:10px;
            border-bottom:0.1px solid silver;
            text-align:center;
        }
        td button{
            border:none;
            color:white;
            padding:10px 20px;
            font-family:teachers;
            border-radius:2px;
        }
        tbody tr:hover{
            background:rgba(144,255,144,0.2)
        }
        
    </style>
</head>
<body>
    <section class="section2">
        <strong style="font-family:poppins">Create Discount Code</strong>
        <form>
            <div class="cont">
                <input type ="text" class="cont_input" placeholder =" ">
                <label class="float">Enter Code Name</label>
            </div>
            <div class="generate_cont">
                <input class="generate_input" value="" disabled type ="text"><button class="generate_button" type ="button">Generate Code</button>
            </div>
              <div class="cont">
                <input type ="text" class="cont_input" placeholder =" ">
                <label class="float">Enter Code percentage</label>
            </div>
            <div class="cont">
                <input type ="text" class="cont_input" placeholder =" ">
                <label class="float">Max usage Allowed </label>
            </div>
            <div class="cont">
                <input type ="text" class="cont_input" placeholder =" ">
                <label class="float">Minimum Checkout Amount Allowed </label>
            </div>
            <button type="submit">
                CREATE CODE <i class="material-icons">chevron_right</i>
            </button>
        </form>
        <strong style="font-family:poppins">Code History</strong>
        <section class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>Code Name</th>
                        <th>Code</th>
                        <th>Code percentage</th>
                        <th>Max Users Allowed</th>
                        <th>Minimum Checkout</th>
                        <th>Pause</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Code 1</td>
                        <td>DSGSHEUVCJUFHIIJGHGHHH</td>
                        <td>25%</td>
                        <td>250</td>
                        <td>&#8358 50000</td>
                        <td><button style="background:blue">PAUSE</button></td>
                        <td><button style="background:red;">DELETE</button></td>
                    </tr>
                    <tr>
                        <td>Code 1</td>
                        <td>DSGSHEUVCJUFHIIJGHGHHH</td>
                        <td>25%</td>
                        <td>250</td>
                        <td>&#8358 50000</td>
                        <td><button style="background:blue">PAUSE</button></td>
                        <td><button style="background:red;">DELETE</button></td>
                    </tr>
                    <tr>
                        <td>Code 1</td>
                        <td>DSGSHEUVCJUFHIIJGHGHHH</td>
                        <td>25%</td>
                        <td>250</td>
                        <td>&#8358 50000</td>
                        <td><button style="background:blue">PAUSE</button></td>
                        <td><button style="background:red;">DELETE</button></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </section>
    <script>
        let generate_button=document.querySelector(".generate_button");
        let generate_input=document.querySelector(".generate_input");
        generate_button.addEventListener("click",function(){
            let alphabets="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            let generated_code="";
            for(let i=0;i < 20;i++){
               let index=Math.floor(Math.random() * alphabets.length);
             generated_code += alphabets[index];
             generate_input.value=generated_code;
            }
           
        })
        
    </script>
</body>
</html>
<!DOCTYPE html> 
<html> 
<title>Coupons</title> 
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css"> 
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway"> 

<script src="http://www.sys2u.com/qrcode/jquery.min.js" type="text/javascript"></script> 
<script src="http://www.sys2u.com/qrcode/jquery.qrcode.min.js" type="text/javascript"></script> 


<style> 

body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif} 

            @page { 
                size: A4; 
                margin: 0; 
            } 
            @media print
                { 
                html, body { 
                    
                    width: 210mm; 
                    height: 297mm; 
                    margin-left: auto; 
                    margin-right: auto;
                     
                } 
            } 
           
	 
            @media screen { 
                html, body { 
                    width: 1350px; 
                } 
            } 
            body 
            { 
                padding: 5mm; 
                margin:0; 
                margin-left: auto; 
                margin-right: auto; 
            } 

            #main-wrap { 
                background-color: #fff; 
                border: solid; 
                border-width: 1px; 
                display: inline-block; 
            } 


            #main-wrap { 
                overflow: hidden; 
                width: 45%; 
            } 

            #leftside { 
                display: inline-block; 
                width: 50%; 
   } 

            #rightside { 
                display: inline-block; 
                width: 45%; 
            }  
            .kangndo table, table.kangndo
{
   border-collapse: collapse;
   margin: 12px;
}

.kangndo th, .kangndo td
{
   padding: 1px;
   border: solid 1px #000000;
   vertical-align: top;
   text-align: center;
   width: 15px;
   font-size: 50px;
}        


</style> 
<body>

<?php
require('template_customer.html');
?> 

<div class id="yui"><center> 
<div id="main-wrap"> 
<header class="w3-container w3-red"> 
   <h4>Coupons</h4> 
</header>

 <div id="leftside" class="w3-container w3-white">
 <body>
<table class="kangndo" style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 120%; margin-right: auto; margin-left: auto;">
<tbody>
<tr>
<td style="width: 100px; text-align: center;"><span style="font-weight: bold; color:#rgb(163, 180, 200); font-size: 20px; font-family: Tahoma;">Username</span></td>
<td style="width: 100px; text-align: center;"><span style="font-weight: bold; color:#rgb(163, 180, 200); font-size: 20px; font-family: Tahoma;">Password</span></td>
</tr>
 <tr>
<td style="width: 100px; text-align: center;"><span style="font-weight: bold; color:#rgb(163, 180, 200); font-size: 15px; font-family: Tahoma;">aaa</span></td>
<td style="width: 100px; text-align: center;"><span style="font-weight: bold; color:#rgb(163, 180, 200); font-size: 15px; font-family: Tahoma;">1234</span></td>
</tr>
</tbody>
</table>
<table class="kangndo" style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 100%; margin-right: auto; margin-left: auto;">
<tbody>
</table>
   
     <br><br><br> 
</div> 
<div id="leftside" class="w3-container w3-white">
<div class id="yui"><center> 

 <body>
<table class="kangndo" style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 120%; margin-right: auto; margin-left: auto;">
<tbody>
<tr>
<td style="width: 100px; text-align: center;"><span style="font-weight: bold; color:#rgb(163, 180, 200); font-size: 20px; font-family: Tahoma;">Username</span></td>
<td style="width: 100px; text-align: center;"><span style="font-weight: bold; color:#rgb(163, 180, 200); font-size: 20px; font-family: Tahoma;">Password</span></td>
</tr>
 <tr>
<td style="width: 100px; text-align: center;"><span style="font-weight: bold; color:#rgb(163, 180, 200); font-size: 15px; font-family: Tahoma;">bbb</span></td>
<td style="width: 100px; text-align: center;"><span style="font-weight: bold; color:#rgb(163, 180, 200); font-size: 15px; font-family: Tahoma;">2233</span></td>
</tr>
</tbody>
</table>
<table class="kangndo" style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 100%; margin-right: auto; margin-left: auto;">
<tbody>
</table>
   
     <br><br><br> 
</div>


        </body>
    
    
   
</footer> 
</center>  
</div>
</div>

<center> <a onclick="window.print();return false;" class="btn btn-success" href="coupons.php">พิมพ์</a></td> </center> 
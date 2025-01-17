   <!-- footer -->
   <footer class="mt-1">
       <br>
       <div class="text-center text-black">
           <script>
               function getYear() {
                   var date = new Date();
                   var year = date.getFullYear();
                   document.getElementById("currentYear").innerHTML = year;
               }
           </script>

           <body onload="getYear()">
               <small  style="font-size: 24px;">
                   <b>FASHION ONLINE</b>
               </small>
               <br>
               <small style="font-size: 24px;">
                   <span>Copyright </span> <span id="currentYear"></span> © Được Vận Hành Bởi<b>
                       <u>TEAM10™</u>
                   </b>
                   <span>All rights reserved</span>
               </small>
           </body>
       </div>
   </footer>
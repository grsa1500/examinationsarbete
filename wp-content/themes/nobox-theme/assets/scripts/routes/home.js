// import Glide from '@glidejs/glide';

export default () => {
    /*
    const slider = new Glide({
        container: '.carousel',
    }).mount();
    */
  

   var count = 0;


   function displayWindowSize(){
       // Get width and height of the window excluding scrollbars
       var w = document.documentElement.clientWidth;
       var h = document.documentElement.clientHeight;
   count = 0;
   
   if( w > 800) {
   
   
       $('.newsbox').each(function(i, obj) {
       
           count = count + 1;
          var border = obj.children[0];
   
          border.id="border"+count;
       border = document.getElementById("border"+count);
   
     
   
          if(count % 2 == 0) {
         
   
           var title = obj.children[1].children[0].children[0].children[0].getBoundingClientRect().width;
          var length = (obj.children[1].children[0].clientWidth + obj.children[1].children[1].clientWidth + 40 - title);
   
          border.style.width=length+"px"; 
    

  if(obj.children[1].children[1].getBoundingClientRect().width == 50) {
    location.reload();
  }

          }
   
          if(count % 2 == 1) {
   
   
           length = (obj.children[1].children[1].clientWidth);
   
           border.style.width=length+40+"px";
   
         
   
          }
         
         
   
   
          
       });
   }
   
   }
   
   window.addEventListener("resize", displayWindowSize);
   
   displayWindowSize();

};



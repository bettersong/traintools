
hD="0123456789ABCDEF";

function d2h(d) 
{
 var h = hD.substr(d&15,1);
 while(d>15) {d>>=4;h=hD.substr(d&15,1)+h;}
 return h;
}

function h2d(h) 
{
 return parseInt(h,16);
}

function pie()
{
 this.ct = 0;
 
 this.data      = new Array();
 this.x_name    = new Array();
 this.max       = 0;

 this.c_array = new Array();
 this.c_array[0] = new Array(105, 146, 26);
 this.c_array[1] = new Array(197, 204, 30);
 this.c_array[2] = new Array(228, 167, 25);
 this.c_array[3] = new Array(229, 91, 28);
 this.c_array[4] = new Array(195, 62, 113);


 this.getColor = function()
  {
   if(this.ct >= (this.c_array.length-1))
      this.ct = 0;
   else
      this.ct++;

   return "#" + d2h(this.c_array[this.ct][0]) + d2h(this.c_array[this.ct][1]) + d2h(this.c_array[this.ct][2]);
  }


 this.add = function(x_name, value)
  {
   this.x_name.push(x_name);  
   this.data.push(parseInt(value,10));

   this.max += parseInt(value,10);
  }

 this.fillArc = function(x, y, r, st_a, en_a, jg)
  {
    //var number_of_steps = Math.round(2.1 * Math.PI * r );
    var number_of_steps = en_a - st_a ;
    var angle_increment = 2 * Math.PI / number_of_steps;

    var xc = new Array();
    var yc = new Array();

    st_r = st_a*Math.PI / 180;
    en_r = en_a*Math.PI / 180;

   
    for (angle = st_r; angle <= en_r; angle += angle_increment)
        {
         if(en_r < angle + angle_increment)
            angle = en_r;

	 var y2 = Math.sin(angle) * r ;
         var x2 = Math.cos(angle) * r ;

    	 xc.push(x+x2);
         yc.push(y-y2);
         //jg.drawLine(x+x2, y-y2, x+x2, y-y2);
        }
    xc.push(x);
    yc.push(y);
    jg.fillPolygon(xc, yc);
    //jg.setColor("black");
    //jg.drawLine(x, y, x+ln_x, y-ln_y);
  }

 this.render = function(canvas, title)
  {
   var jg = new jsGraphics(canvas);

   var r  = 85;
   var sx = 200;
   var sy = 200;
   var hyp = 100;
   var fnt    = 11;

   // shadow
   jg.setColor("gray");
   //this.fillArc(sx+5, sy+5, r, 0, 360, jg);
   jg.fillEllipse(sx+5-r, sy+5-r, 2*r, 2*r);

   var st_angle = 0;
   for(i = 0; i<this.data.length; i++)
      {
       var angle = Math.round(this.data[i]/this.max*360);
       var pc    = Math.round(this.data[i]/this.max*100);
       jg.setColor(this.getColor());
       this.fillArc(sx, sy, r, st_angle, st_angle+angle, jg);
  

       var ang_rads = (st_angle+(angle/2))*2*Math.PI/360;
       var my  = Math.sin(ang_rads) * hyp;
       var mx  = Math.cos(ang_rads) * hyp;

       st_angle += angle;

       mxa = (mx < 0 ? 50 : 0);
       
       jg.drawString(this.x_name[i]+"",sx+mx*1.2-mxa,sy-my*1.4-30);
      }

    
   jg.setColor("black");
   jg.drawEllipse(sx-r, sy-r, 2*r, 2*r);
   jg.paint();
  }

}

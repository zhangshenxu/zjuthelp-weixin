var source = new EventSource("sse.php");
source.onmessage = function(event){
    var ul = document.getElementsByTagName("ul")[0];
    ul.removeChild(ul.lastElementChild);

    var b = 0;
    function changemsgboxtop(){
        b += 8;
        for (var i = ul.childNodes.length - 1; i >= 0; i--) {
          if(ul.childNodes[i].nodeType == 1){
            ul.childNodes[i].style.top = (b.toString()+"px");
          }
        };
        if ( b < 160) {
            setTimeout(changemsgboxtop, 50);
        }
    }
    setTimeout(changemsgboxtop, 50);


    var newnode = document.createElement("li");
    newnode.setAttribute("class","msgbox");
    var returnnode = ul.insertBefore(newnode,ul.firstChild);
    returnnode.innerHTML = event.data;


    //逐渐改变msgbox的透明度
    var a = 0;
    function changemsgbox(){
        a += 0.1;
        returnnode.style.opacity = a.toString();
        if (returnnode.style.opacity < 1) {
            setTimeout(changemsgbox, 100);
        }
    }
    setTimeout(changemsgbox, 100);
};
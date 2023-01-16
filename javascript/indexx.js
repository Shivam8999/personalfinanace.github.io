function opennav(){
  document.getElementById("sidemenu").style.width="210px"
}

function closenav(){
document.getElementById("sidemenu").style.width="0px"
}


var con=["Welcome to RandomCreator ","Get courses like Sketchup and Web development "," and website hosting for absolutely free"]
var element = 0
var element_index=0
var interval;
var dis = document.querySelector("#display")
function typing(){
  var text=con[element].substring(0,element_index+1)
  document.getElementById("secpart").innerHTML=text;
  element_index++;
  if (text===con[element]){
    clearInterval(interval);
    setTimeout(function() {interval=setInterval(deleted, 50);},800);
  }
}
function deleted(){ //delete is an internal function of javascript so we have to use another name
  var text=con[element].substring(0,element_index-1)
  document.getElementById("secpart").innerHTML=text
  element_index --
  if (text===""){
    clearInterval(interval);
    if (element==(con.length-1)){element=0}
    else {
      element++ ;
      element_index = 0 ;          }
    setTimeout(function(){interval = setInterval(typing,50);},200);
  }
}
interval=setInterval(typing,50)

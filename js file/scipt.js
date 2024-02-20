//.......for agents dashboard..........
var dashboard = document.getElementById("dashboard");
var dashFrame = document.getElementById("dashFrame");

var account = document.getElementById("account");
var accountFrame = document.getElementById("accountFrame");

var sent = document.getElementById("sent");
var sentFrame = document.getElementById("sentFrame");

var inventory = document.getElementById("inventory");
var inventoryFrame = document.getElementById("inventoryFrame");

var keyBtn = document.getElementById("key");
var keyFrame = document.getElementById("key_frame");

dashboard.onclick = function(){
  dashFrame.style.visibility="visible";
  accountFrame.style.visibility="hidden";
  sentFrame.style.visibility="hidden"; 
  inventoryFrame.style.visibility="hidden";
  keyFrame.style.visibility="hidden";
}

account.onclick = function(){
  accountFrame.style.visibility="visible";
  dashFrame.style.visibility="hidden"; 
  sentFrame.style.visibility="hidden"; 
  inventoryFrame.style.visibility="hidden";
  keyFrame.style.visibility="hidden";
}

sent.onclick = function(){
  sentFrame.style.visibility="visible"; 
  accountFrame.style.visibility="hidden";
  dashFrame.style.visibility="hidden"; 
  inventoryFrame.style.visibility="hidden";
  keyFrame.style.visibility="hidden";
}

inventory.onclick = function(){
  inventoryFrame.style.visibility="visible";
  sentFrame.style.visibility="hidden"; 
  accountFrame.style.visibility="hidden";
  dashFrame.style.visibility="hidden"; 
  keyFrame.style.visibility="hidden";
}

keyBtn.onclick = function(){
  keyFrame.style.visibility="visible";
  inventoryFrame.style.visibility="hidden";
  sentFrame.style.visibility="hidden"; 
  accountFrame.style.visibility="hidden";
  dashFrame.style.visibility="hidden"; 
  
}


//......sent.php...........




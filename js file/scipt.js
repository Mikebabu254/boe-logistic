var addUser = document.getElementById('addUsers');
var regFrame = document.getElementById('regFrame');
var userList = document.getElementById('userList');
var viewList = document.getElementById('viewList');
var dashboard = document.getElementById('dashboard');
var dashFrame = document.getElementById('dashFrame');
var visibleColor = "#0d4683";
var hiddenColor = "#c7943f";


addUser.onclick = function(){
    regFrame.style.visibility="visible";
    userList.style.visibility="hidden";
    dashFrame.style.visibility="hidden";
    addUser.style.backgroundColor=visibleColor;
    viewList.style.backgroundColor=hiddenColor;
    dashboard.style.backgroundColor=hiddenColor;
}


viewList.onclick = function(){
    userList.style.visibility="visible";
    regFrame.style.visibility="hidden";
    dashFrame.style.visibility="hidden";
    viewList.style.backgroundColor=visibleColor;
    addUser.style.backgroundColor=hiddenColor;
    dashboard.style.backgroundColor=hiddenColor;
}

dashboard.onclick = function(){
    dashFrame.style.visibility="visible";
    userList.style.visibility="hidden";
    regFrame.style.visibility="hidden";
    viewList.style.backgroundColor=hiddenColor;
    addUser.style.backgroundColor=hiddenColor;
    dashboard.style.backgroundColor=visibleColor;
}
function showAgentDetails(tab) {
    // Reset styles for all buttons
    const buttons = document.querySelectorAll('#agentMenu button');
    buttons.forEach(button => button.classList.remove('active'));
  
    // Highlight the selected button
    const selectedButton = document.querySelector(`#agentMenu button:nth-child(${buttons.length + 1})`);
    selectedButton.classList.add('active');
  
    // Display agent details based on the selected tab
    const agentDetailsSection = document.getElementById('agentDetails');
    switch (tab) {
      case 'profile':
        agentDetailsSection.innerHTML = '<h2>Profile Details</h2><p>Agent profile information goes here.</p>';
        break;
      case 'ordersSent':
        agentDetailsSection.innerHTML = '<h2>Orders Sent</h2><p>List of orders sent by the agent goes here.</p>';
        break;
      case 'ordersReceived':
        agentDetailsSection.innerHTML = '<h2>Orders Received</h2><p>List of orders received by the agent goes here.</p>';
        break;
      default:
        agentDetailsSection.innerHTML = '<h2>No details available</h2>';
    }
  }
  
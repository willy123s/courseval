document.addEventListener("DOMContentLoaded", function () {
  // Create message box elements
  const messageBox = document.createElement("div");
  messageBox.id = "messageBox";
  messageBox.className =
    "fixed bottom-4 right-4 w-96 p-4 bg-gray-800 text-white rounded shadow-md hidden";

  const messageContent = document.createElement("div");
  messageContent.id = "messageContent";

  const closeButton = document.createElement("button");
  closeButton.id = "closeButton";
  closeButton.className = "mt-2 px-4 py-2 bg-blue-500 text-white rounded";
  closeButton.textContent = "Close";

  messageBox.appendChild(messageContent);
  messageBox.appendChild(closeButton);
  document.body.appendChild(messageBox);

  const showMessageBoxButton = document.createElement("button");
  showMessageBoxButton.id = "showMessageBox";
  showMessageBoxButton.className =
    "mt-8 ml-8 px-4 py-2 bg-green-500 text-white rounded";
  showMessageBoxButton.textContent = "Show Message Box";
  document.body.appendChild(showMessageBoxButton);

  showMessageBoxButton.addEventListener("click", function () {
    showMessage("This is a sample message!");
  });

  closeButton.addEventListener("click", function () {
    hideMessage();
  });

  function showMessage(message) {
    messageContent.innerHTML = message;
    messageBox.style.display = "block";
  }

  function hideMessage() {
    messageBox.style.display = "none";
  }
});

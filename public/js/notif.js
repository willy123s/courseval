function hideNotification(duration = 8000) {
  const notification = document.querySelector(".notif");

  if (notification) {
    setTimeout(() => {
      notification.classList.add("hidden");
    }, duration);
  }
}
const dismissBtn = document.getElementById("dismiss-btn");
if (dismissBtn) {
  dismissBtn.addEventListener("click", () => {
    const notification = document.getElementById("notif");
    notification.style.display = "none";
  });
}
// Call the function to hide the notification after 3 seconds (3000 milliseconds)
hideNotification();

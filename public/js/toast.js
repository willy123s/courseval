class Toast {
  constructor() {
    this.container = document.createElement("div");
    this.container.id = "toastContainer";
    this.container.className = "fixed bottom-4 right-4";
    document.body.appendChild(this.container);
  }

  showToast(message) {
    const toast = document.createElement("div");
    toast.className = "bg-gray-800 text-white p-4 rounded shadow-md mb-2";

    const toastContent = document.createElement("div");
    toastContent.textContent = message;

    toast.appendChild(toastContent);
    this.container.appendChild(toast);

    setTimeout(() => {
      this.container.removeChild(toast);
    }, 10000); // Auto-close after 10 seconds
  }
}

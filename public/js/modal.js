const openModalBtn = document.getElementById("open-modal-btn");
const closeModal = () => {
  const modal = document.getElementById("modal");
  modal.classList.add("modal-leave");
  modal.classList.remove("modal-enter");
  setTimeout(() => {
    modal.classList.add("hidden");
  }, 300);
};

openModalBtn.addEventListener("click", () => {
  const modal = document.getElementById("modal");
  modal.classList.remove("hidden");
  setTimeout(() => {
    modal.classList.add("modal-enter");
    modal.classList.remove("modal-leave");
  }, 50);
});

const cancelBtn = document.getElementById("cancel-btn");
cancelBtn.addEventListener("click", closeModal);

const confirmDeleteBtn = document.getElementById("confirm-delete-btn");
confirmDeleteBtn.addEventListener("click", () => {
  closeModal();
  // Perform the delete action here
  console.log("Item deleted");
});

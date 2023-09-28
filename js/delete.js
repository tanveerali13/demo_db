function deleteExpense(id) {
  const confirmationPopup = document.getElementById("delete-popup");
  const confirmDeleteButton = document.getElementById("confirm-delete");
  const cancelDeleteButton = document.getElementById("cancel-delete");

  confirmDeleteButton.addEventListener("click", () => {
    const url = `app/delete.php?id=${id}`;
    fetch(url);

    // To refresh the list
    fetchExpense("app/select.php");

    // Close the confirmation popup
    confirmationPopup.style.display = "none";
  });

  cancelDeleteButton.addEventListener("click", () => {
    // Close the confirmation popup
    confirmationPopup.style.display = "none";
  });

  // Show the confirmation popup
  confirmationPopup.style.display = "block";
}

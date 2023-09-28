function editExpense(expense) {
  const editPopup = document.getElementById("edit-popup");
  editPopup.style.display = "block";

  // Populate the form fields with the expense data
  document.querySelector("#edit-id").value = expense.id;
  document.querySelector("#edit-date").value = expense.added_on;
  document.querySelector("#edit-expense-name").value = expense.expense_name;
  document.querySelector("#edit-amount").value = expense.amount;
  document.querySelector("#edit-details").value = expense.details;

  const updateButton = document.querySelector("#update-edit");
  updateButton.textContent = "Update";

  // Add an event listener to the update button
  updateButton.addEventListener("click", (event) => {
    event.preventDefault();

    // Retrieve the edited values from the form fields
    const editedId = document.querySelector("#edit-id").value;
    const editedDate = document.querySelector("#edit-date").value;
    const editedExpenseName =
      document.querySelector("#edit-expense-name").value;
    const editedAmount = document.querySelector("#edit-amount").value;
    const editedDetails = document.querySelector("#edit-details").value;
    // console.log(editedDate);
    // console.log(editedDetails);
    const url = `app/edit.php?id=${editedId}&date=${editedDate}&expense_name=${editedExpenseName}&amount=${editedAmount}&details=${editedDetails}`;

    editPopup.style.display = "none";
    updater(url);

    //updateButton.style.display = "none";
    //submitButton.style.display = "block";
  });

  //Cancel and close popup
  const cancelButton = document.querySelector("#edit-cancel");
  cancelButton.textContent = "Cancel";
  cancelButton.addEventListener("click", () => {
    editPopup.style.display = "none";
  });
}

async function updater(url) {
  fetch(url);
  fetchExpense("app/select.php");
}

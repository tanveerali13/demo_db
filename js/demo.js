
async function fetchExpense(url){
  const repsonse = await fetch(url);
  const data = await repsonse.json();
  displayData(data);
}

//call function to fetch data
fetchExpense('app/select.php');

function displayData(data){
    //select element from HTML where we'll show our list
    const tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = '';
    

    data.forEach((expense) => {
        // Create a new table row
        const row = document.createElement('tr');

        row.classList.add('table-success', 'table-striped');

        // Create table cells for each piece of data
        const dateCell = document.createElement('td');
        dateCell.textContent = expense.added_on;

        const nameCell = document.createElement('td');
        nameCell.textContent = expense.expense_name;

        const amountCell = document.createElement('td');
        amountCell.textContent = `$${expense.amount}`;

        const detailsCell = document.createElement('td');
        detailsCell.textContent = expense.details;

        // Append the cells to the row
        row.appendChild(dateCell);
        row.appendChild(nameCell);
        row.appendChild(amountCell);
        row.appendChild(detailsCell);

        // Append the row to the table body
        tableBody.appendChild(row);
    });

    // Append the table body to the table
    //table.appendChild(tableBody);

    // Append the table to your display element
   // display.appendChild(table);
    let total = document.querySelector('#total');
    total.innerHTML = `Total = $${calculateTotal(data)}`;
}

const submitButton = document.querySelector('#submit');
submitButton.addEventListener('click', getFormData);

function getFormData(event){
  event.preventDefault();

  //get the form data & call an async function
  const insertFormData = new FormData(document.querySelector('#insert-form'));
  let url = 'app/insert_v2.php';
  inserter(insertFormData, url);
}

async function inserter(data, url){
  const response = await fetch(url, {
    method: "POST",
    body: data
  });
  const confirmation = await response.json();

  console.log(confirmation);
  //call function again to refresh the page
  fetchExpense('app/select.php');
}

function calculateTotal(data) {
    let totalAmount = 0;

    data.forEach((expense) => {
        totalAmount = totalAmount + expense.amount;
    });
    return totalAmount;   
}

const rowsPerPage = 10;
let currentPage = 1;
let data = [];
let headers = [];

function readTableHeaders() {
  const tableHeaders = document
    .getElementById("dataTable")
    .querySelectorAll("thead th");
  headers = Array.from(tableHeaders).map((header) => header.textContent);
}

function readTableData() {
  const tableBody = document.getElementById("tableBody");
  const rows = tableBody.querySelectorAll("tr");
  data = Array.from(rows).map((row) => {
    const cells = row.querySelectorAll("td");
    const rowData = {
      trClassList: Array.from(row.classList),
      data: {},
      tdClassList: [],
    };
    headers.forEach((header, index) => {
      rowData.data[header] = cells[index].innerHTML;
      rowData.tdClassList.push(Array.from(cells[index].classList));
    });
    return rowData;
  });
}

const search = document.getElementById("searchInput");
if (search) {
  search.addEventListener("input", function (e) {
    currentPage = 1;
    updateTable(e.target.value.trim().toLowerCase());
  });
}

function updateTable(search) {
  const tableBody = document.getElementById("tableBody");
  tableBody.innerHTML = "";

  const filteredData = search
    ? data.filter((item) =>
        headers.some(
          (header) =>
            item.data[header] &&
            item.data[header].toLowerCase().includes(search)
        )
      )
    : data;

  const start = (currentPage - 1) * rowsPerPage;
  const end = start + rowsPerPage;
  const paginatedData = filteredData.slice(start, end);

  paginatedData.forEach((item) => {
    const row = document.createElement("tr");
    item.trClassList.forEach((className) => row.classList.add(className));
    headers.forEach((header, index) => {
      const cell = document.createElement("td");
      cell.innerHTML = item.data[header] || "";
      if (item.tdClassList[index]) {
        item.tdClassList[index].forEach((className) =>
          cell.classList.add(className)
        );
      }
      row.appendChild(cell);
    });
    tableBody.appendChild(row);
  });

  updatePagination(filteredData.length);
}

function updatePagination(totalRows) {
  const totalPages = Math.ceil(totalRows / rowsPerPage);
  document.getElementById(
    "currentPage"
  ).textContent = `${currentPage} / ${totalPages}`;
  document.getElementById("prevBtn").disabled = currentPage === 1;
  document.getElementById("nextBtn").disabled = currentPage === totalPages;
}
function prevPage() {
  currentPage -= 1;
  updateTable(
    document.getElementById("searchInput").value.trim().toLowerCase()
  );
}

function nextPage() {
  currentPage += 1;
  updateTable(
    document.getElementById("searchInput").value.trim().toLowerCase()
  );
}

// Read table headers and content, then initialize the table with pagination and search
readTableHeaders();
readTableData();
updateTable("");

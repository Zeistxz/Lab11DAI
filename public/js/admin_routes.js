
// Esto corresponde a vehículo

const resultRows = document.querySelectorAll("tr");
const editBtns = document.querySelectorAll(".edit-button");
const deleteBtns = document.querySelectorAll(".delete-button");
const table = document.querySelector("table");
const addRouteForm = document.querySelector("#addRouteForm");


resultRows.forEach(row => 
    row.addEventListener("click", editOrDelete)  
);

if(table)
{
    table.addEventListener("click", collapseForm);
}

function collapseForm(evt){
    if(evt.target.className.includes("btn-close")){
        const collapseRow = evt.target.parentElement.parentElement.parentElement.parentElement;

        // enable the edit button
        const editBtn = collapseRow.previousElementSibling.children[7].children[0];
        editBtn.disabled = false;
        editBtn.classList.remove("disabled");

        // Collapse the row
        collapseRow.remove();
    }
}

function editOrDelete(evt){
    
    if(evt.target.className.includes("edit-button"))
    {
        // Disable the button
        evt.target.disabled = true;
        evt.target.classList.add("disabled");

        const editRow = document.createElement("tr");
        editRow.innerHTML = `
        <td colspan="8">
            <form class="editRouteForm d-flex justify-content-between" action="${evt.target.dataset.link}" method="POST">

                <input type="hidden" class="form-control" name="_method" value="PUT">
                <input type="hidden" class="form-control" name="_token" value="${evt.target.dataset.token}">

                <input type="hidden" class="form-control" name="id" value="${evt.target.dataset.id}">
                <select class="form-control" id="customer_id" name="customer_id" required>
                    <option value="" disabled>Seleccione un cliente</option>
                    ${JSON.parse(evt.target.dataset.customers).map(customer => `
                        <option value="${customer._id}" ${evt.target.dataset.customer_id == customer._id ? 'selected' : ''}>${customer.name} ${customer.lastname}</option>
                    `)}
                </select>
                <input type="text" class="form-control" name="plate" value="${evt.target.dataset.plate}" required>
                <input type="text" class="form-control" name="brand" value="${evt.target.dataset.brand}" required>
                <input type="text" class="form-control" name="model" value="${evt.target.dataset.model}" required>
                <input type="number" class="form-control" name="year" value="${evt.target.dataset.year}" required> 
                <input type="text" class="form-control" name="color" value="${evt.target.dataset.color}" required> 
                <input type="text" class="form-control" name="description" value="${evt.target.dataset.description}" required> 
           
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success btn-sm" name="edit">SUBMIT</button>
                    <button type="button" class="btn-close align-self-center"></button>
                </div>
            </form>
        </td>
    `;
    
    this.after(editRow);
    }
    // if delete button is clicked
    else if(evt.target.className.includes("delete-button"))
    {
        const form = document.getElementById("delete-form");
        form.action = evt.target.dataset.link;
        const deleteInput = document.querySelector("#delete-id");
        deleteInput.value = evt.target.dataset.id;
    }
}



// Route element
const routesBody = document.body;
// AddRouteForm
const busJsonInput = document.querySelector("#busJson");
const busJson = busJsonInput.value;
const searchBoxes = document.querySelectorAll(".searchBus");
const searchInputs = document.querySelectorAll(".sucnameInput");
const suggBoxes = document.querySelectorAll(".sugg");
// Here is the bus data to be shown in the add Modal
let data = busJson !== '' ? JSON.parse(busJson) : [];

routesBody.addEventListener("click", listenforBusSearches);
function listenforBusSearches(evt){
    if(evt.target.className.includes("sucnameInput"))
    {
        const searchInput = evt.target;
        const searchBox = searchInput.parentElement;
        const suggBox = searchInput.nextElementSibling;
        searchInput.addEventListener("input", showSuggestions);
        suggBox.addEventListener("click", selectSuggestion);
    }
}

// Collapses the suggestions Box when the input is not focussed on
// routesBody.addEventListener("click", collapseSugg);

// function collapseSugg(evt){
//     if(evt.target.className.includes("sucnameInput"))
//     {
//         const searchInput = evt.target;
//         const suggBox = searchInput.nextElementSibling;
//         suggBox.innerText = "";
//     }
// }

function selectSuggestion(evt){
    if(evt.target.nodeName === "LI")
    {
        this.previousElementSibling.value = evt.target.innerText;
        this.innerText = "";
    }
}

function showSuggestions()
{
    const word = this.value;
    if(!word)
    {
        this.nextElementSibling.innerText = "";
        return;
    }

    const regex = new RegExp(word, "gi");

    let suggestions = data.filter(({bus_no}) => {
        return bus_no.match(regex);
    }).map(({bus_no}) => {
        const bus_num = bus_no.replace(regex, `<span class="hl">${this.value.toUpperCase()}</span>`);;
        return `<li>${bus_num}</li>`;
    }).join("");

    this.nextElementSibling.innerHTML = suggestions;
}


// Esto corresponde a sucursal

const resultRows = document.querySelectorAll("tr");
const editBtns = document.querySelectorAll(".edit-button");
const deleteBtns = document.querySelectorAll(".delete-button");
const table = document.querySelector("table");

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
        const editBtn = collapseRow.previousElementSibling.children[5].children[0];
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
        <td colspan="6">
            <form class="editRouteForm d-flex justify-content-between" action="${evt.target.dataset.link}" method="POST">
                <input type="hidden" class="form-control" name="_method" value="PUT">
                <input type="hidden" class="form-control" name="_token" value="${evt.target.dataset.token}">            

                <input type="hidden" name="id" value="${evt.target.dataset.id}">
                <input type="text" class="form-control" name="name" value="${evt.target.dataset.name}" required>
                <input type="text" class="form-control" name="address" value="${evt.target.dataset.address}" required>
                <input type="tel" class="form-control" name="phone" value="${evt.target.dataset.phone}" required>
                <input type="text" class="form-control" name="email" value="${evt.target.dataset.email}" required>
                <input type="text" class="form-control" name="manager" value="${evt.target.dataset.manager}" required>

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

// Add Bus Form validation
const addBusForm = document.querySelector("#addBusForm");

addBusForm.addEventListener("submit", validateForm);

function validateForm(evt)
{
    const sucnameInput = addBusForm.elements.busnumber;
    const regex = new RegExp("[a-z]+", "g");
    const errorSpan = document.querySelector("#error");

    if(sucnameInput.value.match(regex))
    {
        evt.preventDefault();
        errorSpan.innerText = "Bus Number should have capital letters";
    }
}


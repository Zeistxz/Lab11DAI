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
        const editBtn = collapseRow.previousElementSibling.children[6].children[0];
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
        <td colspan="7">
            <form class="editRouteForm d-flex justify-content-between" action="${evt.target.dataset.link}" method="POST">
                <input type="hidden" class="form-control" name="_method" value="PUT">
                <input type="hidden" class="form-control" name="_token" value="${evt.target.dataset.token}">

                <input type="hidden" class="form-control" name="id" value="${evt.target.dataset.id}">
                <input type="number" class="form-control" name="dni" value="${evt.target.dataset.dni}">
                <input type="text" class="form-control" name="name" value="${evt.target.dataset.name}">
                <input type="text" class="form-control" name="lastname" value="${evt.target.dataset.lastname}">
                <input type="text" class="form-control" name="address" value="${evt.target.dataset.address}">
                <input type="text" class="form-control" name="email" value="${evt.target.dataset.email}">
                <input type="tel" class="form-control cphone" name="phone" value="${evt.target.dataset.phone}">        
           
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



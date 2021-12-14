// open model func
openDeleteModal = function(id) {
    document.getElementById("del_modal").action = '/clients/' + id;
    document.getElementById("backdrop").style.display = "block";
    document.getElementById("confirmationModal").style.display = "block";
    document.getElementById("confirmationModal").classList.add("show");
}

// close model func
closeDeleteModal = function() {
    document.getElementById("backdrop").style.display = "none";
    document.getElementById("confirmationModal").style.display = "none";
    document.getElementById("confirmationModal").classList.remove("show");
}

/* Get the modal */
var modal = document.getElementById('confirmationModal');

/* When the user clicks anywhere outside of the modal, close it */
window.onclick = function(event) {
    if (event.target == modal) {
        closeDeleteModal();
    }
}
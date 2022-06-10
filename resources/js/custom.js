function openCloseModal(modalId) {
    var modal = document.getElementById(modalId);
    console.log(modal);

    if(modal.style.display == "none") {
        modal.style.display = "block"
    } else {
        modal.style.display = "none"
    }
}

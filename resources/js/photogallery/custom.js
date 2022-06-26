const sidebar = document.getElementById("sidebar");

window.sidebarToggle = function () {
    if (sidebar.style.display === "none") {
        sidebar.style.display = "block";
    } else {
        sidebar.style.display = "none";
    }
};

const profileDropdown = document.getElementById("ProfileDropDown");

window.profileToggle = function () {
    if (profileDropdown.style.display === "none") {
        profileDropdown.style.display = "block";
    } else {
        profileDropdown.style.display = "none";
    }
};

/**
 * ### Modals ###
 */

window.toggleModal = function (action, elem_trigger) {
    elem_trigger.addEventListener("click", function () {
        if (action == "add") {
            let modal_id = this.dataset.modal;
            document
                .getElementById(`${modal_id}`)
                .classList.add("modal-is-open");
        } else {
            // Automaticlly get the opned modal ID
            let modal_id = elem_trigger
                .closest(".modal-wrapper")
                .getAttribute("id");
            document
                .getElementById(`${modal_id}`)
                .classList.remove("modal-is-open");
        }
    });
};

// Check if there is modals on the page
if (document.querySelector(".modal-wrapper")) {
    // Open the modal
    document.querySelectorAll(".modal-trigger").forEach((btn) => {
        window.toggleModal("add", btn);
    });

    // close the modal
    document.querySelectorAll(".close-modal").forEach((btn) => {
        window.toggleModal("remove", btn);
    });
}

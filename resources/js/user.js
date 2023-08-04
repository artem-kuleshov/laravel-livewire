Livewire.on("delete", (id, name) => {

    alert('her');

    const proceed = confirm(`Are you sure you want to delete ${name}`);

    if (proceed) {
        Livewire.emit("delete", id);
    }
});


window.addEventListener("user-deleted", (event) => {
    alert(`${event.detail.user_name} was deleted!`);
});

window.addEventListener("triggerCreate", (event) => {
    $("#user-modal").modal("show");
});

window.addEventListener("user-created", (event) => {
    $("#user-modal").modal("hide");
    console.log(`${event.detail.user_name} was create!`);
});

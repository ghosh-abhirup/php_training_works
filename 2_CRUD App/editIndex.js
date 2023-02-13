const edits = document.querySelectorAll(".edit");
const deletes = document.querySelectorAll(".delete");

edits.forEach((edit) => {
  edit.addEventListener("click", (e) => {
    console.log("hey", e.target.parentNode.parentNode);
    var tr = e.target.parentNode.parentNode;

    var noteEdit = document.querySelector("#noteEdit");
    var descEdit = document.querySelector("#descEdit");
    var id = document.querySelector("#idEdit");

    noteEdit.value = tr.getElementsByTagName("td")[0].innerText;
    descEdit.value = tr.getElementsByTagName("td")[1].innerText;
    id.value = e.target.id;

    console.log(noteEdit);
  });
});

deletes.forEach((del) => {
  del.addEventListener("click", (e) => {
    console.log(e);

    const delId = e.target.id;

    if (confirm("Are you sure you want to delete this note!")) {
      console.log("yes");
      window.location = `/phpw/CRUD App/index.php?delete=${delId}`;
    } else {
      console.log("no");
    }
  });
});

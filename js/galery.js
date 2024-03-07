document.addEventListener("DOMContentLoaded", () => {

  const modals = document.querySelectorAll(".modal");

  modals.forEach( modal => {
    let span = modal.parentNode.querySelector("span");
    span.onclick = () => modal.classList.add("mostraModal");
    span.ondblclick = () => modal.classList.remove("mostraModal");
  });
});

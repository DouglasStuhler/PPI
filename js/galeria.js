window.onload = () => {
  const modals = document.querySelectorAll(".modal");

  for (let modal of modals) {
    let span = modal.parentNode.querySelector("span");
    span.onclick = () => modal.classList.add("mostraModal");
    span.ondblclick = () => modal.classList.remove("mostraModal");
    modal.onclick = () => modal.classList.remove("mostraModal");
  }
};

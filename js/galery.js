window.onload = () => {
  const modals = document.querySelectorAll(".modal");

  for (let modal of modals) {
    let span = modal.parentNode.querySelector("span");
    span.onclick = () => modal.classList.add("mostraModal");
    modal.onmouseout = () => modal.classList.remove("mostraModal");
  }
};

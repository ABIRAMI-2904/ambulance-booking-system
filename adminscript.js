function toggleDropdown() {
  document.getElementById("dropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.admin-btn')) {
    const dropdowns = document.getElementsByClassName("dropdown-content");
    for (let i = 0; i < dropdowns.length; i++) {
      const openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function toggleSidebar() {
  // Sidebar logic to be implemented later
  alert("Sidebar will be implemented soon.");
}

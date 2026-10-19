(function () {
  function waInitNav() {
    var header = document.getElementById("wa-header");
    if (!header) return;

    var toggle = document.getElementById("wa-toggle");

    // Solid background after scrolling
    function onScroll() {
      header.dataset.scrolled = window.scrollY > 10 ? "true" : "false";
    }
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });

    // Mobile menu
    if (toggle) {
      toggle.addEventListener("click", function () {
        var open = header.dataset.open !== "true";
        header.dataset.open = open ? "true" : "false";
        toggle.setAttribute("aria-expanded", open ? "true" : "false");
        toggle.setAttribute(
          "aria-label",
          open ? "Close main menu" : "Open main menu",
        );
      });
    }

    // Dropdowns (any number)
    var buttons = header.querySelectorAll("[data-wa-dropdown-btn]");

    function setDropdown(btn, open) {
      var menu = document.getElementById(btn.getAttribute("aria-controls"));
      var icon = btn.querySelector("[data-wa-icon]");
      if (!menu) return;
      menu.classList.toggle("hidden", !open);
      if (icon) icon.classList.toggle("rotate-180", open);
      btn.setAttribute("aria-expanded", open ? "true" : "false");
    }

    function closeAll(except) {
      buttons.forEach(function (b) {
        if (b !== except) setDropdown(b, false);
      });
    }

    buttons.forEach(function (btn) {
      btn.addEventListener("click", function (e) {
        e.stopPropagation();
        var willOpen = btn.getAttribute("aria-expanded") !== "true";
        closeAll(btn);
        setDropdown(btn, willOpen);
      });
    });

    document.addEventListener("click", function (e) {
      if (!e.target.closest("[data-wa-dropdown]")) closeAll();
    });

    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") closeAll();
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", waInitNav);
  } else {
    waInitNav();
  }
})();

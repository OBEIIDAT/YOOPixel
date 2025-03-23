function ypShowPopup(menuSlug, customTitle = null) {
  const popup = document.getElementById("yp-popup");
  const titleEl = document.getElementById("yp-popup-title");
  const content = document.getElementById("yp-popup-content");

  const menu = window.yoopixelMenus?.[menuSlug];

  if (!menu) {
    titleEl.textContent = customTitle || "Options";
    content.innerHTML = "<p>No options found.</p>";
    popup.style.display = "flex";
    return;
  }

  titleEl.textContent = customTitle || menu.title || "Options";

  if (!Array.isArray(menu.items) || menu.items.length === 0) {
    content.innerHTML = "<p>No options found.</p>";
    popup.style.display = "flex";
    return;
  }

  // بناء المحتوى
  let html = "";
  menu.items.forEach(item => {
    html += `
      <a class="yp-icon-tile" href="${item.url}">
        <span class="dashicons ${item.icon || 'dashicons-admin-links'}"></span>
        <span class="yp-icon-label">${item.title}</span>
      </a>
    `;
  });

  content.innerHTML = html;
  popup.style.display = "flex";
}

function ypClosePopup() {
  document.getElementById("yp-popup").style.display = "none";
}

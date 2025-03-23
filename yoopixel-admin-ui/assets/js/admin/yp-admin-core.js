
// YOOPixel Admin Core Script with MutationObserver Support

(function () {
    const observeToggleButton = () => {
        const toggleBtn = document.getElementById('yp-toggle-clean-view');
        if (toggleBtn) {
            console.log("✅ YOOPixel toggle found");
            toggleBtn.addEventListener('change', function () {
                console.log("🔁 Toggled Clean View");
                document.body.classList.toggle('yp-clean-view');
            });
            return true;
        }
        return false;
    };

    // Try immediately in case the button is already loaded
    if (observeToggleButton()) return;

    // Otherwise observe changes in the DOM
    const observer = new MutationObserver(function () {
        if (observeToggleButton()) {
            observer.disconnect();
        }
    });

    observer.observe(document.body, { childList: true, subtree: true });
})();
document.addEventListener("DOMContentLoaded", function () {
  const userInfo = document.querySelector(".yp-user-info");
  const dropdown = document.querySelector(".yp-user-dropdown");

  let timeout;

  if (userInfo && dropdown) {
    userInfo.addEventListener("mouseenter", function () {
      clearTimeout(timeout);
      dropdown.style.display = "flex";
    });

    userInfo.addEventListener("mouseleave", function () {
      timeout = setTimeout(() => {
        dropdown.style.display = "none";
      }, 300); // ← 300ms قبل ما تختفي
    });

    dropdown.addEventListener("mouseenter", function () {
      clearTimeout(timeout);
      dropdown.style.display = "flex";
    });

    dropdown.addEventListener("mouseleave", function () {
      timeout = setTimeout(() => {
        dropdown.style.display = "none";
      }, 300);
    });
  }
});

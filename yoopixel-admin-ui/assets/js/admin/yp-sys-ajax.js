document.addEventListener('DOMContentLoaded', function () {
  const filterForm = document.querySelector('.yp-posts-filters');
  if (!filterForm) return;

  filterForm.querySelectorAll('select, input[type="text"]').forEach(function (field) {
    field.addEventListener('change', function () {
      const formData = new FormData(filterForm);
      const params = new URLSearchParams();

      for (const [key, value] of formData.entries()) {
        if (value !== '') params.append(key, value);
      }

      // تحديث URL بدون تحديث الصفحة
      const newUrl = window.location.pathname + '?' + params.toString();
      window.history.pushState({}, '', newUrl);

      // إعادة تحميل قسم النتائج (لاحقاً يمكن جعله Ajax)
      location.reload();
    });
  });

  filterForm.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      e.target.blur(); // إزالة التركيز
    }
  });
});

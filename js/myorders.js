
let currentPage = 1;
const itemsPerPage = 3; // عدد العناصر في كل صفحة
const items = document.querySelectorAll('.item');
const totalPages = Math.ceil(items.length / itemsPerPage);

function showPage(page) {
    items.forEach((item, index) => {
        item.style.display = (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) ? 'block' : 'none';
    });
    document.querySelector('.page-number').textContent = page;
}

document.querySelector('.prev-page').addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
    }
});

document.querySelector('.next-page').addEventListener('click', () => {
    if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
    }
});

// لعرض الصفحة الأولى عند تحميل الصفحة
showPage(currentPage);

const filter = document.getElementById("categoryFilter");
const searchInput = document.getElementById("searchInput");
const sortSelect = document.getElementById("sortSelect");
const grid = document.getElementById("productGrid");
const countBadge = document.getElementById("countBadge");
const emptyState = document.getElementById("emptyState");

function clearSearch() {
  searchInput.value = "";
  applyFilters();
}

function quickFilter(category) {
  filter.value = category;
  applyFilters();
  window.scrollTo({
    top: document.querySelector(".panel").offsetTop - 80,
    behavior: "smooth",
  });
}

function resetAll() {
  filter.value = "all";
  sortSelect.value = "default";
  searchInput.value = "";
  applyFilters();
}

function getItems() {
  return Array.from(document.querySelectorAll(".product-item"));
}

function applyFilters() {
  const category = filter.value.toLowerCase();
  const search = searchInput.value.toLowerCase().trim();
  const items = getItems();

  // filter visibility
  let visible = [];
  items.forEach((item) => {
    const name = (
      item.dataset.name ||
      item.querySelector(".product-name")?.textContent ||
      ""
    ).toLowerCase();
    const matchCategory =
      category === "all" || item.classList.contains(category);
    const matchSearch = !search || name.includes(search);
    const show = matchCategory && matchSearch;
    item.style.display = show ? "" : "none";
    if (show) visible.push(item);
  });

  // sort visible items by re-appending
  const sort = sortSelect.value;
  if (sort !== "default") {
    const sorted = visible.slice().sort((a, b) => {
      const ap = Number(a.dataset.price || 0);
      const bp = Number(b.dataset.price || 0);
      const an = (a.dataset.name || "").toLowerCase();
      const bn = (b.dataset.name || "").toLowerCase();
      if (sort === "priceAsc") return ap - bp;
      if (sort === "priceDesc") return bp - ap;
      if (sort === "nameAsc") return an.localeCompare(bn);
      return 0;
    });
    sorted.forEach((el) => grid.appendChild(el));
  }

  countBadge.textContent = visible.length;
  emptyState.style.display = visible.length ? "none" : "block";
}

filter.addEventListener("change", applyFilters);
sortSelect.addEventListener("change", applyFilters);
searchInput.addEventListener("keyup", applyFilters);

// initial
applyFilters();

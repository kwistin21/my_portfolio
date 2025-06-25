// Add product to cart
function addToCart(productName, price) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  cart.push({ name: productName, price: price });
  localStorage.setItem("cart", JSON.stringify(cart));
  alert(`${productName} added to cart!`);
  updateCartCount();
}

// Update cart count in icon and dropdown
function updateCartCount() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  document.getElementById("cart-count").innerText = cart.length;
  updateCartDropdown(cart);
}

// Update dropdown display with cart items and total
function updateCartDropdown(cart) {
  const cartItems = document.getElementById("cartItems");
  const cartTotal = document.getElementById("cartTotal");

  if (!cartItems || !cartTotal) return;

  cartItems.innerHTML = "";
  let total = 0;

  cart.forEach(item => {
    const li = document.createElement("li");
    li.textContent = `${item.name} - S$ ${item.price.toFixed(2)}`;
    cartItems.appendChild(li);
    total += item.price;
  });

  cartTotal.innerText = total.toFixed(2);
}

// Filter product cards (optional feature)
function filterProducts() {
  const search = document.getElementById('searchInput')?.value.toLowerCase() || "";
  const category = document.getElementById('categoryFilter')?.value || "all";
  const cards = document.querySelectorAll('.product-card');

  cards.forEach(card => {
    const name = card.getAttribute('data-name')?.toLowerCase() || "";
    const cat = card.getAttribute('data-category') || "";
    const matchesSearch = name.includes(search);
    const matchesCategory = category === 'all' || cat === category;

    card.style.display = matchesSearch && matchesCategory ? "block" : "none";
  });
}

// Star Rating System
function initStarRatings() {
  const productCards = document.querySelectorAll(".product-card");

  productCards.forEach(card => {
    const productName = card.querySelector("h3").textContent.trim();
    const ratingContainer = document.createElement("div");
    ratingContainer.className = "star-rating";

    for (let i = 1; i <= 5; i++) {
      const star = document.createElement("i");
      star.className = "fa fa-star";
      star.dataset.value = i;

      // Hover effect
      star.addEventListener("mouseover", () => highlightStars(ratingContainer, i));
      star.addEventListener("mouseout", () => renderStars(ratingContainer, productName));

      // Click to rate
      star.addEventListener("click", () => handleRating(productName, i, ratingContainer));

      ratingContainer.appendChild(star);
    }

    const ratingInfo = document.createElement("div");
    ratingInfo.className = "rating-info";
    ratingInfo.innerText = "0.0 (0 reviews)";

    card.appendChild(ratingContainer);
    card.appendChild(ratingInfo);

    renderStars(ratingContainer, productName);
  });
}

function highlightStars(container, value) {
  const stars = container.querySelectorAll(".fa-star");
  stars.forEach((star, index) => {
    star.classList.toggle("selected", index < value);
  });
}

function handleRating(productName, rating, container) {
  let ratings = JSON.parse(localStorage.getItem("ratings")) || {};
  if (!ratings[productName]) ratings[productName] = [];

  ratings[productName].push(rating);
  localStorage.setItem("ratings", JSON.stringify(ratings));
  renderStars(container, productName);
}

function renderStars(container, productName) {
  let ratings = JSON.parse(localStorage.getItem("ratings")) || {};
  const productRatings = ratings[productName] || [];

  const avgRating = productRatings.length
    ? productRatings.reduce((a, b) => a + b) / productRatings.length
    : 0;

  const stars = container.querySelectorAll(".fa-star");
  stars.forEach((star, index) => {
    star.classList.toggle("selected", index < Math.round(avgRating));
  });

  const info = container.nextElementSibling;
  info.textContent = `${avgRating.toFixed(1)} (${productRatings.length} review${productRatings.length !== 1 ? 's' : ''})`;
}

// Initialize everything on load
document.addEventListener("DOMContentLoaded", () => {
  updateCartCount();
  initStarRatings();
});
// Toggle Account Dropdown
const accountIcon = document.getElementById('accountIcon');
const accountDropdown = document.getElementById('accountDropdown');

accountIcon.addEventListener('click', function () {
  const isVisible = accountDropdown.style.display === 'block';
  accountDropdown.style.display = isVisible ? 'none' : 'block';
});

// Optional: Close dropdown when clicking outside
document.addEventListener('click', function (event) {
  if (!accountIcon.contains(event.target) && !accountDropdown.contains(event.target)) {
    accountDropdown.style.display = 'none';
  }
});
document.addEventListener('DOMContentLoaded', function() {
  const accountIcon = document.getElementById('accountIcon');
  const accountDropdown = document.getElementById('accountDropdown');
  if (accountIcon && accountDropdown) {
    accountIcon.addEventListener('click', function(e) {
      e.stopPropagation();
      accountDropdown.style.display =
        accountDropdown.style.display === 'block' ? 'none' : 'block';
    });
    document.addEventListener('click', function() {
      accountDropdown.style.display = 'none';
    });
    accountDropdown.addEventListener('click', function(e) {
      e.stopPropagation();
    });
  }
});

function showLoginPrompt() {
  alert('Please log in to add items to your cart.');
}

function showLogoutConfirm(e) {
  if (e) e.preventDefault();
  var modal = document.getElementById('logoutModal');
  if (modal) modal.style.display = 'flex';
}
function closeLogoutModal() {
  var modal = document.getElementById('logoutModal');
  if (modal) modal.style.display = 'none';
}

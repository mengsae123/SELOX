<?php

session_start();

// include client DB connection so we can fetch products

include __DIR__ . '/client/conntion.php';



if (!isset($_SESSION['cart_count'])) {

    $_SESSION['cart_count'] = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'],'qty')) : 0;

}

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHLOX - Shop</title>

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>

        :root {

            --primary-color: #007bff;

            --secondary-color: #6c757d;

            --accent-color: #ff6b6b;

            --light-bg: #f8f9fa;

            --dark-bg: #343a40;

        }

       

        body {

            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

            color: #333;

            padding-top: 80px;

        }

       

        .navbar {

            background-color:   #B0C4DE;

            box-shadow: 0 2px 10px rgba(0,0,0,0.1);

            padding: 15px 0;

        }

       

        .nav-link {

            font-weight: 500;

            color: #333;

        }

       

        .nav-link:hover {

            color: var(--primary-color);

        }

       

        .logo {

            font-weight: 700;

            font-size: 24px;

            color: #333;

        }

       

        .shop-hero {

            background: linear-gradient(135deg, #3D87D0FF 0%, #A5B2BFFF 100%);

            padding: 60px 40px;

            margin-bottom: 40px;

        }

       

        .shop-title {

            font-weight: 700;

            font-size: 3rem;

            margin-bottom: 10px;

        }

       

        .shop-subtitle {

            font-size: 1.5rem;

            color: var(--secondary-color);

            margin-bottom: 20px;

        }

       

        .product-card {

            border: 1px solid #e9ecef;

            border-radius: 12px;

            overflow: hidden;

            transition: transform 0.3s ease, box-shadow 0.3s ease;

            height: 100%;

            margin-bottom: 20px;

        }

       

        .product-card:hover {

            transform: translateY(-5px);

            box-shadow: 0 10px 20px rgba(0,0,0,0.1);

            border-color: var(--primary-color);

        }

       

        .product-card-img {

            height: 200px;

            object-fit: cover;

            width: 100%;

            padding: 15px;

        }

       

        .product-title {

            font-weight: 600;

            font-size: 1.2rem;

            margin-bottom: 5px;

        }

       

        .product-price {

            font-size: 1.3rem;

            font-weight: 700;

            color: var(--primary-color);

        }

       

        .product-old-price {

            font-size: 1rem;

            text-decoration: line-through;

            color: var(--secondary-color);

        }

       

       

        .add-to-cart-btn {

            background-color: var(--primary-color);

            color: white;

            border: none;

            padding: 8px 20px;

            border-radius: 30px;

            font-weight: 600;

            transition: background-color 0.3s ease;

            width: 100%;

        }

       

        .add-to-cart-btn:hover {

            background-color: #0056b3;

            color: white;

        }

       

        .sidebar {

            background-color: var(--light-bg);

            border-radius: 10px;

            padding: 20px;

            margin-bottom: 30px;

        }

       

        .sidebar-title {

            font-weight: 700;

            margin-bottom: 20px;

            font-size: 1.2rem;

            border-bottom: 2px solid var(--primary-color);

            padding-bottom: 10px;

        }

       

        .filter-item {

            margin-bottom: 15px;

        }

       

        .category-list {

            list-style: none;

            padding-left: 0;

        }

       

        .category-list li {

            margin-bottom: 10px;

        }

       

        .category-list a {

            color: #333;

            text-decoration: none;

            transition: color 0.3s ease;

        }

       

        .category-list a:hover {

            color: var(--primary-color);

        }

       

        .pagination {

            margin-top: 40px;

        }

       

        .footer {

            background-color: var(--dark-bg);

            color: white;

            padding: 40px 0;

            margin-top: 60px;

        }

       

        .footer-title {

            font-weight: 700;

            margin-bottom: 20px;

            font-size: 1.2rem;

        }

       

        @media (max-width: 768px) {

            .shop-title {

                font-size: 2.5rem;

            }

           

            .shop-subtitle {

                font-size: 1.2rem;

            }

        }

       

        /* Cart badge */

        .cart-badge {

            position: relative;

        }

       

        .cart-count {

            position: absolute;

            top: -8px;

            right: -8px;

            background-color: var(--accent-color);

            color: white;

            border-radius: 50%;

            width: 20px;

            height: 20px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 12px;

        }

       

        .user-dropdown {

            margin-left: 10px;

        }

       

        .stock-badge {

            font-size: 0.8rem;

            padding: 5px 10px;

        }
        .corner {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
}

    
.btn-outline-primary, 
.btn-outline-secondary {
    padding: 8px 20px; /* Slightly adjusted for better balance */
    border-radius: 50px; /* Gives that smooth pill shape from your image */
    display: flex;
    align-items: center ;
    transition: all 0.3s ease;
}

.cart-badge {
    margin-left: 6px;
}
.btn-outline-primary:hover, 

.custom-pagination .page-link {
    border-radius: 20px !important; /* Matches your buttons */
    margin: 0 5px;                 /* Adds space between numbers */
    color: #333;
    border: 1px solid #dee2e6;
    padding: 8px 16px;
}

/* Active Page Color */
.custom-pagination .page-item.active .page-link {
    background-color: #0d6efd;    /* Change to your brand color */
    border-color: #0d6efd;
    color: white;
}

/* Hover Effect */
.custom-pagination .page-link:hover {
    background-color: #f8f9fa;
    color: #0d6efd;
}


    </style>

</head>

<body>

    <!-- Navigation -->

    <nav class="navbar navbar-expand-lg fixed-top ">

        <div class="container " >

            <a class="navbar-brand logo" href="index.php">SELOX</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item">

                        <a class="nav-link" href="index.php">Home</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link active" href="shop.php">Shop</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="#">About Us</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="#">Blog</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="#">Contact Us</a>

                    </li>

                </ul>
                    
              <div class="d-flex align-items-center gap-2">

    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="dropdown user-dropdown">
            <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user me-2"></i> My Account
            </a>
            
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="client/profile.php"><i class="fas fa-user-circle me-2"></i>Profile</a></li>
                <li><a class="dropdown-item" href="client/orders.php"><i class="fas fa-box me-2"></i>Orders</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="auth/logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
        </div> <?php else: ?>
        <a href="auth/login.php" class="btn btn-outline-primary">Login</a>
    <?php endif; ?>

    <a href="client/cart.php" class="btn btn-outline-secondary position-relative">
        <i class="fas fa-shopping-cart"></i>
        <?php if (isset($_SESSION['cart_count']) && $_SESSION['cart_count'] > 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.rem;">
                <?php echo $_SESSION['cart_count']; ?>
            </span>
        <?php endif; ?>
    </a>

</div>
    </nav>



    <!-- Shop Hero Section -->

    <section class="shop-hero">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <h1 class="shop-title">Welcome to Products</h1>

                    <h2 class="shop-subtitle">Premium Electronics & Accessories</h2>

                    <p class="product-description">

                        Discover high-quality headphones, speakers, and gaming gear. 
        Enjoy peace of mind with our full product warranty and 24/7 customer support.

                    </p>

                </div>

                <div class="col-lg-4 text-center">

                    <div class="position-relative">

                        <h1 class="display-1 fw-bold" style="color: rgba(0,123,255,0.1); position: absolute; top: -30px; left: 50%; transform: translateX(-50%); z-index: 0;">SHOP</h1>

                        <img src="https://i.pinimg.com/1200x/64/71/3c/64713cc43391a19a6925bca3c131e5e5.jpg"

                             alt="Shopping"

                             class="img-fluid rounded shadow"

                             style="max-height: 200px; position: relative; z-index: 1;">

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- Shop Content -->

    <div class="container ">

        <div class="row">

            <!-- Sidebar with filters -->

            <div class="col-lg-3">

                <div class="sidebar">

                    <h3 class="sidebar-title">Categories</h3>

                    <ul class="category-list">

                        <li><a href="#" onclick="filterCategory('headphones')">Headphones</a></li>

                        <li><a href="#" onclick="filterCategory('speakers')">Speakers</a></li>

                        <li><a href="#" onclick="filterCategory('wearables')">Smart Watches</a></li>

                        <li><a href="#" onclick="filterCategory('laptops')">Laptops & Computers</a></li>

                        <li><a href="#" onclick="filterCategory('gaming')">Gaming Consoles & Accessories</a></li>

                        <li><a href="#" onclick="filterCategory('mobile')">Mobile Phones</a></li>

                        <li><a href="#" onclick="filterCategory('cameras')">Cameras & Photography</a></li>

                        <li><a href="#" onclick="filterCategory('home')">Home Electronics</a></li>

                    </ul>

                </div>

               
                <div class="sidebar">

                    <h3 class="sidebar-title">Brands</h3>

                    <div class="filter-item">

                        <div class="form-check">

                            <input class="form-check-input" type="checkbox" id="brandBeats" checked>

                            <label class="form-check-label" for="brandBeats">Beats</label>

                        </div>

                        <div class="form-check">

                            <input class="form-check-input" type="checkbox" id="brandApple">

                            <label class="form-check-label" for="brandApple">Apple</label>

                        </div>

                        <div class="form-check">

                            <input class="form-check-input" type="checkbox" id="brandSamsung">

                            <label class="form-check-label" for="brandSamsung">Samsung</label>

                        </div>

                        <div class="form-check">

                            <input class="form-check-input" type="checkbox" id="brandSony">

                            <label class="form-check-label" for="brandSony">Sony</label>

                        </div>

                        <div class="form-check">

                            <input class="form-check-input" type="checkbox" id="brandBose">

                            <label class="form-check-label" for="brandBose">Bose</label>

                        </div>

                    </div>

                </div>

               

                <div class="sidebar">

                    <h3 class="sidebar-title">Sort By</h3>

                    <div class="filter-item">

                        <select class="form-select" id="sortBy" onchange="sortProducts()">

                            <option value="popularity">Popularity</option>

                            <option value="price-low">Price: Low to High</option>

                            <option value="price-high">Price: High to Low</option>

                            <option value="newest">Newest Arrivals</option>

                            <option value="rating">Customer Rating</option>

                        </select>

                    </div>

                </div>

            </div>

           

            <!-- Product Grid -->

            <div class="col-lg-9 corner" style="background-color:#E8EDF2FF;color:#000;">

                <div class="row mb-4">

                    <div class="col">

                        <p class="mb-0">Showing <strong>1-9</strong> of <strong>48</strong> products</p>

                    </div>

                    <div class="col text-end">

                        <div class="btn-group" role="group">

                            <button type="button" class="btn btn-outline-primary active" id="gridViewBtn"><i class="fas fa-th"></i></button>

                            <button type="button" class="btn btn-outline-primary" id="listViewBtn"><i class="fas fa-list"></i></button>

                        </div>

                    </div>

                </div>

               

                <div class="row" id="productGrid">

                    <?php

                    // Fetch products from DB

                    $products = [];

                    if (isset($con) && $con) {

                        $res = $con->query('SELECT id, title, price, image, description FROM products ORDER BY id DESC LIMIT 100');

                        if ($res) {

                            while ($row = $res->fetch_assoc()) {

                                $products[] = [

                                    'id' => (int)$row['id'],

                                    'name' => $row['title'],

                                    'image' => $row['image'] ? ('client/upload/' . $row['image']) : 'https://via.placeholder.com/400x220?text=No+Image',

                                    'price' => (float)$row['price'],

                                    'old_price' => null,

                                    'rating' => 4.0,

                                    'stock' => 'In Stock',

                                    'stock_class' => 'bg-success',

                                    'category' => '' ,

                                    'description' => $row['description'] ?? ''

                                ];

                            }

                        }

                    }

                    // If no DB products, keep $products as empty and show the no-products message in UI.

                   

                    // Display products

                    foreach ($products as $product) {

                        $disabled = ($product['stock'] == 'Out of Stock') ? 'disabled' : '';

                        $disabledClass = ($product['stock'] == 'Out of Stock') ? 'disabled' : '';

                       

                        echo '

                        <div class="col-md-6 col-lg-4 product-item" data-category="' . $product['category'] . '" data-price="' . $product['price'] . '" data-rating="' . $product['rating'] . '">

                            <div class="product-card shadow-sm">

                                <img src="' . $product['image'] . '"

                                     class="product-card-img" alt="' . htmlspecialchars($product['name']) . '">

                                <div class="p-3">

                                    <h3 class="product-title">' . htmlspecialchars($product['name']) . '</h3>


                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <span class="product-price">$' . number_format($product['price'], 2) . '</span>';

                                           

                        if ($product['old_price']) {

                            echo '<span class="product-old-price ms-2">$' . number_format($product['old_price'], 2) . '</span>';

                        }

                       

                        echo '</div>

                                            <span class="badge stock-badge ' . $product['stock_class'] . '">' . $product['stock'] . '</span>

                                        </div>

                                        <button class="btn add-to-cart-btn mt-3 ' . $disabledClass . '" ' . $disabled . ' onclick="addToCart(' . $product['id'] . ')">

                                            <i class="fas fa-cart-plus me-2"></i> ' . (($product['stock'] == 'Out of Stock') ? 'Out of Stock' : 'Add to Cart') . '

                                        </button>

                                    </div>

                                </div>

                            </div>

                        ';

                    }

                   

                    // Function to generate star rating

                    function generateStars($rating) {

                        $stars = '';

                        $fullStars = floor($rating);

                        $halfStar = ($rating - $fullStars) >= 0.5;

                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

                       

                        for ($i = 0; $i < $fullStars; $i++) {

                            $stars .= '<i class="fas fa-star"></i>';

                        }

                       

                        if ($halfStar) {

                            $stars .= '<i class="fas fa-star-half-alt"></i>';

                        }

                       

                        for ($i = 0; $i < $emptyStars; $i++) {

                            $stars .= '<i class="far fa-star"></i>';

                        }

                       

                        return $stars;

                    }

                    ?>

                </div>

               

                <!-- Pagination -->

                    <div class="row mt-5 mb-5">
    <div class="col-12">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center custom-pagination">
                <li class="page-item disabled">
                    <a class="page-link shadow-sm" href="#" tabindex="-1">Previous</a>
                </li>

                <li class="page-item active"><a class="page-link shadow-sm" href="#">1</a></li>
                <li class="page-item"><a class="page-link shadow-sm" href="#">2</a></li>
                <li class="page-item"><a class="page-link shadow-sm" href="#">3</a></li>
                <li class="page-item"><a class="page-link shadow-sm" href="#">4</a></li>

                <li class="page-item">
                    <a class="page-link shadow-sm" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

            </div>

        </div>

    </div>



    <!-- Footer -->

    <footer class="footer">

        <div class="container">

            <div class="row">

                <div class="col-lg-4 mb-4">

                    <h4 class="footer-title">SELOX</h4>

                    <p>Your destination for premium electronics and accessories. Quality products with excellent customer service.</p>

                </div>

                <div class="col-lg-2 col-md-6 mb-4">

                    <h4 class="footer-title">Quick Links</h4>

                    <ul class="list-unstyled">

                        <li><a href="index.php" class="text-light text-decoration-none">Home</a></li>

                        <li><a href="shop.php" class="text-light text-decoration-none">Shop</a></li>

                        <li><a href="#" class="text-light text-decoration-none">About Us</a></li>

                        <li><a href="#" class="text-light text-decoration-none">Blog</a></li>

                        <li><a href="#" class="text-light text-decoration-none">Contact Us</a></li>

                    </ul>

                </div>

                <div class="col-lg-3 col-md-6 mb-4">

                    <h4 class="footer-title">Contact Info</h4>

                    <ul class="list-unstyled">

                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Phnom Penh, Cambodia</li>

                        <li class="mb-2"><i class="fas fa-phone me-2"></i>(885)71 65 21 931</li>

                        <li class="mb-2"><i class="fas fa-envelope me-2"></i>Product@selox.com</li>

                    </ul>

                </div>

                <div class="col-lg-3 mb-4">

                    <h4 class="footer-title">Newsletter</h4>

                    <p>Subscribe to get updates on new arrivals and special offers.</p>

                    <div class="input-group">

                        <input type="email" class="form-control" placeholder="Your email">

                        <button class="btn btn-primary" type="button" onclick="subscribeNewsletter()">Subscribe</button>

                    </div>

                </div>

            </div>

            <hr class="mt-4 mb-4">

            <div class="row">

                <div class="col-md-6 text-center text-md-start">

                    <p>&copy; 2025 SELOX. All Rights Reserved.</p>

                </div>

                <div class="col-md-6 text-center text-md-end">

                    <a href="https://www.facebook.com/mengse11" target="_blank" class="text-light me-3">
        <i class="fab fa-facebook-f"></i>
    </a>

                    <a href="https://t.me/John_MengSae" class="text-light me-3"><i class="fab fa-telegram"></i></a>

                    <a href="https://www.instagram.com/siri_errr?igsh=MThkaHl0YTNidXFmNw%3D%3D&utm_source=qr" class="text-light me-3"><i class="fab fa-instagram"></i></a>

                    <a href="#" class="text-light"><i class="fab fa-linkedin-in"></i></a>

                </div>

            </div>

        </div>

    </footer>



    <!-- Bootstrap JS Bundle with Popper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

   

    <script>

        // Update price value display

        function updatePriceValue(value) {

            document.getElementById('priceValue').textContent = `0 - ${value}`;

            filterProducts();

        }

       

        // Add to cart function

        function addToCart(productId) {

                // Check if user is logged in

            <?php if (empty($_SESSION['is_login'])): ?>

                alert('Please login to add items to cart!');

                window.location.href = 'auth/login.php';

                return;

            <?php endif; ?>



            // Send AJAX request to add to cart

            const xhr = new XMLHttpRequest();

            xhr.open('POST', 'client/add_to_cart.php', true);

            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');



            xhr.onload = function() {

                if (this.status === 200) {

                    const response = JSON.parse(this.responseText);

                    if (response.success) {

                        // Update cart count

                        document.querySelector('.cart-count').textContent = response.cart_count || '0';



                        // Show success message

                        alert('Product added to cart!');



                        // Redirect to cart page after 1 second

                        setTimeout(() => {

                            window.location.href = 'client/cart.php';

                        }, 1000);

                    } else {

                        alert('Error: ' + (response.message || 'Unknown error'));

                    }

                }

            };



            xhr.send('id=' + productId + '&qty=1');

        }

       

        // Filter products by category

        function filterCategory(category) {

            const products = document.querySelectorAll('.product-item');

            products.forEach(product => {

                if (category === 'all' || product.dataset.category === category) {

                    product.style.display = 'block';

                } else {

                    product.style.display = 'none';

                }

            });

           

            // Update product count

            updateProductCount();

        }

       

        // Filter products by price and other filters

        function filterProducts() {

            const priceRange = parseInt(document.getElementById('priceRange').value);

            const products = document.querySelectorAll('.product-item');

           

            // Get checked brands

            const checkedBrands = [];

            if (document.getElementById('brandBeats').checked) checkedBrands.push('Beats');

            if (document.getElementById('brandApple').checked) checkedBrands.push('Apple');

            if (document.getElementById('brandSamsung').checked) checkedBrands.push('Samsung');

            if (document.getElementById('brandSony').checked) checkedBrands.push('Sony');

            if (document.getElementById('brandBose').checked) checkedBrands.push('Bose');

           

            let visibleCount = 0;

           

            products.forEach(product => {

                const price = parseFloat(product.dataset.price);

                const productName = product.querySelector('.product-title').textContent;

               

                // Check price filter

                const priceMatch = price <= priceRange;

               

                // Check brand filter (simplified - checking if product name contains brand)

                let brandMatch = checkedBrands.length === 0; // If no brands selected, show all

                if (checkedBrands.length > 0) {

                    brandMatch = checkedBrands.some(brand => productName.includes(brand));

                }

               

                if (priceMatch && brandMatch) {

                    product.style.display = 'block';

                    visibleCount++;

                } else {

                    product.style.display = 'none';

                }

            });

           

            // Update product count display

            document.querySelector('.row.mb-4 p strong').textContent = `1-${visibleCount}`;

        }

       

        // Sort products

        function sortProducts() {

            const sortBy = document.getElementById('sortBy').value;

            const productGrid = document.getElementById('productGrid');

            const products = Array.from(document.querySelectorAll('.product-item'));

           

            products.sort((a, b) => {

                switch(sortBy) {

                    case 'price-low':

                        return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);

                    case 'price-high':

                        return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);

                    case 'rating':

                        return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);

                    default:

                        return 0; // Popularity - keep original order

                }

            });

           

            // Reorder products in the grid

            products.forEach(product => {

                productGrid.appendChild(product);

            });

        }

       

        // Update product count

        function updateProductCount() {

            const visibleProducts = document.querySelectorAll('.product-item[style*="display: block"]').length;

            document.querySelector('.row.mb-4 p strong').textContent = `1-${visibleProducts}`;

        }

       

        // Grid/List view toggle

        document.addEventListener('DOMContentLoaded', function() {

            const gridViewBtn = document.getElementById('gridViewBtn');

            const listViewBtn = document.getElementById('listViewBtn');

            const productItems = document.querySelectorAll('.product-item');

           

            gridViewBtn.addEventListener('click', function() {

                gridViewBtn.classList.add('active');

                listViewBtn.classList.remove('active');

               

                productItems.forEach(item => {

                    item.classList.remove('col-12');

                    item.classList.add('col-md-6', 'col-lg-4');

                });

            });

           

            listViewBtn.addEventListener('click', function() {

                listViewBtn.classList.add('active');

                gridViewBtn.classList.remove('active');

               

                productItems.forEach(item => {

                    item.classList.remove('col-md-6', 'col-lg-4');

                    item.classList.add('col-12');

                });

            });

           

            // Initialize filter event listeners

            const brandCheckboxes = document.querySelectorAll('input[type="checkbox"]');

            brandCheckboxes.forEach(checkbox => {

                checkbox.addEventListener('change', filterProducts);

            });

           

            // Initialize product count

            updateProductCount();

        });

       

        // Newsletter subscription

        function subscribeNewsletter() {

            const emailInput = document.querySelector('.input-group input[type="email"]');

            const email = emailInput.value;

           

            if (email && validateEmail(email)) {

                alert('Thank you for subscribing to our newsletter!');

                emailInput.value = '';

            } else {

                alert('Please enter a valid email address.');

            }

        }

       

        // Email validation

        function validateEmail(email) {

            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            return re.test(email);

        }

    </script>

</body>

</html>
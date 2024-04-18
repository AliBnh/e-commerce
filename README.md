# E-commerce App Requirements

## 1. Functionalities

### Admin & Client

- **Login & Logout**
- **Client:**
  - Registration.
  - Add, remove, or modify products in the cart.
  - Finalize an order by providing address details and choosing a payment method, either by credit card or cash on delivery.
  - List products by category.
  - Search for products by label.
  - Filter products by price or other criteria.
  - Sort products by ascending or descending order of price or other criteria.
  - Track orders.
- **Administrator:**
  - Create, modify, and delete products/categories.
  - Manage orders.
  - Visualize order items.
  - Manage clients (modify/delete).

## 2. User Interface

### Client

- **Navbar:** 
  - Contains links to all the app's pages.
  - Includes a search bar for products.
  - Includes a link to the cart.
  - Includes a dropdown menu containing categories of products.
  - Includes a link to either register or log in if the user isn't logged in; if logged in, includes a link to log out.
- **Footer**

### Home Page

- Contains a short and concise description of the store.
- Features product cards showcasing top-selling products.

### Products Page (by Category)

- Displays product cards categorized by the selected category.
- Provides the option to sort/filter products by certain criteria, especially price.

### Product Page

- Shows a detailed description of the product.
- Provides the option to add the product to the cart.

### Cart page & sidebar

- Allows modification of products in the cart.
- Provides a button to checkout.

### Checkout Page

- Provides a form for entering checkout data and placing orders.
- Offers the choice of payment methods, either bank card or cash on delivery.

### Order Tracking Page

## Admin

### Sidebar

- Contains links to three pages: Categories, Products, Orders.

### Categories Page

- Performs CRUD (Create, Read, Update, Delete) operations for categories.

### Products Page

- Performs CRUD operations for products.

### Orders Page

- Performs Read and Update operations for orders.

### Customers Page

- Performs Read, Update and delete operations for customers.

## Tables

### categories

- `id` (int): Unique identifier for the category (primary key)
- `name` (varchar(255)): Name of the category
- `description` (text): Optional description of the category
- `archived` (tinyint(1)): Flag indicating if the category is archived (0: active, 1: archived)

### orders

- `id` (int): Unique identifier for the order (primary key)
- `user_id` (int): Foreign key referencing the user who placed the order (links to users.id)
- `address` (text): Billing/shipping address for the order
- `payment_method` (enum): Payment method used for the order (credit_card, cash_on_delivery)
- `status` (enum): Current status of the order (pending, processing, shipped, completed, cancelled)
- `created_at` (datetime): Date and time the order was created
- `total` (decimal(10,2)): Total amount paid for the order

### order_items

- `id` (int): Unique identifier for the order item (primary key)
- `order_id` (int): Foreign key referencing the order the item belongs to (links to orders.id)
- `product_id` (int): Foreign key referencing the product in the order (links to products.id)
- `quantity` (int): Quantity of the product ordered
- `total` (decimal(10,2)): Total price for the specific quantity of the product ordered

### products

- `id` (int): Unique identifier for the product (primary key)
- `name` (varchar(255)): Name of the product
- `description` (text): Optional description of the product
- `price` (decimal(10,2)): Selling price of the product
- `purchase_price` (int): Price at which the product was purchased
- `stock` (int): Current stock level of the product
- `image` (varchar(255)): Path to the product image (optional)
- `category_id` (int): Foreign key referencing the category the product belongs to (links to categories.id)
- `archived` (tinyint(1)): Flag indicating if the product is archived (0: active, 1: archived)

### users

- `id` (int): Unique identifier for the user (primary key)
- `username` (varchar(255)): Username for login
- `email` (varchar(255)): User's email address
- `address` (varchar(100)): User's address (optional)
- `phone_number` (varchar(20)): User's phone number (optional)
- `password` (varchar(255)): Hashed password for secure login
- `is_admin` (tinyint(1)): Flag indicating if the user is an administrator (0: regular user, 1: administrator)
- `archived` (tinyint(1)): Flag indicating if the user is archived (0: active, 1: archived)

## Relationships

- `orders.user_id` references `users.id` (a user can have many orders)
- `order_items.order_id` references `orders.id` (an order can have many items)
- `order_items.product_id` references `products.id` (a product can be in many orders)
- `products.category_id` references `categories.id` (a category can have many products)

![image](https://github.com/AliBnh/e-commerce/assets/107149305/517fca79-a4c2-4231-86b1-8354926c67e6)


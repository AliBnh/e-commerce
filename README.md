# E-commerce App Requirements
Stripe link : https://dashboard.stripe.com/test/payments
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

- id: Unique identifier for each category (Auto-incremented).
- name: Name of the category.
- description: Description of the category.
- image: Path to the image associated with the category.
- archived: Flag indicating if the category is archived or not.

### Orders

- id: Unique identifier for each order (Auto-incremented).
- user_id: Identifier for the user who placed the order.
- payment_method: Payment method used for the order (credit card or cash on delivery).
- status: Current status of the order (pending, processing, shipped, cancelled).
- created_at: Timestamp indicating when the order was created.
- total: Total amount of the order.

### Order Items

- id: Unique identifier for each order item (Auto-incremented).
- order_id: Identifier for the order the item belongs to.
- product_id: Identifier for the product associated with the order item.
- quantity: Quantity of the product ordered.
- total: Total cost for the specific quantity of the product.

### Products

- id: Unique identifier for each product (Auto-incremented).
- name: Name of the product.
- description: Description of the product.
- ram: Amount of RAM memory the product has.
- storage: Storage capacity of the product.
- price: Selling price of the product.
- cost_price: Cost price of the product.
- color: Color of the product.
- image: Path to the image associated with the product.
- category_id: Identifier for the category the product belongs to.
- archived: Flag indicating if the product is archived or not.

### Users

- id: Unique identifier for each user (Auto-incremented).
- username: Username of the user.
- email: Email address of the user.
- address: Address of the user.
- phone_number: Phone number of the user.
- password: Encrypted password of the user.
- is_admin: Flag indicating if the user is an administrator or not.
- archived: Flag indicating if the user is archived or not.

## Relationships

- `orders.user_id` references `users.id` (a user can have many orders)
- `order_items.order_id` references `orders.id` (an order can have many items)
- `order_items.product_id` references `products.id` (a product can be in many orders)
- `products.category_id` references `categories.id` (a category can have many products)

![image](https://github.com/AliBnh/e-commerce/assets/107149305/517fca79-a4c2-4231-86b1-8354926c67e6)

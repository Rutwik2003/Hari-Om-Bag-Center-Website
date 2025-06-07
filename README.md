# Hari Om Bag Center Website

## Overview
Hari Om Bag Center is a full-featured e-commerce platform for a bag store. The website allows users to browse products, manage their shopping cart, place orders, and track their packages. It also includes an admin panel for managing products, users, categories, and feedback.

## Technologies Used
- **Backend:** PHP
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript
- **Frameworks/Libraries:** Bootstrap, jQuery, FontAwesome

## Project Structure
- **Root Directory:** Contains core PHP files for business logic, user flows, and utility scripts.
- **Assets:** Static files including CSS, JavaScript, images, and fonts.
- **Admin:** Admin panel for managing products, users, categories, and feedback.
- **Connection:** Database connection scripts and SQL dumps.
- **ProductImages:** Product images for listings.

## Main Features
- **User Side:**
  - Home page with banner carousel and product grid.
  - User authentication (registration, login, logout).
  - Product browsing and details.
  - Shopping cart management.
  - Order processing and tracking.
  - User profile management.
  - Search functionality and comments.

- **Admin Side:**
  - Admin authentication.
  - Dashboard for overview of products, users, orders, and feedback.
  - Product management (add, edit, delete, show/hide).
  - User management.
  - Category management.
  - Feedback and reports management.

## Database
The database schema and seed data are provided in the `olx.sql` and `olxpersonnalshop.sql` files. The database connection is centralized in `connection/conn.php`.

## Security & Best Practices
- Session management for user authentication.
- Error reporting enabled in development.
- Input handling needs improvement to prevent SQL injection.

## Styling & UI
- Bootstrap for responsive design and layout.
- Custom CSS/SCSS for branding and page-specific styles.
- FontAwesome for icons.
- Carousels and sliders for banners and product showcases.

## JavaScript
- jQuery for DOM manipulation and AJAX.
- Custom scripts for UI interactivity, admin panel, and frontend enhancements.
- Vendor scripts including Bootstrap JS and slick sliders.

## Notable Files
- `index.php`: Main landing page and entry point.
- `shop.php`, `shop-single.php`: Product listing and detail pages.
- `ShoppingCart.php`, `addtocart.php`, `remove_from_cart.php`: Cart management.
- `register.php`, `login.php`: User authentication.
- `admin/`: All admin-related logic and UI.
- `connection/conn.php`: Database connection.
- `olx.sql`, `olxpersonnalshop.sql`: Database schema and data.

## Potential Improvements
- Use prepared statements to prevent SQL injection.
- Increase code reuse with includes and functions.
- Consider using a PHP framework (Laravel, Symfony) for better structure and security.
- Add an API layer for AJAX and mobile app support.
- Implement automated tests for critical flows.

## Conclusion
This project is a robust e-commerce platform with a clear separation between user and admin logic, and a rich set of static assets for a modern UI. If you have any questions or need further details, feel free to ask! 

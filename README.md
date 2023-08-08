
# E-Commerce Platform Project Readme

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
  - [Home Page](#home-page)
  - [Product Page](#product-page)
  - [Cart](#cart)
  - [User Authentication](#user-authentication)
  - [Admin Panel](#admin-panel)
  - [Database Schema](#database-schema)
- [Contributors](#contributors)
- [License](#license)

## Introduction

Welcome to the E-Commerce Platform project! This project aims to create a user-friendly online shopping experience for customers. It provides various features such as browsing sale products, viewing top buying products, categorizing products, adding products to a cart, and making purchases securely. The platform also supports user authentication for customers and provides admin functionalities for managing products.

## Features

### Home Page:
- Display sale products.
- Highlight top buying products.

### Product Pages:

- Categorize products for easy navigation.
- Separate pages for each product category.
- View detailed product information and images.

### Product Purchase:

- Select desired quantity before purchasing.
- Add products to the cart.

### Cart:

- Review selected products before checkout.
- Adjust product quantities in the cart.
- Proceed to purchase multiple products at once.

### User Authentication:

- Users can register accounts.
- Registered users can log in to the platform.
- Guest users can browse products but need to log in to make a purchase.

### Admin Panel:

- Admins can add, delete, and modify product details.
- Admins can manage product quantities.

## Database Schema

The E-Commerce Platform project uses a MySQL database to manage various aspects of the platform. Here is an overview of the key tables and their relationships in the database:

#### customer

Stores information about customers, including their names, email, phone number, addresses, and passwords.

#### category

Contains different product categories to organize the products effectively.

#### product

Holds information about individual products, including their names, categories, prices, quantities, image URLs, and details.

#### cart

Represents individual shopping carts associated with customers.

#### cart_items

Stores items that customers have added to their carts. Includes information about the product ID, quantity, and price.

#### orders

Tracks order information, including the order date, total amount, and order status.

#### order_item

Stores information about individual items within an order, including product ID, quantity, and price.

#### admin

Associates customers with admin privileges, allowing them to manage products.

The provided database schema is designed to support the various features of the E-Commerce Platform, such as product browsing, cart management, and order processing. It includes primary keys, foreign keys, and relationships between tables to ensure data integrity and consistency.

To integrate this schema into your project, make sure to configure your PHP scripts to interact with the database for operations like fetching data, inserting new records, updating quantities, and more.

## Team

- E/19/413 Viduranga G.G.N. [email](#e19413@eng.pdn.ac.lk)
- E/19/349 Sandaruwan K.G.S.T. [email](#e19349@eng.pdn.ac.lk)
- E/19/170 Jayawardhana K.N.N. [email](#e19170@eng.pdn.ac.lk)

#
Thank you for choosing our E-Commerce Platform project. We hope it provides a seamless shopping experience for your customers and simplifies the management of your online store. If you have any questions or feedback, please don't hesitate to contact us. Happy coding!





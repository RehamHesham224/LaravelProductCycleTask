## Overview
This Task implements a product order management system using Laravel. It allows users to create products with unique slugs, manage orders, and handle requests asynchronously through a queue system.

## Database Design
you can see database design of task during this link [database design](https://drawsql.app/teams/reham/diagrams/producttask) .

## Features
- Create new products with variations
- Retrieve a list of products
- Pagination support for product listings
- API responses formatted for easy consumption
- Order Creation with Queue
  - The order creation process is handled asynchronously to ensure that users do not experience delays when placing orders. 
- Validations

## Technologies Used
- Laravel 11
- PHP >8.2
- Mysql
- Packages:
  - for upload media -> laravel media library
  - for track requests -> telescope

## Code Enhancement:

### Design Patterns Used

- Service Pattern:
  - The OrderService, Product Service class encapsulate the business logic for order management, promoting a clean separation between business logic and controller logic.
- Observer Pattern:
  - Slug Generation with Observer
- ModelService:
  - The ModelService class centralizes common model operations and shared functionalities, providing a unified interface for model-related logic across the application. This promotes code reusability and adheres to DRY (Don't Repeat Yourself) principles.
- Request Validation:
  - The StoreOrderRequest class utilizes Laravel's form request feature for validating incoming request data, adhering to the Single Responsibility Principle.
- Dependency Injection:
  - Services are injected into controllers and other classes to promote loose coupling and facilitate easier testing.

### Traits
Reusable Traits: Traits are utilized to encapsulate shared functionality across models, promoting code reuse and keeping the codebase clean and maintainable.
### Enums for Casting
Type Safety with Enums: Enums are employed for casting model attributes to ensure type safety and improve code readability. This approach allows for a clearer definition of possible values for certain attributes.
### Helpers
Custom Helpers: Helper functions are included to simplify common tasks and reduce code duplication. These functions can be used throughout the application to provide utility methods.


## Installation

- Install dependencies:
> composer install

- Set up your .env file:
> cp .env.example .env 

> php artisan key:generate

- Run migrations and seed the database:
> php artisan migrate --seed

- Start the queue worker:
> php artisan queue:work --queue=order

### Running Tests
- To run the tests, use the following command:
> php artisan test

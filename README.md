# Hotel Management System

## Overview
This project is a hotel management system built with Laravel that provides API support for managing hotel operations such as user registration, login, role management (with one role per user), reservations, rooms, customers, and conflict prevention in bookings.

## Features
- **User Registration & Login:** API endpoints for user registration and authentication.
- **Role Management (One Role Per User):** Each user is assigned only one role, simplifying role-based access control based on the user’s assigned role.
- **Room Management:** Create, update, and delete room records, with detailed information about room.
- **Customer Management:** Manage customer details including contact information.
- **Reservation System:** Add and manage room reservations, including the ability to check room availability and prevent overlapping bookings.
- **Conflict Prevention:** A built-in mechanism to check room availability before confirming a reservation, preventing double bookings.

## Technologies Used
- **Backend:** Laravel 11
- **Database:** Sqlite
- **Authentication:** Laravel Sanctum for API authentication
- **Authorization:** Role-based access control using Laravel's built-in Authorization and Policies
- **Conflict Prevention:** Custom logic to prevent overlapping reservations

## API Endpoints

### User Role Management
- **POST** `/api/v1/assignRole`: Assign a role to a user.
- **DELETE** `/api/v1/removeRoleFromUser`: Remove a role from a user.

### Booking Management
- **GET** `/api/v1/bookings`: Get a list of all bookings.
- **POST** `/api/v1/bookings`: Create a new booking.
- **GET** `/api/v1/bookings/{booking}`: Get details of a specific booking.
- **PUT/PATCH** `/api/v1/bookings/{booking}`: Update a booking.
- **DELETE** `/api/v1/bookings/{booking}`: Delete a booking.

### Client Management
- **GET** `/api/v1/clients`: Get a list of all clients.
- **POST** `/api/v1/clients`: Add a new client.
- **GET** `/api/v1/clients/{client}`: Get details of a specific client.
- **PUT/PATCH** `/api/v1/clients/{client}`: Update a client.
- **DELETE** `/api/v1/clients/{client}`: Delete a client.

### Authentication
- **POST** `/api/v1/login`: User login.
- **POST** `/api/v1/logout`: User logout.
- **POST** `/api/v1/register`: User registration.

### Room Management
- **GET** `/api/v1/rooms`: Get a list of all rooms.
- **POST** `/api/v1/rooms`: Add a new room.
- **GET** `/api/v1/rooms/{room}`: Get details of a specific room.
- **PUT/PATCH** `/api/v1/rooms/{room}`: Update a room.
- **DELETE** `/api/v1/rooms/{room}`: Delete a room.


### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/mo-hamed8/Hotel_system.git
   cd Hotel_system

# Tometou 
**An Anonymous Message Collection Website**

*"To me, to you" - Share your thoughts anonymously*

---

## Overview

Tometou is a web-based platform that allows users to share anonymous messages in a visually appealing, letter-inspired interface. The name "Tometou" comes from "To me, to you," reflecting the core purpose of the platform - facilitating anonymous communication between users.

## Features

### User Features
- **Anonymous Messaging**: Send and receive messages without revealing your identity
- **User Registration & Authentication**: Secure account creation with email verification
- **Profile Customization**: Choose from 16 different profile icons
- **Search Functionality**: Find messages by recipient name
- **Dark Mode Support**: Toggle between light and dark themes
- **Message Management**: View, post, and delete your own messages
- **Guest Browsing**: Browse public messages without registration

### Admin Features
- **User Account Management**: View and manage all user accounts
- **Content Moderation**: Activate/deactivate posts and users
- **Developer Section Management**: Add, update, or remove team member information
- **Landing Page Customization**: Edit about section content
- **Admin Dashboard**: Comprehensive overview of platform activity

### Additional Features
- **Games Section**: Built-in games for user entertainment
- **Terms & Conditions**: Legal compliance and user guidelines
- **Contact Information**: Team member profiles with social media links
- **Responsive Design**: Works seamlessly across devices

## Technology Stack

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP 7.4+
- **Database**: MySQL
- **Server**: Apache (XAMPP recommended)
- **Libraries**: Font Awesome, Google APIs

## 📁 Project Structure

```
Tometou/
├── tometou.php              # Landing page
├── admin/                   # Admin panel files
│   ├── homepage_admin.php   # Admin dashboard
│   ├── useraccounts.php     # User management
│   ├── developersCrud.php   # Team management
│   └── ...
├── assets/                  # Backend logic & utilities
│   ├── connect.php          # Database connection
│   ├── login.php           # Authentication handler
│   ├── submitpost_handler.php # Message submission logic
│   └── ...
├── content/                 # User-facing pages
│   ├── homepage.php         # User dashboard
│   ├── signin.php          # Login page
│   ├── register.php        # Registration page
│   ├── profile.php         # User profile
│   └── ...
├── css/                    # Stylesheets
├── images/                 # Static assets
│   ├── profile/           # Profile icons (1-16.png)
│   ├── nav/              # Navigation icons
│   └── ...
└── uploads/               # User uploaded content
```

## Installation & Setup

### Prerequisites
- XAMPP or similar LAMP/WAMP stack
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web browser (Chrome, Firefox, Safari, Edge)

### Installation Steps

1. **Clone/Download the Project**
   ```bash
   # Place the project in your htdocs folder
   C:\xampp\htdocs\Tometou\
   ```

2. **Database Setup**
   - Create a MySQL database named `wptgpbcm_tometou`
   - Import the required tables:
     - `user_accounts` (USER_ID, USERNAME, EMAIL, PASSWORD, PROFILE_ICON, STATUS, CREATED_AT)
     - `global_posts` (POST_ID, USER_ID, USERNAME, TO_WHOM, POST_CONTENT, POST_STATUS, POSTED_AT)
     - `developers` (id, name, surname, photo, fb, ig, gm)
     - `landing_crud` (CRUD_ID, ABOUT)

3. **Database Configuration**
   - Update database credentials in `assets/connect.php`:
   ```php
   $conn = new mysqli('localhost', 'root', '', 'wptgpbcm_tometou');
   ```

4. **Start Server**
   - Start Apache and MySQL in XAMPP
   - Navigate to `http://localhost/Tometou/tometou.php`

## Database Schema

### user_accounts
- `USER_ID` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `USERNAME` (VARCHAR)
- `EMAIL` (VARCHAR, UNIQUE)
- `PASSWORD` (VARCHAR, HASHED)
- `PROFILE_ICON` (VARCHAR, DEFAULT: '1.png')
- `STATUS` (ENUM: 'active', 'inactive')
- `CREATED_AT` (TIMESTAMP)

### global_posts
- `POST_ID` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `USER_ID` (INT, FOREIGN KEY)
- `USERNAME` (VARCHAR)
- `TO_WHOM` (VARCHAR)
- `POST_CONTENT` (TEXT)
- `POST_STATUS` (ENUM: 'active', 'inactive')
- `POSTED_AT` (TIMESTAMP)

### developers
- `id` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `name` (VARCHAR)
- `surname` (VARCHAR)
- `photo` (VARCHAR)
- `fb` (VARCHAR)
- `ig` (VARCHAR)
- `gm` (VARCHAR)

## Usage

### For Users:
1. **Registration**: Create an account with email and password
2. **Login**: Access your dashboard
3. **Post Messages**: Click "SPILL YOUR SAUCE" to compose anonymous messages
4. **Browse**: View all active messages on the homepage
5. **Search**: Find messages addressed to specific people
6. **Profile**: Manage your posts and customize your profile icon

### For Admins:
1. **Access Admin Panel**: Login with admin credentials
2. **Manage Users**: View, activate/deactivate user accounts
3. **Moderate Content**: Review and manage posts
4. **Update Content**: Edit the about section and team information

## Security Features

- **Password Hashing**: Passwords are encrypted using PHP's `password_hash()`
- **SQL Injection Prevention**: Prepared statements used throughout
- **XSS Protection**: Input sanitization with `htmlspecialchars()`
- **Session Management**: Secure session handling for authentication
- **Status Control**: Admin can deactivate problematic users/posts

## Customization

### Profile Icons
- 16 unique profile icons available in `/images/profile/`
- Icons numbered 1.png through 16.png
- Default icon is 1.png for new users

### Themes
- Built-in dark mode support
- Theme preference stored in localStorage
- CSS variables for easy color customization

## Contributing

The Tometou project was developed by a team of developers. To add team members:

1. Access the admin panel
2. Navigate to "EDIT DEVELOPERS SECTION"
3. Upload photo and add contact information
4. Social media integration (Facebook, Instagram, Gmail)

## License

This project is for educational and demonstration purposes. Please respect user privacy and implement appropriate security measures for production use.

## Support

For technical support or questions about the Tometou platform, please contact the development team through the contact section on the website.

---

**Made with ❤️ by the Tometou Development Team**

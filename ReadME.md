===================================================================
PROJECT: Online Restaurant Table Booking System (RestoBook)
DEVELOPER: [Your Name]
DEGREE: BSc Computer Science (Final Year Project)
TECHNOLOGIES: PHP, MySQL, HTML, CSS, JavaScript, Bootstrap

[1] PREREQUISITES

To run this project, you need:

XAMPP (or WAMP/MAMP) installed on your computer.

A Web Browser (Chrome, Firefox, Edge).

VS Code or Notepad++ (for editing code).

[2] INSTALLATION STEPS

STEP 1: FOLDER SETUP

Copy the folder restaurant_booking (containing all project files).

Paste it inside the XAMPP htdocs directory.

Path should look like: C:\xampp\htdocs\restaurant_booking\

STEP 2: DATABASE SETUP

Open XAMPP Control Panel and start "Apache" and "MySQL".

Open your browser and go to: http://localhost/phpmyadmin/

Click "New" and create a database named: restaurant_db

Click on restaurant_db in the left sidebar.

Go to the "Import" tab.

Choose the file db_schema.sql (provided in the project root or documentation) and click "Go".

Alternatively, go to the "SQL" tab and copy-paste the SQL code provided during development.

STEP 3: CONFIGURATION

Check config/db.php. Ensure settings match your XAMPP:
$host = 'localhost';
$username = 'root';
$password = ''; // Default XAMPP password is empty
$dbname = 'restaurant_db';

[3] HOW TO RUN

Open your browser.

Type: http://localhost/restaurant_booking/

You will see the Homepage.

[4] ACCESS CREDENTIALS

ADMIN PANEL:

URL: http://localhost/restaurant_booking/admin/

Username: admin

Password: admin123

USER PANEL:

You must Register a new account via the "Sign Up" button on the homepage.

[5] FEATURES

User Registration & Login

View Menu & Pricing (in INR)

Check Table Availability

Book a Table (Select Date, Time, Guests)

View Booking History & Cancel Bookings

Admin Dashboard (Stats)

Admin: Manage Bookings (Approve/Cancel/Complete)

Admin: Manage Tables (Add/Delete/Set Capacity)

Admin: View Registered Users

===================================================================
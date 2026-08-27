<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Student Registration System

**Course:** ITST 302 – Client-Server Technologies
**Mini Project 03** – Week 4: Laravel Forms, Validation, and File Upload
**Repository:** week04-student-registration

---

## 1. Introduction

Digital registration systems replace slow, error-prone paper processes with fast,
validated, centrally stored records. This project — a **Student Registration System**
built for the College of Information Technology — lets a student's information be
submitted online, validated on the server, and stored safely in a MySQL database,
instead of relying on paper slips and manual encoding.

**Data validation** matters because it stops bad data — duplicate student IDs,
malformed emails, missing required fields, unsafe file uploads — from ever reaching
the database. Once bad data gets in, every report, search, and downstream process
built on top of it becomes unreliable.

**Registration systems** like this one are the entry point of almost every enterprise
information system — universities, hospitals, banks, and government agencies all
depend on the same core pattern: collect input, validate it strictly at the server,
store only clean data, and confirm the result back to the user. This project applies
that exact pattern at a small, learnable scale.

## 2. Objectives

By completing this activity, the following objectives were accomplished:

- Built a registration form using Blade templates.
- Processed client requests through a dedicated `StudentController`.
- Implemented server-side validation using Laravel's Validator, covering required
  fields, uniqueness, email format, numeric fields, and image constraints.
- Displayed flash messages (a pop-up confirmation modal) for successful registration,
  and inline error messages for failed validation.
- Uploaded and securely stored a profile picture using Laravel Storage, linked via
  `php artisan storage:link`.
- Designed and migrated a relational `students` table in MySQL.
- Practiced troubleshooting a real local development environment (PHP installation,
  PHP extensions, database drivers, storage symlinks).

## 3. Laravel Request Lifecycle

```
Browser  --(POST /students)-->  Route (routes/web.php)
                                     |
                                     v
                          StudentController@store
                                     |
                                     v
                         Request Validation (rules)
                              /            \
                          fails           passes
                            |                |
                            v                v
                    Redirect back      Student::create()
                    with errors               |
                                               v
                                     Storage::disk('public')
                                     ->store(profile_picture)
                                               |
                                               v
                                    Save record to MySQL
                                    (student_registration_db)
                                               |
                                               v
                                Redirect to students.show
                                with flash success message
                                (rendered as a pop-up modal)
```

*(A cleaner version of this diagram should be redrawn in `documentation/` using
Draw.io, Figma, Canva, or similar, and saved as an image for the README.)*

## 4. Validation Rules

| Field | Rule | Why |
|---|---|---|
| `student_id` | `required\|unique:students` | Prevents duplicate student records |
| `first_name`, `last_name` | `required\|string\|max:100` | Ensures core identity fields are always present |
| `email` | `required\|email\|unique:students` | Ensures a usable, non-duplicate contact address |
| `mobile_number` | `required\|numeric\|digits_between:7,15` | Rejects non-numeric junk input |
| `date_of_birth` | `required\|date\|before:today` | Ensures a valid, real date |
| `gender`, `program`, `year_level`, `address` | `required` | Prevents incomplete student profiles |
| `profile_picture` | `required\|image\|mimes:jpeg,png,jpg\|max:2048` | Restricts uploads to safe image types under 2MB, reducing storage abuse and attack surface |

Server-side validation is required even though the form also uses basic HTML5
input types (`type="email"`, `type="date"`, `accept="image/*"`), because
client-side checks can always be bypassed — disabled JavaScript, a modified
request sent directly to the server, or a tool like Postman skips the browser
entirely. The Laravel validator on the server is the only checkpoint that
cannot be bypassed by the client.

## 5. Database Design

**Database:** `student_registration_db` (MySQL, managed via XAMPP)
**Table:** `students`

| Column | Type | Constraints |
|---|---|---|
| id | bigint | Primary Key, Auto Increment |
| student_id | varchar | Unique, Not Null |
| first_name | varchar | Not Null |
| middle_name | varchar | Nullable |
| last_name | varchar | Not Null |
| email | varchar | Unique, Not Null |
| mobile_number | varchar | Not Null |
| gender | varchar | Not Null |
| date_of_birth | date | Not Null |
| program | varchar | Not Null |
| year_level | varchar | Not Null |
| address | text | Not Null |
| profile_picture | varchar | Not Null (stores file path only, e.g. `profile_pictures/xyz.jpg`) |
| created_at / updated_at | timestamp | Auto-managed by Laravel |

*(Add a formal ERD image to `documentation/erd.png`, drawn in Draw.io or similar.)*

## 6. Flowchart

```
User Opens Registration Page
        |
        v
   Fill Out Form
        |
        v
  Submit Registration
        |
        v
  Laravel Validation
    ┌─────────────┐
    │ Valid Data? │
    └──────┬──────┘
      Yes  │  No
       v   │   v
 Save to DB│ Display Errors
       │   │
       v   │
Upload Profile Picture
       │
       v
Success Pop-up Message
       │
       v
 Student Profile Page
```

*(Recreate this as an actual diagram image in `documentation/flowchart.png`.)*

## 7. Features Implemented

- **Dashboard** landing page with live stats (total students, programs represented,
  most-enrolled program) and a "Recent Registrations" preview.
- **Registration form** grouped into Identification, Personal Information, and
  Academic Information sections, with an image upload area that shows a **live
  preview** of the selected photo before submitting.
- **Success pop-up** — a centered modal with a scale-in animation and a pulsing
  checkmark icon, auto-dismissing after a few seconds, shown right after a
  successful registration.
- **Student directory** — a searchable-by-eye table listing every registered
  student with their photo, program, and year level.
- **Student profile page** — displays the student's photo, name, and ID inside a
  styled header, with full details (email, mobile number, gender, date of birth,
  program, year level, address) below.

## 8. Screenshots

### Registration Form
![Registration Form](screenshots/Registration%20Form.png)

### Validation Errors
![Validation Errors](screenshots/Validation%20Errors.png)

### Successful Registration
![Successful Registration](screenshots/Successful%20Registration.png)

### Flash Success Message
![Flash Success Message](screenshots/Flash%20Success%20Message.png)

### Uploaded Image
![Uploaded Image](screenshots/Uploaded%20Image.png)

### Student Profile
![Student Profile](screenshots/Student%20Profile.png)

### Database Table
![Database Table](screenshots/Database%20Table.png)

### Laravel Project Structure
![Laravel Project Structure](screenshots/Laravel%20Project%20Structure.png)

### Terminal Output
![Terminal Output](screenshots/Terminal%20Output.png)

### Browser Output
![Browser Output](screenshots/Browser%20Output.png)

## 9. Problems Encountered

1. **Broken profile pictures after upload.**
   Uploaded images showed a broken image icon instead of the actual photo.

2. **`could not find driver` error when running `php artisan migrate`.**
   After switching the project from SQLite to MySQL, Laravel could not connect
   to the database.

3. **PHP not recognized in the terminal (`scoop` / broken path errors).**
   The installed PHP could not be located by the terminal, blocking every
   `php artisan` command from running.

## 10. Solutions

1. Ran `php artisan storage:link` to create the symbolic link from
   `public/storage` to `storage/app/public`, so uploaded files became
   publicly accessible through the browser.

2. Opened `php.ini` (located via `php --ini`) and removed the semicolon (`;`)
   in front of `extension=pdo_mysql` and `extension=mysqli` to enable the
   MySQL PDO driver, then restarted the terminal and re-ran the migration.

3. Verified the correct PHP installation was on the system `PATH` and used a
   working PHP binary directly, confirmed with `php -v`, before retrying all
   `artisan` commands.

## 11. Reflection

Building this Student Registration System made the value of server-side
validation concrete rather than theoretical. Early on, it was tempting to think
that a well-designed HTML form with `required` attributes and `type="email"`
fields was "good enough." Working through Laravel's validation rules showed why
that assumption is dangerous: a browser's built-in checks are easy to disable,
bypass, or simply skip when a request is sent directly to the server. Laravel's
`$request->validate()` call is the one place that cannot be bypassed by the
client, and that is exactly why enterprise systems treat it as the real gate
between "user input" and "trusted data."

Handling user input also meant thinking about it defensively rather than
optimistically. A required field is not just about forcing the user to fill in
a box — it is about guaranteeing that every downstream feature (the dashboard
statistics, the student profile page, the directory table) can safely assume
that value exists. The `unique` rule on `student_id` and `email` protects data
integrity at the database level, preventing duplicate accounts that would
otherwise corrupt reporting and search later on. Numeric and date validation
rules exist for the same reason: garbage data anywhere in the pipeline becomes
everyone's problem downstream.

File security turned out to be one of the more subtle lessons in this project.
Allowing "any file" to be uploaded as a profile picture would be a serious
vulnerability — a malicious file disguised with an image extension could be
uploaded and potentially executed if the server were misconfigured. Restricting
uploads to `image`, specific MIME types (`jpeg`, `png`, `jpg`), and a maximum
file size limits both the attack surface and the risk of storage abuse. Storing
only the file *path* in the database, rather than the file itself, is also a
deliberate security and performance choice — it keeps the database lean and
keeps file handling isolated to Laravel's Storage system, which manages
permissions and public accessibility through the `storage:link` symlink rather
than exposing the raw filesystem directly.

Debugging the local environment — fixing the broken PHP path, enabling the
`pdo_mysql` extension, and troubleshooting the storage symlink — was, in a way,
as instructive as writing the Laravel code itself. Real development work is
rarely just "write code and it works"; a large share of a junior developer's
time goes into configuring an environment correctly and reading error messages
carefully enough to trace them back to their actual cause rather than guessing.

Finally, this project made clear how central registration systems are to almost
every enterprise application. Whether it is a university enrolling students, a
hospital registering patients, or a bank onboarding customers, the same
pattern repeats: collect information, validate it strictly, store it securely,
and confirm the result to the user. Having built a working, smaller-scale
version of that pattern makes it much easier to recognize — and extend — in
larger systems later in this course and beyond.

*(Feel free to personalize this reflection further with your own specific
experience, timing, and any additional details from your actual build.)*

## 12. References

- Laravel. (2024). *Laravel 11.x Documentation.* https://laravel.com/docs
- PHP Group. (2024). *PHP Manual.* https://www.php.net/manual/en/
- Oracle Corporation. (2024). *MySQL 8.0 Reference Manual.* https://dev.mysql.com/doc/
- Tailwind Labs. (2024). *Tailwind CSS Documentation.* https://tailwindcss.com/docs
- Mozilla Developer Network. (2024). *MDN Web Docs.* https://developer.mozilla.org/

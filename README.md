# Laravel Posting App

## Description
This is a simple Laravel application built for learning purposes. It provides user authentication, post creation, and email notifications using `Mailtrap.io`.

### Features:
- **User Registration & Login:** Users can register and log in to the system.
- **Post Management:** Authenticated users can create, edit, and delete their own posts.
- **Post Attributes:** Each post has a title, description, and optional image.
- **Email Notifications:**
  - Upon successful post creation, users receive an email confirmation.
  - New users must verify their email upon registration. Unverified users cannot post.
  - Users can opt-in for email subscriptions to receive updates.
- **Forgot Password:** Users can request a password reset link via email.
- **Mailtrap Integration:** Used for email functionality testing.

### Technologies Used:
- **PHP**: Backend language.
- **Laravel**: Web framework.
- **MySQL**: Database for storing users and posts.
- **Mailtrap.io**: Testing email sending and receiving.



# Blog Website with Laravel

This repository contains the source code for a blog website built using the Laravel framework. The website provides administrators with powerful tools to manage categories, create posts, and interact with user comments. It incorporates role-based access control using Laravel's gates for enhanced security and flexibility.

## Features

- **Category Management**: Efficiently organize posts into different categories for easy navigation and content organization.
- **Post Management**: Create, edit, and publish blog posts with a user-friendly interface and seamless content creation process.
- **Tagging**: Assign relevant tags to posts to enhance searchability and content discovery.
- **User Comment Interaction**: Users can leave comments on blog posts, fostering engagement and promoting discussions.
- **Comment Reporting**: Users have the ability to report inappropriate or offensive comments, enabling content moderation.
- **Roles and Permissions**: Implement secure access and different levels of administrative control based on user roles using Laravel's gate functionality.

## Getting Started

To set up the project locally, follow these steps:

1. Clone the repository: `git clone https://github.com/your-username/blog-laravel.git`
2. Install dependencies: `composer install`
3. Configure the database in the `.env` file.
4. Run database migrations: `php artisan migrate`
5. Serve the application: `php artisan serve`

For more detailed instructions, refer to the [Installation Guide](docs/INSTALLATION.md).

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please feel free to submit a pull request or open an issue.

## License

This project is licensed under the [MIT License](LICENSE).


# Dynamic Join Package

This Laravel package provides dynamic joining functionality for Laravel projects.

## Installation from GitHub

To use this package in your Laravel project, follow these steps:

To use this package in your Laravel project, follow these steps:

1. **Require the Package**: Add the repository URL and package name to your project's `composer.json` file under the `"repositories"` and `"require"` sections.

    ```json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/reddotdigitalit-sd1/dynamic-join-package"
        }
    ],
    "require": {
        "reddotdigitalit/dynamic-join": "dev-main"
    }
    ```

2. **Run Composer Update**: After adding the package to your `composer.json` file, run the following command to install the package and its dependencies:

    ```bash
    composer update
    ```

3. **Publish Package Resources**: You have to publish the package's views, public assets and migration file using the `php artisan vendor:publish` command with the appropriate tag.

      ```bash
      php artisan vendor:publish --provider="RedDotDigitalIT\DynamicJoin\DynamicJoinServiceProvider"
      ```
## Testing

To test the package, follow these steps:

1. Run migrations: 
   ```bash
   php artisan migrate
2. Run the development server
   ```bash
   php artisan serve
3. URL path
   ```bash
   localhost:8000/view-report-list

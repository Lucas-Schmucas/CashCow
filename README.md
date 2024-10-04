# VR Online Banking CSV Dashboard

## Description

This project is a dashboard application designed to handle and analyze CSV exports from the VR-Online-Banking site. It provides users with an intuitive interface to import, process, and visualize their banking data, making it easier to manage finances and gain insights from transaction history.

## Features

- CSV import functionality for VR-Online-Banking exports
- Data processing and cleaning
- Interactive dashboard with financial visualizations
- Transaction categorization and analysis
- Export capabilities for processed data

## Installation

To set up this project locally, follow these steps:

1. Clone the repository:
   ```
   git clone https://github.com/Lucas-Schmucas/CashCow.git 
   ```
2. Navigate to the project directory:
   ```
   cd CashCow
   ```

3. Run docker compose
   ```
   docker compose up -d
   ```
4. Install dependencies:
   ```
   composer install
   ```
5. Copy the `.env.example` file to `.env` and configure your environment variables:
   ```
   cp .env.example .env
   ```
6. Generate an application key:
   ```
   php artisan key:generate
   ```
7. Run database migrations:
   ```
   php artisan migrate
   ```

## Usage

1. Open your browser and navigate to `http://localhost:8000`
2. Upload your VR-Online-Banking CSV export file
3. Explore the dashboard and analyze your financial data

## Technologies Used

- PHP 8.2
- Laravel 11.x
- Filament 3
- MySQL

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Acknowledgements

- [VR-Online-Banking](https://www.vr.de/) for providing the CSV export functionality
- [Filament](https://filamentphp.com/) for the admin panel framework


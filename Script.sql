SELECT 'CREATE DATABASE Facture'
WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = 'laravel_db')\gexec
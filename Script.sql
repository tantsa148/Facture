SELECT 'CREATE DATABASE Facture'
WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = 'laravel_db')\gexec

INSERT INTO mois (nom) VALUES
('Janvier'),
('Février'),
('Mars'),
('Avril'),
('Mai'),
('Juin'),
('Juillet'),
('Août'),
('Septembre'),
('Octobre'),
('Novembre'),
('Décembre');

UPDATE mois
SET nom = 'Decembre'
WHERE id = 12;
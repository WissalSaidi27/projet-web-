CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Identifiant unique
    event_name VARCHAR(255) NOT NULL,          -- Nom de l'événement
    event_description TEXT,                    -- Description de l'événement
    event_date DATE NOT NULL,                  -- Date de l'événement
    media_paths TEXT,                          -- Chemins des fichiers uploadés (stockés au format JSON)
    user_id INT NOT NULL,                      -- ID de l'utilisateur ayant créé l'événement
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date de création
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Dernière mise à jour
    
);

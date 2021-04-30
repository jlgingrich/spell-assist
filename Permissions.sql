/*    CREATE PERMISSIONS   */
USE spell_assist;
START TRANSACTION;

/* Remote Access Admin Permissions */
CREATE USER RemoteAdmin;
GRANT ALL ON spell_assist.* TO RemoteAdmin WITH GRANT OPTION;

/* Programattic User Permissions */
CREATE USER ProgUser IDENTIFIED WITH mysql_native_password BY 'itsaSECUREpassword';

-- Select permissions
GRANT SELECT ON spell_assist.* TO ProgUser;
-- Insert permissions
GRANT INSERT ON Characters TO ProgUser;
GRANT INSERT ON Descriptions TO ProgUser;
GRANT INSERT ON KnownSpell TO ProgUser;
GRANT INSERT ON Spells TO ProgUser;
-- Update permissions
GRANT UPDATE ON Characters TO ProgUser;
GRANT UPDATE ON Descriptions TO ProgUser;
GRANT UPDATE ON KnownSpell TO ProgUser;
GRANT UPDATE ON Spells TO ProgUser;
FLUSH PRIVILEGES;
COMMIT;
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
GRANT INSERT ON HasSpell TO ProgUser;
GRANT INSERT ON Spells TO ProgUser;
GRANT INSERT ON Users TO ProgUser;
-- Delete permissions
GRANT DELETE ON Characters TO ProgUser;
GRANT DELETE ON Descriptions TO ProgUser;
GRANT DELETE ON HasSpell TO ProgUser;
GRANT DELETE ON Spells TO ProgUser;
FLUSH PRIVILEGES;
COMMIT;
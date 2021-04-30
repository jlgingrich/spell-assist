CREATE SCHEMA IF NOT EXISTS spell_assist;
USE spell_assist;

/*      CREATE STATIC TABLES      */

-- Prebuild Components table (STATIC)
START TRANSACTION;
CREATE TABLE IF NOT EXISTS Components (
	componentname CHAR(8) NOT NULL UNIQUE, 
    abbreviation CHAR(1) PRIMARY KEY
);
INSERT INTO Components VALUES ('Verbal', 'V');
INSERT INTO Components VALUES ('Somatic', 'S');
INSERT INTO Components VALUES ('Material', 'M');
SELECT * FROM Components;
COMMIT;

-- Prebuild Levels table (STATIC)
START TRANSACTION;
CREATE TABLE IF NOT EXISTS Levels (
	levelname CHAR(9) NOT NULL UNIQUE,
    abbreviation CHAR(1) PRIMARY KEY
);
INSERT INTO Levels VALUES ('Cantrip', 'C');
INSERT INTO Levels VALUES ('1st-level', '1');
INSERT INTO Levels VALUES ('2nd-level', '2');
INSERT INTO Levels VALUES ('3rd-level', '3');
INSERT INTO Levels VALUES ('4th-level', '4');
INSERT INTO Levels VALUES ('5th-level', '5');
INSERT INTO Levels VALUES ('6th-level', '6');
INSERT INTO Levels VALUES ('7th-level', '7');
INSERT INTO Levels VALUES ('8th-level', '8');
INSERT INTO Levels VALUES ('9th-level', '9');
SELECT * FROM Levels;
COMMIT;

-- Prebuild Schools table (STATIC)
START TRANSACTION;
CREATE TABLE IF NOT EXISTS Schools (
	schoolname CHAR(13) NOT NULL UNIQUE,
    abbreviation CHAR(1) PRIMARY KEY
);
INSERT INTO Schools VALUES ('Abjuration', 'A');
INSERT INTO Schools VALUES ('Conjuration', 'C');
INSERT INTO Schools VALUES ('Divination', 'D');
INSERT INTO Schools VALUES ('Enchantment', 'E');
INSERT INTO Schools VALUES ('Evocation', 'V');
INSERT INTO Schools VALUES ('Illusion', 'I');
INSERT INTO Schools VALUES ('Necomancy', 'N');
INSERT INTO Schools VALUES ('Transmutation', 'T');
SELECT * FROM Schools;
COMMIT;

/*   CREATE DYNAMIC TABLES   */
START TRANSACTION;

-- Define Users table (DYNAMIC)
CREATE TABLE IF NOT EXISTS Users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Define Spells table (DYNAMIC)
CREATE TABLE IF NOT EXISTS Spells (
	spellname VARCHAR(26) PRIMARY KEY,
    lvl CHAR(1) REFERENCES Levels(abbreviation),
    school CHAR(1) REFERENCES Schools(abbreviation),
    castingtime VARCHAR(16),
    targetrange VARCHAR(32),
    verbal BOOLEAN,
    somatic BOOLEAN,
    material VARCHAR(32),
    duration VARCHAR(16),
    concentration BOOLEAN,
    ritual BOOLEAN
);

-- Define Description table (DYNAMIC)
CREATE TABLE IF NOT EXISTS Descriptions (
	spellname VARCHAR(26) PRIMARY KEY REFERENCES Spells(spellname),
    maintext JSON,
    higherleveltext JSON
);

-- Define Characters table (DYNAMIC)
CREATE TABLE IF NOT EXISTS Characters (
	characterid INT PRIMARY KEY AUTO_INCREMENT,
    charactername VARCHAR(64) NOT NULL,
    username VARCHAR(50) NOT NULL REFERENCES Users(username)
);


-- Define HasSpell table (DYNAMIC)
CREATE TABLE IF NOT EXISTS HasSpell (
	characterid INT NOT NULL REFERENCES Characters(characterid),
    spellname VARCHAR(26) NOT NULL REFERENCES Spells(spellname),
    castingclass VARCHAR(10),
    prepared BOOLEAN,
    alwaysprepared BOOLEAN,
    PRIMARY KEY (characterid, spellname)
);

COMMIT;
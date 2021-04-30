USE spell_assist;
SELECT * FROM Characters;
SELECT * FROM Components;
SELECT * FROM Descriptions;
SELECT * FROM KnownSpell;
SELECT * FROM Levels;
SELECT * FROM Schools;
SELECT * FROM Spells;

INSERT INTO Characters (charactername, playername, class) VALUES ('Valdror Berevan', 'Liam Gingrich', 'Cleric');
SELECT * FROM Characters;
DELETE FROM Characters WHERE characterid < 10;
SELECT * FROM Characters;
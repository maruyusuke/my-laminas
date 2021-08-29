CREATE TABLE album (id INTEGER PRIMARY KEY AUTOINCREMENT, command varchar(100) NOT NULL, explanation varchar(100) NOT NULL, type varchar(50) NOT NULL);
INSERT INTO album (command, explanation, type) VALUES ('cd', 'ディレクトリを移動する', 'linux');
INSERT INTO album (command, explanation, type) VALUES ('ls', 'カレントディレクトリの中身を表示する', 'linux');

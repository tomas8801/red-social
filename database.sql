CREATE DATABASE IF NOT EXISTS red_social;
USE red_social;

CREATE TABLE IF NOT EXISTS users (
id int(255) auto_increment not null,
role varchar(50),
name varchar(100), 
surname varchar(100),
nick varchar(100),
email varchar(255),
password varchar(255),
image varchar(255),
created_at datetime,
updated_at datetime,
remember_token varchar(255),
CONSTRAINT pk_users PRIMARY KEY (id)
)Engine=InnoDb;

INSERT INTO users VALUES(
null,'user', 'Tomas', 'Marsili', 'tomas8801', 'tomasmarsili@hotmail.com', '123', null, CURTIME(), CURTIME(), null
);
INSERT INTO users VALUES(
null,'user', 'Emanuel', 'Marinelli', 'ema10', 'emanuel@hotmail.com', '1233', null, CURTIME(), CURTIME(), null
);
INSERT INTO users VALUES(
null,'user', 'Leandro', 'Mendez', 'lean20', 'leandromendez@hotmail.com', '1232', null, CURTIME(), CURTIME(), null
);

CREATE TABLE IF NOT EXISTS images (
id int(255) auto_increment not null,
user_id int(255),
image_path varchar(255),
description text,
created_at datetime,
updated_at datetime,
CONSTRAINT pk_images PRIMARY KEY(id),
CONSTRAINT fk_images_users FOREIGN KEY (user_id) REFERENCES users(id)
)Engine=InnoDb;

INSERT INTO images VALUES(
null, 1, 'yo.jpg','descripcion de prueba', CURTIME(), CURTIME()
);
INSERT INTO images VALUES(
null, 1, 'hola.jpg','otra descripcion', CURTIME(), CURTIME()
);
INSERT INTO images VALUES(
null, 2, 'caca.jpg','description yeah', CURTIME(), CURTIME()
);
INSERT INTO images VALUES(
null, 2, 'caca.jpg','description yeah', CURTIME(), CURTIME()
);
INSERT INTO images VALUES(
null, 3, 'see.jpg','description raaaal', CURTIME(), CURTIME()
);

CREATE TABLE IF NOT EXISTS comments (
id int(255) auto_increment not null,
user_id int(255),
image_id int(255),
content text,
created_at datetime,
updated_at datetime,
CONSTRAINT pk_comments PRIMARY KEY(id),
CONSTRAINT fk_comments_users FOREIGN KEY (user_id) REFERENCES users(id),
CONSTRAINT fk_comments_images FOREIGN KEY (image_id) REFERENCES images(id)
)Engine=InnoDb;

INSERT INTO comments VALUES(
null, 1, 4, 'Buena foto!!', CURTIME(), CURTIME()
);
INSERT INTO comments VALUES(
null, 1, 3, 'Lindoooo', CURTIME(), CURTIME()
);
INSERT INTO comments VALUES(
null, 2, 4, 'Que buena ondaaa', CURTIME(), CURTIME()
);
INSERT INTO comments VALUES(
null, 3, 2, 'Sos hermosooo', CURTIME(), CURTIME()
);


CREATE TABLE IF NOT EXISTS likes (
id int(255) auto_increment not null,
user_id int(255),
image_id int(255),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_likes PRIMARY KEY(id),
CONSTRAINT fk_likes_users FOREIGN KEY (user_id) REFERENCES users(id),
CONSTRAINT fk_likes_images FOREIGN KEY (image_id) REFERENCES images(id)
)Engine=InnoDb;

INSERT INTO likes VALUES(
null, 1, 2,CURTIME(), CURTIME()
);
INSERT INTO likes VALUES(
null, 1, 3,CURTIME(), CURTIME()
);
INSERT INTO likes VALUES(
null, 2, 1,CURTIME(), CURTIME()
);
INSERT INTO likes VALUES(
null, 3, 2,CURTIME(), CURTIME()
);
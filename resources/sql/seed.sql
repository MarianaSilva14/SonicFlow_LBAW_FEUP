DROP TABLE IF EXISTS "user" CASCADE;
DROP TABLE IF EXISTS customer CASCADE;
DROP TABLE IF EXISTS moderator CASCADE;
DROP TABLE IF EXISTS administrator CASCADE;
DROP TABLE IF EXISTS banned CASCADE;
DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS product CASCADE;
DROP TABLE IF EXISTS comment CASCADE;
DROP TABLE IF EXISTS answer CASCADE;
DROP TABLE IF EXISTS flagged CASCADE;
DROP TABLE IF EXISTS attribute CASCADE;
DROP TABLE IF EXISTS attribute_product CASCADE;
DROP TABLE IF EXISTS category_attribute CASCADE;
DROP TABLE IF EXISTS favorite CASCADE;
DROP TABLE IF EXISTS purchase CASCADE;
DROP TABLE IF EXISTS purchase_product CASCADE;
DROP TABLE IF EXISTS rating CASCADE;

CREATE TABLE "user" (
    username text PRIMARY KEY,
    "password" text NOT NULL,
    email text UNIQUE NOT NULL,
    joindate TIMESTAMP DEFAULT now() NOT NULL,
    role text NOT NULL DEFAULT 'CUST',
    picture text,
    remember_token text,

    CONSTRAINT role_valid CHECK ((role in ('CUST', 'MOD', 'ADMIN')))
);

CREATE TABLE customer (
    user_username text PRIMARY KEY REFERENCES "user" ON DELETE CASCADE,
    "name" text NOT NULL,
    "address" text,
    loyaltypoints INTEGER NOT NULL DEFAULT 0,
    newsletter BOOLEAN NOT NULL DEFAULT TRUE,
    inactive BOOLEAN NOT NULL DEFAULT FALSE,

    CONSTRAINT lp_positive CHECK ((loyaltypoints >= 0))
);

CREATE TABLE moderator (
    user_username text PRIMARY KEY REFERENCES "user" ON DELETE CASCADE
);

CREATE TABLE administrator (
    user_username text PRIMARY KEY REFERENCES "user" ON DELETE CASCADE
);

CREATE TABLE banned (
    customer_username_customer TEXT PRIMARY KEY REFERENCES customer ON DELETE CASCADE,
    banneddate TIMESTAMP DEFAULT now() NOT NULL,
    moderator_username_moderator TEXT NOT NULL REFERENCES moderator ON DELETE CASCADE
);

CREATE TABLE category (
    id SERIAL PRIMARY KEY,
    "name" text NOT NULL,
    icon text NOT NULL DEFAULT TEXT 'far fa-square'
);

CREATE TABLE product (
    sku SERIAL PRIMARY KEY,
    title text NOT NULL,
    category_idcat INTEGER NOT NULL REFERENCES category ON DELETE CASCADE,
    price REAL NOT NULL,
    discountprice REAL,
    rating REAL NOT NULL DEFAULT 0,
    stock INTEGER NOT NULL,
    description TEXT,
    search tsvector,
    picture TEXT,


    CONSTRAINT price_positive CHECK (price > 0),
    CONSTRAINT discount_positive CHECK (discountprice is NULL or discountprice > 0),
    CONSTRAINT stock_positive CHECK(stock >= 0),
    CONSTRAINT rating_positive CHECK(rating >= 0)
);

CREATE TABLE comment (
    id SERIAL PRIMARY KEY,
    user_username TEXT REFERENCES "user" ON DELETE SET NULL,
    "date" TIMESTAMP DEFAULT now() NOT NULL,
    commentary text NOT NULL,
    flagsno INTEGER NOT NULL DEFAULT 0,
    deleted BOOLEAN DEFAULT FALSE NOT NULL,
    product_idproduct INTEGER NOT NULL REFERENCES product ON DELETE CASCADE,
    search tsvector
);

CREATE TABLE answer (
    comment_idparent INTEGER NOT NULL REFERENCES comment ON DELETE CASCADE,
    comment_idchild INTEGER NOT NULL REFERENCES comment ON DELETE CASCADE,

    UNIQUE(comment_idparent, comment_idchild)
);

CREATE TABLE flagged (
    comment_idcomment INTEGER NOT NULL REFERENCES comment ON DELETE CASCADE,
    "hidden" BOOLEAN NOT NULL
);

CREATE TABLE attribute (
    id SERIAL PRIMARY KEY,
    "name" text NOT NULL
);

CREATE TABLE attribute_product (
    attribute_idattribute INTEGER NOT NULL REFERENCES attribute ON DELETE CASCADE,
    product_idproduct INTEGER NOT NULL REFERENCES product ON DELETE CASCADE,
    "value" text NOT NULL
);

CREATE TABLE category_attribute (
    attribute_idattribute INTEGER NOT NULL REFERENCES attribute ON DELETE CASCADE,
    category_idcategory INTEGER NOT NULL REFERENCES category ON DELETE CASCADE,

    UNIQUE(attribute_idattribute, category_idcategory)
);

CREATE TABLE favorite (
    customer_username TEXT NOT NULL REFERENCES customer ON DELETE CASCADE,
    product_idproduct INTEGER NOT NULL REFERENCES product ON DELETE CASCADE,

    UNIQUE(customer_username, product_idproduct)
);

CREATE TABLE purchase (
    id SERIAL PRIMARY KEY,
    customer_username TEXT NOT NULL REFERENCES customer ON DELETE CASCADE,
    "date" TIMESTAMP DEFAULT now() NOT NULL,
    "value" REAL NOT NULL,
    method text NOT NULL,

    CONSTRAINT value_positive CHECK ("value" > 0),
    CONSTRAINT method_check CHECK (method in ('Credit', 'Debit' , 'Paypal' ))
);

CREATE TABLE purchase_product (
    purchase_idpurchase INTEGER NOT NULL REFERENCES purchase ON DELETE CASCADE,
    product_idproduct INTEGER NOT NULL REFERENCES product ON DELETE CASCADE,
    price REAL NOT NULL,
    quantity INTEGER NOT NULL,

    CONSTRAINT quantity_positive CHECK (quantity > 0),
    CONSTRAINT price_positive CHECK (price > 0),

    UNIQUE(purchase_idpurchase, product_idproduct)
);

CREATE TABLE rating (
    customer_username text REFERENCES customer ON DELETE CASCADE,
    product_idproduct INTEGER NOT NULL REFERENCES product ON DELETE CASCADE,
    value INTEGER NOT NULL CHECK ((value > 0 ) AND (value <= 5)),
    PRIMARY KEY(customer_username, product_idproduct)
);

-- TRIGGERS----------------------------------------------------------------------------------------

-- 1 user can only be banned after joining

CREATE OR REPLACE FUNCTION check_banned_date() RETURNS trigger AS $check_banned_date$
    BEGIN

        IF EXISTS (
            SELECT U.joindate FROM "user" U  WHERE U.username = NEW.customer_username_customer AND U.joindate > NEW.banneddate
        )
        THEN RAISE EXCEPTION '% cannot be banned before joining', NEW.customer_username_customer;
        END IF;

        RETURN NEW;
    END;
$check_banned_date$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS check_banned_date ON banned;
CREATE TRIGGER check_banned_date BEFORE INSERT OR UPDATE ON banned
    FOR EACH ROW EXECUTE PROCEDURE check_banned_date();


--2 date of comment answer must be later than parent comment

CREATE OR REPLACE FUNCTION check_answer_date() RETURNS trigger AS $check_answer_date$
    BEGIN

        IF EXISTS (
            SELECT C1.id, C2.id FROM comment C1, comment C2
            WHERE
                C1.id < C2.id
                AND
                C1.id = NEW.comment_idparent
                AND
                C2.id = NEW.comment_idchild
                AND
                C1."date" > C2."date"
        )
        THEN RAISE EXCEPTION 'Must comment on an older commentary.';
        END IF;

        RETURN NEW;
    END;
$check_answer_date$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS check_answer_date ON answer;
CREATE TRIGGER check_answer_date BEFORE INSERT OR UPDATE ON answer
    FOR EACH ROW EXECUTE PROCEDURE check_answer_date();


-- 3 update the rating of a product

CREATE OR REPLACE FUNCTION update_product_rating() RETURNS trigger AS $update_product_rating$
    BEGIN

        UPDATE product SET rating = (
            SELECT AVG("value") FROM rating R WHERE R.product_idproduct = NEW.product_idproduct
        )
        WHERE sku = NEW.product_idproduct;

        RETURN NEW;
    END;
$update_product_rating$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_product_rating ON rating;
CREATE TRIGGER update_product_rating AFTER INSERT OR UPDATE ON rating
    FOR EACH ROW EXECUTE PROCEDURE update_product_rating();

-- 4 discount price on a product

CREATE OR REPLACE FUNCTION constraint_product_discount() RETURNS trigger AS $constraint_product_discount$
    BEGIN
        IF NEW.discountprice > NEW.price THEN
        RAISE EXCEPTION 'Discount price must be lower than price.';
        END IF;

        RETURN NEW;
    END;
$constraint_product_discount$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS constraint_product_discount ON product;
CREATE TRIGGER constraint_product_discount BEFORE INSERT OR UPDATE ON product
    FOR EACH ROW EXECUTE PROCEDURE constraint_product_discount();


-- 5 update insert product

CREATE OR REPLACE FUNCTION insert_update_product() RETURNS trigger AS $insert_update_product$
    BEGIN

    IF TG_OP = 'INSERT'
    THEN NEW.search = setweight(to_tsvector(coalesce(NEW.title,'')), 'A')    ||
                      setweight(to_tsvector(coalesce(NEW.description,'')), 'B');
    END IF;
    IF TG_OP = 'UPDATE' THEN
        IF NEW.title <> OLD.title OR NEW.description <> OLD.description
        THEN NEW.search = setweight(to_tsvector(coalesce(NEW.title,'')), 'A')    ||
                          setweight(to_tsvector(coalesce(NEW.description,'')), 'B');
        END IF;
    END IF;
    RETURN NEW;
    END;
$insert_update_product$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS insert_update_product ON product;
CREATE TRIGGER insert_update_product BEFORE INSERT OR UPDATE ON product
    FOR EACH ROW EXECUTE PROCEDURE insert_update_product();


-- 6 update insert comment

CREATE OR REPLACE FUNCTION insert_update_comment() RETURNS trigger AS $insert_update_comment$
    BEGIN

    IF TG_OP = 'INSERT'
    THEN NEW.search = to_tsvector(NEW.commentary);
    END IF;
    IF TG_OP = 'UPDATE' THEN
        IF NEW.commentary <> OLD.commentary
        THEN NEW.search = to_tsvector(NEW.commentary);
        END IF;
    END IF;
    RETURN NEW;
    END;
$insert_update_comment$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS insert_update_comment ON comment;
CREATE TRIGGER insert_update_comment BEFORE INSERT OR UPDATE ON comment
    FOR EACH ROW EXECUTE PROCEDURE insert_update_comment();


-- INDEXES-----------------------------------------------------------------------------------------

-- varias tabelas que dêm search pelo idCat
DROP INDEX IF EXISTS discounted_product;
CREATE INDEX discounted_product ON product USING hash(category_idcat);

-- mais lento e com maior tamanho que GiST mas não é lossy
DROP INDEX IF EXISTS search_product;
CREATE INDEX search_product ON product USING GIN (search);

DROP INDEX IF EXISTS search_comments;
CREATE INDEX search_comments ON product USING GIST (search);

-- para mostrar apenas comentarios mais recentes por exemplo
DROP INDEX IF EXISTS comments_range;
CREATE INDEX comments_range ON comment USING btree("date");

-- para mostrar compras de um cliente
DROP INDEX IF EXISTS customer_purchases;
CREATE INDEX customer_purchases ON purchase USING hash(customer_username);

-- POPULATE----------------------------------------------------------------------------------------

--USER
INSERT INTO "user" VALUES ('xavirt','$2y$10$3U/Uo5OTfiKohXC0f06TIu51gaGw8qFeaOR3KRZ66GHC/WQYdKFm6','xfontes42@gmail.com','2018-04-06 18:30:24','ADMIN');
INSERT INTO "user" VALUES ('ana','$2y$10$3U/Uo5OTfiKohXC0f06TIu51gaGw8qFeaOR3KRZ66GHC/WQYdKFm6','anaezes2@gmail.com','2018-04-07 23:59:44','ADMIN');
INSERT INTO "user" VALUES ('mariana','$2y$10$3U/Uo5OTfiKohXC0f06TIu51gaGw8qFeaOR3KRZ66GHC/WQYdKFm6','marianals@gmail.com','2018-04-08 02:28:28','ADMIN');
INSERT INTO "user" VALUES ('eduardo','$2y$10$3U/Uo5OTfiKohXC0f06TIu51gaGw8qFeaOR3KRZ66GHC/WQYdKFm6','edu.swimming@gmail.com','2018-04-06 15:52:45','ADMIN');
INSERT INTO "user" VALUES ('jcl','$2y$10$g841JOLd/Oh.1y2qt8QCUu8ZuXM9HlVn2O.0gMmu4l4pf5jbRnQHG','jcl@gmail.com','2018-04-04 01:47:20','MOD');
INSERT INTO "user" VALUES ('xavi123', '$2y$10$ov5gkUSHX79k6Gnhl.izP.fYWS4B8wARqpYVvaPcEAOU.xA0RYu7q', 'xfontes@gmail.com', '2018-04-14 15:15:40.431337');
INSERT INTO "user" VALUES ('edu123', '$2y$10$L6r7FmhS30ehMpxoSjqkxeuCcMkN167VdcJxWXYu7AsbdKCPtczna', 'edu@gmail.com', '2018-04-14 15:37:32.106099','ADMIN');
INSERT INTO "user" VALUES ('antonio', '$2y$10$ov5gkUSHX79k6Gnhl.izP.fYWS4B8wARqpYVvaPcEAOU.xA0RYu7q', 'antonio@gmail.com', '2018-04-03 15:15:40.431337');
INSERT INTO "user" VALUES ('lbaw1723', '$2y$10$DRJc1fH6vmyYwHReyIfs2urU8MSOv0/u9MCUR5c/HC5J6Wms9YmbW', 'lbaw1723@gmail.com', '2018-04-03 15:16:40.431337');
INSERT INTO "user" VALUES ('ana123','$2y$10$s/6g9B2CPEpUEmFfGI8AyO/6FAsuJZ7pJCXmdOxxUfibKsKEgsLYm','anaezes@gmail.com','2018-07-08 23:59:44');


--CUSTOMER
INSERT INTO customer VALUES ('xavi123', 'Xavier Fontes', 'lole stree', 1200, 'TRUE', 'FALSE');
INSERT INTO customer VALUES ('antonio', 'Antonio Faria', 'flower street', 1200, 'TRUE', 'FALSE');
INSERT INTO customer VALUES ('lbaw1723', 'Lbaw Group', 'flower street n105', 1200, 'TRUE', 'FALSE');
INSERT INTO customer VALUES ('ana123', 'Ana Santos', 'flower street n105', 1200, 'TRUE', 'FALSE');


--MODERATOR
INSERT INTO moderator VALUES ('jcl');

--ADMINISTRATOR
INSERT INTO administrator VALUES ('xavirt');
INSERT INTO administrator VALUES ('edu123');
INSERT INTO administrator VALUES ('ana');
INSERT INTO administrator VALUES ('mariana');
INSERT INTO administrator VALUES ('eduardo');

--BANNED
INSERT INTO banned VALUES ('antonio','2018-04-04 09:05:05','jcl');

--CATEGORY
INSERT INTO category VALUES (1, 'Computers','fas fa-desktop');
INSERT INTO category VALUES (2, 'Laptops','fas fa-laptop');
INSERT INTO category VALUES (3, 'Mobile','fas fa-mobile-alt');
INSERT INTO category VALUES (4, 'Components','fas fa-camera-retro');
INSERT INTO category VALUES (5, 'Storage','fas fa-hdd');
INSERT INTO category VALUES (6, 'Peripherals','fas fa-keyboard');
INSERT INTO category VALUES (7, 'Photo','fas fa-camera-retro');
INSERT INTO category VALUES (8, 'Video','fas fa-camera-retro');
INSERT INTO category VALUES (9, 'Network','fas fa-rss');
INSERT INTO category VALUES (10, 'Software','far fa-window-maximize');

--PRODUCT
-- sku, title, category_idcat, price, discountprice, rating, stock, description, search, picture
INSERT INTO product VALUES ('841341724','Desktop All-in-One HP Pavilion PC 24-b200np',1,999.99,950.99,2.66,914,'Intel Core i5-7400T/4GB/1TB');
INSERT INTO product VALUES ('780741675','Desktop All-in-One ASUS ETOP Z240IEGK-77D05DB4',1,1199.99,1190.99,4.78,1026, 'i7-7700T/8GB/1TB+256GB');
INSERT INTO product VALUES ('410469648','Desktop All-in-One 21.5'' ASUS V221ICUK-37DHDPB1',1,649.99,600.99,1.18,929, 'i3-7100U/4GB/1TB');
INSERT INTO product VALUES ('901889798','Desktop All-in-One LENOVO Ideacentre 510-23ISH',1,799.99,700.99,4.22,1138, 'i5-7400T/4GB/1TB');
INSERT INTO product VALUES ('171093287','Desktop All-in-One ASUS ZEN PRO Z240IEGK-77D05DB3',1,2249.99,2240.99,3.75,451,'i7-7700T/16GB/1TB HDD+512GB SSD');
INSERT INTO product VALUES ('278925974','Desktop Gaming MSI Nightblade MIB VR7RC-243EU',1,1299.99,1290.27,1.02,290, 'Intel Core i7/16GB/1TB+128GB');
INSERT INTO product VALUES ('000000001','Dell Enterprise Desktop',1,7195.11,7100.39,0,200,'Intel Core i5/8GB/1TB+128GB');
INSERT INTO product VALUES ('000000002','HP Enterprise Desktop',1,500.10,null,0,500, 'Intel Core i3/16GB/1TB+128GB');

INSERT INTO product VALUES ('901896832','Apple MacBook Air 13'' i5-1,8GHz | 8GB | 128GB',2,1129,1029,1.86,245, 'i7 2.5GHz/16GB/1TB/Iris Pro Graphics');
INSERT INTO product VALUES ('672442768','Portátil Asus VivoBook A542UR-58A93CB1',2,699.99,600.99,1.88,965,'Intel Core i7-7200U/4GB/128GB');
INSERT INTO product VALUES ('186596482','Apple MacBook Pro 13'' Retina i5-2,3GHz | 16GB | 256GB | Intel Iris Plus 640',2,1729.99,1700.99,4.66,800,'i7 5GHz/16GB/1TB/Iris Pro Graphics');
INSERT INTO product VALUES ('556397271','Portátil Lenovo Legion Y520-15IKBN-951',2,999.99,950.99,2.27,935, 'Intel Core i5-6800U/4GB/128GB');
INSERT INTO product VALUES ('696296971','Portátil HP Pavilion 15-ck017np',2,999.99,950.99,1.19,454, 'Intel Core i5-7200U/4GB/500GB');
INSERT INTO product VALUES ('000000003','Portátil Híbrido 13'' LENOVO Yoga 720-13IKB-804 e Pen 2',2,1499.99,1400.99,4.66,800, 'Intel Core i7-8550U/8GB/512GB SSD/Intel UHD Graphics 620');
INSERT INTO product VALUES ('000000004','MacBook 12'' APPLE I7 MNYK2 Gold',2,2089.99,950.99,2.27,935,'i7 2.5GHz/32GB/1TB/Iris Pro Graphics');
INSERT INTO product VALUES ('914510007','MICROSOFT Surface Laptop 13.5'' Platina',2,899.99,850.99,1.19,454, 'Intel Core i5-7200U/4GB/128GB');

INSERT INTO product VALUES ('542291350','Smartphone SAMSUNG Galaxy A3 2017 16GB Golden',3,299.99,290.02,3.78,1401,'iOS 10/4''/A9');
INSERT INTO product VALUES ('000000005','Smartphone APPLE iPhone SE 128GB Pink Golden',3,393.99,null,0,125,'iOS 10/4''/A9');
INSERT INTO product VALUES ('000000006','Smartphone XIAOMI Redmi 5 Plus 64GB Black',3,199.99,190.99,0,75, 'Android 7.0/5.9''/Octa-core 4x2.36 + 4x1.7GHz/4GB RAM/Dual SIM');
INSERT INTO product VALUES ('000000019','Smartphone NOS HUAWEI P9 32GB Black and Grey',3,299.00,209.99,0,75,'Android 6.0/5.9''/Octa-core 4x2.36 + 4x1.7GHz/4GB RAM/Dual SIM');
INSERT INTO product VALUES ('000000020','Smartphone MEO SAMSUNG Galaxy J3 2016 8GB Golden',3,159.99,140.00,0,75,'Android 6.0/5.9''/Octa-core 4x2.36 + 4x1.7GHz/4GB RAM/Dual SIM');
INSERT INTO product VALUES ('000000021','Smartphone SONY Xperia XA2 32GB Black',3,318.99,null,0,75, 'Android 8.0/5.2''/Octa-core 2.2GHz/4GB RAM');

INSERT INTO product VALUES ('000000022','Cabo Componentes WOXTER WII U / WII',4,18.5,null,3.78,1401,'WII/WII U');
INSERT INTO product VALUES ('000000023','Cabo GEFEN VGA/Componente Preto',4,24.99,null,0,125,'VGA/Macho-Macho');
INSERT INTO product VALUES ('000000024','Placa Gráfica MSI GF GTX1080 SEA HAWK EK X 8GB DDR5',4,680.99,null,0,75, 'NVIDIA/GTX1080');
INSERT INTO product VALUES ('000000025','Router ASUS RT-AC68U AiMesh AC1900 Dual-Band Gigabit WiFi',4,158.99,150.99,0,75,'Dual-Band/1900Mbps');

INSERT INTO product VALUES ('000000026','Cabo MUVIT USB Load and Storage',5,59.95,null,0,75,'USB');
INSERT INTO product VALUES ('000000027','Hub SATECHI Type-C Multi-Port Ethernet V2 em Cinzento sideral',5,94.99,null,0,75,'PC/Mac USB-C');
INSERT INTO product VALUES ('000000028','Hub SATECHI Aluminum Type-C Pro Grey',5,92.99,null,0,75,'PC/Mac USB-C');
INSERT INTO product VALUES ('000000029','Hub HYPERDRIVE Solo 7-em-1 USB-C Grey',5,199.99,null,0,75,'7 Gates PC/Mac');

INSERT INTO product VALUES ('000000009','Rato Gaming DRAGON WAR Prog 4 Phantom 4.1',6,79.99,null,0,75,'Wired');
INSERT INTO product VALUES ('000000010','Rato Gaming LOGITECH G403 Prodigy',6,99.99,null,0,75,'Wired');
INSERT INTO product VALUES ('000000030','Rato Gaming RAZER Mamba 16000',6,139.99,null,0,75,'Wired');

INSERT INTO product VALUES ('000000011','Camera CANON EOS M50 + EF-M 15-45 White',7,799.99,null,0,75,'24.1MP');
INSERT INTO product VALUES ('000000012','Camera SONY Alpha A7II 24-70mm Black',7,3559.00,null,0,75,'24.3 MP/ISO:50-25600');
INSERT INTO product VALUES ('000000008','Camera SONY RX100 III',7,1175.00,null,0,75,'20.1 MP/ISO:50-25600');
INSERT INTO product VALUES ('000000007','Camera FUJIFILM XP130 Sky Blue',7,219.00,null,0,75,'16.4 MP/ISO:100-6400');

INSERT INTO product VALUES ('000000013','Video Camera SONY FDR-AX33',8,699.99,690.99,0,75,'4K/Optical zoom:10x');
INSERT INTO product VALUES ('000000014','Video Camera DJI Osmo Plus',8,749.99,null,0,75,'4K/Optical zoom:10x');
INSERT INTO product VALUES ('083108184','Video Camera PANASONIC V180-EC',8,229.99,220.49,4.93,964,'2.51 MP/Optcal zoom:50x');

INSERT INTO product VALUES ('000000015','Leitor Networks MARANTZ NA-6005 SG',9,699.99,null,0,75,'35 W/Bluetooth, WiFi');
INSERT INTO product VALUES ('000000016','Leitor Audio Network MARANTZ Na-11s1 Bk',9,4499.00,4400.99,0,75,'30 W');

INSERT INTO product VALUES ('000000017','Windows 10 HomeEdition',10,11.99,null,0,75, 'Permanent,Authorized,Global Key, For 1 PC');
INSERT INTO product VALUES ('000000018','Kaspersky protection System 2 years package',10,499.99,null,0,75, 'Permanent,Authorized,Global Key, For 1 PC');
INSERT INTO product VALUES ('891931229','Kaspersky protection System 1 years package',10,390.99,null,0,75, 'Permanent,Authorized,Global Key, For 1 PC');


SELECT setval(pg_get_serial_sequence('product', 'sku'), 18) FROM product;


--COMMENT
INSERT INTO comment VALUES (11,'xavi123', '2012-05-18 13:36:38','i want this computer', 0, FALSE, '186596482');
INSERT INTO comment VALUES (12,'xavi123', '2012-05-18 13:36:50','i want this computer now!', 0, FALSE, '186596482');


SELECT setval(pg_get_serial_sequence('comment', 'id'), max(id)) FROM comment;

--ANSWER
INSERT INTO answer VALUES (11,12);


--FLAGGED
INSERT INTO flagged values (12, FALSE);

--ATTRIBUTE
INSERT INTO attribute VALUES (1,'Processor');
INSERT INTO attribute VALUES (2,'RAM_memory');
INSERT INTO attribute VALUES (3,'Disk_Space');
INSERT INTO attribute VALUES (4,'Screen_Size');
INSERT INTO attribute VALUES (5,'Rpm');
INSERT INTO attribute VALUES (6,'Mechanical_Keys');
INSERT INTO attribute VALUES (7,'Max_Resolution(MP)');
INSERT INTO attribute VALUES (8,'Dual-Band');
INSERT INTO attribute VALUES (9,'Usability_Time');

--ATTRIBUTE_PRODUCT

--COMPUTERS
INSERT INTO attribute_product VALUES (1,'000000001', 'Intel i7');
INSERT INTO attribute_product VALUES (2,'000000001', '8GB');
INSERT INTO attribute_product VALUES (3,'000000001', '1TB');
INSERT INTO attribute_product VALUES (1,'000000002', 'Amd Ryzen 7');
INSERT INTO attribute_product VALUES (2,'000000002', '2*8GB');
INSERT INTO attribute_product VALUES (3,'000000002', '3TB');
INSERT INTO attribute_product VALUES (1,'841341724', 'Amd Ryzen 7');
INSERT INTO attribute_product VALUES (2,'841341724', '2*8GB');
INSERT INTO attribute_product VALUES (3,'841341724', '3TB');
INSERT INTO attribute_product VALUES (1,'780741675', 'Amd Ryzen 7');
INSERT INTO attribute_product VALUES (2,'780741675', '2*8GB');
INSERT INTO attribute_product VALUES (3,'780741675', '3TB');
INSERT INTO attribute_product VALUES (1,'410469648', 'Amd Ryzen 7');
INSERT INTO attribute_product VALUES (2,'410469648', '2*8GB');
INSERT INTO attribute_product VALUES (3,'410469648', '3TB');
INSERT INTO attribute_product VALUES (1,'901889798', 'Amd Ryzen 7');
INSERT INTO attribute_product VALUES (2,'901889798', '2*8GB');
INSERT INTO attribute_product VALUES (3,'901889798', '3TB');
INSERT INTO attribute_product VALUES (1,'171093287', 'Amd Ryzen 7');
INSERT INTO attribute_product VALUES (2,'171093287', '2*8GB');
INSERT INTO attribute_product VALUES (3,'171093287', '3TB');
INSERT INTO attribute_product VALUES (1,'278925974', 'Amd Ryzen 7');
INSERT INTO attribute_product VALUES (2,'278925974', '2*8GB');
INSERT INTO attribute_product VALUES (3,'278925974', '3TB');

--LAPTOPS
INSERT INTO attribute_product VALUES (1,'000000003', 'Intel i7');
INSERT INTO attribute_product VALUES (2,'000000003', '16GB');
INSERT INTO attribute_product VALUES (3,'000000003', '256GB');
INSERT INTO attribute_product VALUES (1,'000000004', 'Intel i5');
INSERT INTO attribute_product VALUES (2,'000000004', '8GB');
INSERT INTO attribute_product VALUES (3,'000000004', '500GB');
INSERT INTO attribute_product VALUES (1,'901896832', 'Intel i5');
INSERT INTO attribute_product VALUES (2,'901896832', '8GB');
INSERT INTO attribute_product VALUES (3,'901896832', '500GB');
INSERT INTO attribute_product VALUES (1,'672442768', 'Intel i5');
INSERT INTO attribute_product VALUES (2,'672442768', '8GB');
INSERT INTO attribute_product VALUES (3,'672442768', '500GB');
INSERT INTO attribute_product VALUES (1,'186596482', 'Intel i5');
INSERT INTO attribute_product VALUES (2,'186596482', '8GB');
INSERT INTO attribute_product VALUES (3,'186596482', '500GB');
INSERT INTO attribute_product VALUES (1,'556397271', 'Intel i5');
INSERT INTO attribute_product VALUES (2,'556397271', '8GB');
INSERT INTO attribute_product VALUES (3,'556397271', '500GB');
INSERT INTO attribute_product VALUES (1,'696296971', 'Intel i5');
INSERT INTO attribute_product VALUES (2,'696296971', '8GB');
INSERT INTO attribute_product VALUES (3,'696296971', '500GB');
INSERT INTO attribute_product VALUES (1,'914510007', 'Intel i5');
INSERT INTO attribute_product VALUES (2,'914510007', '8GB');
INSERT INTO attribute_product VALUES (3,'914510007', '500GB');

--MOBILE
INSERT INTO attribute_product VALUES (4,'542291350', '5.6\"');
INSERT INTO attribute_product VALUES (4,'000000005', '5.6\"');
INSERT INTO attribute_product VALUES (4,'000000006', '14.4');
INSERT INTO attribute_product VALUES (4,'000000019', '14.4');
INSERT INTO attribute_product VALUES (4,'000000020', '14.4');
INSERT INTO attribute_product VALUES (4,'000000021', '14.4');

--COMPONENTS
INSERT INTO attribute_product VALUES (4,'000000022', '5.6\"');
INSERT INTO attribute_product VALUES (4,'000000023', '5.6\"');
INSERT INTO attribute_product VALUES (4,'000000024', '5.6\"');
INSERT INTO attribute_product VALUES (4,'000000025', '5.6\"');

--STORAGE
INSERT INTO attribute_product VALUES (5,'000000026', '7200');
INSERT INTO attribute_product VALUES (6,'000000026', 'Yes');
INSERT INTO attribute_product VALUES (7,'000000026', '20.4');
INSERT INTO attribute_product VALUES (5,'000000027', '7200');
INSERT INTO attribute_product VALUES (6,'000000027', 'Yes');
INSERT INTO attribute_product VALUES (7,'000000027', '20.4');
INSERT INTO attribute_product VALUES (5,'000000028', '7200');
INSERT INTO attribute_product VALUES (6,'000000028', 'Yes');
INSERT INTO attribute_product VALUES (7,'000000028', '14.4');
INSERT INTO attribute_product VALUES (5,'000000029', '7200');
INSERT INTO attribute_product VALUES (6,'000000029', 'Yes');
INSERT INTO attribute_product VALUES (7,'000000029', '14.4');

--PERIPHERALS
INSERT INTO attribute_product VALUES (6,'000000009', 'Yes');
INSERT INTO attribute_product VALUES (6,'000000010', 'Yes');
INSERT INTO attribute_product VALUES (6,'000000030', 'Yes');

--PHOTO
INSERT INTO attribute_product VALUES (7,'000000011', '14.4');
INSERT INTO attribute_product VALUES (7,'000000012', '14.4');
INSERT INTO attribute_product VALUES (7,'000000008', '14.4');
INSERT INTO attribute_product VALUES (7,'000000007', '14.4');

--VIDEO
INSERT INTO attribute_product VALUES (4,'000000013', '5.6\"');
INSERT INTO attribute_product VALUES (4,'000000014', '5.6\"');
INSERT INTO attribute_product VALUES (4,'083108184', '5.6\"');

--NETWORK
INSERT INTO attribute_product VALUES (8,'000000015', 'No');
INSERT INTO attribute_product VALUES (8,'000000016', 'Yes');

--SOFTWARE
INSERT INTO attribute_product VALUES (9,'000000017', 'Lifetime');
INSERT INTO attribute_product VALUES (9,'000000018', '2 Years');
INSERT INTO attribute_product VALUES (9,'891931229', '2 Years');

--CATEGORY_ATTRIBUTE
INSERT INTO category_attribute VALUES (1,1);
INSERT INTO category_attribute VALUES (2,1);
INSERT INTO category_attribute VALUES (3,1);
INSERT INTO category_attribute VALUES (1,2);
INSERT INTO category_attribute VALUES (2,2);
INSERT INTO category_attribute VALUES (3,2);
INSERT INTO category_attribute VALUES (4,3);
INSERT INTO category_attribute VALUES (4,4);
INSERT INTO category_attribute VALUES (5,5);
INSERT INTO category_attribute VALUES (6,6);
INSERT INTO category_attribute VALUES (7,7);
INSERT INTO category_attribute VALUES (4,8);
INSERT INTO category_attribute VALUES (8,9);
INSERT INTO category_attribute VALUES (9,10);

--FAVORITE
INSERT INTO favorite VALUES ('xavi123','901896832');
INSERT INTO favorite VALUES ('xavi123','186596482');

--PURCHASE

INSERT INTO purchase VALUES (16,'xavi123', '2012-05-16 12:36:38', 899.02,'Credit');

SELECT setval(pg_get_serial_sequence('purchase', 'id'), 17) FROM purchase;

--PURCHASE_PRODUCT
INSERT INTO purchase_product VALUES (16,'278925974', 899.02, 2);
INSERT INTO purchase_product VALUES (16,'914510007', 899.02, 1);
INSERT INTO purchase_product VALUES (16,'083108184', 899.02, 4);

--RATING
INSERT INTO rating VALUES ('xavi123','901896832', 5);
INSERT INTO rating VALUES ('antonio','672442768', 1);

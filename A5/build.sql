-- Tables
 
CREATE TABLE user_ (
    username text NOT NULL,
    "password" text NOT NULL,
    email text UNIQUE NOT NULL,
    joinDate DATE NOT NULL,
    picture text
);
 
CREATE TABLE customer (
    username_user text NOT NULL,
    "name" text NOT NULL,
    "address" text,
    loyaltyPoints INTEGER,
    newsletter INTEGER NOT NULL,
    inactive INTEGER NOT NULL,
    CONSTRAINT lp_positive CHECK ((loyaltyPoints > 0))
);

CREATE TABLE moderator (
    username_user text NOT NULL
);

CREATE TABLE administrator (
    username_user text NOT NULL
);

CREATE TABLE banned (
    username_customer text NOT NULL,
    bannedDate DATE NOT NULL,
    username_moderator text NOT NULL
);

CREATE TABLE comment (
    id INTEGER,
    username_customer text NOT NULL,
    "date" DATE NOT NULL,
    commentary text NOT NULL,
    flagsNo INTEGER NOT NULL
);

CREATE TABLE answer (
    idParent INTEGER NOT NULL,
    idChild INTEGER NOT NULL
);

CREATE TABLE flagged (
    idComment INTEGER NOT NULL,
    "hidden" INTEGER NOT NULL
);

CREATE TABLE category (
    id INTEGER PRIMARY KEY,
    "name" text NOT NULL,
);

CREATE TABLE product (
    sku INTEGER PRIMARY KEY,
    title text NOT NULL,
    idCat INTEGER NOT NULL,
    price REAL NOT NULL,
    discountPrice REAL NOT NULL,
    rating REAL NOT NULL,
    stock INTEGER NOT NULL,

    CONSTRAINT price_positive CHECK (price > 0),
    CONSTRAINT discount_positive CHECK (discountPrice > 0)
);

CREATE TABLE attribute (
    id INTEGER PRIMARY KEY,
    "name" text NOT NULL,
);

CREATE TABLE attribute_product (
    idAttribute INTEGER NOT NULL,
    refProduct INTEGER NOT NULL,
    "value" text NOT NULL,
);

CREATE TABLE category_attribute (
    idAttribute INTEGER NOT NULL,
    idCATEGORY INTEGER NOT NULL
);

CREATE TABLE favorite (
    username_customer text NOT NULL,
    refProduct INTEGER NOT NULL
);

-- TODO: define PaymentMethod

CREATE TABLE purchase (
    id INTEGER PRIMARY KEY,
    username text NOT NULL,
    "date" DATE NOT NULL,
    "value" REAL NOT NULL,
    method PaymentMethod NOT NULL
);

CREATE TABLE purchase_product (
    idPurchase INTEGER NOT NULL,
    price REAL NOT NULL,
    quantity INTEGER NOT NULL,

    CONSTRAINT quantity_positive CHECK (quantity > 0)
);

-- TODO: define domain rating

CREATE TABLE rating (
    username_customer text NOT NULL,
    refProduct INTEGER NOT NULL,
    "value" Rating NOT NULL,
    PRIMARY KEY(username_customer, refProduct)
);

-- TODO: define domain TODAY


-- -- Primary Keys and Uniques
 
-- ALTER TABLE ONLY user
--     ADD CONSTRAINT author_pkey PRIMARY KEY (id);
 
-- ALTER TABLE ONLY author_work
--     ADD CONSTRAINT author_work_pkey PRIMARY KEY (id_author, id_work);
 
-- ALTER TABLE ONLY book
--     ADD CONSTRAINT book_isbn_key UNIQUE (isbn);
 
-- ALTER TABLE ONLY book
--     ADD CONSTRAINT book_pkey PRIMARY KEY (id_work);
 
-- ALTER TABLE ONLY collection
--     ADD CONSTRAINT collection_pkey PRIMARY KEY (id);
 
-- ALTER TABLE ONLY item
--     ADD CONSTRAINT item_pkey PRIMARY KEY (id);
 
-- ALTER TABLE ONLY loan
--     ADD CONSTRAINT loan_pkey PRIMARY KEY (id);
 
-- ALTER TABLE ONLY location
--     ADD CONSTRAINT location_pkey PRIMARY KEY (id);
 
-- ALTER TABLE ONLY nonbook
--     ADD CONSTRAINT nonbook_pkey PRIMARY KEY (id_work);
 
-- ALTER TABLE ONLY publisher
--     ADD CONSTRAINT publisher_pkey PRIMARY KEY (id);
 
-- ALTER TABLE ONLY review
--     ADD CONSTRAINT review_pkey PRIMARY KEY (id_user, id_work);
 
-- ALTER TABLE ONLY "user"
--     ADD CONSTRAINT user_email_key UNIQUE (email);
 
-- ALTER TABLE ONLY "user"
--     ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 
-- ALTER TABLE ONLY wish_list
--     ADD CONSTRAINT wish_list_pkey PRIMARY KEY (id_user, id_work);
 
-- ALTER TABLE ONLY WORK
--     ADD CONSTRAINT work_pkey PRIMARY KEY (id);
 
--     -- Foreign Keys
 
-- ALTER TABLE ONLY author_work
--     ADD CONSTRAINT author_work_id_author_fkey FOREIGN KEY (id_author) REFERENCES author(id) ON UPDATE CASCADE;
 
-- ALTER TABLE ONLY author_work
--     ADD CONSTRAINT author_work_id_work_fkey FOREIGN KEY (id_work) REFERENCES WORK(id) ON UPDATE CASCADE;
 
-- ALTER TABLE ONLY book
--     ADD CONSTRAINT book_id_publisher_fkey FOREIGN KEY (id_publisher) REFERENCES publisher(id) ON UPDATE CASCADE;
 
-- ALTER TABLE ONLY book
--     ADD CONSTRAINT book_id_work_fkey FOREIGN KEY (id_work) REFERENCES WORK(id) ON UPDATE CASCADE;
 
-- ALTER TABLE ONLY review
--     ADD CONSTRAINT review_id_user_fkey FOREIGN KEY (id_user) REFERENCES "user"(id) ON UPDATE CASCADE;
 
-- ALTER TABLE ONLY review
--     ADD CONSTRAINT review_id_work_fkey FOREIGN KEY (id_work) REFERENCES WORK(id) ON UPDATE CASCADE;
 
-- ALTER TABLE ONLY item
--     ADD CONSTRAINT item_id_location_fkey FOREIGN KEY (id_location) REFERENCES location(id) ON UPDATE CASCADE;
 
-- ALTER TABLE ONLY item
--     ADD CONSTRAINT item_id_work_fkey FOREIGN KEY (id_work) REFERENCES WORK(id) ON UPDATE CASCADE;
 
-- ALTER TABLE ONLY loan
--     ADD CONSTRAINT loan_id_item_fkey FOREIGN KEY (id_item) REFERENCES item(id) ON UPDATE CASCADE;
 
-- ALTER TABLE ONLY loan
--     ADD CONSTRAINT loan_id_user_fkey FOREIGN KEY (id_user) REFERENCES "user"(id) ON UPDATE CASCADE;
 
-- ALTER TABLE ONLY nonbook
--     ADD CONSTRAINT nonbook_id_work_fkey FOREIGN KEY (id_work) REFERENCES WORK(id) ON UPDATE CASCADE ON DELETE CASCADE;
 
-- ALTER TABLE ONLY wish_list
--     ADD CONSTRAINT wish_list_id_user_fkey FOREIGN KEY (id_user) REFERENCES "user"(id) ON UPDATE CASCADE;
 
-- ALTER TABLE ONLY wish_list
--     ADD CONSTRAINT wish_list_id_work_fkey FOREIGN KEY (id_work) REFERENCES WORK(id) ON UPDATE CASCADE;
 
-- ALTER TABLE ONLY WORK
--     ADD CONSTRAINT work_id_collection_fkey FOREIGN KEY (id_collection) REFERENCES collection(id) ON UPDATE CASCADE;
 
-- ALTER TABLE ONLY WORK
--     ADD CONSTRAINT work_id_user_fkey FOREIGN KEY (id_user) REFERENCES "user"(id) ON UPDATE CASCADE;
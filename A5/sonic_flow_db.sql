-- Tables


CREATE TABLE "user" (
    username text PRIMARY KEY,
    "password" text NOT NULL,
    email text UNIQUE NOT NULL,
    joinDate TIMESTAMP DEFAULT now() NOT NULL,
    picture text
);
 
CREATE TABLE customer (
    username_user text NOT NULL 
        REFERENCES "user" ON DELETE CASCADE,
    "name" text NOT NULL,
    "address" text,
    loyaltyPoints INTEGER NOT NULL DEFAULT 0,
    newsletter INTEGER NOT NULL,
    inactive INTEGER NOT NULL,

    CONSTRAINT lp_positive CHECK ((loyaltyPoints >= 0)),
);

-- ALTER TABLE ONLY customer
    -- ADD CONSTRAINT customer_fk FOREIGN KEY(username_user) REFERENCES "user"(username) ON DELETE CASCADE;

CREATE TABLE moderator (
    username_user text NOT NULL REFERENCES "user" ON DELETE CASCADE
);

CREATE TABLE administrator (
    username_user text NOT NULL REFERENCES "user" ON DELETE CASCADE
);

CREATE TABLE banned (
    username_customer text PRIMARY KEY REFERENCES customer ON DELETE CASCADE,
    bannedDate DATE NOT NULL, --this has to be with triggers
    username_moderator text NOT NULL REFERENCES moderator ON DELETE CASCADE,
);

CREATE TABLE comment (
    id SERIAL PRIMARY KEY,
    username_customer text NOT NULL REFERENCES moderator ON DELETE CASCADE,
    "date" DATE NOT NULL, --this has to be with triggers
    commentary text NOT NULL,
    flagsNo INTEGER NOT NULL
);

CREATE TABLE answer (
    idParent INTEGER NOT NULL REFERENCES comment ON DELETE CASCADE,
    idChild INTEGER NOT NULL REFERENCES comment ON DELETE CASCADE
);

CREATE TABLE flagged (
    idComment INTEGER NOT NULL REFERENCES comment ON DELETE CASCADE,
    "hidden" INTEGER NOT NULL,
);

CREATE TABLE category (
    id SERIAL PRIMARY KEY,
    "name" text NOT NULL,
);

CREATE TABLE product (
    sku INTEGER PRIMARY KEY,
    title text NOT NULL,
    idCat INTEGER NOT NULL REFERENCES category ON DELETE CASCADE,
    price REAL NOT NULL,
    discountPrice REAL,
    rating REAL NOT NULL,
    stock INTEGER NOT NULL,

    CONSTRAINT price_positive CHECK (price > 0),
    CONSTRAINT discount_positive CHECK (discountPrice is NULL or discountPrice > 0),
    CONSTRAINT stock_positive CHECK(stock >= 0),
    CONSTRAINT rating_positive CHECK(rating >= 0)
);

CREATE TABLE attribute (
    id SERIAL PRIMARY KEY,
    "name" text NOT NULL,
);

CREATE TABLE attribute_product (
    idAttribute INTEGER NOT NULL REFERENCES attribute ON DELETE CASCADE,
    refProduct INTEGER NOT NULL REFERENCES product ON DELETE CASCADE,
    "value" text NOT NULL,
);

CREATE TABLE category_attribute (
    idAttribute INTEGER NOT NULL REFERENCES attribute ON DELETE CASCADE,
    idCategory INTEGER NOT NULL REFERENCES category ON DELETE CASCADE,

    UNIQUE(idAttribute, idCategory)
);

CREATE TABLE favorite (
    username_customer text NOT NULL REFERENCES customer ON DELETE CASCADE,
    refProduct INTEGER NOT NULL REFERENCES product ON DELETE CASCADE,

    UNIQUE(username_customer, refProduct)
);

-- TODO: define PaymentMethod

CREATE TABLE purchase (
    id SERIAL PRIMARY KEY,
    username text NOT NULL REFERENCES customer ON DELETE CASCADE,
    "date" DATE NOT NULL, -- trigger
    "value" REAL NOT NULL,
    method text NOT NULL,

    CONSTRAINT value_positive CHECK ("value" > 0),
    --CONSTRAINT method_check CHECK ((method = ANY ( ARRAY['Credit'::text , 'Debit'::text , 'Paypal'::text ]))),
    CONSTRAINT method_check CHECK (method in ('Credit', 'Debit' , 'Paypal' ))
);

CREATE TABLE purchase_product (
    idPurchase INTEGER NOT NULL REFERENCES purchase ON DELETE CASCADE,
    idProduct INTEGER NOT NULL REFERENCES product ON DELETE CASCADE,
    price REAL NOT NULL,
    quantity INTEGER NOT NULL,

    CONSTRAINT quantity_positive CHECK (quantity > 0),
    CONSTRAINT price_positive CHECK (price > 0),

    UNIQUE(idPurchase, idProduct)
);

-- TODO: define domain rating

CREATE TABLE rating (
    username_customer text NOT NULL,
    refProduct INTEGER NOT NULL,
    "value" INTEGER NOT NULL CHECK (("value" > 0 ) AND ("value" <= 5)),
    PRIMARY KEY(username_customer, refProduct)
);

-- TODO: define domain TODAY
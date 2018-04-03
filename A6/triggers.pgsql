-- 1 user can only be banned after joining

CREATE OR REPLACE FUNCTION check_banned_date() RETURNS trigger AS $check_banned_date$
    BEGIN

        IF EXISTS (
            SELECT U.joinDate FROM "user" U  WHERE U.username = NEW.username_customer AND U.joinDate > NEW.bannedDate;
        ) 
        THEN RAISE EXCEPTION '% cannot be banned before joining', NEW.username_customer;
        END IF;
        
        RETURN NEW;
    END;
$check_banned_date$ LANGUAGE plpgsql;

CREATE  TRIGGER check_banned_date BEFORE INSERT OR UPDATE ON banned
    FOR EACH ROW EXECUTE PROCEDURE check_banned_date();


--2 date of comment answer must be later than parent comment

CREATE OR REPLACE FUNCTION check_answer_date() RETURNS trigger AS $check_answer_date$
    BEGIN

        IF EXISTS (
            SELECT C1.id, C2.id FROM comment C1, comment C2  
            WHERE 
                C1.id < C2.id 
                AND
                C1.id = NEW.idParent
                AND 
                C2.id = NEW.idChild
                AND 
                C1."date" > C2."date";
        ) 
        THEN RAISE EXCEPTION 'Must comment on an older commentary.';
        END IF;
        
        RETURN NEW;
    END;
$check_answer_date$ LANGUAGE plpgsql;

CREATE TRIGGER check_answer_date BEFORE INSERT OR UPDATE ON answer
    FOR EACH ROW EXECUTE PROCEDURE check_answer_date();


-- 3 update the rating of a product

CREATE OR REPLACE FUNCTION update_product_rating() RETURNS trigger AS $update_product_rating$
    BEGIN

        UPDATE product SET rating = (
            SELECT AVG("value") FROM rating R WHERE R.refProduct = NEW.refProduct 
        )
        WHERE id = NEW.refProduct;
        
        RETURN NEW;
    END;
$update_product_rating$ LANGUAGE plpgsql;


CREATE TRIGGER update_product_rating AFTER INSERT OR UPDATE ON rating
    FOR EACH ROW EXECUTE PROCEDURE update_product_rating();

-- 4 discount price on a product

CREATE OR REPLACE FUNCTION constraint_product_discount() RETURNS trigger AS $constraint_product_discount$
    BEGIN
        IF NEW.discountPrice > NEW.price THEN
        RAISE EXCEPTION 'Discount price must be lower than price.';
        END IF;
        
        RETURN NEW;
    END;
$constraint_product_discount$ LANGUAGE plpgsql;

CREATE TRIGGER constraint_product_discount BEFORE INSERT OR UPDATE ON product
    FOR EACH ROW EXECUTE PROCEDURE constraint_product_discount();

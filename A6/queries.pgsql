--PRODUCT QUICK VIEWS
SELECT product.title,
        product.idCat,
        product.category,
        product.price,
        product.discountPrice,
  FROM product, category
  WHERE discountPrice != NULL AND product.idCat = category.id;

SELECT product.title,
        category."name",
        product.price,
        product.discountPrice,
  FROM product, category
  WHERE Product.idCat = $cat AND category.id = $cat;

SELECT product.title,
        category."name",
        product.price,
        product.discountPrice,
  FROM product, category
  WHERE product.title LIKE %$name% and category.id = product.idCat;

SELECT product.title,
        category."name",
        product.price,
        product.discountPrice,
  FROM "user" JOIN favorite ON username, product, category
  WHERE favorite.refProduct = product.sku AND category.id = product.idCat;

--PRODUCT PAGE
SELECT product.sku,
        product.title,
        category."name",
        product.price,
        product.discountPrice,
        product.rating,
        attribute."name",
        attribute_product."value",
  FROM product, attribute_product, category_attribute, attribute, category
  WHERE product.idCat = category.id
   AND category_attribute.idCategory = product.idCat
   AND category_attribute.idAttribute = attribute_product.idAttribute
   AND attribute_product.refProduct = product.sku;

--CUSTOMER PROFILE SELECT
SELECT "name","address",loyaltyPoints,email,username,picture
  FROM "user" JOIN customer ON username;

--:::::::::::::::INSERTS::::::::::::
--insert new answer or comment
INSERT INTO comment(username,commentary)
  VALUES ($username,$commentary);
INSERT INTO answer(idParent)
  VALUES (idParent);

--add product to favorites
INSERT INTO favorites(username,refProduct)
  VALUES ($username,$refproduct);

--product purchase
INSERT INTO purchase
  VALUES(DEFAULT,$username,now(),$cost,$method)
INSERT INTO purchase_product(idPurchase ,idProduct, price, quantity)
  VALUES($idPurchase,$idProduct,$price,$quantity);

--rate a product
INSERT INTO rating
  VALUES($username,$refProduct,$value);

--new user
INSERT INTO "user"
  VALUES($username, $password, $email, DEFAULT, $picture);
INSERT INTO customer
  VALUES($username, $name, $address, $loyaltyPoints, $newsletter, $inactive);
--OR
INSERT INTO moderator
  VALUES($username);
--OR
INSERT INTO administrator
  VALUES($username);

--::::::::::::::::::::UPDATES:::::::::::::::
--update profile info
UPDATE "user"
  SET "password" = $password,
        email = $email,
        picture = $picture
  WHERE username = $username;
UPDATE customer
  SET name = $name,
        address = $address,
        loyaltyPoints = $loyaltyPoints,
        newsletter = $newsletter,
        inactive = $inactive
  WHERE username = $username;

--update product rating
UPDATE rating
  SET "value" = $value
  WHERE username = $username AND refProduct = $refProduct;

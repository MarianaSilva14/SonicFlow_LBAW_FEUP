--PRODUCT QUICK VIEWS
SELECT product.title,
        product.idCat,
        product.category,
        product.price,
        product.discountPrice,
  FROM product
  WHERE discountPrice != NULL;

SELECT product.title,
        category."name",
        product.price,
        product.discountPrice,
  FROM Product
  WHERE Product.idCat == $cat;

SELECT product.title,
        category."name",
        product.price,
        product.discountPrice,
  FROM Product,
  WHERE Product.title LIKE %$name%

SELECT product.title,
        category."name",
        product.price,
        product.discountPrice,
  FROM "user" JOIN favorite ON username, product
  WHERE favorite.refProduct = product.sku;

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
   AND attribute_product.refProduct = product.sku

--CUSTOMER PROFILE
SELECT "name","address",loyaltyPoints,email,username,picture
  FROM "user" JOIN customer ON username

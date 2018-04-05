-- varias tabelas que dêm search pelo idCat
DROP INDEX IF EXISTS discounted_product;
CREATE INDEX discounted_product ON product USING hash(idCat);

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
CREATE INDEX customer_purchases ON purchase USING hash(username);




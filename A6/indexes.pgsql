-- varias tabelas que dêm search pelo idCat
CREATE INDEX discounted_product ON product USING hash(idCat);

-- mais lento e com maior tamanho que GiST mas não é lossy
CREATE INDEX search_product ON product USING GIN (to_tsvector('english', title));

-- para mostrar apenas comentarios mais recentes por exemplo
CREATE INDEX comments_range ON comment USING btree("date");

-- para mostrar compras de um cliente
CREATE INDEX customer_purchases ON purchase USING hash(username);




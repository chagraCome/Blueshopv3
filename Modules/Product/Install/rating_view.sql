
CREATE VIEW product_rating_view AS SELECT AVG(rate) as rate, count(*) as rate_count, entity_id FROM entity_rating where entity_class = 'Product_Product_Model' GROUP By entity_id
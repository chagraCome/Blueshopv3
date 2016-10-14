-- SALES ORDER BY QUOTE (Stock DEPENDS)
-- DROP VIEW IF NOT EXISTS product_sale_most;
-- CREATE VIEW product_sale_most AS 
 SELECT 
    product.id, 
    SUM(sale_order_item.quantity) as sale_quantity,  
    ((SUM(sale_order_item.quantity))+product.quantity) as initialquantity, 
    (SUM(1)/((SUM(1))+product.quantity))*100 as quote, 
    product.quantity, 
    product.insertat, 
    product.updateat, 
    sale_order.insertat as sale_date_time FROM product
 LEFT JOIN sale_order_item ON product.id = sale_order_item.item_id
 LEFT JOIN sale_order ON sale_order_item.sale_order_id = sale_order.id
 WHERE sale_order_item.item_id IS NOT NULL
 GROUP BY product.id

-- ALL PRODUCTS SALES PER DATE AND PER PRICE
-- SELECT item_id, date(sale_order.insertat), SUM(sale_order_item.quantity) as verkauf, sale_order_item.unit_price
-- FROM sale_order_item
-- LEFT JOIN sale_order ON sale_order.id = sale_order_item.sale_order_id
-- WHERE sale_order_item.item_id IS NOT NULL
-- GROUP BY sale_order_item.unit_price, date(sale_order.insertat)


-- SALES PER STOCK DURATION
-- SELECT  product.id, product.quantity as rest_quantity, SUM(sale_order_item.quantity) as sales, DATEDIFF(NOW(), product.insertat) as duration,
-- SUM(sale_order_item.quantity)/DATEDIFF(NOW(), product.insertat)  as sale_per_duration
-- FROM product 
-- LEFT JOIN sale_order_item ON sale_order_item.item_id = product.id
-- WHERE product.insertat IS NOT NULL AND sale_order_item.item_id IS NOT NULL
-- GROUP BY product.id

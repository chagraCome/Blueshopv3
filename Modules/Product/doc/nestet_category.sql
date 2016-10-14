# SELECT all categories by parent id
SELECT node.*
FROM product_category AS node,
product_category AS parent
WHERE node.previous BETWEEN parent.previous AND parent.next
AND parent.id = 1
ORDER BY node.previous;

# select depth of all nodes
SELECT node.*, (COUNT(1) - 1) AS depth
FROM product_category AS node,
product_category AS parent
WHERE node.previous BETWEEN parent.previous AND parent.next
GROUP BY node.id
ORDER BY node.previous

# select top cateogies (depth==0)
SELECT node.*, (COUNT(1) - 1) AS depth
FROM product_category AS node,
product_category AS parent
WHERE node.previous BETWEEN parent.previous AND parent.next
GROUP BY node.id
HAVING depth = 0

# get path by giving node id 
SELECT parent.*
FROM product_category AS node,
product_category AS parent
WHERE node.previous BETWEEN parent.previous AND parent.next
AND node.id= 10
ORDER BY parent.previous;

# find all leaf
SELECT *
FROM product_category
WHERE next = previous + 1;

# select all drawing
SELECT CONCAT( REPEAT(' ', COUNT(parent.name) - 1), node.name) AS name
FROM product_category AS node,
product_category AS parent
WHERE node.previous BETWEEN parent.previous AND parent.next
GROUP BY node.name
ORDER BY node.previous;


# select products in a categoriy
SELECT parent.name, COUNT(product.name)
FROM product_category AS node ,
product_category AS parent,
product
WHERE node.previous BETWEEN parent.previous AND parent.next
AND node.category_id = product.category_id
GROUP BY parent.name
ORDER BY node.previous;




# insert category after cateogiry_id = 3
LOCK TABLE product_category WRITE;
SELECT @myRight := next FROM product_category
WHERE id = 3;

UPDATE product_category SET next = next + 2 WHERE next > @myRight;
UPDATE product_category SET previous = previous + 2 WHERE previous > @myRight;

INSERT INTO product_category(name, previous, next) VALUES('GAME CONSOLES', @myRight + 1, @myRight + 2);

UNLOCK TABLES;


# add new top category
SELECT @mright := IF(max(next),  max(next), 1) FROM `product_category` WHERE 1
INSERT INTO product_category VALUES (NULL, 'TEST3', '', 0, @mright+1, @mright+2);



# add subcateogry in top id
LOCK TABLE product_category WRITE;
SELECT @myLeft := previous FROM product_category
WHERE id = 1;

UPDATE product_category SET next = next + 2 WHERE next > @myLeft;
UPDATE product_category SET previous = previous + 2 WHERE previous > @myLeft;

INSERT INTO product_category VALUES (NULL, 'TEST3', '', 0, @myLeft+1, @myLeft+2);
UNLOCK TABLES;


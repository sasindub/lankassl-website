-- Adds price columns to an existing Lanka SSL orders database (run once).
ALTER TABLE orders      ADD COLUMN subtotal   DECIMAL(12,2) NULL COMMENT 'Total of priced items (LKR); NULL when nothing is priced' AFTER item_count;
ALTER TABLE order_items ADD COLUMN unit_price DECIMAL(12,2) NULL COMMENT 'LKR at time of order; NULL = price on confirmation' AFTER quantity;
ALTER TABLE order_items ADD COLUMN line_total DECIMAL(12,2) NULL AFTER unit_price;

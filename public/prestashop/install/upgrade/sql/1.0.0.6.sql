/* STRUCTURE */
SET NAMES 'utf8';

ALTER TABLE PREFIX_order_detail
	CHANGE product_price product_price DECIMAL(13, 6) NOT NULL DEFAULT '0.000000';


/*  CONTENTS */

/* CONFIGURATION VARIABLE */


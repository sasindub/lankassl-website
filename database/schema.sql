-- Lanka SSL — online ordering schema (MySQL / MariaDB, utf8mb4)

CREATE TABLE IF NOT EXISTS admins (
	id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username      VARCHAR(60)  NOT NULL UNIQUE,
	name          VARCHAR(120) NOT NULL DEFAULT '',
	password_hash VARCHAR(255) NOT NULL,
	last_login_at DATETIME     NULL,
	created_at    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS orders (
	id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	order_no       VARCHAR(20)  NOT NULL UNIQUE,
	status         ENUM('pending','confirmed','processing','dispatched','delivered','cancelled') NOT NULL DEFAULT 'pending',
	customer_name  VARCHAR(120) NOT NULL,
	company        VARCHAR(160) NOT NULL DEFAULT '',
	email          VARCHAR(160) NOT NULL,
	phone          VARCHAR(30)  NOT NULL,
	address_line1  VARCHAR(200) NOT NULL,
	address_line2  VARCHAR(200) NOT NULL DEFAULT '',
	city           VARCHAR(100) NOT NULL,
	district       VARCHAR(60)  NOT NULL,
	postal_code    VARCHAR(12)  NOT NULL DEFAULT '',
	notes          TEXT         NULL,
	item_count     INT UNSIGNED NOT NULL DEFAULT 0,
	subtotal       DECIMAL(12,2) NULL COMMENT 'Total of priced items (LKR); NULL when nothing is priced',
	ip_address     VARCHAR(45)  NOT NULL DEFAULT '',
	created_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	INDEX idx_status (status),
	INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS order_items (
	id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	order_id     INT UNSIGNED NOT NULL,
	product_slug VARCHAR(80)  NOT NULL,
	product_name VARCHAR(160) NOT NULL,
	variant      VARCHAR(160) NOT NULL DEFAULT '',
	unit         VARCHAR(30)  NOT NULL DEFAULT '',
	quantity     INT UNSIGNED NOT NULL,
	unit_price   DECIMAL(12,2) NULL COMMENT 'LKR at time of order; NULL = price on confirmation',
	line_total   DECIMAL(12,2) NULL,
	CONSTRAINT fk_items_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
	INDEX idx_order (order_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS order_status_history (
	id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	order_id   INT UNSIGNED NOT NULL,
	status     VARCHAR(20)  NOT NULL,
	note       VARCHAR(500) NOT NULL DEFAULT '',
	admin_id   INT UNSIGNED NULL,
	created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT fk_history_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
	CONSTRAINT fk_history_admin FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE SET NULL,
	INDEX idx_order (order_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

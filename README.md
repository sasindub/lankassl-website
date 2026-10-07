# Lanka Special Steels — Website

Corporate website for Lanka Special Steels Limited (black & gold revamp, 2026).

## Stack
- Plain PHP 8 (no framework), Apache with `mod_rewrite` (`.htaccess` routes everything through `index.php`)
- GSAP + ScrollTrigger, Lenis smooth scroll, GLightbox (loaded from CDN)

## Structure
| Path | Purpose |
| --- | --- |
| `index.php` | Router, redirects for old URLs, maintenance switch |
| `inc/data.php` | **All site content** — products, people, awards, contacts |
| `inc/layout.php` | Shared head, header, footer, icons |
| `pages/` | Page templates |
| `assets/v2/` | New CSS, JS and optimized images |
| `post-and-get/ajax/` | Contact & careers form mail handlers |
| `pages/checkout.php`, `assets/v2/js/cart.js` | Cart and checkout (cart is kept in the browser) |
| `pages/api-order.php`, `inc/orders.php` | `POST /api/order` — validates and saves orders |
| `admin/` | Order management panel (`/admin`) |
| `database/schema.sql` | MySQL schema |

## Online ordering
Customers add products (with size/variant and quantity) to a cart, then place an order with contact and delivery details.
Orders are **requests** — no prices or payment online; the sales team confirms pricing and updates the status in the admin panel
(pending → confirmed → processing → dispatched → delivered, or cancelled).

### Database setup
1. Start MySQL in XAMPP and create the database and schema:
   ```
   mysql -u root -e "CREATE DATABASE lankassl CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
   mysql -u root lankassl < database/schema.sql
   ```
2. Copy `inc/db-config.example.php` to `inc/db-config.php` and add the credentials.
3. Create an admin: `php tools/create-admin.php <username> "Display Name"` (prints a generated password).

## Run locally (XAMPP)
1. Symlink or copy the project into `htdocs`, start Apache.
2. Copy `class/mail-config.example.php` to `class/mail-config.php` and add SMTP credentials.
3. Open `http://localhost/<folder>/`.

On non-localhost hosts `index.php` currently shows the under-construction page — remove the maintenance block to go live.

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

## Run locally (XAMPP)
1. Symlink or copy the project into `htdocs`, start Apache.
2. Copy `class/mail-config.example.php` to `class/mail-config.php` and add SMTP credentials.
3. Open `http://localhost/<folder>/`.

On non-localhost hosts `index.php` currently shows the under-construction page — remove the maintenance block to go live.

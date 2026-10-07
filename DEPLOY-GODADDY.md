# Deploying to GoDaddy (cPanel hosting)

Build the package first, on your computer:

```
python3 tools/build-deploy.py
```

This creates `deploy/` with `lankassl-site.zip`, `database.sql` and `ADMIN-LOGIN.txt`.

**Requirements:** a GoDaddy *Web Hosting (cPanel)* plan, with PHP 8.1 or newer and MySQL.
A "Websites + Marketing" (website builder) plan cannot run this site.

## 1. Check the PHP version
cPanel → **Select PHP Version** (or **MultiPHP Manager**) → choose **PHP 8.1** or newer for the domain.

## 2. Create the database
cPanel → **MySQL® Databases**:
1. Create a database, e.g. `lankassl` (cPanel adds a prefix, giving something like `abc123_lankassl`).
2. Create a user with a strong password.
3. **Add the user to the database** and tick **ALL PRIVILEGES**.

cPanel → **phpMyAdmin** → select the new database → **Import** → choose `deploy/database.sql` → **Go**.

## 3. Upload the website
cPanel → **File Manager** → open the domain's folder (usually `public_html`):
1. Back up anything already there first (select all → **Compress** → download the zip).
2. **Upload** `lankassl-site.zip`, then right-click → **Extract**.
3. Turn on **Settings → Show Hidden Files** and check that `.htaccess` is present.

## 4. Connect the database
In File Manager, edit `inc/db-config.php` and replace the three `CHANGE_ME` values with the database
name, user and password from step 2. Keep `'host' => 'localhost'`.

## 5. Check
- Visit the domain → the new website appears.
- Visit `/admin/` → sign in with the details in `deploy/ADMIN-LOGIN.txt`.
- Place a small test order and confirm it shows in the admin panel. Then cancel it.

To show the "under construction" page instead, create an empty file named `MAINTENANCE` in the site
folder; delete it to go live again.

## About the domain and DNS
The website only appears on the domain if the domain's **A record** (`@` and `www`) points to this
hosting account's IP address (shown in cPanel → **General Information** → *Shared IP Address*).

- If it already points there, nothing needs to change.
- If it doesn't, the **A records for `@` and `www` are the only records that need to change**.
  Email works through the **MX**, **TXT** (SPF/DKIM/verification) and email **CNAME** records. Those
  must be left exactly as they are, and changing the website's A record does not affect them.
- Do **not** change the domain's **nameservers** — that would replace every DNS record, including email.

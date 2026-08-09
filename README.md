# Portofolio IT — Syahril Akbar

Portofolio pribadi berbasis **Laravel 11 + Filament 5** dengan panel admin lengkap untuk mengelola CV, proyek, sertifikasi, pengalaman, pendidikan, skill, training, bahasa, dan penghargaan. Termasuk backend untuk **CV download (PDF)** via dompdf.

---

## ✨ Fitur

- 🌐 **Frontend publik** — landing page responsif (hero, about, experience, projects, skills, certifications, education, langs, achievements)
- 🎨 **Admin panel Filament 5** di `/admin` — CRUD lengkap:
  - Profil, Projek (gallery + tech stack tags), Sertifikasi, Pengalaman, Pendidikan, Skills, Training, Bahasa, Penghargaan
  - Rich text editor untuk deskripsi
  - Upload gambar (thumbnail proyek, sertifikat, dll.)
  - Ganti password/email sendiri via menu avatar → **Profile** (`/admin/profile`)
- 📄 **Download CV (PDF)** — route `/download-cv` (dompdf)
- ⚡ **Live Preview Online** via ngrok (tunnel satu-klik)

---

## Teknologi

| Layer | Stack |
|---|---|
| Backend | PHP 8.4, Laravel 11.55, Filament 5.x |
| Database | SQLite (`database/database.sqlite`) / MySQL |
| Frontend | Blade + Tailwind CSS v4 (compiled via Vite) |
| PDF | barryvdh/laravel-dompdf |
| Deploy | php artisan serve / Herd nginx / Railway (Dockerfile ada) |

---

## Struktur Project

```
portofolio/
├── app/
│   ├── Models/                 # Eloquent models (Project, Profile, Certification…)
│   ├── Filament/               # Filament 5 resources & schemas
│   │   └── Resources/Projects/ # Contoh resource proyek (form + table)
│   ├── Http/Controllers/Frontend/
│   └── Providers/Filament/AdminPanelProvider.php   # Panel config
├── database/
│   ├── migrations/             # Semua skema DB
│   └── database.sqlite         # SQLite DB (gitignored)
├── resources/views/            # Blade templates (frontend, resume)
├── public/                     # Assets, build/, storage images
├── routes/web.php
├── composer.json
└── package.json
```

---

## Setup Lokal (Windows / Herd)

### 1. Prasyarat

- **PHP ≥ 8.4** (gunakan Herd: `C:\Users\<you>\.config\herd\bin\php84\php.exe` atau PATH)
- **Composer** (`composer.phar` dari Herd: `C:\Users\<you>\.config\herd\bin\composer.phar`)
- **Node.js / npm** (untuk Vite build, opsional — sudah ada `public/build`)
- **ngrok** (opsional, untuk akses online)

### 2. Install dependencies
```bash
composer install
npm install && npm run build   # hanya jika ubah CSS/JS
```

### 3. Konfigurasi environment
```bash
cp .env.example .env
php artisan key:generate
php artisan migrate --seed   # jalankan migration + seeder
```

`.env` utama:
```
APP_NAME="Portofolio IT"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database/database.sqlite

SESSION_DRIVER=database
CACHE_DRIVER=database
QUEUE_CONNECTION=database
```

> Untuk SQLite: buat file `database/database.sqlite` dulu (`touch database/database.sqlite`),
> lalu set `DB_CONNECTION=sqlite` di `.env`.

### 4. Jalankan dev server
```bash
php artisan serve
# → http://127.0.0.1:8000
```

### 5. Admin panel
Buka http://127.0.0.1:8000/admin

Login default (seeder):
- **Email:** `admin@portofolio.test`
- **Password:** `admin123`

> ⚠️ Ganti segera! Ubah dari menu avatar → **Profile** → tab Password.

### 6. (Opsional) Akses online via ngrok
```bash
# Terminal 1: jalankan server
php artisan serve --port=8080

# Terminal 2: tunnel
ngrok http 8080 --host-header=localhost:8080
# → https://xxx-xxx.ngrok-free.app

# Update APP_URL di .env dengan URL ngrok, lalu:
php artisan config:clear
```

---

## Daftar Model / Migrasi

| Resources | Fitur |
|---|---|
| **Profiles** | Bio, foto, social links |
| **Projects** | title, slug, role, description (rich text), tech_stack (JSON), github/demo link, start/end date, image |
| **Certifications** | judul, penerbit, tanggal, file |
| **Experiences** | perusahaan, posisi, details, waktu |
| **Educations** | institusi, jurusan, IPK, periode |
| **Skills** | nama skill |
| **Trainings** | pelatihan + detail |
| **Achievements** | penghargaan + file bukti |
| **Languages** | bahasa + level |

---

## Fitur Teknis Kunci

### Casting `tech_stack` (JSON)
Pastikan `App\Models\Project` punya:
```php
protected $casts = [
    'tech_stack' => 'array',
    'is_published' => 'boolean',
];
```
Tanpa cast ini, menyimpan array ke kolom JSON akan error **"Array to string conversion"**.

### Profile / Edit password
Panel registrasi `EditProfile` di `AdminPanelProvider` (sudah otomatis via `->profile()` di Filament 5):
```php
use Filament\Auth\Pages\EditProfile;

// di pages():
->pages([
    Dashboard::class,
    EditProfile::class,
])
```

### Download CV
Route: `GET /download-cv` → menghasilkan PDF dari view resume via `barryvdh/laravel-dompdf`.
Pastikan `dompdf` diinstall: `composer require barryvdh/laravel-dompdf`.

---

## Deployment

### Option A — Railway / Docker
Sudah tersedia `Dockerfile` + `railway.json`:
```bash
# Railway (CLI)
railway init
railway link
railway up

# atau manual docker
docker build -t portfolio .
docker run -p 8080:80 portfolio
```

### Option B — Deploy di VPS (Ubuntu 22.04 + nginx + PHP 8.4)

1. **Install stack:**
```bash
sudo apt update && sudo apt install -y nginx php8.4 php8.4-cli php8.4-fpm \
  php8.4-mbstring php8.4-xml php8.4-sqlite3 php8.4-gd php8.4-curl \
  unzip git curl
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
```

2. **Pull project & install deps:**
```bash
cd /var/www
git clone <repo-url> portfolio
cd portfolio
composer install --no-dev --optimize-autoloader --prefer-dist
npm install && npm run build   # generate public/build
touch database/database.sqlite
chmod 664 database/database.sqlite
```

3. **Environment & key:**
```bash
cp .env.example .env
php artisan key:generate
# edit .env: set DB_CONNECTION=sqlite, DB_DATABASE=/var/www/portfolio/database/database.sqlite
# APP_URL=https://domain.kamu.com
# APP_ENV=production, APP_DEBUG=false
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

4. **Set permission:**
```bash
sudo chown -R www-data:www-data /var/www/portfolio
sudo chmod -R 775 /var/www/portfolio/storage /var/www/portfolio/bootstrap/cache
```

5. **Buat systemd service (optional) atau gunakan nginx + php-fpm langsung.**

   Jika pakai `php artisan serve` via systemd (`/etc/systemd/system/portfolio.service`):
```ini
[Unit]
Description=Portofolio Laravel
After=network.target

[Service]
User=www-data
Group=www-data
WorkingDirectory=/var/www/portfolio
ExecStart=/usr/bin/php artisan serve --host=127.0.0.1 --port=9001
Restart=always

[Install]
WantedBy=multi-user.target
```
```bash
sudo systemctl enable portfolio && sudo systemctl start portfolio
```

6. **Config nginx** (`/etc/nginx/sites-available/portfolio`):
```nginx
server {
    listen 80;
    server_name domain.kamu.com;
    root /var/www/portfolio/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Laravel Horizon? (optional)
    location /horizon {
        Rewrite ^/horizon/?(.*)$ /index.php?/$1 last;
    }

    # PHP-FPM
    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # static files
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```
Aktifkan & reload:
```bash
sudo ln -s /etc/nginx/sites-available/portfolio /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx
```

7. **SSL (Let's Encrypt):**
```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d domain.kamu.com
```

8. **Supervisor (queue worker, optional):**
```ini
[program:portofolio-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/portfolio/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/portfolio/storage/logs/laravel-worker.log
```
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start portofolio-worker:*
```

### Option C — Deploy pada aaPanel

aaPanel (https://www.aapanel.com) adalah panel Linux berbasis web (mirip cPanel) untuk mengelola nginx, PHP, MySQL, dan site deployment.

#### Langkah 1: Install aaPanel
Di VPS Ubuntu 22.04:
```bash
# Install via official script (CentOS/Ubuntu/Debian)
wget -O install.sh https://www.aapanel.com/script/install_6.0_en.sh && sudo bash install.sh
# Atau versi ID:
# wget -O install.sh https://www.aapanel.com/script/install_6.0_id.sh && sudo bash install.sh
```
Buka `http://<vps-ip>:8888` → catat password login.

#### Langkah 2: Instal software stack via aaPanel
- Buka **App Store** → install:
  - nginx
  - PHP 8.4 (atau terbaru) + extension: mbstring, xml, curl, gd, sqlite3, fileinfo
  - MySQL (opsional)

#### Langkah 3 (jika pakai MySQL):
- Buka **Database** → tambah database (misal: `portofolio`) & user.
- Edit `.env` di server:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portofolio
DB_USERNAME=<user>
DB_PASSWORD=<pass>
```

#### Langkah 4: Buat site project
- Buka **Website** → **Tambah** → pilih domain/subdomain
    - Domain: `portofolio.domainkamu.com`
    - Root directory: `/www/wwwroot/portofolio`
- Setelah dibuat, masuk folder via file manager atau SSH:
```bash
cd /www/wwwroot/portofolio
git clone <repo> .
composer install --no-dev --optimize-autoloader
npm install
npm run build || true   # public/build sudah ada, skip jika tak ubah aset
cp .env.example .env
php artisan key:generate
```

#### Langkah 5: Konfig domain root di aaPanel
- Buka site yang dibuat → **Konfigurasi** → ubah root document ke `/www/wwwroot/portofolio/public`.
- Tambahkan rewrite rule (Laravel):
```text
location / {
  try_files $uri $uri/ /index.php?$query_string;
}
```

#### Langkah 6: PHP konfig
- Buka **App Store → PHP → Setelan** → aktifkan ekstensi: mbstring, pdo, pdo_mysql, curl, gd, fileinfo, zip, sqlite3 (jika pakai sqlite).

#### Langkah 7: Migrate & storage
```bash
cd /www/wwwroot/portofolio
php artisan migrate --force
php artisan storage:link
chmod -R 775 storage bootstrap/cache
sudo chown -R www:www /www/wwwroot/portofolio   # (www = user default aaPanel)
```

#### Langkah 8: SSL otomatis
- Buka site → **SSL** → pakai Let's Encrypt → klik **Memasang** untuk dapatkan cert + HTTPS redirect otomatis.

#### Langkah 9: Queue worker (optional)
- Buka **Crontab** → tambah task:
```bash
*/5 * * * * cd /www/wwwroot/portofolio && php artisan schedule:run >> /dev/null 2>&1
* * * * * cd /www/wwwroot/portofolio && php artisan queue:work --stopwaitforjob 60 >> /dev/null 2>&1
```

#### Troubleshooting aaPanel
| Issue | Fix |
|---|---|
| Permission error (`storage`, `bootstrap/cache`) | `chown -R www:www storage bootstrap/cache`, chmod 775 |
| 500 error — check logs | `tail -f storage/logs/laravel.log` atau aaPanel → Log |
| DB connection refused | Pastikan DB di-create & user benar; pakai `127.0.0.1` bukan `localhost` |
| Asset 404 | Pastikan PHP punya `fileinfo` + rewrite rule `/public/index.php` |
| SSL not work | Pastikan port 80 terbuka & domain resolve — gunakan domain palsu dulu untuk test |


### Option D — Deploy pada VPS via Docker (manual)
Lihat `Dockerfile` + `start.sh` di root project. Build & jalankan:
```bash
docker build -t portofolio .
docker run -d \
  -p 8080:8000 \
  -v $(pwd)/database:/app/database \
  -v $(pwd)/storage:/app/storage \
  portofolio
```

---

## Keamanan
- Admin panel dilindungi session-based auth (Filament default)
- CSRF protection aktif (Livewire)
- Password di-hash (bcrypt)
- Ganti default credentials segera setelah deploy

---

## Troubleshooting umum

| Masalah | Solusi |
|---|---|
| **Array to string conversion** saat create project | Tambah `casts` di `Project` model (lihat atas) |
| `symfony/polyfill-php83` not found | `composer install` ulang |
| Assets 404 / CSS tidak ke-load | `npm install && npm run build`, atau hapus `public/hot` |
| Session/cookie tidak tersimpan via ngrok | `SESSION_DOMAIN` kosongkan; pakai `--host-header` ngrok |
| Migrasi gagal untuk sqlite | Pastikan file `database.sqlite` ada |

---

## Kontribusi & Lisensi
Personal project — untuk keperluan portofolio pribadi. Bebas digunakan sebagai referensi.

---

*Last updated: 9 Agustus 2026*
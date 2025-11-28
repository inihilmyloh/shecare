# 🏥 SheCare Backend API

Backend system untuk SheCare - Platform Diagnosis Kesehatan Kewanitaan menggunakan Decision Tree (ID3 Algorithm).

## 📋 Daftar Isi

- [Fitur](#fitur)
- [Tech Stack](#tech-stack)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Menjalankan Server](#menjalankan-server)
- [API Endpoints](#api-endpoints)
- [Struktur Database](#struktur-database)
- [Decision Tree](#decision-tree)
- [Testing](#testing)

## ✨ Fitur

### User Features
- ✅ **Authentication** - Register, Login dengan JWT
- ✅ **Kuisioner Dinamis** - Pertanyaan dengan skala 1-5
- ✅ **AI Diagnosis** - Decision Tree (ID3) untuk diagnosis otomatis
- ✅ **History** - Riwayat kuisioner dan hasil diagnosis
- ✅ **Health Articles** - Artikel kesehatan real-time
- ✅ **Maps Integration** - Pencarian klinik terdekat

### Admin Features
- ✅ **User Management** - Lihat dan kelola user
- ✅ **CRUD Questions** - Tambah, edit, hapus pertanyaan kuisioner
- ✅ **CRUD Diseases** - Tambah, edit, hapus daftar penyakit
- ✅ **View All History** - Lihat riwayat semua user
- ✅ **Statistics** - Data statistik penyakit

## 🛠️ Tech Stack

- **Runtime**: Node.js v14+
- **Framework**: Express.js
- **Database**: MySQL 8.0+
- **Authentication**: JWT (JSON Web Token)
- **Password Hashing**: bcryptjs
- **Validation**: express-validator
- **Decision Tree**: Python 3.8+ (ID3 Algorithm)
- **External APIs**: 
  - News API (Health Articles)
  - Google Maps API (Nearby Clinics)

## 🚀 Instalasi

### Prerequisites

Pastikan sudah terinstall:
- Node.js (v14 atau lebih tinggi)
- MySQL (v8.0 atau lebih tinggi)
- Python 3.8+ (optional, untuk decision tree)
- npm atau yarn

### Step 1: Clone atau Extract Project

```bash
cd shecare-backend
```

### Step 2: Install Dependencies

```bash
npm install
```

### Step 3: Setup Database

```bash
# Login ke MySQL
mysql -u root -p

# Atau langsung import schema
mysql -u root -p < database/schema.sql
```

Database `shecare_db` akan otomatis dibuat dengan:
- Struktur tabel lengkap
- Admin default (email: admin@shecare.com, password: admin123)
- Sample data (diseases, questions, statistics)

### Step 4: Konfigurasi Environment

```bash
cp .env.example .env
```

Edit file `.env`:

```env
PORT=5000
NODE_ENV=development

DB_HOST=localhost
DB_USER=root
DB_PASSWORD=your_mysql_password
DB_NAME=shecare_db
DB_PORT=3306

JWT_SECRET=your_super_secret_jwt_key_change_this_min_32_characters
JWT_EXPIRE=7d

# API Keys (optional)
NEWS_API_KEY=your_news_api_key
HEALTH_API_KEY=your_health_api_key
GOOGLE_MAPS_API_KEY=your_google_maps_key

CORS_ORIGIN=http://localhost:3000
```

## 🎯 Menjalankan Server

### Development Mode

```bash
npm run dev
```

Server akan berjalan di: `http://localhost:5000`

### Production Mode

```bash
npm start
```

### Health Check

Buka browser dan akses:
```
http://localhost:5000/api/health
```

## 📡 API Endpoints

### Authentication

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| POST | `/api/auth/register` | Register user baru | Public |
| POST | `/api/auth/login` | Login user | Public |
| GET | `/api/auth/me` | Get user profile | Private |
| POST | `/api/auth/logout` | Logout user | Private |

### Questionnaire (User)

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/questions` | Get semua pertanyaan | Public |
| POST | `/api/questionnaire/submit` | Submit jawaban | Private |
| GET | `/api/questionnaire/result/:id` | Lihat hasil diagnosis | Private |
| GET | `/api/questionnaire/history` | History user | Private |

### Admin - User Management

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/admin/users` | List semua user | Admin |
| GET | `/api/admin/users/:id` | Detail user | Admin |
| GET | `/api/admin/history` | All users history | Admin |
| DELETE | `/api/admin/users/:id` | Delete user | Admin |

### Admin - Questions CRUD

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/admin/questions` | List pertanyaan | Admin |
| POST | `/api/admin/questions` | Tambah pertanyaan | Admin |
| PUT | `/api/admin/questions/:id` | Update pertanyaan | Admin |
| DELETE | `/api/admin/questions/:id` | Delete pertanyaan | Admin |

### Admin - Diseases CRUD

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/admin/diseases` | List penyakit | Admin |
| POST | `/api/admin/diseases` | Tambah penyakit | Admin |
| PUT | `/api/admin/diseases/:id` | Update penyakit | Admin |
| DELETE | `/api/admin/diseases/:id` | Delete penyakit | Admin |

### Articles & Maps

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/articles` | Health articles | Public |
| GET | `/api/maps/clinics?lat=&lng=` | Nearby clinics | Public |

### Statistics

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/statistics/diseases` | Disease statistics | Public |
| GET | `/api/statistics/summary` | Summary stats | Public |

## 🗄️ Struktur Database

### Tables

1. **users** - User accounts (admin & regular users)
2. **diseases** - Disease definitions
3. **questions** - Questionnaire questions
4. **question_rules** - Decision tree rules (untuk dinamis)
5. **questionnaire_submissions** - User submissions
6. **questionnaire_answers** - Individual answers
7. **diagnosis_results** - Diagnosis results
8. **disease_statistics** - Statistics untuk homepage

### Default Admin

```
Email: admin@shecare.com
Password: admin123
```

## 🌲 Decision Tree

### Algoritma

Menggunakan **ID3 (Iterative Dichotomiser 3)** algorithm:
- **Entropy** - Mengukur ketidakmurnian data
- **Information Gain** - Memilih fitur terbaik untuk split
- **Rule-based Classification** - Diagnosis berdasarkan aturan

### Struktur Tree

```
Root: Nyeri panggul kronis?
├─ Tidak (<=2)
│  └─ Keputihan abnormal?
│     ├─ Ya (>=3)
│     │  └─ Gatal/Iritasi?
│     │     ├─ Ya (>=3) → Infeksi Jamur
│     │     └─ Tidak (<=2) → Infeksi Bakteri
│     └─ Tidak (<=2) → Normal
└─ Ya (>=3)
   └─ Keputihan abnormal?
      ├─ Tidak (<=2) → Endometriosis
      └─ Ya (>=3) → PID
```

### Confidence Score

- **0.85-1.00**: Very High (Sangat Tinggi)
- **0.70-0.84**: High (Tinggi)
- **0.50-0.69**: Moderate (Sedang)
- **<0.50**: Low (Rendah)

## 🧪 Testing API

### Menggunakan cURL

#### 1. Register User

```bash
curl -X POST http://localhost:5000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Test User",
    "email": "test@example.com",
    "password": "password123",
    "phone": "08123456789"
  }'
```

#### 2. Login

```bash
curl -X POST http://localhost:5000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@example.com",
    "password": "password123"
  }'
```

Copy token dari response.

#### 3. Submit Questionnaire

```bash
curl -X POST http://localhost:5000/api/questionnaire/submit \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "answers": [
      {"question_id": 1, "answer_value": 4},
      {"question_id": 2, "answer_value": 3},
      {"question_id": 3, "answer_value": 2}
    ]
  }'
```

#### 4. Admin - Create Question

```bash
curl -X POST http://localhost:5000/api/admin/questions \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer ADMIN_TOKEN" \
  -d '{
    "question_text": "Apakah Anda mengalami demam?",
    "question_type": "scale",
    "min_value": 1,
    "max_value": 5,
    "order_number": 6,
    "is_active": true
  }'
```

### Menggunakan Postman

1. Import collection dari `docs/postman_collection.json` (jika ada)
2. Set base URL: `http://localhost:5000`
3. Untuk protected routes, tambahkan header:
   ```
   Authorization: Bearer YOUR_JWT_TOKEN
   ```

## 📝 Response Format

### Success Response

```json
{
  "success": true,
  "message": "Success message",
  "data": { ... }
}
```

### Error Response

```json
{
  "success": false,
  "message": "Error message",
  "errors": [ ... ]
}
```

## 🔒 Security

- Passwords di-hash menggunakan bcryptjs (salt rounds: 10)
- JWT tokens untuk authentication
- Protected routes menggunakan middleware
- Role-based access control (user/admin)
- Input validation menggunakan express-validator
- SQL injection prevention (parameterized queries)

## 📊 Monitoring & Logs

Server akan log setiap request:
```
2024-11-28T10:30:00.000Z - POST /api/auth/login
2024-11-28T10:30:05.000Z - GET /api/questions
```

## 🐛 Troubleshooting

### Database Connection Error

```
❌ Database connection failed: ER_ACCESS_DENIED_ERROR
```

**Solusi**: Check DB_USER dan DB_PASSWORD di `.env`

### Python Script Error

```
Python script exited with code 1
```

**Solusi**: 
- Pastikan Python 3 terinstall
- Check path python: `python3 --version`
- Install dependencies jika ada: `pip install -r requirements.txt`

### JWT Token Expired

```
Token has expired. Please login again.
```

**Solusi**: Login ulang untuk mendapatkan token baru

## 👥 Tim Pengembang

SheCare Development Team

## 📄 License

MIT License - Silakan gunakan untuk projek Anda

## 🙏 Kontribusi

Untuk menambahkan fitur atau memperbaiki bug:
1. Fork repository ini
2. Buat branch baru
3. Commit changes
4. Push ke branch
5. Buat Pull Request

## 📞 Support

Jika ada pertanyaan atau issue:
- Email: support@shecare.com
- Documentation: Lihat file API_DOCUMENTATION.md

---

**Happy Coding! 🚀**
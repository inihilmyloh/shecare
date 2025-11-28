# 🚀 SheCare Backend - Quick Start Guide

Panduan cepat untuk menjalankan backend SheCare dalam 5 menit!

## ✅ Prerequisites Checklist

Pastikan sudah terinstall:
- [ ] Node.js v14+ (`node --version`)
- [ ] MySQL 8.0+ (`mysql --version`)
- [ ] npm atau yarn (`npm --version`)

## 📦 Step-by-Step Installation

### 1. Extract Project & Install Dependencies

```bash
# Masuk ke folder project
cd shecare-backend

# Install dependencies
npm install
```

⏱️ Estimasi: 2-3 menit

---

### 2. Setup Database

**Opsi A: Via Command Line**
```bash
mysql -u root -p < database/schema.sql
```

**Opsi B: Via MySQL Workbench**
1. Buka MySQL Workbench
2. Connect ke server MySQL
3. File → Open SQL Script → Pilih `database/schema.sql`
4. Execute (⚡ icon)

⏱️ Estimasi: 1 menit

---

### 3. Konfigurasi Environment

```bash
# Copy template
cp .env.example .env

# Edit dengan text editor favorit Anda
nano .env
# atau
code .env
```

**Minimal configuration:**
```env
PORT=5000
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=your_mysql_password
DB_NAME=shecare_db
JWT_SECRET=ganti_dengan_string_random_minimal_32_karakter
```

⏱️ Estimasi: 1 menit

---

### 4. Jalankan Server

```bash
npm run dev
```

Jika berhasil, Anda akan melihat:
```
✅ Database connected successfully
🚀 SheCare Backend Server Started
📡 API URL: http://localhost:5000/api
🏥 Health Check: http://localhost:5000/api/health
```

⏱️ Estimasi: 30 detik

---

## 🧪 Test Installation

### 1. Test Health Check

Buka browser atau gunakan curl:
```bash
curl http://localhost:5000/api/health
```

**Expected response:**
```json
{
  "success": true,
  "message": "SheCare API is running",
  "timestamp": "2024-11-28T10:30:00.000Z",
  "uptime": 5.123
}
```

---

### 2. Test Login Admin

```bash
curl -X POST http://localhost:5000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@shecare.com",
    "password": "admin123"
  }'
```

**Expected response:**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "Admin SheCare",
      "email": "admin@shecare.com",
      "role": "admin"
    },
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
  }
}
```

✅ **Jika kedua test berhasil, instalasi SELESAI!**

---

## 🎯 Next Steps

### Untuk Frontend Developer

Base URL API Anda: `http://localhost:5000/api`

Endpoints utama:
- Authentication: `/api/auth/`
- Questions: `/api/questions`
- Submit: `/api/questionnaire/submit`
- Admin: `/api/admin/`

📖 **Dokumentasi lengkap:** Baca `API_DOCUMENTATION.md`

---

### Untuk Testing

**Menggunakan Postman:**
1. Buat collection baru
2. Set base URL: `http://localhost:5000`
3. Untuk protected routes, tambahkan header:
   ```
   Authorization: Bearer YOUR_TOKEN
   ```

**Menggunakan cURL:**
Lihat contoh-contoh di `API_DOCUMENTATION.md`

---

## 🛠️ Default Accounts

### Admin Account
```
Email: admin@shecare.com
Password: admin123
```

**⚠️ PENTING:** Ganti password admin setelah instalasi!

---

## 🐛 Common Issues

### Issue 1: Database Connection Failed

**Error:**
```
❌ Database connection failed: ER_ACCESS_DENIED_ERROR
```

**Solution:**
1. Check DB_USER dan DB_PASSWORD di `.env`
2. Pastikan MySQL service berjalan:
   ```bash
   # Windows
   net start mysql
   
   # Linux/Mac
   sudo service mysql start
   ```

---

### Issue 2: Port Already in Use

**Error:**
```
Error: listen EADDRINUSE: address already in use :::5000
```

**Solution:**
1. Ganti PORT di `.env` (misal: 5001, 5002)
2. Atau stop aplikasi yang menggunakan port 5000:
   ```bash
   # Windows
   netstat -ano | findstr :5000
   taskkill /PID <PID> /F
   
   # Linux/Mac
   lsof -ti:5000 | xargs kill
   ```

---

### Issue 3: Module Not Found

**Error:**
```
Error: Cannot find module 'express'
```

**Solution:**
```bash
npm install
```

Jika masih error:
```bash
rm -rf node_modules
rm package-lock.json
npm install
```

---

## 📁 Project Structure Overview

```
shecare-backend/
├── src/
│   ├── config/          # Database & config
│   ├── controllers/     # Business logic
│   ├── middleware/      # Auth & validation
│   ├── routes/          # API routes
│   ├── utils/           # Helper functions
│   └── server.js        # Main server file
├── database/
│   └── schema.sql       # Database schema
├── python/
│   └── decision_tree.py # AI decision tree
├── .env                 # Environment variables
└── package.json         # Dependencies
```

---

## 🔐 Security Tips

1. **Ganti JWT_SECRET** dengan string random yang kuat
2. **Ganti password admin default** setelah instalasi
3. **Jangan commit file `.env`** ke repository
4. **Gunakan HTTPS** di production
5. **Enable rate limiting** sebelum production

---

## 📚 Additional Resources

- **Full Documentation:** `README.md`
- **API Reference:** `API_DOCUMENTATION.md`
- **Database Schema:** `database/schema.sql`

---

## 💬 Need Help?

Jika ada masalah yang tidak tercantum di sini:

1. Check error message di console
2. Periksa MySQL error log
3. Baca dokumentasi lengkap
4. Contact support team

---

## ✨ Tips for Development

### Hot Reload
Gunakan `npm run dev` untuk auto-restart saat ada perubahan file.

### Database Reset
Jika ingin reset database:
```bash
mysql -u root -p -e "DROP DATABASE IF EXISTS shecare_db;"
mysql -u root -p < database/schema.sql
```

### Test API Endpoints
Gunakan extension VS Code: "REST Client" atau "Thunder Client"

### Environment Switching
Buat multiple .env files:
- `.env.development`
- `.env.production`
- `.env.test`

---

**Happy Coding! 🚀**

*Last Updated: 28 November 2024*
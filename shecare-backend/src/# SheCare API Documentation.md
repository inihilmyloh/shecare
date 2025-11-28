# SheCare API Documentation

Base URL: `http://localhost:5000/api`

## 📑 Table of Contents

- [Response Format](#response-format)
- [Authentication](#authentication)
- [User Endpoints](#user-endpoints)
- [Questionnaire Endpoints](#questionnaire-endpoints)
- [Admin Endpoints](#admin-endpoints)
- [External APIs](#external-apis)
- [Error Codes](#error-codes)

---

## Response Format

### Success Response
```json
{
  "success": true,
  "message": "Success message",
  "data": { ... },
  "count": 10  // optional, for list endpoints
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error message",
  "errors": [
    {
      "field": "email",
      "message": "Valid email is required",
      "value": "invalid-email"
    }
  ]
}
```

---

## Authentication

All protected endpoints require JWT token in header:

```
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
```

---

## User Endpoints

### 1. Register

Register new user account.

**Endpoint:** `POST /api/auth/register`

**Access:** Public

**Request Body:**
```json
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "securepass123",
  "phone": "08123456789"  // optional
}
```

**Validation:**
- `name`: Required, string
- `email`: Required, valid email format
- `password`: Required, minimum 6 characters
- `phone`: Optional, string

**Success Response (201):**
```json
{
  "success": true,
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "Jane Doe",
      "email": "jane@example.com",
      "role": "user",
      "phone": "08123456789",
      "created_at": "2024-11-28T10:30:00.000Z"
    },
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
  }
}
```

**Error Response (400):**
```json
{
  "success": false,
  "message": "Email already registered"
}
```

---

### 2. Login

Login to existing account.

**Endpoint:** `POST /api/auth/login`

**Access:** Public

**Request Body:**
```json
{
  "email": "jane@example.com",
  "password": "securepass123"
}
```

**Success Response (200):**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "Jane Doe",
      "email": "jane@example.com",
      "role": "user",
      "phone": "08123456789"
    },
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
  }
}
```

**Error Response (401):**
```json
{
  "success": false,
  "message": "Invalid email or password"
}
```

---

### 3. Get Current User

Get currently logged in user profile.

**Endpoint:** `GET /api/auth/me`

**Access:** Private (requires token)

**Headers:**
```
Authorization: Bearer YOUR_TOKEN_HERE
```

**Success Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Jane Doe",
    "email": "jane@example.com",
    "role": "user",
    "phone": "08123456789",
    "created_at": "2024-11-28T10:30:00.000Z"
  }
}
```

---

### 4. Logout

Logout current user (client should remove token).

**Endpoint:** `POST /api/auth/logout`

**Access:** Private

**Success Response (200):**
```json
{
  "success": true,
  "message": "Logout successful. Please remove token from client."
}
```

---

## Questionnaire Endpoints

### 1. Get Questions

Get all active questionnaire questions.

**Endpoint:** `GET /api/questions`

**Access:** Public

**Success Response (200):**
```json
{
  "success": true,
  "count": 5,
  "data": [
    {
      "id": 1,
      "question_text": "Seberapa sering Anda mengalami nyeri panggul kronis dalam 3 bulan terakhir?",
      "question_type": "scale",
      "min_value": 1,
      "max_value": 5,
      "order_number": 1
    },
    {
      "id": 2,
      "question_text": "Apakah Anda mengalami keputihan abnormal?",
      "question_type": "scale",
      "min_value": 1,
      "max_value": 5,
      "order_number": 2
    }
  ]
}
```

---

### 2. Submit Questionnaire

Submit questionnaire answers and get diagnosis.

**Endpoint:** `POST /api/questionnaire/submit`

**Access:** Private

**Request Body:**
```json
{
  "answers": [
    {
      "question_id": 1,
      "answer_value": 4
    },
    {
      "question_id": 2,
      "answer_value": 3
    },
    {
      "question_id": 3,
      "answer_value": 5
    }
  ]
}
```

**Success Response (201):**
```json
{
  "success": true,
  "message": "Questionnaire submitted successfully",
  "data": {
    "submission_id": 10,
    "diagnosis_id": 5,
    "diagnosis": {
      "disease_id": 1,
      "disease_name": "Endometriosis",
      "confidence": 0.80,
      "diagnosis_text": "Nyeri panggul kronis yang Anda alami mengindikasikan kemungkinan endometriosis...",
      "recommendations": "Segera konsultasi dengan dokter spesialis kandungan untuk pemeriksaan lebih lanjut..."
    }
  }
}
```

---

### 3. Get Result

Get diagnosis result by submission ID.

**Endpoint:** `GET /api/questionnaire/result/:id`

**Access:** Private

**Example:** `GET /api/questionnaire/result/10`

**Success Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 5,
    "submission_id": 10,
    "confidence_score": 0.80,
    "diagnosis_text": "Nyeri panggul kronis yang Anda alami...",
    "recommendations": "Segera konsultasi dengan dokter...",
    "created_at": "2024-11-28T10:30:00.000Z",
    "disease_name": "Endometriosis",
    "disease_description": "Kondisi dimana jaringan yang mirip dengan lapisan rahim...",
    "severity": "high",
    "submission_date": "2024-11-28T10:30:00.000Z",
    "answers": [
      {
        "question_id": 1,
        "answer_value": "4",
        "question_text": "Seberapa sering Anda mengalami nyeri panggul..."
      }
    ]
  }
}
```

---

### 4. Get History

Get user's questionnaire submission history.

**Endpoint:** `GET /api/questionnaire/history`

**Access:** Private

**Query Parameters:**
- `limit` (optional, default: 10)
- `offset` (optional, default: 0)

**Example:** `GET /api/questionnaire/history?limit=5&offset=0`

**Success Response (200):**
```json
{
  "success": true,
  "count": 5,
  "total": 15,
  "data": [
    {
      "submission_id": 10,
      "submission_date": "2024-11-28T10:30:00.000Z",
      "completed": true,
      "diagnosis_id": 5,
      "confidence_score": 0.80,
      "disease_name": "Endometriosis",
      "severity": "high"
    }
  ]
}
```

---

## Admin Endpoints

All admin endpoints require:
- Valid JWT token
- User role must be `admin`

### User Management

#### 1. Get All Users

**Endpoint:** `GET /api/admin/users`

**Access:** Admin only

**Query Parameters:**
- `limit` (optional, default: 10)
- `offset` (optional, default: 0)

**Success Response (200):**
```json
{
  "success": true,
  "count": 10,
  "total": 150,
  "data": [
    {
      "id": 2,
      "name": "Jane Doe",
      "email": "jane@example.com",
      "phone": "08123456789",
      "role": "user",
      "created_at": "2024-11-28T10:30:00.000Z"
    }
  ]
}
```

---

#### 2. Get User Detail

**Endpoint:** `GET /api/admin/users/:id`

**Access:** Admin only

**Success Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 2,
    "name": "Jane Doe",
    "email": "jane@example.com",
    "phone": "08123456789",
    "role": "user",
    "created_at": "2024-11-28T10:30:00.000Z",
    "total_submissions": 5
  }
}
```

---

#### 3. Get All History

Get all users' questionnaire history.

**Endpoint:** `GET /api/admin/history`

**Access:** Admin only

**Query Parameters:**
- `limit` (optional, default: 20)
- `offset` (optional, default: 0)

**Success Response (200):**
```json
{
  "success": true,
  "count": 20,
  "total": 500,
  "data": [
    {
      "submission_id": 100,
      "submission_date": "2024-11-28T10:30:00.000Z",
      "completed": true,
      "user_id": 2,
      "user_name": "Jane Doe",
      "user_email": "jane@example.com",
      "confidence_score": 0.85,
      "disease_name": "Infeksi Jamur",
      "severity": "low"
    }
  ]
}
```

---

#### 4. Delete User

**Endpoint:** `DELETE /api/admin/users/:id`

**Access:** Admin only

**Note:** Cannot delete admin users

**Success Response (200):**
```json
{
  "success": true,
  "message": "User deleted successfully"
}
```

**Error Response (403):**
```json
{
  "success": false,
  "message": "Cannot delete admin users"
}
```

---

### Questions Management (CRUD)

#### 1. Get All Questions

**Endpoint:** `GET /api/admin/questions`

**Access:** Admin only

**Success Response (200):**
```json
{
  "success": true,
  "count": 5,
  "data": [
    {
      "id": 1,
      "question_text": "Seberapa sering Anda mengalami nyeri panggul kronis?",
      "question_type": "scale",
      "min_value": 1,
      "max_value": 5,
      "order_number": 1,
      "is_active": true,
      "created_at": "2024-11-28T10:30:00.000Z",
      "updated_at": "2024-11-28T10:30:00.000Z"
    }
  ]
}
```

---

#### 2. Create Question

**Endpoint:** `POST /api/admin/questions`

**Access:** Admin only

**Request Body:**
```json
{
  "question_text": "Apakah Anda mengalami demam?",
  "question_type": "scale",
  "min_value": 1,
  "max_value": 5,
  "order_number": 6,
  "is_active": true
}
```

**Validation:**
- `question_text`: Required, string
- `question_type`: Optional, enum: ['scale', 'yesno', 'multiple'], default: 'scale'
- `min_value`: Optional, integer, default: 1
- `max_value`: Optional, integer, default: 5
- `order_number`: Required, integer (min: 1)
- `is_active`: Optional, boolean, default: true

**Success Response (201):**
```json
{
  "success": true,
  "message": "Question created successfully",
  "data": {
    "id": 6,
    "question_text": "Apakah Anda mengalami demam?",
    "question_type": "scale",
    "min_value": 1,
    "max_value": 5,
    "order_number": 6,
    "is_active": true,
    "created_at": "2024-11-28T11:00:00.000Z",
    "updated_at": "2024-11-28T11:00:00.000Z"
  }
}
```

---

#### 3. Update Question

**Endpoint:** `PUT /api/admin/questions/:id`

**Access:** Admin only

**Request Body:** (all fields optional)
```json
{
  "question_text": "Seberapa sering Anda mengalami demam?",
  "question_type": "scale",
  "min_value": 1,
  "max_value": 5,
  "order_number": 6,
  "is_active": false
}
```

**Success Response (200):**
```json
{
  "success": true,
  "message": "Question updated successfully",
  "data": { ... }
}
```

---

#### 4. Delete Question

**Endpoint:** `DELETE /api/admin/questions/:id`

**Access:** Admin only

**Success Response (200):**
```json
{
  "success": true,
  "message": "Question deleted successfully"
}
```

---

### Diseases Management (CRUD)

#### 1. Get All Diseases

**Endpoint:** `GET /api/admin/diseases`

**Access:** Admin only

**Success Response (200):**
```json
{
  "success": true,
  "count": 5,
  "data": [
    {
      "id": 1,
      "name": "Endometriosis",
      "description": "Kondisi dimana jaringan yang mirip dengan lapisan rahim...",
      "severity": "high",
      "recommendations": "Konsultasi dengan dokter kandungan...",
      "created_at": "2024-11-28T10:30:00.000Z",
      "updated_at": "2024-11-28T10:30:00.000Z"
    }
  ]
}
```

---

#### 2. Create Disease

**Endpoint:** `POST /api/admin/diseases`

**Access:** Admin only

**Request Body:**
```json
{
  "name": "PCOS",
  "description": "Polycystic Ovary Syndrome adalah...",
  "severity": "moderate",
  "recommendations": "Jaga pola makan, olahraga teratur..."
}
```

**Validation:**
- `name`: Required, string
- `description`: Optional, string
- `severity`: Optional, enum: ['low', 'moderate', 'high'], default: 'moderate'
- `recommendations`: Optional, string

**Success Response (201):**
```json
{
  "success": true,
  "message": "Disease created successfully",
  "data": { ... }
}
```

---

#### 3. Update Disease

**Endpoint:** `PUT /api/admin/diseases/:id`

**Access:** Admin only

**Request Body:** (all fields optional)
```json
{
  "name": "PCOS (Updated)",
  "description": "Updated description...",
  "severity": "high",
  "recommendations": "Updated recommendations..."
}
```

**Success Response (200):**
```json
{
  "success": true,
  "message": "Disease updated successfully",
  "data": { ... }
}
```

---

#### 4. Delete Disease

**Endpoint:** `DELETE /api/admin/diseases/:id`

**Access:** Admin only

**Success Response (200):**
```json
{
  "success": true,
  "message": "Disease deleted successfully"
}
```

---

## External APIs

### 1. Get Health Articles

**Endpoint:** `GET /api/articles`

**Access:** Public

**Query Parameters:**
- `limit` (optional, default: 10)
- `q` (optional, default: 'women health')

**Example:** `GET /api/articles?limit=5&q=endometriosis`

**Success Response (200):**
```json
{
  "success": true,
  "count": 5,
  "data": [
    {
      "title": "Understanding Endometriosis",
      "description": "A comprehensive guide to endometriosis...",
      "url": "https://example.com/article",
      "urlToImage": "https://example.com/image.jpg",
      "publishedAt": "2024-11-28T10:00:00.000Z",
      "source": {
        "name": "Health Magazine"
      }
    }
  ]
}
```

---

### 2. Get Nearby Clinics

**Endpoint:** `GET /api/maps/clinics`

**Access:** Public

**Query Parameters:**
- `lat` (required): Latitude
- `lng` (required): Longitude
- `radius` (optional, default: 5000): Search radius in meters

**Example:** `GET /api/maps/clinics?lat=-6.2088&lng=106.8456&radius=3000`

**Success Response (200):**
```json
{
  "success": true,
  "count": 3,
  "data": [
    {
      "name": "Klinik Kesehatan Wanita Pratama",
      "address": "Jl. Sudirman No. 123, Jakarta",
      "phone": "+62-21-12345678",
      "rating": 4.5,
      "distance": "1.2 km",
      "location": {
        "lat": -6.2108,
        "lng": 106.8476
      },
      "open_now": true
    }
  ]
}
```

---

### 3. Get Disease Statistics

**Endpoint:** `GET /api/statistics/diseases`

**Access:** Public

**Success Response (200):**
```json
{
  "success": true,
  "count": 4,
  "data": [
    {
      "id": 2,
      "disease_name": "Infeksi Jamur",
      "region": "Indonesia",
      "percentage": 15.30,
      "total_cases": 3600000,
      "year": 2024,
      "source": "WHO Indonesia",
      "severity": "low"
    }
  ]
}
```

---

### 4. Get Summary Statistics

**Endpoint:** `GET /api/statistics/summary`

**Access:** Public

**Success Response (200):**
```json
{
  "success": true,
  "data": {
    "total_users": 150,
    "total_submissions": 520,
    "total_diseases": 5
  }
}
```

---

## Error Codes

| Code | Meaning |
|------|---------|
| 200 | Success |
| 201 | Created |
| 400 | Bad Request (validation error) |
| 401 | Unauthorized (authentication required) |
| 403 | Forbidden (insufficient permissions) |
| 404 | Not Found |
| 500 | Internal Server Error |

---

## Rate Limiting

Currently no rate limiting implemented. Consider adding for production:
- Authentication endpoints: 5 requests/minute
- Other endpoints: 100 requests/minute

---

## Notes

1. All timestamps are in ISO 8601 format (UTC)
2. All responses use `application/json` content type
3. API versioning not implemented yet (consider `/api/v1/` for future)
4. CORS configured for `http://localhost:3000` by default

---

**Last Updated:** 28 November 2024
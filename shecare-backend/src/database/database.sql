-- SheCare Database Schema
-- Drop existing database if exists
DROP DATABASE IF EXISTS shecare_db;
CREATE DATABASE shecare_db;
USE shecare_db;

-- Users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role)
);

-- Diseases table
CREATE TABLE diseases (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    severity ENUM('low', 'moderate', 'high') DEFAULT 'moderate',
    recommendations TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Questions table (untuk kuisioner dinamis)
CREATE TABLE questions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    question_text TEXT NOT NULL,
    question_type ENUM('scale', 'yesno', 'multiple') DEFAULT 'scale',
    min_value INT DEFAULT 1,
    max_value INT DEFAULT 5,
    order_number INT NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_order (order_number),
    INDEX idx_active (is_active)
);

-- Question rules untuk decision tree (dinamis)
CREATE TABLE question_rules (
    id INT PRIMARY KEY AUTO_INCREMENT,
    question_id INT NOT NULL,
    condition_operator VARCHAR(20) NOT NULL,
    condition_value VARCHAR(50) NOT NULL,
    next_question_id INT,
    disease_id INT,
    confidence_score DECIMAL(3,2) DEFAULT 0.5,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
    FOREIGN KEY (next_question_id) REFERENCES questions(id) ON DELETE SET NULL,
    FOREIGN KEY (disease_id) REFERENCES diseases(id) ON DELETE CASCADE
);

-- Questionnaire submissions
CREATE TABLE questionnaire_submissions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_date (user_id, submission_date)
);

-- Questionnaire answers
CREATE TABLE questionnaire_answers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    submission_id INT NOT NULL,
    question_id INT NOT NULL,
    answer_value VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (submission_id) REFERENCES questionnaire_submissions(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);

-- Diagnosis results
CREATE TABLE diagnosis_results (
    id INT PRIMARY KEY AUTO_INCREMENT,
    submission_id INT NOT NULL,
    disease_id INT,
    confidence_score DECIMAL(3,2),
    diagnosis_text TEXT,
    recommendations TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (submission_id) REFERENCES questionnaire_submissions(id) ON DELETE CASCADE,
    FOREIGN KEY (disease_id) REFERENCES diseases(id) ON DELETE SET NULL
);

-- Statistics table untuk homepage visualization
CREATE TABLE disease_statistics (
    id INT PRIMARY KEY AUTO_INCREMENT,
    disease_id INT NOT NULL,
    region VARCHAR(100) DEFAULT 'Indonesia',
    percentage DECIMAL(5,2),
    total_cases INT,
    year INT,
    source VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (disease_id) REFERENCES diseases(id) ON DELETE CASCADE
);

-- Insert default admin user (password: admin123)
-- Hash password menggunakan bcrypt dengan salt 10
INSERT INTO users (name, email, password, role) VALUES
('Admin SheCare', 'admin@shecare.com', '$2a$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert sample diseases
INSERT INTO diseases (name, description, severity, recommendations) VALUES
('Endometriosis', 'Kondisi dimana jaringan yang mirip dengan lapisan rahim tumbuh di luar rahim, menyebabkan nyeri panggul kronis dan masalah kesuburan.', 'high', 'Konsultasi dengan dokter kandungan segera, pemeriksaan USG transvaginal, terapi hormon, kemungkinan laparoskopi'),
('Infeksi Jamur (Kandidiasis)', 'Infeksi vagina yang disebabkan oleh pertumbuhan berlebih jamur Candida albicans, menyebabkan gatal, iritasi, dan keputihan kental.', 'low', 'Gunakan obat antijamur topikal atau oral, jaga kebersihan area kewanitaan, hindari pakaian ketat dan sintetis, konsumsi yogurt probiotik'),
('Infeksi Bakteri (Bacterial Vaginosis)', 'Infeksi bakteri pada vagina yang menyebabkan keputihan dengan bau tidak sedap, gatal ringan.', 'moderate', 'Konsultasi dokter untuk antibiotik, jaga pH vagina dengan sabun khusus, hindari douching'),
('PID (Pelvic Inflammatory Disease)', 'Infeksi pada organ reproduksi wanita (rahim, tuba fallopi, ovarium) yang dapat menyebabkan nyeri panggul, demam, dan keputihan.', 'high', 'Segera konsultasi dokter untuk antibiotik kuat, istirahat total, hindari hubungan seksual selama pengobatan'),
('Normal', 'Tidak ditemukan indikasi penyakit yang signifikan berdasarkan gejala yang dilaporkan. Kondisi kesehatan reproduksi dalam batas normal.', 'low', 'Pemeriksaan rutin setiap 6-12 bulan, jaga pola hidup sehat, konsumsi makanan bergizi, olahraga teratur');

-- Insert sample questions untuk decision tree
INSERT INTO questions (question_text, question_type, min_value, max_value, order_number) VALUES
('Seberapa sering Anda mengalami nyeri panggul kronis dalam 3 bulan terakhir? (1=Tidak pernah, 5=Sangat sering/setiap hari)', 'scale', 1, 5, 1),
('Apakah Anda mengalami keputihan abnormal (berbeda dari biasanya dalam hal warna, bau, atau tekstur)? (1=Tidak sama sekali, 5=Sangat parah)', 'scale', 1, 5, 2),
('Apakah Anda merasakan gatal atau iritasi di area kewanitaan? (1=Tidak, 5=Sangat parah/tidak tertahankan)', 'scale', 1, 5, 3),
('Apakah keputihan Anda disertai bau yang tidak sedap? (1=Tidak, 5=Sangat berbau)', 'scale', 1, 5, 4),
('Seberapa parah rasa sakit saat menstruasi Anda? (1=Tidak sakit, 5=Sangat sakit hingga mengganggu aktivitas)', 'scale', 1, 5, 5);

-- Insert sample statistics
INSERT INTO disease_statistics (disease_id, region, percentage, total_cases, year, source) VALUES
(1, 'Indonesia', 10.5, 2500000, 2024, 'Kementerian Kesehatan RI'),
(2, 'Indonesia', 15.3, 3600000, 2024, 'WHO Indonesia'),
(3, 'Indonesia', 12.8, 3000000, 2024, 'Kementerian Kesehatan RI'),
(4, 'Indonesia', 8.7, 2050000, 2024, 'WHO Indonesia');
const { spawn } = require('child_process');
const path = require('path');
const db = require('../config/database');

/**
 * Run decision tree algorithm (Python ID3 implementation)
 */
exports.runDecisionTree = async (answers) => {
    try {
        // Simple rule-based decision tree implementation
        // Based on the structure you provided:
        // Root: Nyeri panggul kronis? -> Keputihan abnormal? -> Gatal/Iritasi?
        
        const answerMap = {};
        answers.forEach(answer => {
            answerMap[answer.question_id] = parseInt(answer.answer_value);
        });

        // Get questions to map IDs
        const [questions] = await db.query('SELECT id, question_text FROM questions ORDER BY order_number');
        
        // Assuming:
        // Question 1: Nyeri panggul kronis (1-5)
        // Question 2: Keputihan abnormal (1-5)
        // Question 3: Gatal/Iritasi (1-5)
        
        const nyeriPanggul = answerMap[1] || 0;
        const keputihanAbnormal = answerMap[2] || 0;
        const gatalIritasi = answerMap[3] || 0;

        let diseaseId = null;
        let diseaseName = '';
        let confidence = 0;
        let diagnosisText = '';
        let recommendations = '';

        // Decision Tree Logic
        if (nyeriPanggul <= 2) {
            // Tidak ada nyeri panggul kronis
            if (keputihanAbnormal >= 3) {
                // Ada keputihan abnormal
                if (gatalIritasi >= 3) {
                    // Ada gatal/iritasi -> Infeksi Jamur
                    diseaseId = 2;
                    diseaseName = 'Infeksi Jamur (Kandidiasis)';
                    confidence = 0.85;
                    diagnosisText = 'Berdasarkan gejala yang Anda laporkan (keputihan abnormal dengan gatal/iritasi), kemungkinan besar Anda mengalami infeksi jamur vagina.';
                } else {
                    // Tidak ada gatal -> Infeksi Bakteri
                    diseaseId = 3;
                    diseaseName = 'Infeksi Bakteri (Bacterial Vaginosis)';
                    confidence = 0.75;
                    diagnosisText = 'Gejala keputihan abnormal tanpa gatal yang signifikan mengindikasikan kemungkinan infeksi bakteri pada vagina.';
                }
            } else {
                // Tidak ada keputihan abnormal -> Normal
                diseaseId = 5;
                diseaseName = 'Normal';
                confidence = 0.90;
                diagnosisText = 'Berdasarkan gejala yang dilaporkan, tidak ditemukan indikasi penyakit yang signifikan. Kondisi Anda tampak normal.';
            }
        } else {
            // Ada nyeri panggul kronis
            if (keputihanAbnormal <= 2) {
                // Tidak ada keputihan abnormal -> Endometriosis
                diseaseId = 1;
                diseaseName = 'Endometriosis';
                confidence = 0.80;
                diagnosisText = 'Nyeri panggul kronis yang Anda alami tanpa keputihan abnormal yang signifikan mengindikasikan kemungkinan endometriosis.';
            } else {
                // Ada keputihan abnormal -> PID
                diseaseId = 4;
                diseaseName = 'PID (Pelvic Inflammatory Disease)';
                confidence = 0.70;
                diagnosisText = 'Kombinasi nyeri panggul kronis dan keputihan abnormal mengindikasikan kemungkinan penyakit radang panggul (PID) atau kondisi kompleks lainnya yang memerlukan pemeriksaan lebih lanjut.';
            }
        }

        // Get disease details from database
        if (diseaseId) {
            const [diseases] = await db.query(
                'SELECT name, description, recommendations FROM diseases WHERE id = ?',
                [diseaseId]
            );

            if (diseases.length > 0) {
                const disease = diseases[0];
                recommendations = disease.recommendations;
            }
        }

        return {
            disease_id: diseaseId,
            disease_name: diseaseName,
            confidence: confidence,
            diagnosis_text: diagnosisText,
            recommendations: recommendations
        };

    } catch (error) {
        console.error('Decision tree error:', error);
        throw error;
    }
};

/**
 * Alternative: Run Python decision tree script
 * Uncomment this if you want to use external Python script
 */
exports.runPythonDecisionTree = (answers) => {
    return new Promise((resolve, reject) => {
        const pythonScript = path.join(__dirname, '../../python/decision_tree.py');
        const python = spawn('python3', [pythonScript]);

        let dataString = '';
        let errorString = '';

        // Send input to Python script
        python.stdin.write(JSON.stringify({ answers }));
        python.stdin.end();

        python.stdout.on('data', (data) => {
            dataString += data.toString();
        });

        python.stderr.on('data', (data) => {
            errorString += data.toString();
        });

        python.on('close', (code) => {
            if (code !== 0) {
                console.error('Python script error:', errorString);
                reject(new Error(`Python script exited with code ${code}`));
            } else {
                try {
                    const result = JSON.parse(dataString);
                    resolve(result);
                } catch (error) {
                    reject(new Error('Failed to parse Python script output'));
                }
            }
        });
    });
};
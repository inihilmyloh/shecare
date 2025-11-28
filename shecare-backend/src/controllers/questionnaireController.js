const db = require('../config/database');
const { runDecisionTree } = require('../utils/decisionTree');

/**
 * @route   GET /api/questions
 * @desc    Get all active questions
 * @access  Public
 */
exports.getQuestions = async (req, res) => {
    try {
        const [questions] = await db.query(
            'SELECT id, question_text, question_type, min_value, max_value, order_number FROM questions WHERE is_active = TRUE ORDER BY order_number ASC'
        );

        res.json({
            success: true,
            count: questions.length,
            data: questions
        });

    } catch (error) {
        console.error('Get questions error:', error);
        res.status(500).json({
            success: false,
            message: 'Error fetching questions',
            error: error.message
        });
    }
};

/**
 * @route   POST /api/questionnaire/submit
 * @desc    Submit questionnaire answers
 * @access  Private
 */
exports.submitQuestionnaire = async (req, res) => {
    const connection = await db.getConnection();
    
    try {
        await connection.beginTransaction();

        const { answers } = req.body;
        const userId = req.user.id;

        // Validate answers format
        if (!answers || !Array.isArray(answers) || answers.length === 0) {
            await connection.rollback();
            return res.status(400).json({
                success: false,
                message: 'Invalid answers format. Expected array of {question_id, answer_value}'
            });
        }

        // Create submission
        const [submissionResult] = await connection.query(
            'INSERT INTO questionnaire_submissions (user_id, completed) VALUES (?, FALSE)',
            [userId]
        );

        const submissionId = submissionResult.insertId;

        // Insert all answers
        const answerValues = answers.map(answer => [
            submissionId,
            answer.question_id,
            answer.answer_value.toString()
        ]);

        await connection.query(
            'INSERT INTO questionnaire_answers (submission_id, question_id, answer_value) VALUES ?',
            [answerValues]
        );

        // Run decision tree algorithm
        const diagnosis = await runDecisionTree(answers);

        // Save diagnosis result
        const [diagnosisResult] = await connection.query(
            'INSERT INTO diagnosis_results (submission_id, disease_id, confidence_score, diagnosis_text, recommendations) VALUES (?, ?, ?, ?, ?)',
            [
                submissionId,
                diagnosis.disease_id || null,
                diagnosis.confidence || 0,
                diagnosis.diagnosis_text || '',
                diagnosis.recommendations || ''
            ]
        );

        // Mark submission as completed
        await connection.query(
            'UPDATE questionnaire_submissions SET completed = TRUE WHERE id = ?',
            [submissionId]
        );

        await connection.commit();

        res.status(201).json({
            success: true,
            message: 'Questionnaire submitted successfully',
            data: {
                submission_id: submissionId,
                diagnosis_id: diagnosisResult.insertId,
                diagnosis
            }
        });

    } catch (error) {
        await connection.rollback();
        console.error('Submit questionnaire error:', error);
        res.status(500).json({
            success: false,
            message: 'Error submitting questionnaire',
            error: error.message
        });
    } finally {
        connection.release();
    }
};

/**
 * @route   GET /api/questionnaire/result/:id
 * @desc    Get diagnosis result by submission ID
 * @access  Private
 */
exports.getResult = async (req, res) => {
    try {
        const { id } = req.params;
        const userId = req.user.id;

        const [results] = await db.query(`
            SELECT 
                dr.id,
                dr.submission_id,
                dr.confidence_score,
                dr.diagnosis_text,
                dr.recommendations,
                dr.created_at,
                d.name as disease_name,
                d.description as disease_description,
                d.severity,
                qs.submission_date
            FROM diagnosis_results dr
            LEFT JOIN diseases d ON dr.disease_id = d.id
            INNER JOIN questionnaire_submissions qs ON dr.submission_id = qs.id
            WHERE dr.submission_id = ? AND qs.user_id = ?
        `, [id, userId]);

        if (results.length === 0) {
            return res.status(404).json({
                success: false,
                message: 'Result not found or access denied'
            });
        }

        // Get answers for this submission
        const [answers] = await db.query(`
            SELECT 
                qa.question_id,
                qa.answer_value,
                q.question_text
            FROM questionnaire_answers qa
            INNER JOIN questions q ON qa.question_id = q.id
            WHERE qa.submission_id = ?
            ORDER BY q.order_number
        `, [id]);

        const result = results[0];
        result.answers = answers;

        res.json({
            success: true,
            data: result
        });

    } catch (error) {
        console.error('Get result error:', error);
        res.status(500).json({
            success: false,
            message: 'Error fetching result',
            error: error.message
        });
    }
};

/**
 * @route   GET /api/questionnaire/history
 * @desc    Get user's questionnaire history
 * @access  Private
 */
exports.getHistory = async (req, res) => {
    try {
        const userId = req.user.id;
        const limit = parseInt(req.query.limit) || 10;
        const offset = parseInt(req.query.offset) || 0;

        const [history] = await db.query(`
            SELECT 
                qs.id as submission_id,
                qs.submission_date,
                qs.completed,
                dr.id as diagnosis_id,
                dr.confidence_score,
                d.name as disease_name,
                d.severity
            FROM questionnaire_submissions qs
            LEFT JOIN diagnosis_results dr ON qs.id = dr.submission_id
            LEFT JOIN diseases d ON dr.disease_id = d.id
            WHERE qs.user_id = ?
            ORDER BY qs.submission_date DESC
            LIMIT ? OFFSET ?
        `, [userId, limit, offset]);

        const [countResult] = await db.query(
            'SELECT COUNT(*) as total FROM questionnaire_submissions WHERE user_id = ?',
            [userId]
        );

        res.json({
            success: true,
            count: history.length,
            total: countResult[0].total,
            data: history
        });

    } catch (error) {
        console.error('Get history error:', error);
        res.status(500).json({
            success: false,
            message: 'Error fetching history',
            error: error.message
        });
    }
};
const db = require('../config/database');

// ==================== USER MANAGEMENT ====================

/**
 * @route   GET /api/admin/users
 * @desc    Get all users
 * @access  Private/Admin
 */
exports.getAllUsers = async (req, res) => {
    try {
        const limit = parseInt(req.query.limit) || 10;
        const offset = parseInt(req.query.offset) || 0;

        const [users] = await db.query(`
            SELECT id, name, email, phone, role, created_at
            FROM users
            ORDER BY created_at DESC
            LIMIT ? OFFSET ?
        `, [limit, offset]);

        const [countResult] = await db.query('SELECT COUNT(*) as total FROM users');

        res.json({
            success: true,
            count: users.length,
            total: countResult[0].total,
            data: users
        });

    } catch (error) {
        console.error('Get all users error:', error);
        res.status(500).json({
            success: false,
            message: 'Error fetching users',
            error: error.message
        });
    }
};

/**
 * @route   GET /api/admin/users/:id
 * @desc    Get user detail
 * @access  Private/Admin
 */
exports.getUserDetail = async (req, res) => {
    try {
        const { id } = req.params;

        const [users] = await db.query(
            'SELECT id, name, email, phone, role, created_at FROM users WHERE id = ?',
            [id]
        );

        if (users.length === 0) {
            return res.status(404).json({
                success: false,
                message: 'User not found'
            });
        }

        // Get user's submission count
        const [submissions] = await db.query(
            'SELECT COUNT(*) as total_submissions FROM questionnaire_submissions WHERE user_id = ?',
            [id]
        );

        const userData = {
            ...users[0],
            total_submissions: submissions[0].total_submissions
        };

        res.json({
            success: true,
            data: userData
        });

    } catch (error) {
        console.error('Get user detail error:', error);
        res.status(500).json({
            success: false,
            message: 'Error fetching user detail',
            error: error.message
        });
    }
};

/**
 * @route   GET /api/admin/history
 * @desc    Get all users' questionnaire history
 * @access  Private/Admin
 */
exports.getAllHistory = async (req, res) => {
    try {
        const limit = parseInt(req.query.limit) || 20;
        const offset = parseInt(req.query.offset) || 0;

        const [history] = await db.query(`
            SELECT 
                qs.id as submission_id,
                qs.submission_date,
                qs.completed,
                u.id as user_id,
                u.name as user_name,
                u.email as user_email,
                dr.confidence_score,
                d.name as disease_name,
                d.severity
            FROM questionnaire_submissions qs
            INNER JOIN users u ON qs.user_id = u.id
            LEFT JOIN diagnosis_results dr ON qs.id = dr.submission_id
            LEFT JOIN diseases d ON dr.disease_id = d.id
            ORDER BY qs.submission_date DESC
            LIMIT ? OFFSET ?
        `, [limit, offset]);

        const [countResult] = await db.query(
            'SELECT COUNT(*) as total FROM questionnaire_submissions'
        );

        res.json({
            success: true,
            count: history.length,
            total: countResult[0].total,
            data: history
        });

    } catch (error) {
        console.error('Get all history error:', error);
        res.status(500).json({
            success: false,
            message: 'Error fetching history',
            error: error.message
        });
    }
};

/**
 * @route   DELETE /api/admin/users/:id
 * @desc    Delete user
 * @access  Private/Admin
 */
exports.deleteUser = async (req, res) => {
    try {
        const { id } = req.params;

        // Check if user exists
        const [users] = await db.query('SELECT id, role FROM users WHERE id = ?', [id]);

        if (users.length === 0) {
            return res.status(404).json({
                success: false,
                message: 'User not found'
            });
        }

        // Prevent deleting admin users
        if (users[0].role === 'admin') {
            return res.status(403).json({
                success: false,
                message: 'Cannot delete admin users'
            });
        }

        await db.query('DELETE FROM users WHERE id = ?', [id]);

        res.json({
            success: true,
            message: 'User deleted successfully'
        });

    } catch (error) {
        console.error('Delete user error:', error);
        res.status(500).json({
            success: false,
            message: 'Error deleting user',
            error: error.message
        });
    }
};

// ==================== QUESTIONS MANAGEMENT (CRUD) ====================

/**
 * @route   GET /api/admin/questions
 * @desc    Get all questions (including inactive)
 * @access  Private/Admin
 */
exports.getAllQuestions = async (req, res) => {
    try {
        const [questions] = await db.query(
            'SELECT * FROM questions ORDER BY order_number ASC'
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
 * @route   POST /api/admin/questions
 * @desc    Create new question
 * @access  Private/Admin
 */
exports.createQuestion = async (req, res) => {
    try {
        const { question_text, question_type, min_value, max_value, order_number, is_active } = req.body;

        const [result] = await db.query(
            'INSERT INTO questions (question_text, question_type, min_value, max_value, order_number, is_active) VALUES (?, ?, ?, ?, ?, ?)',
            [question_text, question_type || 'scale', min_value || 1, max_value || 5, order_number, is_active !== false]
        );

        const [newQuestion] = await db.query(
            'SELECT * FROM questions WHERE id = ?',
            [result.insertId]
        );

        res.status(201).json({
            success: true,
            message: 'Question created successfully',
            data: newQuestion[0]
        });

    } catch (error) {
        console.error('Create question error:', error);
        res.status(500).json({
            success: false,
            message: 'Error creating question',
            error: error.message
        });
    }
};

/**
 * @route   PUT /api/admin/questions/:id
 * @desc    Update question
 * @access  Private/Admin
 */
exports.updateQuestion = async (req, res) => {
    try {
        const { id } = req.params;
        const { question_text, question_type, min_value, max_value, order_number, is_active } = req.body;

        // Check if question exists
        const [existingQuestion] = await db.query('SELECT id FROM questions WHERE id = ?', [id]);

        if (existingQuestion.length === 0) {
            return res.status(404).json({
                success: false,
                message: 'Question not found'
            });
        }

        await db.query(
            'UPDATE questions SET question_text = ?, question_type = ?, min_value = ?, max_value = ?, order_number = ?, is_active = ? WHERE id = ?',
            [question_text, question_type, min_value, max_value, order_number, is_active, id]
        );

        const [updatedQuestion] = await db.query('SELECT * FROM questions WHERE id = ?', [id]);

        res.json({
            success: true,
            message: 'Question updated successfully',
            data: updatedQuestion[0]
        });

    } catch (error) {
        console.error('Update question error:', error);
        res.status(500).json({
            success: false,
            message: 'Error updating question',
            error: error.message
        });
    }
};

/**
 * @route   DELETE /api/admin/questions/:id
 * @desc    Delete question
 * @access  Private/Admin
 */
exports.deleteQuestion = async (req, res) => {
    try {
        const { id } = req.params;

        const [existingQuestion] = await db.query('SELECT id FROM questions WHERE id = ?', [id]);

        if (existingQuestion.length === 0) {
            return res.status(404).json({
                success: false,
                message: 'Question not found'
            });
        }

        await db.query('DELETE FROM questions WHERE id = ?', [id]);

        res.json({
            success: true,
            message: 'Question deleted successfully'
        });

    } catch (error) {
        console.error('Delete question error:', error);
        res.status(500).json({
            success: false,
            message: 'Error deleting question',
            error: error.message
        });
    }
};

// ==================== DISEASES MANAGEMENT (CRUD) ====================

/**
 * @route   GET /api/admin/diseases
 * @desc    Get all diseases
 * @access  Private/Admin
 */
exports.getAllDiseases = async (req, res) => {
    try {
        const [diseases] = await db.query('SELECT * FROM diseases ORDER BY name ASC');

        res.json({
            success: true,
            count: diseases.length,
            data: diseases
        });

    } catch (error) {
        console.error('Get diseases error:', error);
        res.status(500).json({
            success: false,
            message: 'Error fetching diseases',
            error: error.message
        });
    }
};

/**
 * @route   POST /api/admin/diseases
 * @desc    Create new disease
 * @access  Private/Admin
 */
exports.createDisease = async (req, res) => {
    try {
        const { name, description, severity, recommendations } = req.body;

        const [result] = await db.query(
            'INSERT INTO diseases (name, description, severity, recommendations) VALUES (?, ?, ?, ?)',
            [name, description, severity || 'moderate', recommendations]
        );

        const [newDisease] = await db.query(
            'SELECT * FROM diseases WHERE id = ?',
            [result.insertId]
        );

        res.status(201).json({
            success: true,
            message: 'Disease created successfully',
            data: newDisease[0]
        });

    } catch (error) {
        console.error('Create disease error:', error);
        res.status(500).json({
            success: false,
            message: 'Error creating disease',
            error: error.message
        });
    }
};

/**
 * @route   PUT /api/admin/diseases/:id
 * @desc    Update disease
 * @access  Private/Admin
 */
exports.updateDisease = async (req, res) => {
    try {
        const { id } = req.params;
        const { name, description, severity, recommendations } = req.body;

        const [existingDisease] = await db.query('SELECT id FROM diseases WHERE id = ?', [id]);

        if (existingDisease.length === 0) {
            return res.status(404).json({
                success: false,
                message: 'Disease not found'
            });
        }

        await db.query(
            'UPDATE diseases SET name = ?, description = ?, severity = ?, recommendations = ? WHERE id = ?',
            [name, description, severity, recommendations, id]
        );

        const [updatedDisease] = await db.query('SELECT * FROM diseases WHERE id = ?', [id]);

        res.json({
            success: true,
            message: 'Disease updated successfully',
            data: updatedDisease[0]
        });

    } catch (error) {
        console.error('Update disease error:', error);
        res.status(500).json({
            success: false,
            message: 'Error updating disease',
            error: error.message
        });
    }
};

/**
 * @route   DELETE /api/admin/diseases/:id
 * @desc    Delete disease
 * @access  Private/Admin
 */
exports.deleteDisease = async (req, res) => {
    try {
        const { id } = req.params;

        const [existingDisease] = await db.query('SELECT id FROM diseases WHERE id = ?', [id]);

        if (existingDisease.length === 0) {
            return res.status(404).json({
                success: false,
                message: 'Disease not found'
            });
        }

        await db.query('DELETE FROM diseases WHERE id = ?', [id]);

        res.json({
            success: true,
            message: 'Disease deleted successfully'
        });

    } catch (error) {
        console.error('Delete disease error:', error);
        res.status(500).json({
            success: false,
            message: 'Error deleting disease',
            error: error.message
        });
    }
};
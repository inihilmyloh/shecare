const express = require('express');
const router = express.Router();
const db = require('../config/database');

/**
 * @route   GET /api/statistics/diseases
 * @desc    Get disease statistics for homepage visualization
 * @access  Public
 */
router.get('/diseases', async (req, res) => {
    try {
        const [statistics] = await db.query(`
            SELECT 
                ds.id,
                d.name as disease_name,
                ds.region,
                ds.percentage,
                ds.total_cases,
                ds.year,
                ds.source,
                d.severity
            FROM disease_statistics ds
            INNER JOIN diseases d ON ds.disease_id = d.id
            WHERE ds.year = (SELECT MAX(year) FROM disease_statistics)
            ORDER BY ds.percentage DESC
        `);

        res.json({
            success: true,
            count: statistics.length,
            data: statistics
        });

    } catch (error) {
        console.error('Get statistics error:', error);
        res.status(500).json({
            success: false,
            message: 'Error fetching statistics',
            error: error.message
        });
    }
});

/**
 * @route   GET /api/statistics/summary
 * @desc    Get summary statistics (total users, submissions, etc)
 * @access  Public
 */
router.get('/summary', async (req, res) => {
    try {
        const [userCount] = await db.query('SELECT COUNT(*) as total FROM users WHERE role = "user"');
        const [submissionCount] = await db.query('SELECT COUNT(*) as total FROM questionnaire_submissions WHERE completed = TRUE');
        const [diseaseCount] = await db.query('SELECT COUNT(*) as total FROM diseases');

        res.json({
            success: true,
            data: {
                total_users: userCount[0].total,
                total_submissions: submissionCount[0].total,
                total_diseases: diseaseCount[0].total
            }
        });

    } catch (error) {
        console.error('Get summary error:', error);
        res.status(500).json({
            success: false,
            message: 'Error fetching summary',
            error: error.message
        });
    }
});

module.exports = router;
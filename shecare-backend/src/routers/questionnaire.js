const express = require('express');
const router = express.Router();
const { body } = require('express-validator');
const { validate } = require('../middleware/validation');
const { protect } = require('../middleware/auth');
const {
    getQuestions,
    submitQuestionnaire,
    getResult,
    getHistory
} = require('../controllers/questionnaireController');

/**
 * @route   GET /api/questions
 * @desc    Get all active questions
 * @access  Public
 */
router.get('/questions', getQuestions);

/**
 * @route   POST /api/questionnaire/submit
 * @desc    Submit questionnaire answers
 * @access  Private
 */
router.post('/questionnaire/submit', [
    protect,
    body('answers')
        .isArray({ min: 1 })
        .withMessage('Answers must be a non-empty array'),
    body('answers.*.question_id')
        .isInt({ min: 1 })
        .withMessage('Valid question_id is required'),
    body('answers.*.answer_value')
        .notEmpty()
        .withMessage('Answer value is required'),
    validate
], submitQuestionnaire);

/**
 * @route   GET /api/questionnaire/result/:id
 * @desc    Get diagnosis result by submission ID
 * @access  Private
 */
router.get('/questionnaire/result/:id', protect, getResult);

/**
 * @route   GET /api/questionnaire/history
 * @desc    Get user's questionnaire history
 * @access  Private
 */
router.get('/questionnaire/history', protect, getHistory);

module.exports = router;
const express = require('express');
const router = express.Router();
const { body } = require('express-validator');
const { validate } = require('../middleware/validation');
const { protect, authorize } = require('../middleware/auth');
const {
    getAllUsers,
    getUserDetail,
    getAllHistory,
    deleteUser,
    getAllQuestions,
    createQuestion,
    updateQuestion,
    deleteQuestion,
    getAllDiseases,
    createDisease,
    updateDisease,
    deleteDisease
} = require('../controllers/adminController');

// Apply auth middleware to all admin routes
router.use(protect);
router.use(authorize('admin'));

// ==================== USER MANAGEMENT ROUTES ====================

/**
 * @route   GET /api/admin/users
 * @desc    Get all users
 * @access  Private/Admin
 */
router.get('/users', getAllUsers);

/**
 * @route   GET /api/admin/users/:id
 * @desc    Get user detail
 * @access  Private/Admin
 */
router.get('/users/:id', getUserDetail);

/**
 * @route   GET /api/admin/history
 * @desc    Get all users' questionnaire history
 * @access  Private/Admin
 */
router.get('/history', getAllHistory);

/**
 * @route   DELETE /api/admin/users/:id
 * @desc    Delete user
 * @access  Private/Admin
 */
router.delete('/users/:id', deleteUser);

// ==================== QUESTIONS CRUD ROUTES ====================

/**
 * @route   GET /api/admin/questions
 * @desc    Get all questions (including inactive)
 * @access  Private/Admin
 */
router.get('/questions', getAllQuestions);

/**
 * @route   POST /api/admin/questions
 * @desc    Create new question
 * @access  Private/Admin
 */
router.post('/questions', [
    body('question_text').trim().notEmpty().withMessage('Question text is required'),
    body('question_type')
        .optional()
        .isIn(['scale', 'yesno', 'multiple'])
        .withMessage('Invalid question type'),
    body('min_value').optional().isInt().withMessage('Min value must be integer'),
    body('max_value').optional().isInt().withMessage('Max value must be integer'),
    body('order_number').isInt({ min: 1 }).withMessage('Order number is required'),
    body('is_active').optional().isBoolean().withMessage('is_active must be boolean'),
    validate
], createQuestion);

/**
 * @route   PUT /api/admin/questions/:id
 * @desc    Update question
 * @access  Private/Admin
 */
router.put('/questions/:id', [
    body('question_text').optional().trim().notEmpty().withMessage('Question text cannot be empty'),
    body('question_type')
        .optional()
        .isIn(['scale', 'yesno', 'multiple'])
        .withMessage('Invalid question type'),
    body('min_value').optional().isInt().withMessage('Min value must be integer'),
    body('max_value').optional().isInt().withMessage('Max value must be integer'),
    body('order_number').optional().isInt({ min: 1 }).withMessage('Order number must be positive integer'),
    body('is_active').optional().isBoolean().withMessage('is_active must be boolean'),
    validate
], updateQuestion);

/**
 * @route   DELETE /api/admin/questions/:id
 * @desc    Delete question
 * @access  Private/Admin
 */
router.delete('/questions/:id', deleteQuestion);

// ==================== DISEASES CRUD ROUTES ====================

/**
 * @route   GET /api/admin/diseases
 * @desc    Get all diseases
 * @access  Private/Admin
 */
router.get('/diseases', getAllDiseases);

/**
 * @route   POST /api/admin/diseases
 * @desc    Create new disease
 * @access  Private/Admin
 */
router.post('/diseases', [
    body('name').trim().notEmpty().withMessage('Disease name is required'),
    body('description').optional().trim(),
    body('severity')
        .optional()
        .isIn(['low', 'moderate', 'high'])
        .withMessage('Invalid severity level'),
    body('recommendations').optional().trim(),
    validate
], createDisease);

/**
 * @route   PUT /api/admin/diseases/:id
 * @desc    Update disease
 * @access  Private/Admin
 */
router.put('/diseases/:id', [
    body('name').optional().trim().notEmpty().withMessage('Disease name cannot be empty'),
    body('description').optional().trim(),
    body('severity')
        .optional()
        .isIn(['low', 'moderate', 'high'])
        .withMessage('Invalid severity level'),
    body('recommendations').optional().trim(),
    validate
], updateDisease);

/**
 * @route   DELETE /api/admin/diseases/:id
 * @desc    Delete disease
 * @access  Private/Admin
 */
router.delete('/diseases/:id', deleteDisease);

module.exports = router;
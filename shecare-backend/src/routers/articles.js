const express = require('express');
const router = express.Router();
const { getArticles } = require('../controllers/articleController');

/**
 * @route   GET /api/articles
 * @desc    Get health articles from News API
 * @access  Public
 * @query   limit - number of articles (default: 10)
 * @query   q - search query (default: 'women health')
 */
router.get('/', getArticles);

module.exports = router;
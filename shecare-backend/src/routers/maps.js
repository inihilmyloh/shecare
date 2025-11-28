const express = require('express');
const router = express.Router();
const { getClinics } = require('../controllers/mapsController');

/**
 * @route   GET /api/maps/clinics
 * @desc    Get nearby clinics using Google Maps API
 * @access  Public
 * @query   lat - latitude (required)
 * @query   lng - longitude (required)
 * @query   radius - search radius in meters (default: 5000)
 */
router.get('/clinics', getClinics);

module.exports = router;
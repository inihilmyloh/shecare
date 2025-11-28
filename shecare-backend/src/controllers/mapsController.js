const axios = require('axios');
const config = require('../config/config');

/**
 * @route   GET /api/maps/clinics
 * @desc    Get nearby clinics using Google Maps API
 * @access  Public
 */
exports.getClinics = async (req, res) => {
    try {
        const { lat, lng, radius } = req.query;

        // Validate parameters
        if (!lat || !lng) {
            return res.status(400).json({
                success: false,
                message: 'Latitude and longitude are required'
            });
        }

        const searchRadius = radius || 5000; // default 5km

        // Check if API key is configured
        if (!config.api.googleMapsApiKey) {
            // Return dummy data if no API key
            return res.json({
                success: true,
                message: 'Using dummy data (configure GOOGLE_MAPS_API_KEY in .env for real data)',
                count: 3,
                data: [
                    {
                        name: 'Klinik Kesehatan Wanita Pratama',
                        address: 'Jl. Sudirman No. 123, Jakarta',
                        phone: '+62-21-12345678',
                        rating: 4.5,
                        distance: '1.2 km',
                        location: {
                            lat: parseFloat(lat) + 0.01,
                            lng: parseFloat(lng) + 0.01
                        },
                        open_now: true
                    },
                    {
                        name: 'RS Ibu dan Anak Harapan',
                        address: 'Jl. Gatot Subroto No. 456, Jakarta',
                        phone: '+62-21-87654321',
                        rating: 4.8,
                        distance: '2.5 km',
                        location: {
                            lat: parseFloat(lat) + 0.02,
                            lng: parseFloat(lng) - 0.01
                        },
                        open_now: true
                    },
                    {
                        name: 'Klinik Bersalin Sejahtera',
                        address: 'Jl. Thamrin No. 789, Jakarta',
                        phone: '+62-21-11223344',
                        rating: 4.3,
                        distance: '3.8 km',
                        location: {
                            lat: parseFloat(lat) - 0.01,
                            lng: parseFloat(lng) + 0.02
                        },
                        open_now: false
                    }
                ]
            });
        }

        // Fetch from Google Maps API
        const response = await axios.get('https://maps.googleapis.com/maps/api/place/nearbysearch/json', {
            params: {
                location: `${lat},${lng}`,
                radius: searchRadius,
                type: 'hospital|doctor',
                keyword: 'women clinic gynecology',
                key: config.api.googleMapsApiKey
            }
        });

        if (response.data.status !== 'OK') {
            throw new Error(`Google Maps API error: ${response.data.status}`);
        }

        const clinics = response.data.results.map(place => ({
            name: place.name,
            address: place.vicinity,
            rating: place.rating || 0,
            location: {
                lat: place.geometry.location.lat,
                lng: place.geometry.location.lng
            },
            open_now: place.opening_hours?.open_now || null,
            place_id: place.place_id
        }));

        res.json({
            success: true,
            count: clinics.length,
            data: clinics
        });

    } catch (error) {
        console.error('Get clinics error:', error.message);
        
        // Return dummy data on error
        res.json({
            success: true,
            message: 'Using fallback data due to API error',
            count: 1,
            data: [
                {
                    name: 'Klinik Terdekat',
                    address: 'Silakan aktifkan Google Maps API',
                    rating: 0,
                    location: {
                        lat: parseFloat(req.query.lat || 0),
                        lng: parseFloat(req.query.lng || 0)
                    }
                }
            ]
        });
    }
};
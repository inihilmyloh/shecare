const jwt = require('jsonwebtoken');
const config = require('../config/config');
const db = require('../config/database');

/**
 * Middleware untuk protect routes yang membutuhkan authentication
 */
exports.protect = async (req, res, next) => {
    try {
        let token;

        // Get token from header
        if (req.headers.authorization && req.headers.authorization.startsWith('Bearer')) {
            token = req.headers.authorization.split(' ')[1];
        }

        // Check if token exists
        if (!token) {
            return res.status(401).json({
                success: false,
                message: 'Not authorized to access this route. Please login.'
            });
        }

        try {
            // Verify token
            const decoded = jwt.verify(token, config.jwt.secret);
            
            // Get user from database
            const [users] = await db.query(
                'SELECT id, name, email, role, phone FROM users WHERE id = ?',
                [decoded.id]
            );

            if (users.length === 0) {
                return res.status(401).json({
                    success: false,
                    message: 'User not found. Token is invalid.'
                });
            }

            // Attach user to request object
            req.user = users[0];
            next();
            
        } catch (error) {
            console.error('JWT verification error:', error.message);
            
            if (error.name === 'TokenExpiredError') {
                return res.status(401).json({
                    success: false,
                    message: 'Token has expired. Please login again.'
                });
            }
            
            return res.status(401).json({
                success: false,
                message: 'Token is invalid or malformed.'
            });
        }
        
    } catch (error) {
        console.error('Auth middleware error:', error);
        return res.status(500).json({
            success: false,
            message: 'Server error during authentication'
        });
    }
};

/**
 * Middleware untuk authorize berdasarkan role
 * Usage: authorize('admin') atau authorize('admin', 'user')
 */
exports.authorize = (...roles) => {
    return (req, res, next) => {
        if (!req.user) {
            return res.status(401).json({
                success: false,
                message: 'User not authenticated'
            });
        }

        if (!roles.includes(req.user.role)) {
            return res.status(403).json({
                success: false,
                message: `User role '${req.user.role}' is not authorized to access this route. Required roles: ${roles.join(', ')}`
            });
        }
        
        next();
    };
};
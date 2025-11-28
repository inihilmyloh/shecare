module.exports = {
    // JWT Configuration
    jwt: {
        secret: process.env.JWT_SECRET || 'your_jwt_secret_key_change_in_production',
        expiresIn: process.env.JWT_EXPIRE || '7d'
    },
    
    // API Keys Configuration
    api: {
        newsApiKey: process.env.NEWS_API_KEY || '',
        healthApiKey: process.env.HEALTH_API_KEY || '',
        googleMapsApiKey: process.env.GOOGLE_MAPS_API_KEY || ''
    },
    
    // Pagination Configuration
    pagination: {
        defaultLimit: 10,
        maxLimit: 100
    },
    
    // Password Configuration
    password: {
        minLength: 6,
        saltRounds: 10
    },
    
    // Decision Tree Configuration
    decisionTree: {
        pythonPath: 'python3', // or 'python' on Windows
        scriptPath: './python/decision_tree.py',
        timeout: 10000 // 10 seconds
    }
};
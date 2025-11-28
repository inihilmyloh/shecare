const mysql = require('mysql2');

// Create connection pool
const pool = mysql.createPool({
    host: process.env.DB_HOST || 'localhost',
    user: process.env.DB_USER || 'root',
    password: process.env.DB_PASSWORD || '',
    database: process.env.DB_NAME || 'shecare_db',
    port: process.env.DB_PORT || 3306,
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0,
    enableKeepAlive: true,
    keepAliveInitialDelay: 0
});

// Get promise pool
const promisePool = pool.promise();

// Test database connection
pool.getConnection((err, connection) => {
    if (err) {
        console.error('❌ Database connection failed:');
        console.error('  Error:', err.message);
        console.error('  Code:', err.code);
        
        if (err.code === 'ER_ACCESS_DENIED_ERROR') {
            console.error('  → Check DB_USER and DB_PASSWORD in .env');
        } else if (err.code === 'ECONNREFUSED') {
            console.error('  → Make sure MySQL server is running');
        } else if (err.code === 'ER_BAD_DB_ERROR') {
            console.error('  → Database does not exist. Run: mysql -u root -p < database/schema.sql');
        }
        
        return;
    }
    
    console.log('✅ Database connected successfully');
    console.log(`   Host: ${process.env.DB_HOST || 'localhost'}`);
    console.log(`   Database: ${process.env.DB_NAME || 'shecare_db'}`);
    
    connection.release();
});

// Handle pool errors
pool.on('error', (err) => {
    console.error('Unexpected database error:', err);
    if (err.code === 'PROTOCOL_CONNECTION_LOST') {
        console.error('Database connection was closed.');
    }
    if (err.code === 'ER_CON_COUNT_ERROR') {
        console.error('Database has too many connections.');
    }
    if (err.code === 'ECONNREFUSED') {
        console.error('Database connection was refused.');
    }
});

module.exports = promisePool;
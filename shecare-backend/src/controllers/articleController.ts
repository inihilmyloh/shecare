const axios = require('axios');
const config = require('../config/config');

/**
 * @route   GET /api/articles
 * @desc    Get health articles from News API
 * @access  Public
 */
exports.getArticles = async (req, res) => {
    try {
        const limit = parseInt(req.query.limit) || 10;
        const query = req.query.q || 'women health';

        // Check if API key is configured
        if (!config.api.newsApiKey) {
            // Return dummy data if no API key
            return res.json({
                success: true,
                message: 'Using dummy data (configure NEWS_API_KEY in .env for real data)',
                count: 3,
                data: [
                    {
                        title: 'Understanding Women\'s Health: A Comprehensive Guide',
                        description: 'Learn about common women\'s health issues and how to maintain reproductive health.',
                        url: 'https://example.com/article1',
                        urlToImage: 'https://via.placeholder.com/400x200',
                        publishedAt: new Date().toISOString(),
                        source: { name: 'Health Magazine' }
                    },
                    {
                        title: 'Endometriosis: Symptoms and Treatment Options',
                        description: 'Everything you need to know about endometriosis, its symptoms, and modern treatment approaches.',
                        url: 'https://example.com/article2',
                        urlToImage: 'https://via.placeholder.com/400x200',
                        publishedAt: new Date().toISOString(),
                        source: { name: 'Medical News' }
                    },
                    {
                        title: 'Preventing Vaginal Infections: Tips and Best Practices',
                        description: 'Expert advice on maintaining vaginal health and preventing common infections.',
                        url: 'https://example.com/article3',
                        urlToImage: 'https://via.placeholder.com/400x200',
                        publishedAt: new Date().toISOString(),
                        source: { name: 'Women\'s Health Today' }
                    }
                ]
            });
        }

        // Fetch from News API
        const response = await axios.get('https://newsapi.org/v2/everything', {
            params: {
                q: query,
                language: 'en',
                sortBy: 'publishedAt',
                pageSize: limit,
                apiKey: config.api.newsApiKey
            }
        });

        const articles = response.data.articles.map(article => ({
            title: article.title,
            description: article.description,
            url: article.url,
            urlToImage: article.urlToImage,
            publishedAt: article.publishedAt,
            source: article.source
        }));

        res.json({
            success: true,
            count: articles.length,
            data: articles
        });

    } catch (error) {
        console.error('Get articles error:', error.message);
        
        // Return dummy data on error
        res.json({
            success: true,
            message: 'Using fallback data due to API error',
            count: 2,
            data: [
                {
                    title: 'Women\'s Health 101',
                    description: 'Basic guide to women\'s reproductive health',
                    url: '#',
                    urlToImage: 'https://via.placeholder.com/400x200',
                    publishedAt: new Date().toISOString(),
                    source: { name: 'Health Portal' }
                },
                {
                    title: 'Maintaining Reproductive Health',
                    description: 'Tips for maintaining optimal reproductive health',
                    url: '#',
                    urlToImage: 'https://via.placeholder.com/400x200',
                    publishedAt: new Date().toISOString(),
                    source: { name: 'Medical Guide' }
                }
            ]
        });
    }
};
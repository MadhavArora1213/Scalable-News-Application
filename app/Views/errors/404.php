<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8fafc; color: #1e293b; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; text-align: center; }
        .card { background: white; padding: 3rem; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1); max-width: 400px; }
        h1 { font-size: 6rem; margin: 0; color: #3b82f6; line-height: 1; }
        h2 { font-size: 1.5rem; margin-top: 0.5rem; }
        p { color: #64748b; margin-bottom: 2rem; }
        a { background: #3b82f6; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-weight: 600; transition: background 0.2s; }
        a:hover { background: #2563eb; }
    </style>
</head>
<body>
    <div class="card">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>Sorry, the news article or page you are looking for has been moved or deleted.</p>
        <a href="<?= SITE_URL ?>">Back to Home</a>
    </div>
</body>
</html>

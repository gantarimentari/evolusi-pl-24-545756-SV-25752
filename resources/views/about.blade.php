<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Aplikasi - {{ $aboutData['app_name'] }}</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f8fafc; color: #1e293b; padding: 40px; }
        .card { background: #ffffff; max-width: 520px; margin: 0 auto; padding: 24px; border-radius: 8px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); }
        h1 { font-size: 1.5rem; margin-bottom: 0.75rem; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem; }
        p { line-height: 1.6; font-size: 0.95rem; }
        .meta { margin-top: 1rem; font-size: 0.85rem; color: #64748b; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Tentang Aplikasi</h1>
        <p>{{ $aboutData['description'] }}</p>
        <div class="meta">
            <span>Versi: <strong>{{ $aboutData['version'] }}</strong></span>
        </div>
    </div>
</body>
</html>
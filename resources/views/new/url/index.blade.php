<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Download Page</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
        }

        .store-buttons img {
            width: 80%;
            max-width: 200px;
            margin: 10px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .store-buttons img:hover {
            transform: scale(1.05);
        }

        h1 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>قم بتحميل التطبيق</h1>
        <div class="store-buttons">
            <a href="{{ App\Models\Setting::where('key', 'ios_url')->first()->value }}" target="_blank">
                <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                    alt="App Store">
            </a>
            <a href="{{ App\Models\Setting::where('key', 'android_url')->first()->value }}" target="_blank">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                    alt="Google Play Store">
            </a>
        </div>
    </div>
</body>

</html>

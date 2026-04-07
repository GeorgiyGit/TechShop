<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechnoWorld - Account</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --blue: #4A70A9;
            --blue-dark: #2f538a;
            --text: #172033;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #eef4fb 0%, #f9fbfe 100%);
            color: var(--text);
        }

        .home-shell {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 2rem;
        }

        .home-card {
            width: min(640px, 100%);
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(74, 112, 169, 0.14);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(47, 83, 138, 0.16);
            padding: 2rem;
        }

        .home-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            background: rgba(74, 112, 169, 0.08);
            color: var(--blue-dark);
            font-weight: 600;
        }

        .home-card h1 {
            margin: 1rem 0 0.75rem;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            letter-spacing: -0.04em;
        }

        .home-card p {
            margin: 0;
            color: #5f6b82;
            line-height: 1.7;
        }

        .home-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .home-button {
            border-radius: 999px;
            padding: 0.75rem 1.15rem;
            font-weight: 600;
            text-decoration: none;
        }

        .home-button-primary {
            background: var(--blue);
            color: white;
        }

        .home-button-secondary {
            border: 1px solid rgba(74, 112, 169, 0.2);
            color: var(--blue-dark);
            background: white;
        }
    </style>
</head>
<body>
    <main class="home-shell">
        <section class="home-card">
            <div class="home-badge">
                <i class="bi bi-check2-circle"></i>
                Account ready
            </div>
            <h1>Welcome, {{ auth()->user()->name }}</h1>
            <p>Your TechnoWorld account has been created and you are signed in now.</p>

            <div class="home-actions">
                <a href="{{ route('signup.create') }}" class="home-button home-button-primary">Create another account</a>
                <a href="{{ route('signup.create') }}" class="home-button home-button-secondary">Back to sign up</a>
            </div>
        </section>
    </main>
</body>
</html>
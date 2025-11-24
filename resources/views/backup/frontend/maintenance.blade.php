<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Under Maintenance — We'll Be Back Soon</title>
    <meta name="description" content="Temporary page: site is under maintenance. We'll be back soon.">
    <style>
        :root {
            --bg: #0f1724;
            --card: #0b1220;
            --muted: #9aa4b2;
            --accent: #6ee7b7;
            --glass: rgba(255, 255, 255, 0.04);
            --radius: 18px;
            --maxw: 1100px;
            --text: #e6eef6;
            color-scheme: light;
            font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            background: linear-gradient(180deg, #071126 0%, #081427 60%, #061422 100%);
            color: var(--text)
        }

        * {
            box-sizing: border-box
        }

        .wrap {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 36px
        }

        .card {
            width: 100%;
            max-width: var(--maxw);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0.01));
            border-radius: var(--radius);
            box-shadow: 0 14px 50px rgba(2, 6, 23, 0.7);
            display: grid;
            grid-template-columns: 1fr 520px;
            gap: 28px;
            padding: 36px;
            position: relative;
            overflow: hidden
        }

        @media (max-width:980px) {
            .card {
                grid-template-columns: 1fr;
                padding: 24px
            }
        }

        .left {
            padding: 6px 8px
        }

        h1 {
            font-size: clamp(28px, 3.8vw, 48px);
            line-height: 1.02;
            margin: 0 0 8px
        }

        p.lead {
            margin: 0 0 18px;
            color: var(--muted);
            font-size: 15px
        }

        form {
            display: flex;
            gap: 12px;
            align-items: center
        }

        .input {
            flex: 1;
            min-width: 0;
            background: var(--glass);
            border: 1px solid rgba(255, 255, 255, 0.03);
            padding: 12px 14px;
            border-radius: 12px;
            color: inherit;
            font-size: 15px
        }

        .btn {
            background: linear-gradient(90deg, #05c46b 0%, #13b8a5 100%);
            border: 0;
            padding: 12px 16px;
            border-radius: 12px;
            font-weight: 700;
            color: #042018;
            cursor: pointer
        }

        .meta {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 16px;
            color: var(--muted);
            font-size: 13px
        }

        .visual {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px
        }

        .scene {
            width: 100%;
            max-width: 460px
        }

        .gear {
            transform-origin: center;
            animation: spin 6s linear infinite
        }

        @keyframes spin {
            from {
                transform: rotate(0)
            }

            to {
                transform: rotate(360deg)
            }
        }

        .cloud {
            animation: float 6s ease-in-out infinite
        }

        @keyframes float {
            0% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-8px)
            }

            100% {
                transform: translateY(0)
            }
        }

        footer {
            margin-top: 18px;
            color: var(--muted);
            font-size: 13px;
            text-align: left
        }

        a.link {
            color: var(--accent);
            text-decoration: none;
            font-weight: 700
        }

        .badge {
            background: rgba(255, 255, 255, 0.03);
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 13px;
            color: var(--muted)
        }

        .topbar {
            display: flex;
            gap: 12px;
            align-items: center;
            justify-content: flex-end
        }

        .toggle {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.06);
            padding: 8px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer
        }

        .toggle .dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 6px 18px rgba(18, 58, 54, 0.14)
        }

        .progress-wrap {
            margin-top: 18px
        }

        .progress {
            height: 8px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 999px;
            overflow: hidden
        }

        .progress>i {
            display: block;
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #3ad8c9, #098f8a);
            border-radius: 999px;
            transition: width 900ms cubic-bezier(.2, .9, .2, 1)
        }

        .particles-canvas {
            position: absolute;
            inset: 0;
            pointer-events: none;
            mix-blend-mode: screen;
            opacity: 0.25
        }

        .lottie-wrap {
            width: 320px;
            height: 320px;
            display: grid;
            place-items: center
        }

        @media (max-width:980px) {
            .visual {
                order: -1;
                padding-bottom: 8px
            }

            .card {
                grid-template-columns: 1fr
            }
        }
    </style>
</head>

<body>
    <main class="wrap" role="main">
        <section class="card" aria-labelledby="title">
            <canvas class="particles-canvas" id="particles"></canvas>
            <div
                style="position:absolute;left:20px;top:20px;right:20px;display:flex;justify-content:flex-end;pointer-events:auto">
                <div class="topbar">
                    <button id="themeToggle" class="toggle" aria-pressed="false" title="Toggle theme">
                        <span class="dot" aria-hidden="true"></span>
                        <span style="font-size:13px;color:var(--muted)">Theme</span>
                    </button>
                </div>
            </div>

            <div class="left">
                <span class="badge" aria-hidden="true">Notice</span>
                <h1 id="title">Sorry, we are undergoing maintenance.</h1>
                <p class="lead">We are improving our service to provide a better experience. We apologize for the
                    inconvenience — our team is working and will be back shortly.</p>

                <form id="subscribe" onsubmit="event.preventDefault();subscribe()" aria-label="Subscribe for updates">
                    <input class="input" id="email" type="email" placeholder="Enter your email for notification"
                        required aria-required="true">
                    <button class="btn" type="submit">Notify me</button>
                </form>

                <div class="meta" role="status" aria-live="polite">
                    <span id="countdown"><strong id="time"></strong></span>
                    <span style="margin-left:auto;color:var(--muted);font-size:13px">Need help? <a class="link"
                            href="mailto:info@malbaligaleria.com">info@malbaligaleria.com</a></span>
                </div>

                <div class="progress-wrap" aria-hidden="true">
                    <div
                        style="display:flex;justify-content:space-between;color:var(--muted);font-size:13px;margin-top:6px">
                        <div>Status</div>
                        <div>Updating</div>
                    </div>
                    <div class="progress" aria-hidden="true">
                        <i id="progressBar"></i>
                    </div>
                </div>

                <footer>
                    <small>Last updated: <time id="updated"></time></small>
                </footer>
            </div>

            <aside class="visual" aria-hidden="true">
                <div class="lottie-wrap" id="lottie"></div>
            </aside>
        </section>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.9.6/lottie.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        (function() {
            const updatedEl = document.getElementById('updated');
            const timeEl = document.getElementById('time');
            const progressBar = document.getElementById('progressBar');
            updatedEl.textContent = new Date().toLocaleString();
            timeEl.textContent = '';
            let progress = 0;

            function step() {
                progress = Math.min(78, progress + (1 + Math.random() * 6));
                progressBar.style.width = Math.round(progress) + '%';
                if (progress < 78) {
                    setTimeout(step, 800 + Math.random() * 400);
                }
            }
            step();

            function subscribe() {
                const email = document.getElementById('email').value.trim();
                if (!email) return alert('Enter a valid email.');
                document.querySelector('.btn').textContent = 'Subscribed';
                setTimeout(function() {
                    document.querySelector('.btn').textContent = 'Notify me'
                }, 2200);
            }
            window.subscribe = subscribe;

            const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            const themeToggle = document.getElementById('themeToggle');

            function applyTheme(mode) {
                if (mode === 'dark') {
                    document.documentElement.style.setProperty('--bg', '#061322');
                    document.documentElement.style.setProperty('--card', '#081727');
                    document.documentElement.style.setProperty('--muted', '#9aa4b2');
                    document.documentElement.style.setProperty('--text', '#e6eef6');
                    themeToggle.setAttribute('aria-pressed', 'true');
                } else {
                    document.documentElement.style.setProperty('--bg', '#f6fbff');
                    document.documentElement.style.setProperty('--card', '#ffffff');
                    document.documentElement.style.setProperty('--muted', '#56616b');
                    document.documentElement.style.setProperty('--text', '#0b1220');
                    themeToggle.setAttribute('aria-pressed', 'false');
                }
            }
            const stored = localStorage.getItem('site-theme');
            if (stored) {
                applyTheme(stored);
            } else {
                applyTheme(prefersDark ? 'dark' : 'light');
            }
            themeToggle.addEventListener('click', function() {
                const current = themeToggle.getAttribute('aria-pressed') === 'true' ? 'dark' : 'light';
                const next = current === 'dark' ? 'light' : 'dark';
                localStorage.setItem('site-theme', next);
                applyTheme(next);
            });

            const canvas = document.getElementById('particles');
            const ctx = canvas.getContext('2d');
            let w = canvas.width = window.innerWidth;
            let h = canvas.height = window.innerHeight;
            const particles = [];

            function rand(min, max) {
                return Math.random() * (max - min) + min
            }

            function createParticles() {
                const count = Math.round((w * h) / 90000);
                particles.length = 0;
                for (let i = 0; i < count; i++) {
                    particles.push({
                        x: rand(0, w),
                        y: rand(0, h),
                        r: rand(0.6, 2.6),
                        vx: rand(-0.35, 0.35),
                        vy: rand(-0.2, 0.2),
                        alpha: rand(0.06, 0.28)
                    });
                }
            }

            function resize() {
                w = canvas.width = window.innerWidth;
                h = canvas.height = window.innerHeight;
                createParticles();
            }
            window.addEventListener('resize', resize);
            createParticles();

            function render() {
                ctx.clearRect(0, 0, w, h);
                for (let i = 0; i < particles.length; i++) {
                    const p = particles[i];
                    p.x += p.vx;
                    p.y += p.vy;
                    if (p.x < -10) p.x = w + 10;
                    if (p.x > w + 10) p.x = -10;
                    if (p.y < -10) p.y = h + 10;
                    if (p.y > h + 10) p.y = -10;
                    ctx.beginPath();
                    ctx.fillStyle = 'rgba(122,232,197,' + p.alpha + ')';
                    ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                    ctx.fill();
                }
                requestAnimationFrame(render);
            }
            render();

            function loadLottie() {
                try {
                    lottie.loadAnimation({
                        container: document.getElementById('lottie'),
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: 'https://assets7.lottiefiles.com/packages/lf20_tll0j4bb.json'
                    });
                } catch (e) {}
            }
            loadLottie();

        })();
    </script>
</body>

</html>

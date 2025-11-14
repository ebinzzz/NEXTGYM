
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXGYM - Neural Fitness Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #ffffff;
            color: #000000;
            overflow-x: hidden;
        }

        /* Animated Grid Background */
        .grid-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 0, 0, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: 0;
            pointer-events: none;
        }

        .content-wrapper {
            position: relative;
            z-index: 1;
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 1.5rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 900;
            letter-spacing: -1px;
            background: linear-gradient(135deg, #000000, #434343);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            gap: 3rem;
            list-style: none;
        }

        .nav-links a {
            color: #000;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
            transition: all 0.3s;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #000;
            transition: width 0.3s;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-cta {
            background: #000;
            color: #fff;
            padding: 0.8rem 2rem;
            border: none;
            font-weight: 600;
            cursor: pointer;
            clip-path: polygon(10% 0%, 100% 0%, 90% 100%, 0% 100%);
            transition: all 0.3s;
        }

        .nav-cta:hover {
            clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);
            transform: translateY(-2px);
        }

        /* Hero */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8rem 5% 4rem;
            position: relative;
        }

        .hero-content {
            max-width: 1400px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-text h1 {
            font-size: 5.5rem;
            font-weight: 900;
            line-height: 0.95;
            letter-spacing: -4px;
            margin-bottom: 2rem;
        }

        .hero-text .highlight {
            background: linear-gradient(135deg, #000000, #666666);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            display: inline-block;
        }

        .hero-text p {
            font-size: 1.25rem;
            color: #666;
            margin-bottom: 3rem;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 1.5rem;
        }

        .btn-hero {
            padding: 1.2rem 2.5rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #000;
            color: #fff;
            clip-path: polygon(5% 0%, 100% 0%, 95% 100%, 0% 100%);
        }

        .btn-primary:hover {
            clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);
            transform: translateY(-3px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .btn-outline {
            background: transparent;
            color: #000;
            border: 2px solid #000;
            clip-path: polygon(0% 0%, 95% 0%, 100% 100%, 5% 100%);
        }

        .btn-outline:hover {
            background: #000;
            color: #fff;
            clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);
        }

        /* Floating 3D Cards */
        .hero-visual {
            position: relative;
            height: 600px;
        }

        .floating-card {
            position: absolute;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .floating-card:nth-child(1) {
            top: 10%;
            left: 10%;
            width: 250px;
            clip-path: polygon(10% 0%, 100% 0%, 90% 100%, 0% 100%);
            animation-delay: 0s;
        }

        .floating-card:nth-child(2) {
            top: 40%;
            right: 5%;
            width: 280px;
            clip-path: polygon(0% 10%, 100% 0%, 100% 90%, 0% 100%);
            animation-delay: 2s;
        }

        .floating-card:nth-child(3) {
            bottom: 10%;
            left: 20%;
            width: 230px;
            clip-path: polygon(0% 0%, 90% 0%, 100% 100%, 10% 100%);
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        .card-number {
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
        }

        .card-label {
            font-size: 0.9rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Features Section */
        .features {
            padding: 8rem 5%;
            background: #000;
            color: #fff;
            clip-path: polygon(0 5%, 100% 0, 100% 95%, 0 100%);
        }

        .features-header {
            text-align: center;
            margin-bottom: 6rem;
        }

        .features-header h2 {
            font-size: 4rem;
            font-weight: 900;
            letter-spacing: -2px;
            margin-bottom: 1rem;
        }

        .features-header p {
            color: #999;
            font-size: 1.2rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 3rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .feature-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 3rem 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s;
        }

        .feature-item:hover::before {
            left: 100%;
        }

        .feature-item:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .feature-number {
            font-size: 1rem;
            color: #666;
            font-weight: 700;
            margin-bottom: 1.5rem;
            letter-spacing: 3px;
        }

        .feature-item h3 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .feature-item p {
            color: #999;
            line-height: 1.7;
            font-size: 1rem;
        }

        /* Stats Section */
        .stats {
            padding: 8rem 5%;
            background: #fff;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 4rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .stat-item {
            text-align: center;
            position: relative;
        }

        .stat-item::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: #000;
        }

        .stat-number {
            font-size: 4.5rem;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 1rem;
        }

        .stat-label {
            font-size: 1rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* CTA Section */
        .cta {
            padding: 10rem 5%;
            background: #f5f5f5;
            text-align: center;
            clip-path: polygon(0 10%, 100% 0, 100% 90%, 0 100%);
        }

        .cta h2 {
            font-size: 5rem;
            font-weight: 900;
            letter-spacing: -3px;
            margin-bottom: 2rem;
        }

        .cta p {
            font-size: 1.3rem;
            color: #666;
            margin-bottom: 3rem;
        }

        .cta-form {
            display: flex;
            justify-content: center;
            gap: 1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .cta-input {
            flex: 1;
            padding: 1.2rem 1.5rem;
            border: 2px solid #000;
            font-size: 1rem;
            background: #fff;
            clip-path: polygon(2% 0%, 100% 0%, 98% 100%, 0% 100%);
        }

        .cta-btn {
            padding: 1.2rem 3rem;
            background: #000;
            color: #fff;
            border: none;
            font-weight: 700;
            cursor: pointer;
            clip-path: polygon(5% 0%, 100% 0%, 95% 100%, 0% 100%);
            transition: all 0.3s;
        }

        .cta-btn:hover {
            clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);
            transform: translateY(-3px);
        }

        /* Footer */
        footer {
            background: #000;
            color: #fff;
            padding: 5rem 5% 3rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 4rem;
            max-width: 1400px;
            margin: 0 auto 4rem;
        }

        .footer-brand h3 {
            font-size: 2rem;
            font-weight: 900;
            margin-bottom: 1rem;
        }

        .footer-brand p {
            color: #999;
            line-height: 1.7;
        }

        .footer-section h4 {
            font-size: 1rem;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .footer-section a {
            display: block;
            color: #999;
            text-decoration: none;
            margin-bottom: 0.8rem;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: #fff;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #666;
        }

        @media (max-width: 1024px) {
            .hero-content {
                grid-template-columns: 1fr;
            }
            
            .hero-visual {
                display: none;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .hero-text h1 {
                font-size: 3.5rem;
            }
            
            .nav-links {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="grid-background"></div>
    
    <div class="content-wrapper">
        <nav>
            <div class="logo">NEXGYM</div>
            <ul class="nav-links">
                <li><a href="#features">FEATURES</a></li>
                <li><a href="#stats">PRICING</a></li>
                <li><a href="#contact">CONTACT</a></li>
            </ul>
            <button class="nav-cta">SIGN IN</button>
        </nav>

        <section class="hero">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>
                        SMART<br>
                        <span class="highlight">FITNESS</span><br>
                        MANAGEMENT
                    </h1>
                    <p>Modern gym management made simple. Streamline member tracking, class scheduling, automated billing, and real-time analytics in one powerful platform.</p>
                    <div class="hero-buttons">
                        <button class="btn-hero btn-primary">START FREE TRIAL</button>
                        <button class="btn-hero btn-outline">WATCH DEMO</button>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="floating-card">
                        <div class="card-number">500+</div>
                        <div class="card-label">GYMS POWERED</div>
                    </div>
                    <div class="floating-card">
                        <div class="card-number">99.9%</div>
                        <div class="card-label">UPTIME</div>
                    </div>
                    <div class="floating-card">
                        <div class="card-number">50K+</div>
                        <div class="card-label">MEMBERS</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="features" id="features">
            <div class="features-header">
                <h2>KEY FEATURES</h2>
                <p>Everything you need to run a modern fitness facility</p>
            </div>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-number">[01]</div>
                    <h3>MEMBER MANAGEMENT</h3>
                    <p>Complete member profiles with attendance tracking, membership status, contact information, and activity history at your fingertips.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-number">[02]</div>
                    <h3>CLASS SCHEDULING</h3>
                    <p>Easy-to-use calendar system for scheduling classes, managing trainers, and allowing members to book sessions online.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-number">[03]</div>
                    <h3>AUTOMATED BILLING</h3>
                    <p>Recurring payment processing, invoice generation, and membership renewal reminders. Accepts all major payment methods.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-number">[04]</div>
                    <h3>ANALYTICS DASHBOARD</h3>
                    <p>Track revenue, monitor attendance trends, and analyze member engagement with comprehensive reports and insights.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-number">[05]</div>
                    <h3>CHECK-IN SYSTEM</h3>
                    <p>Quick member check-ins with QR codes or ID cards. Track facility usage and manage access permissions efficiently.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-number">[06]</div>
                    <h3>MOBILE ACCESS</h3>
                    <p>Manage your gym from anywhere with mobile-responsive design. Members can book classes and check schedules on any device.</p>
                </div>
            </div>
        </section>

        <section class="stats" id="stats">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Active Gyms</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50K+</div>
                    <div class="stat-label">Happy Members</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">Uptime</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Support</div>
                </div>
            </div>
        </section>

        <section class="cta" id="contact">
            <h2>GET STARTED</h2>
            <p>Start your 14-day free trial. No credit card required.</p>
            <div class="cta-form">
                <input type="email" class="cta-input" placeholder="ENTER YOUR EMAIL">
                <button class="cta-btn">START TRIAL</button>
            </div>
        </section>

        <footer>
            <div class="footer-content">
                <div class="footer-brand">
                    <h3>NEXGYM</h3>
                    <p>Complete gym management software designed for modern fitness facilities. Streamline operations and grow your business.</p>
                </div>
                <div class="footer-section">
                    <h4>PRODUCT</h4>
                    <a href="#">Features</a>
                    <a href="#">Pricing</a>
                    <a href="#">Integrations</a>
                    <a href="#">Demo</a>
                </div>
                <div class="footer-section">
                    <h4>COMPANY</h4>
                    <a href="#">About Us</a>
                    <a href="#">Contact</a>
                    <a href="#">Blog</a>
                    <a href="#">Careers</a>
                </div>
                <div class="footer-section">
                    <h4>SUPPORT</h4>
                    <a href="#">Help Center</a>
                    <a href="#">Documentation</a>
                    <a href="#">Community</a>
                    <a href="#">Contact Sales</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 NEXGYM. ALL RIGHTS RESERVED.</p>
            </div>
        </footer>
    </div>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Parallax effect on hero cards
        document.addEventListener('mousemove', (e) => {
            const cards = document.querySelectorAll('.floating-card');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            cards.forEach((card, index) => {
                const speed = (index + 1) * 10;
                card.style.transform = `translate(${x * speed}px, ${y * speed}px) rotate(${x * 2}deg)`;
            });
        });

        // Counter animation
        const animateCounter = (element, target) => {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    element.textContent = Math.ceil(current).toLocaleString();
                }
            }, 20);
        };

        const observerOptions = { threshold: 0.5 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const number = entry.target.querySelector('.stat-number');
                    const text = number.textContent.replace(/,/g, '');
                    if (text.includes('M')) {
                        animateCounter(number, parseFloat(text) * 1000000);
                    } else if (text.includes('%')) {
                        number.textContent = text;
                    } else if (text.includes('/')) {
                        number.textContent = text;
                    } else {
                        animateCounter(number, parseInt(text));
                    }
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stat-item').forEach(item => observer.observe(item));
    </script>
</body>
</html>

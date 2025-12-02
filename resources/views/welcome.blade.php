<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweat2Share</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom Tailwind Configuration (Optional, but useful for defining colors) */
        :root {
            --sidebar-bg: #233D4D;
            --bg-color: #F8F9FB;
            --accent-orange: #F57E30;
            --text-light: #495E6F;
            --border-color: #e2e8f0;
            --color-text: #333333;
        }

        /* Base Styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--color-text);
            line-height: 1.6;
        }

        h1, h2, h3 {
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 2.5rem;
            color: var(--sidebar-bg);
        }
        
        section {
            padding: 4rem 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 50px; 
            font-weight: 600;
            transition: background-color 0.3s, transform 0.1s;
            text-decoration: none;
            margin-left: 10px;
        }

        .btn-dark {
            background-color: var(--accent-orange);
            color: white;
            border: 2px solid var(--accent-orange);
        }

        .btn-dark:hover {
            background-color: var(--accent-orange);
            transform: translateY(-1px);
            opacity: 0.9 ;
        }

        .btn-outline {
            background-color: transparent;
            color: var(--accent-orange);
            border: 2px solid var(--accent-orange);
        }

        .btn-outline:hover {
            background-color: var(--accent-orange);
            color: white;
            transform: translateY(-1px);
        }

        .btn-small {
            background-color: var(--bg-color);
            color: var(--accent-orange);
            border: 1px solid var(--accent-orange);
            padding: 5px 15px;
            border-radius: 5px;
            font-size: 0.8rem;
            display: inline-block;
            margin-top: 10px;
        }

        /* Header / Navigation */
        header {
            padding: 1.5rem 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .nav-links a {
            color: var(--color-text);
            margin: 0 15px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--accent-orange);
        }

        .nav-links .fa-search {
            margin-left: 15px;
            cursor: pointer;
            color: #555;
        }

        /* Hero Section */
        .hero {
            padding: 6rem 0;
            background: linear-gradient(135deg, var(--bg-color) 0%, #E3E7EB 100%);
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .hero-content {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .hero-text {
            max-width: 500px;
        }
        
        /* Placeholder Bar Animation (for visual effect) */
        .bar {
            background-color: var(--sidebar-bg);
            height: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            animation: pulse-bar 2s infinite ease-in-out;
            opacity: 0.8;
        }
        .bar.thick {
            height: 40px;
            background-color: var(--sidebar-bg);
        }
        .bar.thin {
            height: 15px;
            background-color: #666;
            width: 80%;
        }

        @keyframes pulse-bar {
            0% { opacity: 0.8; }
            50% { opacity: 1; }
            100% { opacity: 0.8; }
        }

        .hero-img {
            width: 100%;
            height: 300px;
            background-color: #ccc; /* Placeholder background */
            border-radius: 15px;
            background-image: url('https://placehold.co/500x300/F4F7F9/0A1C2B?text=Hero+Image+of+Runners');
            background-size: cover;
            background-position: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        @media (min-width: 768px) {
            .hero-img {
                width: 50%;
                height: 400px;
            }
        }

        .hero-buttons {
            margin-top: 30px;
        }

        /* About Section */
        .about-section h3 {
            font-size: 1.5rem;
            color: var(--accent-orange);
        }
        
        .about-row {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            margin-bottom: 3rem;
            padding: 2rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        
        .about-section .about-row:nth-child(even) {
            flex-direction: column-reverse; /* Reverses order on mobile for alternating layout */
        }

        @media (min-width: 768px) {
            .about-row {
                flex-direction: row;
            }
            .about-section .about-row:nth-child(even) {
                flex-direction: row-reverse;
            }
        }
        
        .about-text {
            flex: 1;
            padding: 1rem;
        }
        
        .about-img {
            flex: 1;
            width: 100%;
            height: 250px;
            background-color: #E0E4E7;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
            color: #555;
        }

        /* Impact Numbers Section */
        .grid-3 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }
        @media (min-width: 640px) {
            .grid-3 {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .number-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .number-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .number-card h3 {
            font-size: 2.5rem;
            color: var(--accent-orange);
            margin-bottom: 0;
            line-height: 1;
        }

        /* Highlights */
        .highlight-img {
            width: 100%;
            height: 300px;
            background-color: #E0E4E7;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3rem;
            color: #555;
            margin-top: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .highlight-labels span {
            display: inline-block;
            background-color: var(--accent-orange);
            color: white;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            margin: 15px 5px 0 5px;
        }

        /* Testimonials */
        .testimonial-card {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            text-align: center;
        }

        .testimonial-img {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px auto;
            border-radius: 50%;
            background-color: #E0E4E7;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            color: #555;
        }

        .testimonial-quote {
            font-style: italic;
            color: #555;
            margin-bottom: 10px;
        }
        .author {
            font-weight: 700;
            color: var(--sidebar-bg);
            margin-bottom: 0;
        }
        .role {
            font-size: 0.8rem;
            color: var(--accent-orange);
        }

        /* News Preview */
        .news-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            text-align: center;
        }

        .news-circle {
            width: 100px;
            height: 100px;
            margin: 0 auto 15px auto;
            border-radius: 50%;
            background-color: #E0E4E7;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
            color: #555;
        }

        .news-btn {
            color: var(--accent-orange);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 10px;
        }

        /* Partners Section (Full Width) */
        .partners {
            background-color: var(--sidebar-bg);
            padding: 3rem 0;
            margin-top: 4rem;
        }

        .logo-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }
        @media (min-width: 640px) {
             .logo-grid {
                grid-template-columns: repeat(6, 1fr);
            }
        }

        .logo-grid i {
            color: #999;
            font-size: 2.5rem;
            opacity: 0.7;
        }
        
        /* Reviews Secondary Grid */
        .reviews-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-top: 4rem;
        }
        @media (min-width: 768px) {
            .reviews-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .review-box {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid var(--accent-orange);
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .review-box .stars {
            color: gold;
            margin-bottom: 5px;
        }

        /* CTA Section */
        .cta-section {
            background-color: var(--accent-orange);
            padding: 4rem 2rem;
            border-radius: 15px;
            margin-top: 4rem;
            color: white;
            text-align: center;
        }
        .cta-section h2 {
            color: white;
            margin-bottom: 20px;
            font-size: 2rem;
        }
        .cta-section .btn-dark {
            background-color: white;
            color: var(--accent-orange);
            border-color: white;
        }
        .cta-section .btn-dark:hover {
            background-color: #f0f0f0;
        }

        /* Contact Section */
        .contact-section {
            padding: 4rem 0;
        }

        .contact-wrapper {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }
        @media (min-width: 768px) {
            .contact-wrapper {
                flex-direction: row;
            }
        }

        .contact-info, .contact-form {
            flex: 1;
        }

        .contact-info p {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: #555;
        }

        .contact-info i {
            margin-right: 10px;
            color: var(--accent-orange);
        }

        .contact-form form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
            font-size: 0.85rem;
        }

        .contact-form input, .contact-form textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.2s;
            outline: none;
            width: 100%;
        }

        .contact-form input:focus, .contact-form textarea:focus {
            border-color: var(--accent-orange);
        }

        .contact-form textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        /* Footer */
        footer {
            padding: 3rem 0 1rem 0;
            border-top: 1px solid #e0e0e0;
        }

        .footer-top {
            display: flex;
            flex-direction: column;
            gap: 40px;
            margin-bottom: 20px;
        }
        @media (min-width: 768px) {
            .footer-top {
                flex-direction: row;
                justify-content: space-between;
                align-items: flex-start;
            }
        }

        .footer-left {
            max-width: 300px;
        }

        .newsletter-box {
            display: flex;
            margin-top: 10px;
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .newsletter-box input {
            padding: 8px 10px;
            border: none;
            flex-grow: 1;
            font-size: 0.9rem;
            outline: none;
        }
        
        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .footer-links a {
            color: #555;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .footer-links a:hover {
            color: var(--accent-orange);
        }

        .socials {
            display: flex;
            gap: 10px;
            margin-top: 5px;
        }

        .social-icon {
            width: 30px;
            height: 30px;
            background-color: #e0e0e0;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--sidebar-bg);
            font-size: 0.8rem;
            transition: background-color 0.2s, color 0.2s;
            cursor: pointer;
        }

        .social-icon:hover {
            background-color: var(--accent-orange);
            color: white;
        }

        .copyright {
            text-align: center;
            font-size: 0.75rem;
            color: #777;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        /* Utility for placeholders */
        .placeholder-img {
            background-color: #E0E4E7;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #555;
        }
        
        /* Responsive adjustments for header */
        @media (max-width: 767px) {
            .nav-links, .nav-actions .btn-outline {
                display: none; /* Hide navigation links and outline button on mobile */
            }
            header {
                padding: 1rem 0;
            }
            .nav-actions {
                gap: 10px;
            }
            .nav-actions .btn-dark {
                padding: 8px 12px;
                font-size: 0.8rem;
                margin-left: 0;
            }
            /* Contact form single column on mobile */
            .form-row {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <!-- Header et premières sections dans un premier container -->
    <div class="container">
        <header class="flex justify-between items-center">
            <div class="logo">
                <img src="{{ asset('Images/primary_logo.svg') }}" alt="Logo" style="height: 50px;">
            </div>
            <div class="flex items-center nav-actions">
                <div class="nav-links flex items-center">
                    <a href="#">All pages <i class="fas fa-chevron-down" style="font-size:0.7rem;"></i></a>
                    <a href="#">Contact</a>
                    <i class="fas fa-search"></i>
                </div>
                <!-- LIENS DYNAMIQUES LARAVEL (Simulated) -->
                <a href="#" class="btn btn-outline" style="border-radius: 5px; padding: 5px 15px;">Login</a>
                <a href="#" class="btn btn-dark">Get Involved</a>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <div class="hero-text">
                    <div class="bar thick" style="width: 85%;"></div>
                    <div class="bar thick" style="width: 90%;"></div>
                    <div class="bar thick" style="width: 60%"></div>
                    <br>
                    <div class="bar thin" style="width: 70%;"></div>
                    <div class="bar thin" style="width: 75%;"></div>
                    
                    <div class="hero-buttons">
                        <a href="#" class="btn btn-dark">Get involved &rarr;</a>
                        <a href="#" class="btn btn-outline">Learn more</a>
                    </div>
                </div>
                <div class="hero-img"></div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section text-center">
            <h2>About Sweat2Share</h2>
            
            <div class="about-row">
                <div class="about-text text-left" style="text-align: left;">
                    <h3>Vision</h3>
                    <p style="color: #666; margin-top: 10px;">To create a globally accessible platform where every stride taken generates meaningful, trackable donations for vital causes.</p>
                    <a href="#" class="btn-small">More info</a>
                </div>
                <div class="placeholder-img about-img"><i class="fas fa-eye"></i></div>
            </div>

            <div class="about-row">
                <div class="about-text text-left" style="text-align: left;">
                    <h3>Mission</h3>
                    <p style="color: #666; margin-top: 10px;">To seamlessly integrate fitness tracking, engaging challenges, and direct financial impact to maximize charitable giving with zero overhead costs.</p>
                    <a href="#" class="btn-small">More info</a>
                </div>
                <div class="placeholder-img about-img"><i class="fas fa-hands-helping"></i></div>
            </div>

            <div class="about-row">
                <div class="about-text text-left" style="text-align: left;">
                    <h3>Team</h3>
                    <p style="color: #666; margin-top: 10px;">We are a dedicated group of developers, athletes, and humanitarians committed to transparency and fitness for a cause.</p>
                    <a href="#" class="btn-small">Contact</a>
                </div>
                <div class="placeholder-img about-img"><i class="fas fa-users"></i></div>
            </div>
        </section>

        <!-- Impact Section -->
        <section class="numbers-section text-center">
            <h2>Our impact in numbers</h2>
            <div class="grid grid-3">
                <div class="number-card">
                    <div class="placeholder-img" style="width: 50px; height: 50px; margin: 0 auto; border-radius: 10px; font-size: 1.5rem;"><i class="fas fa-hand-holding-usd"></i></div>
                    <p style="margin-top:10px; font-size: 0.9rem;">Donations</p>
                    <h3>15k TND</h3>
                </div>
                <div class="number-card">
                    <div class="placeholder-img" style="width: 50px; height: 50px; margin: 0 auto; border-radius: 10px; font-size: 1.5rem;"><i class="fas fa-user-friends"></i></div>
                    <p style="margin-top:10px; font-size: 0.9rem;">Participants</p>
                    <h3>100k+</h3>
                </div>
                <div class="number-card">
                    <div class="placeholder-img" style="width: 50px; height: 50px; margin: 0 auto; border-radius: 10px; font-size: 1.5rem;"><i class="fas fa-running"></i></div>
                    <p style="margin-top:10px; font-size: 0.9rem;">Challenges</p>
                    <h3>12k+</h3>
                </div>
            </div>
        </section>

        <!-- Highlights -->
        <section class="mt-4 text-center">
            <h2>Program highlights</h2>
            <div class="placeholder-img highlight-img"><i class="fas fa-map-marked-alt"></i></div>
            <div class="highlight-labels">
                <span>Cycle marathon</span>
                <span>Running marathon</span>
                <span>Training courses</span>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="mt-4 text-center">
            <h2>What our participants say</h2>
            <div class="grid grid-3">
                <div class="testimonial-card">
                    <div class="placeholder-img testimonial-img"><i class="fas fa-quote-left"></i></div>
                    <p class="testimonial-quote">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore."</p>
                    <p class="author">Lahmar Fatima</p>
                    <p class="role">Student</p>
                </div>
                <div class="testimonial-card">
                    <div class="placeholder-img testimonial-img"><i class="fas fa-quote-left"></i></div>
                    <p class="testimonial-quote">"Ultrices eros in cursus turpis massa tincidunt dui ut ornare lectus sit amet est."</p>
                    <p class="author">Fayedhi Aymen</p>
                    <p class="role">Engineer</p>
                </div>
                <div class="testimonial-card">
                    <div class="placeholder-img testimonial-img"><i class="fas fa-quote-left"></i></div>
                    <p class="testimonial-quote">"Convallis posuere morbi leo urna molestie at elementum eu facilisis sapien pellentesque."</p>
                    <p class="author">Sabri Rayen</p>
                    <p class="role">CEO Yogamax</p>
                </div>
            </div>
        </section>

        <!-- News Preview -->
        <section class="mt-4 text-center">
            <h2>News Preview</h2>
            <div class="grid grid-3">
                <div class="news-card">
                    <div class="placeholder-img news-circle"><i class="fas fa-trophy"></i></div>
                    <h4>First marathon</h4>
                    <a href="#" class="news-btn">Learn more</a>
                </div>
                <div class="news-card">
                    <div class="placeholder-img news-circle"><i class="fas fa-calendar-alt"></i></div>
                    <h4>Next challenge</h4>
                    <a href="#" class="news-btn">Learn more</a>
                </div>
                <div class="news-card">
                    <div class="placeholder-img news-circle"><i class="fas fa-heartbeat"></i></div>
                    <h4>New impact</h4>
                    <a href="#" class="news-btn">Learn more</a>
                </div>
            </div>
        </section>
    </div>

    <!-- Partners (Section pleine largeur, en dehors du container principal) -->
    <section class="partners">
        <div class="container">
            <h5 style="color: white; margin-bottom: 20px;">Our partners</h5>
            <div class="logo-grid">
                <i class="fas fa-mountain"></i>
                <i class="fas fa-fire"></i>
                <i class="fas fa-tree"></i>
                <i class="fas fa-plane"></i>
                <i class="fas fa-car"></i>
                <i class="fas fa-bicycle"></i>
            </div>
        </div>
    </section>

    <!-- Sections de fin de page et Footer, dans un nouveau container -->
    <div class="container">
        <!-- Reviews (Secondary) -->
        <div class="reviews-grid">
            <div class="review-box">
                <div class="stars">★★★★★</div>
                <p style="font-size: 0.8rem; color: #777; margin-bottom: 5px;">"Definitely one of the best platforms in town! Making a difference while staying active."</p>
                <p style="font-weight: bold;">Jack Smith</p>
            </div>
            <div class="review-box">
                <div class="stars">★★★★★</div>
                <p style="font-size: 0.8rem; color: #777; margin-bottom: 5px;">"A unique and transparent way to combine fitness goals with charitable giving."</p>
                <p style="font-weight: bold;">Elise Dubois</p>
            </div>
            <div class="review-box">
                <div class="stars">★★★★★</div>
                <p style="font-size: 0.8rem; color: #777; margin-bottom: 5px;">"Simple to use, great motivation, and the impact tracking is excellent."</p>
                <p style="font-weight: bold;">Ahmed Khalef</p>
            </div>
        </div>

        <!-- CTA -->
        <section class="cta-section">
            <h2>Ready to go next level?</h2>
            <a href="#" class="btn btn-dark">Get involved today</a>
        </section>

        <!-- Contact -->
        <section class="contact-section">
            <div class="contact-wrapper">
                <div class="contact-info">
                    <p style="font-size: 0.7rem; font-weight: bold; letter-spacing: 1px; color: #555;">CONTACT US</p>
                    <h2>Get in touch today</h2>
                    <br>
                    <p><i class="far fa-envelope"></i> INFO@SWEAT2SHARE.COM</p>
                    <p><i class="fas fa-phone"></i> 00 216 92 92 58</p>
                    <p><i class="fas fa-map-marker-alt"></i> MANOUBA,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TUNISIA</p>
                </div>
                <div class="contact-form">
                    <form onsubmit="event.preventDefault(); alert('Message sent successfully!');">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" placeholder="Jane Doe" required>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="tel" placeholder="(123) 456 - 789">
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label>Email</label>
                            <input type="email" placeholder="jane@example.com" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label>Message</label>
                            <textarea placeholder="Please type your message here..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark" style="border-radius: 50px; padding: 10px 20px; font-size: 0.8rem;">Send message</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer>
            <div class="footer-top">
                <div class="footer-left">
                    <img src="{{ asset('Images/primary_logo.svg') }}" alt="Logo" style="height: 50px;">
                    <p style="font-size: 0.8rem; margin-top: 10px;">Subscribe to our newsletter</p>
                    <div class="newsletter-box">
                        <input type="email" placeholder="Email address">
                        <button class="btn btn-dark" style="padding: 5px 15px; font-size: 0.7rem; border-radius: 0 5px 5px 0;">Subscribe</button>
                    </div>
                    <p style="font-size: 0.8rem; margin-top: 15px;">Follow us</p>
                    <div class="socials">
                        <div class="social-icon"><i class="fab fa-facebook-f"></i></div>
                        <div class="social-icon"><i class="fab fa-twitter"></i></div>
                        <div class="social-icon"><i class="fab fa-instagram"></i></div>
                        <div class="social-icon"><i class="fab fa-linkedin-in"></i></div>
                        <div class="social-icon"><i class="fab fa-youtube"></i></div>
                    </div>
                </div>
                <div class="footer-links">
                    <a href="#">About</a>
                    <a href="#">Platform</a>
                    <a href="#">Support</a>
                    <a href="#">Blog</a>
                    <a href="#">Careers</a>
                </div>
            </div>
            <p class="copyright">Copyright &copy; 2023 Sweat2Share | All Rights Reserved | Terms and Conditions | Privacy Policy</p>
        </footer>
    </div>
    <!-- Simple alert function for demo purposes -->
    <script>
        function alert(message) {
            const container = document.createElement('div');
            container.style.cssText = 'position:fixed; top:20px; right:20px; padding:15px; background:var(--accent-orange); color:white; border-radius:8px; z-index:1000; box-shadow:0 4px 10px rgba(0,0,0,0.2);';
            container.textContent = message;
            document.body.appendChild(container);
            setTimeout(() => {
                container.remove();
            }, 3000);
        }
    </script>
</body>
</html>
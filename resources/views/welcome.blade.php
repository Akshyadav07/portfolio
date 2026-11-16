<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio | Laravel Developer</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- HEADER -->
    <header class="header">
        <div class="container navbar">

            <a href="#home" class="logo">My<span>Portfolio.</span></a>

            <nav class="nav-menu">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#skills">Skills</a>
                <a href="#education">Education</a>
                <a href="#experience">Experience</a>
                <a href="#projects">Projects</a>
                <a href="#services">Services</a>
                <a href="#contact" class="contact-btn">Contact</a>
            </nav>

        </div>
    </header>


    <!-- HOME SECTION -->
    <section id="home" class="home section">

        <div class="container home-content">

            <div class="home-text">
                <p class="welcome">WELCOME TO MY PORTFOLIO</p>

                <h1>Hello, I'm <span>Your Name</span></h1>

                <h2>PHP Laravel Developer</h2>

                <p>
                    I build secure, scalable and dynamic web applications
                    using modern technologies.
                </p>

                <div class="home-buttons">
                    <a href="#projects" class="btn">View Projects</a>
                    <a href="#contact" class="btn btn-outline">Contact Me</a>
                </div>
            </div>

            <div class="home-image">
                <img src="assets/images/profile.png" alt="My Profile">
            </div>

        </div>

    </section>


    <!-- ABOUT SECTION -->
    <section id="about" class="section">
        <div class="container">

            <div class="section-title">
                <p>GET TO KNOW ME</p>
                <h2>About <span>Me</span></h2>
            </div>

            <div class="about-content">
                <div class="about-image">
                    <img src="assets/images/profile.png" alt="About Me">
                </div>

                <div class="about-text">
                    <h3>I'm a PHP Laravel Developer</h3>

                    <p>
                        I am passionate about backend development and
                        building dynamic web applications.
                    </p>

                    <p>
                        I enjoy working with PHP, Laravel, MySQL and
                        modern web technologies.
                    </p>

                    <a href="#contact" class="btn">Let's Connect</a>
                </div>
            </div>

        </div>
    </section>


    <!-- SKILLS SECTION -->
    <section id="skills" class="section">
        <div class="container">

            <div class="section-title">
                <p>MY EXPERTISE</p>
                <h2>Technical <span>Skills</span></h2>
            </div>

            <div class="skills-grid">

                <div class="skill-card">
                    <h3>PHP</h3>
                    <p>Backend Programming</p>
                </div>

                <div class="skill-card">
                    <h3>Laravel</h3>
                    <p>PHP Framework</p>
                </div>

                <div class="skill-card">
                    <h3>MySQL</h3>
                    <p>Database Management</p>
                </div>

                <div class="skill-card">
                    <h3>JavaScript</h3>
                    <p>Frontend Interactivity</p>
                </div>

                <div class="skill-card">
                    <h3>HTML5</h3>
                    <p>Web Structure</p>
                </div>

                <div class="skill-card">
                    <h3>CSS3</h3>
                    <p>Web Designing</p>
                </div>

            </div>

        </div>
    </section>


    <!-- EDUCATION SECTION -->
    <section id="education" class="section">
        <div class="container">

            <div class="section-title">
                <p>MY QUALIFICATIONS</p>
                <h2>My <span>Education</span></h2>
            </div>

            <div class="timeline-card">
                <h3>Bachelor of Technology</h3>
                <p>Computer Science Engineering</p>
                <p>College Name</p>
                <span>2022 - 2026</span>
            </div>

        </div>
    </section>


    <!-- EXPERIENCE SECTION -->
    <section id="experience" class="section">
        <div class="container">

            <div class="section-title">
                <p>MY JOURNEY</p>
                <h2>Work <span>Experience</span></h2>
            </div>

            <div class="timeline-card">
                <h3>PHP Laravel Developer</h3>
                <p>Company Name</p>
                <p>Worked on backend development and web applications.</p>
                <span>Internship / Job Duration</span>
            </div>

        </div>
    </section>


    <!-- PROJECTS SECTION -->
    <section id="projects" class="section">
        <div class="container">

            <div class="section-title">
                <p>MY RECENT WORK</p>
                <h2>My <span>Projects</span></h2>
            </div>

            <div class="projects-grid">

                <div class="project-card">
                    <h3>AI E-Book Builder</h3>
                    <p>AI-powered ebook creation platform.</p>
                    <a href="#">View Project ↗</a>
                </div>

                <div class="project-card">
                    <h3>Business Management</h3>
                    <p>Dynamic business management application.</p>
                    <a href="#">View Project ↗</a>
                </div>

                <div class="project-card">
                    <h3>Portfolio CMS</h3>
                    <p>Dynamic personal portfolio website.</p>
                    <a href="#">View Project ↗</a>
                </div>

            </div>

        </div>
    </section>


    <!-- SERVICES SECTION -->
    <section id="services" class="section">
        <div class="container">

            <div class="section-title">
                <p>WHAT I OFFER</p>
                <h2>My <span>Services</span></h2>
            </div>

            <div class="services-grid">

                <div class="service-card">
                    <h3>Backend Development</h3>
                    <p>Secure and scalable backend applications.</p>
                </div>

                <div class="service-card">
                    <h3>Web Development</h3>
                    <p>Dynamic and responsive web applications.</p>
                </div>

                <div class="service-card">
                    <h3>API Development</h3>
                    <p>REST API development and integration.</p>
                </div>

            </div>

        </div>
    </section>


    <!-- CONTACT SECTION -->
    <section id="contact" class="section">
        <div class="container">

            <div class="section-title">
                <p>GET IN TOUCH</p>
                <h2>Contact <span>Me</span></h2>
            </div>

            <form class="contact-form">

                <input type="text" placeholder="Your Name" required>

                <input type="email" placeholder="Your Email" required>

                <input type="text" placeholder="Subject" required>

                <textarea rows="6" placeholder="Your Message" required></textarea>

                <button type="submit" class="btn">Send Message</button>

            </form>

        </div>
    </section>


    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <p>© 2026 Your Name. All Rights Reserved.</p>
        </div>
    </footer>

</body>
<script src="assets/js/script.js"></script>

</html>
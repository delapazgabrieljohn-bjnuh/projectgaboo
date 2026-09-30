<?php
require_once 'db.php';

$alertMessage = '';
$alertType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!empty($fullname) && !empty($email) && !empty($subject) && !empty($message)) {
        try {
            $stmt = $conn->prepare("INSERT INTO contacts (fullname, email, subject, message) VALUES (:fullname, :email, :subject, :message)");
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':message', $message);

            if ($stmt->execute()) {
                $alertType = 'success';
                $alertMessage = 'Thank you! Your submission has been saved successfully.';
            } else {
                $alertType = 'danger';
                $alertMessage = 'Failed to submit your message. Please try again.';
            }
        } catch (PDOException $e) {
            $alertType = 'danger';
            $alertMessage = 'Error: ' . $e->getMessage();
        }
    } else {
        $alertType = 'warning';
        $alertMessage = 'Please fill out all required fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My 2026 TikTok Meme Archive | Personal Video Collection</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }
        section {
            padding: 80px 0;
        }
        .hero-section {
            padding: 120px 0 80px 0;
            background: linear-gradient(135deg, #000000 0%, #111827 100%);
        }
        .month-header {
            border-left: 5px solid #fe2c55;
            padding-left: 15px;
        }
        .clip-video-frame {
            aspect-ratio: 9 / 16;
            display: block;
            overflow: hidden;
            position: relative;
            width: 100%;
        }
        .clip-video-frame > img,
        .clip-video-frame > iframe {
            height: 100%;
            inset: 0;
            position: absolute;
            width: 100%;
        }
        .clip-video-frame > img {
            object-fit: cover;
        }
        .clip-play {
            align-items: center;
            background: rgba(0, 0, 0, 0.75);
            border-radius: 50%;
            color: #fff;
            display: flex;
            font-size: 2rem;
            height: 64px;
            justify-content: center;
            left: 50%;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 64px;
        }
        .clip-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .clip-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
        }
    </style>
</head>
<body data-bs-spy="scroll" data-bs-target="#main-navbar" data-bs-offset="100">

    <!-- 1. Top Bar / Navigation -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-danger" href="#home">
                <i class="bi bi-tiktok me-2"></i>My TikTok Archive 2026
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto fw-semibold">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#products">Monthly Vault</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 2. Home Section -->
    <section id="home" class="hero-section text-white">
        <div class="container text-center py-5">
            <span class="badge bg-danger px-3 py-2 rounded-pill fw-bold mb-3">PERSONALLY CURATED VIDEO ARCHIVE</span>
            <h1 class="display-4 fw-bold mb-3">My 2026 TikTok Meme Archive</h1>
            <p class="lead col-md-8 mx-auto text-light opacity-75 mb-4">
                Every video here is a Filipino meme or clip I personally chose for its place in Filipino internet culture.
            </p>
            <a href="#products" class="btn btn-danger btn-lg fw-bold me-2"><i class="bi bi-play-circle me-2"></i>Explore My Collection</a>
            <a href="#contact" class="btn btn-outline-light btn-lg">Suggest a Clip</a>
        </div>
    </section>

    <!-- 3. Services Section -->
    <section id="services" class="bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Our Services</h2>
                <p class="text-muted">Short-form video editing, clip curation, and social media trend research.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="display-5 text-danger mb-3"><i class="bi bi-camera-reels"></i></div>
                        <h5 class="card-title fw-bold">Short-Form Clip Curation</h5>
                        <p class="card-text text-muted">Tracking and archiving high-retention TikTok, Shorts, and Reels trends for content creators.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="display-5 text-danger mb-3"><i class="bi bi-aspect-ratio"></i></div>
                        <h5 class="card-title fw-bold">9:16 Re-Formatting & VFX</h5>
                        <p class="card-text text-muted">Optimizing raw video into engaging 9:16 vertical clips complete with animated captions and sound effects.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="display-5 text-danger mb-3"><i class="bi bi-graph-up-arrow"></i></div>
                        <h5 class="card-title fw-bold">Trend Analytics</h5>
                        <p class="card-text text-muted">Analyzing audio trends and viral formats to help brands stay ahead in social media marketing.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Products Section (Monthly Meme Vault 2026) -->
    <section id="products">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">My 2026 Monthly Meme Collection</h2>
                <p class="text-muted">A month-by-month collection of Filipino memes and clips that I consider culturally significant.</p>
            </div>

            <?php
            $monthsData = [
                "January 2026" => [
                    ["title" => "Anong goal mo ngayong 2026?", "desc" => "My ultimate goal in my life is to achieve my goals.", "badge" => "Goals", "video_url" => "https://www.tiktok.com/@mrc9269/video/7590623663980924168", "cover" => "assets/january-meme-cover.jpg"],
                    ["title" => "Kei Birthday", "desc" => "HBD Kei", "badge" => "Happy Birthday Kei", "video_url" => "https://www.tiktok.com/@raeinhyer/video/7591536065069059348", "cover" => "assets/january-meme-2-cover.jpg"],
                ],
                "February 2026" => [
                    ["title" => "Linda Walker Meme", "desc" => "A young student discovers she may be the long-lost daughter of a wealthy family.", "badge" => "Drama", "video_url" => "https://www.tiktok.com/@freereels.ph/video/7609436489251998984", "cover" => "assets/february-meme-1-cover.jpg"],
                ],
                "March 2026" => [
                    ["title" => "Hawak Mo Ang Beat", "desc" => "Dance edits featuring the Hawak Mo Ang Beat trend.", "badge" => "Dance Trend", "video_url" => "https://www.tiktok.com/@jode.aep/video/7616951402992012545", "cover" => "assets/march-meme-1-cover.jpg"],
                    ["title" => "ANO TARA", "desc" => "A relatable clip about thoughts that just won't stay quiet.", "badge" => "Relatable", "video_url" => "https://www.tiktok.com/@aldriandeleon/video/7615927458201652488", "cover" => "assets/march-meme-2-cover.jpg"],
                    ["title" => "Jisontitom", "desc" => "Welcome back, Titom!", "badge" => "Meme", "video_url" => "https://www.tiktok.com/@k_mikee_/photo/7614709968746319122", "cover" => "assets/march-meme-3-cover.jpg"]
                ],
                "April 2026" => [
                    ["title" => "Gooding", "desc" => "A meme take on the 'Bading o Lalaki' Gooding version.", "badge" => "Meme", "video_url" => "https://www.tiktok.com/@arknox.official/video/7629247963381927176", "cover" => "assets/april-meme-1-cover.jpg"],
                    ["title" => "Goodness Gracious", "desc" => "Goodness gracious ka talaga, Girly!", "badge" => "GGBT", "video_url" => "https://www.tiktok.com/@abscbnpr/video/7620644574280666388", "cover" => "assets/april-meme-2-cover.jpg"],
                    ["title" => "Batangina Song", "desc" => "The full song from Batang Ina Jean. So proud of you, Jean!", "badge" => "Meme", "video_url" => "https://www.tiktok.com/@cutemayei/video/7622217099024305415", "cover" => "assets/july-meme-3-cover.jpg"]
                ],
                "May 2026" => [
                    ["title" => "Bato: Kung Di Ako Pumapasok, Hinahanap N'yo Ako", "desc" => "A humorous Bato Dela Rosa edit about being noticed when he is absent.", "badge" => "Meme", "video_url" => "https://www.tiktok.com/@diisleee/video/7639343431252249863", "cover" => "assets/may-meme-1-cover.jpg"],
                ],
                "June 2026" => [
                    ["title" => "Sharmaine", "desc" => "Gawan yan ng paraan.", "badge" => "Meme", "video_url" => "https://www.tiktok.com/@eko06004/video/7626359299970780436", "cover" => "assets/june-meme-1-cover.jpg"],
                    ["title" => "JBSuarez Nakakainis Ka Eh", "desc" => "A JBSuarez meme about being seriously annoying.", "badge" => "Meme", "video_url" => "https://www.tiktok.com/@sselfcontrolover911/video/7651519733077904658", "cover" => "assets/june-meme-2-cover.jpg"],
                    ["title" => "Bea Alonzo", "desc" => "A Bea Alonzo meme set to the 'chai chai chai again' audio.", "badge" => "Meme", "video_url" => "https://www.tiktok.com/@wetbaddie01/video/7647718423408971026", "cover" => "assets/june-meme-3-cover.jpg"]
                ],
                "July 2026" => [
                    ["title" => "Ngayon Tayo Ay Magluluto Na", "desc" => "A lucky meme featuring the 'Ngayon Tayo Ay Magluluto Na' trend.", "badge" => "Meme", "video_url" => "https://www.tiktok.com/@_caileng/video/7657190222668762389", "cover" => "assets/july-meme-1-cover.jpg"],
                    ["title" => "Kain", "desc" => "Vice Ganda's foodie era in a playful food-trip meme.", "badge" => "Foodie Meme", "video_url" => "https://www.tiktok.com/@mimacaguicla/video/7661140163132804373", "cover" => "assets/july-meme-2-cover.jpg"],
                    ["title" => "4 Signs", "desc" => "A funny school performance with a dramatic sabayang pagbigkas.", "badge" => "School Meme", "video_url" => "https://www.tiktok.com/@hanikanikani/video/7662363018625322261", "cover" => "assets/july-meme-3-4-signs-cover.jpg"]
                ],
                "August 2026" => [
                    ["title" => "Avisala Fhukerat", "desc" => "A meme edit using the Avisala trend.", "badge" => "Meme", "video_url" => "https://www.tiktok.com/@poot0180/video/7665325073460481300", "cover" => "assets/august-meme-1-cover.jpg"],
                ],
                "September 2026" => [
                    ["title" => "Jose Mari Chan", "desc" => "A Jose Mari Chan edit welcoming the Ber months.", "badge" => "Ber Months", "video_url" => "https://www.tiktok.com/@rhexzm_/video/7678913043413208340", "cover" => "assets/september-meme-1-cover.jpg"],
                    ["title" => "Puede Nang Mangarap", "desc" => "Sing along to Lyca Gairanod's song and join the trend.", "badge" => "Viral Audio", "video_url" => "https://www.tiktok.com/@umgph/video/7686694454366965012", "cover" => "assets/september-meme-2-cover.jpg"],
                ]
            ];

            foreach ($monthsData as $month => $clips):
            ?>
                <div class="mb-5">
                    <h3 class="fw-bold month-header text-dark mb-4"><?= htmlspecialchars($month) ?></h3>
                    <div class="row g-4 justify-content-center">
                        <?php foreach ($clips as $clip): ?>
                            <div class="col-md-4">
                                <div class="card h-100 shadow-sm border-0 clip-card overflow-hidden">
                                    <a class="clip-video-frame bg-black text-decoration-none" href="<?= htmlspecialchars($clip['video_url']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Watch <?= htmlspecialchars($clip['title']) ?> on TikTok">
                                        <img src="<?= htmlspecialchars($clip['cover']) ?>" alt="Cover for <?= htmlspecialchars($clip['title']) ?>">
                                        <span class="clip-play">
                                            <i class="bi bi-play-fill fs-1" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                    <div class="card-body">
                                        <span class="badge bg-danger mb-2"><?= htmlspecialchars($clip['badge']) ?></span>
                                        <h5 class="card-title fw-bold"><?= htmlspecialchars($clip['title']) ?></h5>
                                        <p class="card-text text-muted"><?= htmlspecialchars($clip['desc']) ?></p>
                                        <a href="<?= htmlspecialchars($clip['video_url']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-tiktok me-1" aria-hidden="true"></i> Watch on TikTok
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="p-5 bg-dark text-white text-center rounded-3 shadow-sm mb-4">
                <i class="bi bi-clock-history display-4 text-danger mb-3 d-block"></i>
                <h3 class="fw-bold">Q4 2026 (October – December)</h3>
                <p class="text-light opacity-75 col-md-6 mx-auto mb-0">
                    This section is still taking shape. I will add October to December clips that I find worth preserving.
                </p>
            </div>

        </div>
    </section>

    <!-- 5. About Us Section -->
    <section id="about" class="bg-light">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <img src="https://via.placeholder.com/600x400/000000/ffffff?text=TikTok+Archive+Developer" class="img-fluid rounded-3 shadow" alt="Developer Workstation">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-3">About the Curator</h2>
                    <p class="lead text-danger fw-semibold">Web Developer & Video Curator</p>
                    <p class="text-muted">
                        Hello! I am an Information Technology student who enjoys collecting Filipino memes and clips that capture our internet culture.
                    </p>
                    <p class="text-muted">
                        Every video featured here is part of my personal selection of Filipino memes and clips, organized month by month.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Contact Us Section -->
    <section id="contact">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Suggest a Clip</h2>
                <p class="text-muted">Know a Filipino meme or clip that belongs in this collection? Send me the link and why it matters to you.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <?php if (!empty($alertMessage)): ?>
                        <div class="alert alert-<?= $alertType ?> alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($alertMessage) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="#contact" method="POST" class="card p-4 shadow-sm border-0">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fullname" class="form-label fw-semibold">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Gabriel Dela Paz" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label fw-semibold">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Video suggestion" required>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label fw-semibold">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Share the video link and why it belongs in the collection..." required></textarea>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-danger btn-lg px-4"><i class="bi bi-send me-2"></i>Send Suggestion</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 text-center">
        <div class="container">
            <small class="opacity-75">&copy; <?= date('Y') ?> My Personal TikTok Meme Archive.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
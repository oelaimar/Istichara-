<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lawyer Profile</title>
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-pbPskwz+tb+8zZsZg5X7sF+GpZ2U7m0y1s3Tp1T03ZZ3lLkV/3j3X6m6KkMl2N1RZ/P2QqgtrT4N06U8i5iRbg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /* Body and background */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #e0f7fa, #f0f4f8);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    /* Profile card */
    .profile-card {
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        padding: 40px 30px;
        max-width: 450px;
        width: 100%;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }

    /* Name section */
    .profile-card h1 {
        font-size: 2rem;
        color: #0b3d91; /* deep US blue */
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .profile-card h1 i {
        color: #f97316; /* orange accent */
        font-size: 1.5rem;
    }

    /* Info boxes */
    .info {
        display: flex;
        align-items: center;
        gap: 15px;
        background-color: #f1f5f9;
        border-radius: 12px;
        padding: 12px 20px;
        margin-bottom: 15px;
        transition: background-color 0.3s;
    }

    .info i {
        font-size: 1.5rem;
        min-width: 30px;
        text-align: center;
    }

    /* Different colors for each icon */
    .icon-experience { color: #2563eb; } /* blue */
    .icon-specialization { color: #059669; } /* green */
    .icon-views { color: #f59e0b; } /* amber */
    .icon-person { color: #f97316; } /* orange */

    .info strong {
        color: #1e293b; /* dark gray */
        margin-right: 5px;
    }

    .info:hover {
        background-color: #e2e8f0;
    }

    /* Responsive */
    @media (max-width: 480px) {
        .profile-card {
            padding: 25px 20px;
        }
        .profile-card h1 {
            font-size: 1.6rem;
        }
        .info i {
            font-size: 1.3rem;
        }
        .info {
            padding: 10px 15px;
        }
    }
</style>
</head>
<body>

<div class="profile-card">
    <h1><i class="fas fa-user icon-person"></i><?= htmlspecialchars($avocat->getName()) ?></h1>

    <div class="info">
        <i class="fas fa-briefcase icon-experience"></i>
        <span><strong>Experience:</strong> <?= $avocat->getExpYears() ?> years</span>
    </div>
    <div class="info">
        <i class="fas fa-gavel icon-specialization"></i>
        <span><strong>Specialization:</strong> <?= $avocat->getSpecialisation()->value ?></span>
    </div>
    <div class="info">
        <i class="fas fa-eye icon-views"></i>
        <span><strong>Views:</strong> <?= $avocat->getNumviwers() ?></span>
    </div>
</div>

</body>
</html>

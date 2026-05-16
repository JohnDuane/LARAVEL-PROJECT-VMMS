<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">

    @vite(['resources/css/app.css'])
</head>

<body>

    @include('layouts.topnav')

<!-- HOME SECTION -->
<section id="home" class="position-relative">

    <!-- Background -->
    <img src="{{ asset('images/carsbg.jpg') }}"
         alt="Background"
         style="
            width: 100%;
            height: 100vh;
            object-fit: cover;
         ">

    <!-- Overlay -->
    <div class="position-absolute w-100 h-100 d-flex flex-column justify-content-center align-items-center"
         style="
            top: 0;
            background: rgba(0,0,0,0.45);
         ">

        <img src="{{ asset('images/BSA-DARK.png') }}"
             alt="Logo"
             style="width: 350px;">

        <h1 class="text-white font-weight-bold mt-4">
            Vehicle Management System
        </h1>

        <p class="text-white text-center mt-2">
            Efficient. Reliable. Modern.
        </p>

    </div>
</section>

<!-- ABOUT SECTION -->
<!-- ABOUT SECTION -->
<section id="about"
         class="container py-5"
         style="min-height: 100vh;">

    <h1 class="font-weight-bold mb-5 text-white text-center text-4xl">
        About Us
    </h1>

    <div class="row align-items-center">

        <!-- IMAGE -->
        <div class="col-md-6 mb-4">
            <img src="{{ asset('images/sideimage.png') }}"
                 alt="Auto Shop"
                 class="img-fluid rounded shadow-lg"
                 style="
                    width: 100%;
                    height: 500px;
                    object-fit: cover;
                 ">
        </div>

        <!-- TEXT -->
        <div class="col-md-6 text-white">

            <h2 class="font-weight-bold mb-4">
                Trusted Auto Repair & Parts Shop
            </h2>

            <p class="mb-4 text-lg leading-relaxed">
                Located in Carmen, Davao del Norte, our auto repair shop is dedicated
                to providing reliable, affordable, and professional vehicle services.
                We specialize in repairing and maintaining different types of vehicles
                including cars, vans, pickups, trucks, and other utility vehicles.
            </p>

            <p class="mb-4 text-lg leading-relaxed">
                With years of hands-on experience, our team focuses on quality
                workmanship, honest service, and customer satisfaction. From basic
                maintenance to major engine and mechanical repairs, we make sure every
                vehicle is properly diagnosed and repaired with care and precision.
            </p>

            <p class="text-lg leading-relaxed">
                Aside from repair services, we also offer quality automotive parts and
                accessories to help keep your vehicle running smoothly and safely.
                Our goal is to become the trusted go-to auto shop for drivers in
                Carmen and nearby areas.
            </p>

        </div>

    </div>

</section>

<!-- SERVICES SECTION -->
<section id="services"
         class="container py-5"
         style="min-height: 100vh;">

    <h1 class="font-weight-bold mb-5 text-white text-center text-4xl">
        Our Services
    </h1>

    <div class="row">

        <!-- SERVICE 1 -->
        <div class="col-md-4 mb-4">
            <div class="bg-dark text-white p-4 rounded shadow-lg h-100">

                <h3 class="font-weight-bold mb-3">
                    Vehicle Repair
                </h3>

                <p>
                    We repair various types of vehicles including cars,
                    vans, pickups, SUVs, and trucks. Our shop handles
                    engine issues, suspension problems, brake repairs,
                    electrical troubleshooting, and more.
                </p>

            </div>
        </div>

        <!-- SERVICE 2 -->
        <div class="col-md-4 mb-4">
            <div class="bg-dark text-white p-4 rounded shadow-lg h-100">

                <h3 class="font-weight-bold mb-3">
                    Preventive Maintenance
                </h3>

                <p>
                    Keep your vehicle in top condition with our preventive
                    maintenance services such as oil changes, tune-ups,
                    fluid replacement, battery checks, and regular inspections
                    to avoid costly repairs.
                </p>

            </div>
        </div>

        <!-- SERVICE 3 -->
        <div class="col-md-4 mb-4">
            <div class="bg-dark text-white p-4 rounded shadow-lg h-100">

                <h3 class="font-weight-bold mb-3">
                    Auto Parts Supply
                </h3>

                <p>
                    We also sell quality automotive parts and accessories
                    for different vehicle models. Whether you need replacement
                    parts, engine components, brake parts, or maintenance items,
                    we’ve got you covered.
                </p>

            </div>
        </div>

        <!-- SERVICE 4 -->
        <div class="col-md-4 mb-4">
            <div class="bg-dark text-white p-4 rounded shadow-lg h-100">

                <h3 class="font-weight-bold mb-3">
                    Engine Diagnostics
                </h3>

                <p>
                    Our diagnostic services help identify engine and system
                    problems quickly and accurately, allowing us to provide
                    efficient repair solutions for your vehicle.
                </p>

            </div>
        </div>

        <!-- SERVICE 5 -->
        <div class="col-md-4 mb-4">
            <div class="bg-dark text-white p-4 rounded shadow-lg h-100">

                <h3 class="font-weight-bold mb-3">
                    Brake & Suspension
                </h3>

                <p>
                    We provide brake inspections, brake pad replacement,
                    suspension repairs, wheel checks, and steering system
                    maintenance to ensure safety and smooth driving.
                </p>

            </div>
        </div>

        <!-- SERVICE 6 -->
        <div class="col-md-4 mb-4">
            <div class="bg-dark text-white p-4 rounded shadow-lg h-100">

                <h3 class="font-weight-bold mb-3">
                    Customer Support
                </h3>

                <p>
                    We believe in honest communication, fair pricing,
                    and dependable service. Our team is always ready to
                    assist customers with vehicle concerns and repair advice.
                </p>

            </div>
        </div>

    </div>

</section>

</body>

<script>

    const navbar = document.getElementById('topNavbar');

    let lastScroll = 0;
    let isHidden = false;

    // SCROLL DETECTION
    window.addEventListener('scroll', () => {

        const currentScroll = window.pageYOffset;

        // Hide when scrolling down
        if(currentScroll > lastScroll && currentScroll > 100){

            navbar.classList.add('hide-nav');
            isHidden = true;
        }

        // Show when scrolling up
        else{

            navbar.classList.remove('hide-nav');
            isHidden = false;
        }

        lastScroll = currentScroll;
    });

    // MOUSE DETECTION
    document.addEventListener('mousemove', (e) => {

        // Cursor near top
        if(e.clientY < 80){

            navbar.classList.remove('hide-nav');
        }

        // Cursor NOT near top
        else if(isHidden){

            navbar.classList.add('hide-nav');
        }
    });

</script>
</html>
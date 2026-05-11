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
    <img src="{{ asset('images/carsbg.jpeg') }}"
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
<section id="about"
         class="container py-5 mt-[50px]"
         style="min-height: 100vh; ">

    <h1 class="font-weight-bold mb-14 text-white text-center text-4xl">
        About Us
    </h1>

    <div class="d-flex gap-4 text-center">
        <p class="text-white flex-fill px-[50px] py-[25px] text-xl">
            Our auto repair shop, located in Carmen, Davao del Norte, Philippines, 
            is a trusted local service center dedicated to providing reliable and 
            high-quality automotive repairs. We cater to a wide range of vehicle concerns, 
            from routine maintenance such as oil changes and tune-ups to more complex engine 
            diagnostics and mechanical repairs. With a commitment to honesty and efficiency, 
            we ensure that every customer receives proper care for their vehicle at a fair 
            and reasonable price.
        </p>

        <p class="text-white flex-fill px-[50px] py-[25px] text-xl">
            The shop is proudly run by Bernie S. Aranda, whose hands-on experience and 
            dedication to quality service have built a strong reputation in the community. 
            Under his leadership, the business continues to prioritize customer satisfaction, 
            safety, and long-term vehicle performance. Our goal is to be the go-to auto repair 
            shop in the area, offering dependable service that drivers in Carmen and nearby towns 
            can always rely on.
        </p>
    </div>

</section>

<!-- SERVICES SECTION -->
<section id="services"
         class="container py-5"
         style="min-height: 100vh;">

    <h1 class="font-weight-bold mb-4 text-white text-center text-4xl">
        Services
    </h1>

    <p class="text-white">
        Put your services here.
    </p>

    

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
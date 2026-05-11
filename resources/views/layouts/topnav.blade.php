<nav id="topNavbar" class="navbar navbar-expand-lg"
     style="
        background-color: rgba(35,35,35,0.9);
        backdrop-filter: blur(8px);
        position: sticky;
        top: 0;
        z-index: 1000;
     ">

        <div class="container">
            <div class="row">
                <img class="my-1.5" style="width: 140px; height: 70px;" src="{{ asset('images/HEAD-LOGO-LIGHT.png') }}" alt="Logo">
            </div>
            

            <div class="navbar-collapse">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item mx-2 font-weight-bold">
                    <a class="nav-link active"
                    style="color: #E9E9E9; font-size: 18px;"
                    href="#home">
                    Home
                    </a>
                </li>

                <li class="nav-item mx-2 font-weight-bold">
                    <a class="nav-link"
                    style="color: #E9E9E9; font-size: 18px;"
                    href="#about">
                    About Us
                    </a>
                </li>

                <li class="nav-item mx-2 font-weight-bold">
                    <a class="nav-link"
                    style="color: #E9E9E9; font-size: 18px;"
                    href="#services">
                    Services
                    </a>
                </li>

                <li class="nav-item font-weight-bold ms-3">
                    <a class="nav-link px-3 py-2"
                    style="color: #E9E9E9; font-size: 18px; background-color: #ff8800; border-radius: 30px;"
                    href="{{ route('login') }}">
                    Log in as admin
                    </a>
                </li>

            </ul>
            </div>
        </div>
</nav>


<style>

    html {
        scroll-behavior: smooth;
    }

    /* NAVBAR */
    #topNavbar{
        background-color: rgba(35,35,35,0.9);
        backdrop-filter: blur(8px);

        position: fixed;
        top: 0;
        width: 100%;

        z-index: 1000;

        transition: transform 0.4s ease;
        animation: bgslide 1.5s ease-in backwards;
    }

    /* Hidden State */
    #topNavbar.hide-nav{
        transform: translateY(-100%);
    }

    @keyframes bgslide {

        0%{
            opacity: 0;
            transform: translateY(-30px);
        }

        100%{
            opacity: 1;
            transform: translateY(0);
        }
    }

</style>
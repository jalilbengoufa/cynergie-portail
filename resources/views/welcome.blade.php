<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="/manifest.webmanifest">
    <title>Cynergie</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}" media="screen">
    <link rel='shortcut icon' href='http://cedille.etsmtl.ca/favicon.ico' type='image/x-icon'/>
    <link rel="stylesheet" href="{{ asset('css/animate-min.css')}}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}" media="screen">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

</head>
<body>
<div id="app">
    <section class="hero  is-info is-large is-bold  ">
        <div class="hero-head ">
            <nav class="navbar  is-fixed-top  ">
                <div class="container">
                    <div class="navbar-brand ">
                        <a class="navbar-item" href="/">
                            <picture>
                                <img src="img/cynergie-logo-white.png" alt="Logo">
                            </picture>

                        </a>
                        <div class="navbar-burger burger" data-target="navbarMenu"
                             onclick="document.querySelector('.navbar-menu').classList.toggle('is-active');">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                    <div id="navbarMenu" class="navbar-menu "
                         onclick="document.querySelector('.navbar-menu').classList.toggle('is-active');">
                        <div class="navbar-end">
                            <a href="#" class="navbar-item ">
                                Projet
                            </a>
                            <a href="#maitrîse" class="navbar-item ">
                                Maitrîse
                            </a>
                            <a href="#technologie" class="navbar-item ">
                                Technologies
                            </a>
                            <a href="#partenaires" class="navbar-item ">
                                Partenaires
                            </a>
                            <a class="navbar-item" href="#contact">
                                Contact
                            </a>
                            <a class="navbar-item" href="{{ url('/grafana') }}">
                                Grafana
                            </a>
                            @if (Route::has('login'))
                                @auth
                                    <a class="navbar-item" href="{{ url('/home') }}">Home</a>
                                @else
                                    <a class="navbar-item" v-b-modal.login>Login</a>
                                    <a class="navbar-item" v-b-modal.register>Register</a>
                                    {{--                                                <a class="navbar-item" href="{{ route('login') }}">Login</a>
                                                                                        <a class="navbar-item" href="{{ route('register') }}">Register</a>--}}
                                @endauth

                            @endif
                            <span class="navbar-item">
                                    <a class="button is-white is-outlined is-small" href="http://cedille.etsmtl.ca/">
                                    <span class="icon">
                                                <i class="far fa-copyright"></i>
                                    </span>
                                    <span>Club cedille</span>
                                    </a>
                                    </span>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title home animated flipInX">
                    Çynergie
                </h1>
                <h2 class="subtitle home animated flipInX">
                    Consommation énergétique en temps réel
                </h2>
            </div>

        </div>
    </section>
    <b-modal id="login" size="lg" title="Login" body-bg-variant="light" header-bg-variant="success"
             header-text-variant="white" centered hide-footer lazy>

        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf

            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                           required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-success">
                        {{ __('Login') }}
                    </button>

                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            </div>
        </form>
    </b-modal>
    <b-modal id="register" size="lg" title="Register" body-bg-variant="light" header-bg-variant="primary"
             header-text-variant="white" centered hide-footer lazy>
        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                           required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm"
                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </b-modal>
    <section id="resumer" class="section">
        <div class="intro column is-8 is-offset-2">
            <div class="content has-text-centered">
                <h3>Çynergie a pour but de fournir une interface de visualisation en temps réel de la consommation des
                    ressources
                    énergétiques de l'École de technologie supérieure(ETS). Cela peut inclure la consommation d'eau,
                    d'électricité,
                    de gaz, etc.</h3>
            </div>
        </div>
        <div class="tile is-ancestor">
            <div class="tile is-4 is-parent ">
                <div class="tile is-child box">

                    <p class="title">
                        Temps réel
                    </p>
                    <p id="tileText1" class="content center ">
                        Récupérer les données de la consommation énergétique de l'ETS en temps réel à partir des
                        contrôleurs connectés aux réseaux
                        des différents bâtiments de l'École de technologie supérieure. La récupération des données sera
                        effectuée de façon
                        efficace pour que les données puissent être fiables et utilisées par les étudiants, les
                        professeurs et par le public
                        pour de la recherche ou autres.<br>

                    </p>
                    <div id="container"></div>


                </div>
            </div>
            <div class="tile is-4 is-parent ">
                <div class="tile is-child box">
                    <p class="title">
                        Graphiques et tableaux
                    </p>
                    <p id="tileText2" class="content center ">
                        Un premier portail est disponible pour la visualisation des données à l’aide de graphiques et de
                        tableaux. Cette plateforme
                        se nommant Grafana, le project Çynergie l’utilise pour pour afficher des graphiques et des
                        tableaux qui illustrent la consommation
                        d’énergie des différents modules de l'École de technologie supérieure. En ce moment ce portail
                        sera accessible avec une authentification unique pour des raisons de sécurité.
                    </p>
                    <div id="container2"></div>

                </div>
            </div>
            <div class="tile is-4 is-parent ">
                <div class="tile is-child box">
                    <p class="title">
                        Portail et API
                    </p>
                    <p id="tileText3" class="content center ">
                        Un deuxième portail Çynergie sera implémenté pour permettre aux étudiants ou aux professeurs de
                        télécharger facilement les données
                        dynamiquement et les exporter en des fichiers CSV ou JSON. De plus une API REST sera disponible
                        pour faciliter l’accès aux données et
                        permettre à l’utilisateur de les exploiter quel que soit le logiciel qu’il utilise.<br>

                    </p>
                    <div id="container3"></div>
                </div>
            </div>
        </div>
    </section>
    <div class="mongrad">
        <section id="maitrîse" class="section">
            <div class="container ">
                <div class="columns">
                    <div class="column">
                        <div class="content">
                            <h1 class="title has-text-white">Projet de maitrîse : </h1>

                            <h3 class="has-text-white">Portée : </h3>
                            <p class="has-text-white">
                                Ce projet concerne la création d’une plateforme permettant de grouper différentes
                                sources de données. Le but est de pouvoir
                                y agréger des données filtrées et fournir des données pouvant subir un post-traitement à
                                la fois pour une diffusion en temps réel que pour permettre un téléchargement par lots.
                                Il est nécessaire d’identifier les sources de données pour être capable de les stocker
                                en
                                ayant subi un prétraitement afin d’assurer une uniformité des données. Depuis la
                                solution
                                de stockage il doit être possible de les distribuer, brutes ou ayant subi un
                                post-traitement
                                de deux manières différentes. En tant que flux de données en temps réel ou par lots afin
                                d’accéder à des données historiques.*
                            </p>

                            <h3 class="has-text-white">Objectifs : </h3>
                            <p class="has-text-white">
                                Le produit s’adresse à la communauté étudiante dans son ensemble allant des utilisateurs
                                souhaitant consulter les données
                                pour des projets d’exposition des données jusqu’à des équipes de chercheurs souhaitant
                                valider
                                des théories. La plateforme propose une réponse à ce besoin d’uniformiser l’accès aux
                                données
                                en proposant de centraliser un maximum de sources de données différentes et de les
                                distribuer
                                ensuite dans des formats standards et documentés.*
                            </p>
                            <h3 class="has-text-white">Architecture du project Çynergie : </h3>

                            <picture>
                                <source type="image/webp" srcset="img/webP/plateform.webp">
                                <source srcset='img/jpeg2000/plateform_generic-page-001.jp2' type='image/jp2'>
                                <img src="img/plateform.jpg" alt="Architecture image">
                            </picture>
                            <figcaption class="has-text-white">
                                * Conception d’un portefeuille de projets exploitant les technologies de l’Internet des
                                Objets pour la gestion des bâtiments
                                de l’ETS par Gautier COLAJANNI
                            </figcaption>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="backgroundNode">
        <section id="technologie" class="section">
            <div class="container contact ">
                <div class="content ">
                    <h1 class="title ">Les technologies utilisées : </h1>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="columns">
                <div class="column is-one-fifth">
                </div>
                <div class="column">
                    <a href="https://www.typescriptlang.org/">
                        <picture>
                            <source srcset='img/jpeg2000/TypeScript.jp2' type='image/jp2'>
                            <img src="img/TypeScript.png" height="200" width="200" alt="Logo typescript">
                        </picture>

                    </a>
                    <br>
                    <a href="https://nodejs.org/en/">
                        <img src="img/nodejs.png" height="200" width="200" alt="Logo nodejs">
                    </a>
                </div>
                <div class="column">
                    <h2>

                        <br> Ces langages sont utilisés pour implementer l'adapteur Çynergie qui permet de récupérer les
                        données en temps
                        réel et les exposer à la base de données Prometheus.
                    </h2>
                </div>
                <div class="column is-one-fifth">
                </div>
            </div>
        </section>
    </div>
    <div class="backgroundApi ">
        <section class="section">
            <div class="columns">
                <div class="column is-one-fifth">
                </div>
                <div class="column">
                    <a href="http://searchmicroservices.techtarget.com/definition/RESTful-API">
                        <img src="https://www.odoo.com/apps/icon_image?module_id=19345" height="200" width="200"
                             alt="Logo api">
                    </a>
                </div>
                <div class="column">
                    <h2>

                        <br> Ce type d’API sera exploité pour faciliter l’accès aux données aux differents logiciels de
                        traitement de façon
                        efficace et sécuritaire.
                    </h2>
                </div>
                <div class="column is-one-fifth">
                </div>
            </div>
        </section>
    </div>
    <div class="prometheus">
        <section class="section">
            <div class="columns">
                <div class="column is-one-fifth">
                </div>
                <div class="column">
                    <a href="https://prometheus.io/">
                        <br>
                        <br>
                        <br>
                        <img src="img/prometheus_logo.png" height="200"
                             width="200" alt="Logo prometheus">
                    </a>
                </div>
                <div class="column ">
                    <div class="content ">

                        <h3 class="title has-text-white">Prometheus</h3>
                    </div>
                    <p class="has-text-white " id="textsize">
                        Prometheus c'est un outil de monitorage et d'alerte de systèmes Open Source, créée à l'origine
                        par SoundCloud. Depuis sa création en 2012, de nombreuses entreprises et organisations ont
                        adopté Prometheus, et le projet a une communauté de développeurs et d'utilisateurs très active.
                        C'est maintenant un projet Open Source autonome et maintenu indépendamment de toute entreprise.
                        Pour souligner cela, et pour clarifier la structure de gouvernance du projet, Prometheus a
                        rejoint la Cloud Native Computing Foundation en 2016 en tant que deuxième projet hébergé, après
                        Kubernetes.
                    </p>
                </div>
                <div class="column is-one-fifth">
                </div>
            </div>
        </section>
    </div>
    <div class="grafana">
        <section class="section">
            <div class="columns">
                <div class="column is-one-fifth">
                </div>
                <div class="column ">
                    <a href="https://grafana.com/">
                        <picture>
                            <source type="image/webp" srcset="img/webP/grafana.webp">
                            <source srcset='img/jpeg2000/grafana_logo.jp2' type='image/jp2'>
                            <img src="img/grafana_logo.jpg" height="200" width="200" alt="Logo grafana">
                        </picture>

                    </a>
                </div>
                <div class="column ">
                    <div class="content ">
                        <h3 class="title has-text-white">Grafana</h3>
                    </div>
                    Grafana est le logiciel de facto pour l'analyse des séries temporelles, avec plus de 100 000
                    installations actives. Les clients se tournent vers Grafana Labs pour rassembler leurs sources de
                    données disparates, via des logiciels neutres et open source.
                </div>
                <div class="column is-one-fifth">
                </div>
            </div>
            <div class="container">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">

                            <picture>
                                <source type="image/webp" srcset="img/webP/grafana1.webp">
                                <source srcset='img/jpeg2000/grafana1.jp2' type='image/jp2'>
                                <img src="img/grafana1.png" alt="Chicago" style="width:100%;">
                            </picture>

                        </div>
                        <div class="item">
                            <picture>
                                <source type="image/webp" srcset="img/webP/grafana2.webp">
                                <source srcset='img/jpeg2000/grafana2.jp2' type='image/jp2'>
                                <img src="img/grafana2.png" alt="Chicago" style="width:100%;">
                            </picture>

                        </div>
                        <div class="item">
                            <picture>
                                <source type="image/webp" srcset="img/webP/grafana3.webp">
                                <source srcset='img/jpeg2000/grafana3.jp2' type='image/jp2'>
                                <img src="img/grafana2.png" alt="Chicago" style="width:100%;">
                            </picture>
                        </div>
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </section>
    </div>
    <section id="partenaires" class="section">
        <div class="container contact">
            <h4 class="title">
                Partenaires
                <br>
            </h4>
            <div class="columns features">
                <div class="column gap">
                    <div class="content center">
                        <a href="https://etsmtl.ca">


                            <img src="img/ets_logo.png" height="200" width="200" alt="Logo ets">
                        </a>
                    </div>
                </div>
                <div class="column">
                    <div class="content center">
                        <a href="https://cedille.etsmtl.ca">
                            <picture>
                                <source type="image/jp2" srcset="img/jpeg2000/cedille-logo.jp2">
                                <img src="img/cedille-logo.png" height="200" width="200" alt="Logo cedille">
                            </picture>
                        </a>
                    </div>
                </div>
                <div class="column">
                    <div class="content center">
                        <a href="https://www.bnc.ca/">

                            <picture>
                                <source type="image/webp" srcset="img/webP/bnc.webp">
                                <img src="img/bnc.jpg" height="400" width="400" alt="Logo banque national">
                            </picture>

                        </a>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section id="contact" class="section is-medium">
        <div class="container contact">
            <h4 class="title">
                Contact
                <br>
                <br>

            </h4>
            <address class="adresse">
                <strong>Email</strong>:&nbsp;&nbsp;<a href="mailto:cedille@ens.etsmtl.ca">cedille@ens.etsmtl.ca</a>
                <br>
                <strong>Téléphone</strong>: (514) 396-8800 ext.7302
                <br>
                <strong>Visitez nous au</strong> :
                <br> 1100, rue Notre-Dame Ouest
                <br> Montréal (Québec) H3C 1K3
                <br> Local A-1304 (partagé avec club ApplETS)
                <br> Canada
            </address>
            <section class="section is-small ">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3325.9302763822852!2d-73.5649800972535!3d45.49472019086769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc91a60aa839707%3A0xb732a719a45c45f6!2s%C3%89cole+de+technologie+sup%C3%A9rieure+%C3%89TS!5e0!3m2!1sen!2sca!4v1518919044091"
                        width="100%" height="500" frameborder="0" style="border:0" allowfullscreen
                        title="googlemap"></iframe>
            </section>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="columns features">
                <div class="column gap">
                    <div class="content is-offset-2 center">
                        <p class="has-text-centered"> Copyleft
                            <span class="Copyleft">©</span> Club Cedille</p>
                        <a class="button is-link is-outlined" href="https://www.facebook.com/clubcedille">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="button is-link is-outlined" href="/contact" alt="cynergie">
                            <i class="far fa-envelope"></i>
                        </a>
                        <a class="button is-link is-outlined"
                           href="https://github.com/ClubCedille?utf8=%E2%9C%93&q=cynergie&type=&language=">
                            <i class="fab fa-github"></i>
                        </a>
                        <a class="button is-link is-outlined" href="https://www.linkedin.com/company/cedille">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
<!-- Scripts -->
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="{{ asset('js/main.js')}}"></script>
<script src="{{ asset('js/progressbar.js')}}"></script>
<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>

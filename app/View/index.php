<?php

    namespace app\View;

    Class Index
    {
        private $model;
        private $controller;

        public function __construct($model, $controller) {
            $this->model        = $model;
            $this->controller   = $controller;
        }

        public function startHtml() {

            $html = '
                <!DOCTYPE html>
                <html lang="en">
                    <head>
                        <title>' . ucfirst($this->model->getPage()) . ' - Bake N Go</title>
                        
                        <meta charset="UTF-8">
                        <meta name="description" content="Bake N Go, Click and collect Bakery">
                        <meta name="keywords"    content="Bake and Go, Bake N Go, Bakery, Cakes, Bread, Cupcakes, Click, Collect, Pick up, Collection, Ordering, Reserve">
                        <meta name="author"      content="Andreas Learmonth">
                        <meta name="viewport"    content="width=device-width, initial-scale=1.0">

                        <link rel="apple-touch-icon" sizes="180x180" href="public/img/apple-touch-icon.png">
                        <link rel="icon" type="image/png" sizes="32x32" href="public/img/favicon-32x32.png">
                        <link rel="icon" type="image/png" sizes="16x16" href="public/img/favicon-16x16.png">
                        <link rel="manifest" href="site.webmanifest">
                        <link rel="mask-icon" href="public/img/safari-pinned-tab.svg" color="#5bbad5">
                        <link rel="shortcut icon" href="public/img/favicon.ico">
                        <meta name="msapplication-TileColor" content="#00aba9">
                        <meta name="msapplication-config" content="public/img/browserconfig.xml">
                        <meta name="theme-color" content="#ffffff">
                        
                        <link rel="stylesheet" type="text/css" href="public/css/normalize.css"                       />
                        <link rel="stylesheet" type="text/css" href="public/css/index.css"                           />
                        <link rel="stylesheet" type="text/css" href="public/css/' . $this->model->getPage() . '.css" />
                    </head>
                    <body>
            ';

            return $html;
        }

        public function endHtml() {

            $html = '
                        <script src="public/js/index.js"></script>
                        <script src="public/js/' . $this->model->getPage() . '.js"></script>
                    </body>
                </html>
            ';

            return $html;
        }

        public function header() {

            $html = '
                <header>
                    
                    <img src="public/img/Logo.webp" alt="Bake N Go Logo" class="logo" /> 
                    
                    <section class="site">
                        <h1 class="company">
                            Bake N Go
                        </h1>
                        
                        <p class="strapline">
                            The click and collect bakery
                        </p>
                    </section>
                    
                    <nav>
                        <a href="?p=home"    aria-label="Home page">    Home    </a> |
                        <a href="?p=store"   aria-label="Store page">   Store   </a> |
                        <a href="?p=faq"     aria-label="FAQs page">    FAQ     </a> |
                        <a href="?p=contact" aria-label="Contacts page">Contact </a>
                    </nav>
                </header>
                <main>
            ';

            return $html;
        }

        public function footer() {

            $html = '
                </main>
                <footer>
                    <section class="flex-container-footer">
                        <article class="footerItem">
                            Email:
                            <a href="mailto:aclearmonth@gmail.com">
                                aclearmonth@gmail.com
                            </a>
                        </article>
                        <article class="footerItem">
                            Phone:
                            <a href="tel:00447850996371">
                                07850 996371
                            </a>
                        </article>
                        <article class="footerItem">
                            <!-- [Social Media] -->
                            <a href="https://www.facebook.com/anders.learmonth" target="_blank" rel="noreferrer">
                                <picture>
                                    <source srcset="public/img/facebook.jpg" class="socialMedia">
                                    <img src="public/img/facebook.jpg" alt="Facebook" class="socialMedia">
                                </picture>
                            </a>
        
                            <a href="https://www.instagram.com/dregozone/" target="_blank" rel="noreferrer">
                                <picture>
                                    <source srcset="public/img/instagram.jpg" class="socialMedia">
                                    <img src="public/img/instagram.jpg" alt="Instagram" class="socialMedia">
                                </picture>
                            </a>
        
                            <a href="https://www.linkedin.com/in/andreas-learmonth-982318a1/" target="_blank" rel="noreferrer">
                                <picture>
                                    <source srcset="public/img/linkedin.jpg" class="socialMedia">
                                    <img src="public/img/linkedin.jpg" alt="LinkedIn" class="socialMedia">
                                </picture>
                            </a>
                        </article>
                    </section>
        
                    <section class="copyright">
                        &copy; Copyright 2019
                    </section>
                </footer>
            ';

            return $html;
        }

        public function success($msg) {

            $html = '
                <article class="success">
                    ' . $msg . '
                </article>
            ';

            return $html;
        }

        public function error($msg) {

            $html = '
                <article class="error">
                    ' . $msg . '
                </article>            
            ';

            return $html;
        }
    }

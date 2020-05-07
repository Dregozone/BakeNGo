<?php

namespace app\View;

Class Contact
{
    private $model;
    private $controller;

    public function __construct($model, $controller) {
        $this->model        = $model;
        $this->controller   = $controller;
    }

    public function title($title) {

        $html = '
                <h1 class="title">
                    ' . $title . '
                </h1>
            ';

        return $html;
    }

    public function showForm() {

        if ( $_SESSION["userName"] == "none" ) {
            $name  = '<input type="text" id="name" name="name" placeholder="Name" tabindex="1" autofocus required />';
            $email = '<input type="email" id="email" name="email" placeholder="Email" tabindex="2" required />';
        } else {
            $this->model->getMIndex()->findUser($_SESSION["userName"]);

            $name  = '
                <input type="text" id="nameVis" name="nameVis" value="' . $_SESSION["userName"] . '" required disabled />
                <input type="hidden" id="name" name="name" value="' . $_SESSION["userName"] . '" required />
            ';
            $email = '
                <input type="email" id="emailVis" name="emailVis" value="' . $this->model->getMIndex()->getUser()[0]["email"] . '" required disabled />
                <input type="hidden" id="email" name="email" value="' . $this->model->getMIndex()->getUser()[0]["email"] . '" required />
            ';
        }

        $html = '
            <section class="contactForm">
                <form id="contactForm" action="?p=contact" method="post">
                    <article>
                        <label for="name"> (*) Name: </label>
                        ' . $name . '
                    </article>
                    
                    <article>
                        <label for="email"> (*) Email: </label>
                        ' . $email . '
                    </article>
                    
                    <article class="top">
                        <label for="message" class="topLabel"> (*) Message: </label>
                        <textarea id="message" name="message" placeholder="Message" class="topTextArea" tabindex="3" required></textarea>
                    </article>
                </form>
                    
                <article class="formOptions">
                    <button onclick="clearForm();" tabindex="4">Clear</button>
                    <button onclick="submitForm();" tabindex="5">Send</button>
                </article>
                
                <article class="note">
                    Please note fields marked with (*) are required.
                    
                    <p id="error" class="note"></p>
                </article>
            </section>
        ';

        return $html;
    }
}

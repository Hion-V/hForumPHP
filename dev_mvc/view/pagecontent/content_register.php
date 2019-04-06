<script type="text/javascript" src="./view/js/checkform.js"></script>   
<article>
    <form action="?p=attempt_register" method="post">
        Username: <input type="text" name="name" id="name" onkeyup="checkInputs()"><br>
        E-mail: <input type="text" name="email" id="email" onkeyup="checkInputs()"><br>
        Password: <input type="password" name="pass" id="pass" onkeyup="checkInputs()"><br>
        Verify Password: <input type="password" name="pass2" id="pass2" onkeyup="checkInputs()"><br>
        <input type="submit" id="submitButton" disabled>
    </form>
    <div id="jsSignupAlert"></div>
</article>
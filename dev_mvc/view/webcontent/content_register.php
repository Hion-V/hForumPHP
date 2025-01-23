<script type="text/javascript" src="./view/js/checkform.js"></script>   
<article>
    <form action="?model=attempt_register" method="post">
        <input type="text" name="name" id="name" placeholder="Username" onkeyup="checkInputs()"><br>
        <input type="text" name="email" id="email" placeholder="E-mail" onkeyup="checkInputs()"><br>
        <input type="password" name="pass" id="pass" placeholder="Password" onkeyup="checkInputs()"><br>
        <input type="password" name="pass2" id="pass2" placeholder="Verify Password" onkeyup="checkInputs()"><br>
        <input type="hidden" name="action" value="do_register" />
        <input type="submit" id="submitButton" disabled>
    </form>
    <div id="jsSignupAlert"></div>
</article>
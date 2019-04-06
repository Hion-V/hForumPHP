var arrWarnings = [];
var arrProblems = [];

function checkInputs(){
    var boolProblem = false;
    document.getElementById("jsSignupAlert").innerHTML = "";
    if(document.getElementById("name").value == ""){
        arrWarnings[0] = "name field is empty<br>";
        boolProblem = true
    }
    else{
        arrWarnings[0] = "";
    }
    if(document.getElementById("email").value == ""){
        arrWarnings[1] = "email field is empty<br>";
        boolProblem = true
    }
    else{
        arrWarnings[1] = ""
    }
    if(document.getElementById("pass").value == ""){
        arrWarnings[2] = "pass field is empty<br>";
        boolProblem = true
    }
    else{
        arrWarnings[2] = ""
    }1
    if(document.getElementById("pass2").value == ""){
        arrWarnings[3] = "pass verification field is empty<br>";
        boolProblem = true
    }
    else{
        arrWarnings[3] = ""
    }
    if(document.getElementById("pass").value == document.getElementById("pass2").value){
        arrWarnings[4] = "";
    }
    else{
        arrWarnings[4] = "pass verification field doesnt match";
        boolProblem = true
    }
    for (var i = 0; i < arrWarnings.length; i++) {
        document.getElementById("jsSignupAlert").innerHTML += arrWarnings[i];
    }
    if(boolProblem){
        document.getElementById("submitButton").disabled = true;
    }
    else{
        document.getElementById("submitButton").disabled = false;
    }
}
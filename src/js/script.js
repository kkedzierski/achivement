var newLine = 0;

var NewAchTexA1 = '<div class="row align-items-center"><div class="col-2 px-0"><button class="btn btn-block btn-primary btn-lg" onclick="del(';
var NewAchTexA2 = ');">-></button></div><div class="col-7 px-1">';
var NewAchTexA11 = '<div class="row align-items-center"><div class="col-2 px-0"><button class="btn btn-block btn-success btn-lg" onclick="undel(';
var NewAchTexA22 = ');">:)</button></div><div class="col-7 px-1">';

var NewAchTexB = '</div><div class="col-3 px-0 myright">';
var NewAchTexC = '</div></div><hr>';
var achiv = [];
var date = "";
var dateDM = [];
var arNr = 0;

function add() {
    achiv[arNr] = document.getElementById("achiv").value;
    date = document.getElementById("date").value;

    dateDM[arNr] = date.replace('2020-','');

    var NewAchivDiv = document.createElement("div");
    NewAchivDiv.setAttribute("id", "New" + newLine);
    
    var NewAchivText = NewAchTexA1 + newLine + NewAchTexA2 + achiv[arNr] + NewAchTexB + dateDM[arNr] + NewAchTexC;
    
    if (achiv[arNr] == "" || dateDM[arNr] == "") {
        alert("Proszę uzupełnić osiągnięcie i datę!");
        return;
    } else {
    NewAchivDiv.innerHTML = NewAchivText;
    document.getElementById("New").appendChild(NewAchivDiv);
    }

    newLine = newLine + 1;
    arNr = arNr + 1
}


function del(buttonNumber) {

    document.getElementById("New" + buttonNumber).innerHTML = NewAchTexA11 + buttonNumber + NewAchTexA22 + "<s>" + achiv[buttonNumber] +"</s>"+ NewAchTexB + "<s>" + dateDM[buttonNumber] + "</s>" + NewAchTexC;

}

function undel(buttonNumber) {
    
    document.getElementById("New" + buttonNumber).innerHTML = NewAchTexA1 + buttonNumber + NewAchTexA2 + achiv[buttonNumber] + NewAchTexB + dateDM[buttonNumber] + NewAchTexC;
    
}

// 1. linia ma del 1 i new 1
// 2. funkcja wczytuje ktory del i przekreśla new1

// 1. Klikasz/ onlclik funkcja add
// 2. Wyświetlasz/ button id2/ input text/ oraz input date/
// 3. zapisujesz w zmiennych/ var achiv i var date
// 5. Zatwierdzasz przyciskiem/ button id2
// 5. Tworzysz div z osiagnieciem/ create element wypisujesz achiv i date
// 6. kasujesz/ button id2/ input text inpuut date
// 2. Pytanie o osiągniecie/ prompt  Zapis w/ var achiv
// 3. Pytasz o date wykonania/ prompt Zapis w/ var date
// 4. Tworzysz div/ createelement wypisujesz/ achiv i date

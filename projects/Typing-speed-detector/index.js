const setofWords = [ "Web developers build and maintain websites and web applications,using programming,design tools and languages such as HTML,CSS and JS.",
"Engineering is the creative application of science,mathematical methods and empirical evidence to the innovation,design,devices,systems and processes.",
"This is a simple website made by HTML,CSS and JS.Just write the text which is shown above and this website will automatically calculate your typing speed.",];

const msg = document.getElementById('msg');
const typeWords = document.getElementById('myWords');
const btn = document.getElementById('btn');
let startTime ,endTime;

const playGame = () =>{
    let randomNumber = Math.floor(Math.random()*setofWords.length);
    msg.innerText = setofWords[randomNumber];
    let date = new Date();
    startTime = date.getTime();
    btn.innerText="Done";
}

const endPlay = () =>{
    let date = new Date();
    endTime = date.getTime();
    let totalTime = ((endTime - startTime)/1000);
    console.log(totalTime);

    let totalStr = typeWords.value;
    let wordCount = wordCounter(totalStr);

    let speed = Math.round((wordCount/totalTime)*60);
    let finalMsg = "You typed total " +speed+ " words per minutes and ";
    finalMsg += compareWords(msg.innerText,totalStr);

    msg.innerText = finalMsg;
}

const compareWords = (str1 ,str2) =>{
    let words1 = str1.split(" ");
    let words2 = str2.split(" ");

    let cnt = 0;

    words1.forEach(function (item, index){
        if(item == words2[index]){
            cnt++;
        }
    })

    let errorWords = ( words1.length - cnt );
    return (cnt + " correct out of " + words1.length + " words and the total number of error are "+ errorWords + "." );
}

const wordCounter = (str) =>{
    let response = str.split(" ").length;
    console.log(response);
    return response;
}

btn.addEventListener('click',function(){
    console.log(this);
    if(this.innerText =="Start"){
        typeWords.disabled = false;
        playGame();
    }
    else if(this.innerText =="Done"){
        typeWords.disabled = true;
        btn.innerText = "Start";
        endPlay();
    }
})

//variables

const listaTweets = document.querySelector('#lista-tweets');

//event listeners

eventListeners();

function eventListeners(){
    //cuando se envia el formulario
    document.querySelector('#formulario').addEventListener('submit',agregarTweet);

    //borrar tweet
    listaTweets.addEventListener('click',borrarTweet);
}

//funciones

function agregarTweet(event){
    event.preventDefault();

    const tweet = document.getElementById('tweet').value;
    const botonBorrar = document.createElement('a');
    botonBorrar.classList = 'borrar-tweet';
    botonBorrar.textContent = 'X';

    let nuevoTweet = document.createElement('li');
    nuevoTweet.textContent = tweet;
    nuevoTweet.appendChild(botonBorrar);

    listaTweets.appendChild(nuevoTweet);
}

function borrarTweet(event){
    event.preventDefault()

    if(event.target.className == 'borrar-tweet'){
        console.log(event.target.parentElement.remove());
    }
}